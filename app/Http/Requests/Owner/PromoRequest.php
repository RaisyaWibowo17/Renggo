<?php

namespace App\Http\Requests\Owner;

use Illuminate\Foundation\Http\FormRequest;

class PromoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],
            'banner' => [$this->isMethod('post') ? 'required' : 'nullable', 'image', 'max:4096'],
            'starts_at' => ['nullable', 'date'],
            'ends_at' => ['nullable', 'date', 'after_or_equal:starts_at'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'judul promo',
            'description' => 'deskripsi promo',
            'banner' => 'banner promo',
            'starts_at' => 'tanggal mulai',
            'ends_at' => 'tanggal berakhir',
        ];
    }
}
