<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function createCustomer()
    {
        return view('auth.login-customer');
    }

    public function createOwner()
    {
        return view('auth.login-owner');
    }

    public function storeCustomer(LoginRequest $request)
    {
        $request->authenticate(User::ROLE_CUSTOMER);

        $request->session()->regenerate();

        return redirect()->intended(route('home'));
    }

    public function storeOwner(LoginRequest $request)
    {
        $request->authenticate(User::ROLE_OWNER);

        $request->session()->regenerate();

        return redirect()->intended(route('owner.dashboard'));
    }

    public function destroy(Request $request)
    {
        $wasOwner = Auth::check() && Auth::user()->isOwner();

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route($wasOwner ? 'login.owner' : 'home')
            ->with('success', 'Anda berhasil logout.');
    }
}
