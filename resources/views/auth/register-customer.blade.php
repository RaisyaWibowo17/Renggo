<x-layouts.guest title="Daftar Pelanggan">
    <div class="mb-8 text-center">
        <div class="mx-auto mb-3 flex h-14 w-14 items-center justify-center rounded-3xl bg-brand-900 text-white shadow-glass-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 9.5L12 3l9 6.5V20a1 1 0 01-1 1h-4.5v-6h-7v6H4a1 1 0 01-1-1V9.5z"/></svg>
        </div>
        <h1 class="text-xl font-bold text-brand-950">Buat Akun Pelanggan</h1>
        <p class="mt-1 text-sm text-brand-500">Temukan & dukung UMKM desa favoritmu</p>
    </div>

    <form action="{{ route('register.customer') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div>
            <label class="field-label">Nama</label>
            <input type="text" name="name" value="{{ old('name') }}" class="input-field" placeholder="Nama lengkap" required>
        </div>
        <div>
            <label class="field-label">Username</label>
            <input type="text" name="username" value="{{ old('username') }}" class="input-field" placeholder="username_unik" required>
        </div>
        <div>
            <label class="field-label">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="input-field" placeholder="nama@email.com" required>
        </div>
        <div>
            <label class="field-label">Nomor HP</label>
            <input type="text" name="phone" value="{{ old('phone') }}" class="input-field" placeholder="08xxxxxxxxxx" required>
        </div>
        <div>
            <label class="field-label">Password</label>
            <input type="password" name="password" class="input-field" placeholder="Minimal 8 karakter" required>
        </div>
        <div>
            <label class="field-label">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="input-field" placeholder="Ulangi password" required>
        </div>
        <div>
            <label class="field-label">Foto Profil (Opsional)</label>
            <input type="file" name="profile_photo" accept="image/*" class="w-full text-xs text-brand-500 file:mr-3 file:rounded-xl file:border-0 file:bg-brand-50 file:px-3 file:py-2 file:text-xs file:font-semibold file:text-brand-700">
        </div>

        <button type="submit" class="btn-primary w-full">Daftar Sekarang</button>
    </form>

    <p class="mt-6 text-center text-sm text-brand-500">
        Sudah punya akun? <a href="{{ route('login.customer') }}" class="font-semibold text-brand-900">Masuk</a>
    </p>
    <p class="mt-2 text-center text-xs text-brand-400">
        Punya UMKM? <a href="{{ route('register.owner') }}" class="font-semibold text-brand-700">Daftar sebagai Pemilik UMKM</a>
    </p>
</x-layouts.guest>
