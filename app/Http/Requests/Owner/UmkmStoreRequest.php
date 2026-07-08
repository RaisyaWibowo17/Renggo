<?php

namespace App\Http\Requests\Owner;

use Illuminate\Foundation\Http\FormRequest;

/**
 * The "Form Pendaftaran UMKM" is rendered as one Blade page whose steps
 * (Informasi UMKM, Media Visual, Tautan, Promo, Preview & Submit) are
 * navigated client-side with Alpine.js, then submitted together in a
 * single POST — so all fields from steps 1-4 are validated here at once.
 */
class UmkmStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Step 1 - Informasi UMKM
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'business_field' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:2000'],
            'address' => ['required', 'string', 'max:255'],
            'rw' => ['required', 'integer', 'between:1,15'],
            'opening_time' => ['required', 'date_format:H:i'],
            'closing_time' => ['required', 'date_format:H:i', 'after:opening_time'],

            // Step 2 - Media Visual
            'cover' => [$this->isMethod('post') ? 'required' : 'nullable', 'image', 'max:4096'],
            'gallery' => ['nullable', 'array', 'max:4'],
            'gallery.*' => ['image', 'max:4096'],

            // Step 3 - Tautan
            'whatsapp' => ['required', 'string', 'max:20'],
            'instagram' => ['nullable', 'string', 'max:100'],
            'gmaps_url' => ['nullable', 'url', 'max:500'],

            // Step 4 - Promo (opsional)
            'promo_title' => ['nullable', 'required_with:promo_description', 'string', 'max:255'],
            'promo_description' => ['nullable', 'required_with:promo_title', 'string', 'max:1000'],
            'promo_banner' => ['nullable', 'image', 'max:4096'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nama UMKM',
            'category_id' => 'bidang usaha',
            'business_field' => 'bidang usaha',
            'description' => 'deskripsi',
            'address' => 'alamat lengkap',
            'rw' => 'RW',
            'opening_time' => 'jam buka',
            'closing_time' => 'jam tutup',
            'cover' => 'cover banner',
            'gallery.*' => 'foto galeri',
            'whatsapp' => 'nomor WhatsApp',
            'instagram' => 'username Instagram',
            'gmaps_url' => 'link Google Maps',
            'promo_title' => 'judul promo',
            'promo_description' => 'deskripsi promo',
            'promo_banner' => 'banner promo',
        ];
    }
}
