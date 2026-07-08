<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterOwnerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'alpha_dash', 'max:50', 'unique:users,username'],
            'phone' => ['required', 'string', 'max:20'],
            'rw' => ['required', 'integer', 'between:1,15'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'profile_photo' => ['nullable', 'image', 'max:2048'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nama',
            'username' => 'username',
            'phone' => 'nomor HP',
            'rw' => 'RW',
            'password' => 'password',
            'profile_photo' => 'foto profil',
        ];
    }
}
