<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterCustomerRequest;
use App\Models\User;
use App\Services\SupabaseStorageService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterCustomerController extends Controller
{
    public function create()
    {
        return view('auth.register-customer');
    }

    public function store(RegisterCustomerRequest $request, SupabaseStorageService $storage)
    {
        $data = $request->validated();

        $photoPath = null;
        if ($request->hasFile('profile_photo')) {
            $photoPath = $storage->upload($request->file('profile_photo'), 'profile-photos');
        }

        $user = User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'role' => User::ROLE_CUSTOMER,
            'profile_photo_url' => $photoPath ? $storage->url($photoPath) : null,
        ]);

        Auth::login($user);

        return redirect()->route('home')->with('success', 'Akun berhasil dibuat. Selamat datang di Renggo!');
    }
}
