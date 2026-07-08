<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterOwnerRequest;
use App\Models\User;
use App\Services\SupabaseStorageService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterOwnerController extends Controller
{
    public function create()
    {
        return view('auth.register-owner');
    }

    public function store(RegisterOwnerRequest $request, SupabaseStorageService $storage)
    {
        $data = $request->validated();

        $photoPath = null;
        if ($request->hasFile('profile_photo')) {
            $photoPath = $storage->upload($request->file('profile_photo'), 'profile-photos');
        }

        $user = User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'phone' => $data['phone'],
            'rw' => $data['rw'],
            'password' => Hash::make($data['password']),
            'role' => User::ROLE_OWNER,
            'profile_photo_url' => $photoPath ? $storage->url($photoPath) : null,
        ]);

        Auth::login($user);

        return redirect()->route('owner.umkm.create')
            ->with('success', 'Akun Pemilik UMKM berhasil dibuat. Yuk, daftarkan UMKM Anda!');
    }
}
