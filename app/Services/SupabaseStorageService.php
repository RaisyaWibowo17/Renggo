<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Talks directly to the Supabase Storage REST API so uploaded files
 * (profile photos, UMKM covers/galleries, promo banners, review photos)
 * land in the Supabase Storage bucket configured in SUPABASE_STORAGE_BUCKET.
 *
 * PENTING: kalau Supabase belum dikonfigurasi dengan benar (URL/anon key
 * kosong, masih placeholder, salah, bucket belum dibuat, dsb), service ini
 * TIDAK melempar error ke pengguna. Ia otomatis fallback menyimpan file ke
 * disk lokal Laravel (storage/app/public, diakses lewat `php artisan
 * storage:link`), supaya form pendaftaran/edit tetap bisa disubmit dan foto
 * tetap tersimpan & tampil walau kredensial Supabase belum lengkap.
 */
class SupabaseStorageService
{
    protected Client $client;

    protected string $baseUrl;

    protected string $bucket;

    protected string $apiKey;

    public function __construct()
    {
        $this->baseUrl = rtrim((string) config('services.supabase.url'), '/');
        $this->bucket = (string) config('services.supabase.bucket', 'umkm');
        $this->apiKey = (string) (config('services.supabase.service_role_key') ?: config('services.supabase.anon_key'));

        $this->client = new Client([
            'base_uri' => $this->baseUrl ?: 'http://localhost',
            'timeout' => 15,
        ]);
    }

    protected function isSupabaseConfigured(): bool
    {
        return filled($this->baseUrl) && filled($this->apiKey);
    }

    /**
     * Upload a file into a folder inside the bucket and return its stored
     * (relative) path. Falls back to the local "public" disk automatically
     * if Supabase is not configured or the request to Supabase fails.
     */
    public function upload(UploadedFile $file, string $folder): string
    {
        $filename = $folder.'/'.Str::uuid().'.'.$file->getClientOriginalExtension();

        if ($this->isSupabaseConfigured()) {
            try {
                $this->client->post("/storage/v1/object/{$this->bucket}/{$filename}", [
                    'headers' => [
                        'Authorization' => 'Bearer '.$this->apiKey,
                        'Content-Type' => $file->getMimeType(),
                        'x-upsert' => 'true',
                    ],
                    'body' => fopen($file->getRealPath(), 'r'),
                ]);

                return $filename;
            } catch (\Throwable $e) {
                report($e);
                // Lanjut ke fallback lokal di bawah — jangan gagalkan
                // submit form pengguna hanya karena Supabase bermasalah
                // (key salah/placeholder, bucket belum ada, dsb).
            }
        }

        $file->storeAs($folder, basename($filename), 'public');

        return $filename;
    }

    /**
     * Replace an existing file: uploads the new one and deletes the old path.
     */
    public function replace(UploadedFile $file, string $folder, ?string $oldPath = null): string
    {
        $newPath = $this->upload($file, $folder);

        if (filled($oldPath)) {
            $this->delete($oldPath);
        }

        return $newPath;
    }

    public function delete(string $path): void
    {
        if (blank($path)) {
            return;
        }

        $relative = $this->toRelativePath($path);

        try {
            if (Storage::disk('public')->exists($relative)) {
                Storage::disk('public')->delete($relative);

                return;
            }

            if ($this->isSupabaseConfigured()) {
                $this->client->delete("/storage/v1/object/{$this->bucket}/{$relative}", [
                    'headers' => [
                        'Authorization' => 'Bearer '.$this->apiKey,
                    ],
                ]);
            }
        } catch (\Throwable $e) {
            report($e);
            // Non-fatal: an orphaned object in storage shouldn't break the request.
        }
    }

    /**
     * Public URL for a stored object path. Otomatis mendeteksi apakah file
     * ada di disk lokal (hasil fallback) atau di Supabase, jadi controller
     * tidak perlu tahu backend mana yang sebenarnya dipakai.
     */
    public function url(?string $path): ?string
    {
        if (blank($path)) {
            return null;
        }

        $relative = $this->toRelativePath($path);

        if (Storage::disk('public')->exists($relative)) {
            return Storage::disk('public')->url($relative);
        }

        if ($this->isSupabaseConfigured()) {
            return "{$this->baseUrl}/storage/v1/object/public/{$this->bucket}/{$relative}";
        }

        return null;
    }

    /**
     * Terima path relatif ("folder/nama.jpg") ATAU URL penuh (hasil dari
     * url() sebelumnya) dan selalu kembalikan bentuk relatifnya, supaya
     * delete()/url() konsisten dipakai ulang untuk data lama.
     */
    protected function toRelativePath(string $path): string
    {
        if (! Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        $marker = "/public/{$this->bucket}/";
        if (Str::contains($path, $marker)) {
            return Str::after($path, $marker);
        }

        if (Str::contains($path, '/storage/')) {
            return Str::afterLast($path, '/storage/');
        }

        return $path;
    }
}