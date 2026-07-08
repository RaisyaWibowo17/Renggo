<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use RuntimeException;

/**
 * Talks directly to the Supabase Storage REST API so uploaded files
 * (profile photos, UMKM covers/galleries, promo banners, review photos)
 * land in the Supabase Storage bucket configured in SUPABASE_STORAGE_BUCKET,
 * instead of the local disk.
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
            'base_uri' => $this->baseUrl,
            'timeout' => 30,
        ]);
    }

    /**
     * Upload a file into a folder inside the bucket and return its stored path.
     */
    public function upload(UploadedFile $file, string $folder): string
    {
        if (blank($this->baseUrl)) {
            throw new RuntimeException('SUPABASE_URL belum dikonfigurasi di file .env.');
        }

        $filename = $folder.'/'.Str::uuid().'.'.$file->getClientOriginalExtension();

        $this->client->post("/storage/v1/object/{$this->bucket}/{$filename}", [
            'headers' => [
                'Authorization' => 'Bearer '.$this->apiKey,
                'Content-Type' => $file->getMimeType(),
                'x-upsert' => 'true',
            ],
            'body' => fopen($file->getRealPath(), 'r'),
        ]);

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
        if (blank($this->baseUrl) || blank($path)) {
            return;
        }

        try {
            $this->client->delete("/storage/v1/object/{$this->bucket}/{$path}", [
                'headers' => [
                    'Authorization' => 'Bearer '.$this->apiKey,
                ],
            ]);
        } catch (\Throwable) {
            // Non-fatal: an orphaned object in storage shouldn't break the request.
        }
    }

    /**
     * Public URL for a stored object path.
     */
    public function url(?string $path): ?string
    {
        if (blank($path)) {
            return null;
        }

        return "{$this->baseUrl}/storage/v1/object/public/{$this->bucket}/{$path}";
    }
}
