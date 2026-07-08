<x-layouts.guest title="Masuk Pelanggan">
    <div class="mb-8 text-center">
        <div class="mx-auto mb-3 flex h-14 w-14 items-center justify-center rounded-3xl bg-brand-900 text-white shadow-glass-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h11m0-9h1a3 3 0 013 3v10a3 3 0 01-3 3h-1"/></svg>
        </div>
        <h1 class="text-xl font-bold text-brand-950">Selamat Datang Kembali</h1>
        <p class="mt-1 text-sm text-brand-500">Masuk sebagai Pelanggan</p>
    </div>

    <form action="{{ route('login.customer') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="field-label">Email</label>
            <input type="text" name="identifier" value="{{ old('identifier') }}" class="input-field" placeholder="nama@email.com" required autofocus>
        </div>
        <div>
            <label class="field-label">Password</label>
            <input type="password" name="password" class="input-field" placeholder="Password Anda" required>
        </div>

        <button type="submit" class="btn-primary w-full">Masuk</button>
    </form>

    <p class="mt-6 text-center text-sm text-brand-500">
        Belum punya akun? <a href="{{ route('register.customer') }}" class="font-semibold text-brand-900">Daftar</a>
    </p>
    <p class="mt-2 text-center text-xs text-brand-400">
        Anda Pemilik UMKM? <a href="{{ route('login.owner') }}" class="font-semibold text-brand-700">Masuk di sini</a>
    </p>
</x-layouts.guest>
