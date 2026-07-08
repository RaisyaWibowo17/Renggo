<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Services\SupabaseStorageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        return view('profile.edit', ['user' => $request->user()]);
    }

    public function update(ProfileUpdateRequest $request, SupabaseStorageService $storage)
    {
        $user = $request->user();
        $data = $request->validated();

        if ($request->hasFile('profile_photo')) {
            $path = $storage->upload($request->file('profile_photo'), 'profile-photos');
            $data['profile_photo_url'] = $storage->url($path);
        }

        $user->update($data);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function editPassword()
    {
        return view('profile.change-password');
    }

    public function updatePassword(ChangePasswordRequest $request)
    {
        $request->user()->update([
            'password' => Hash::make($request->validated()['password']),
        ]);

        return back()->with('success', 'Password berhasil diganti.');
    }
}
