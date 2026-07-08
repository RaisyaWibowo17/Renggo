<x-layouts.guest title="Daftar Pemilik UMKM">
    <div class="mb-8 text-center">
        <div class="mx-auto mb-3 flex h-14 w-14 items-center justify-center rounded-3xl bg-brand-900 text-white shadow-glass-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
        </div>
        <h1 class="text-xl font-bold text-brand-950">Daftar Pemilik UMKM</h1>
        <p class="mt-1 text-sm text-brand-500">Kelola & promosikan usahamu di Renggo</p>
    </div>

    <form action="{{ route('register.owner') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
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
            <label class="field-label">Nomor HP</label>
            <input type="text" name="phone" value="{{ old('phone') }}" class="input-field" placeholder="08xxxxxxxxxx" required>
        </div>
        <div>
            <label class="field-label">RW</label>
            <select name="rw" class="input-field" required>
                <option value="">Pilih RW</option>
                @for ($i = 1; $i <= 15; $i++)
                    <option value="{{ $i }}" @selected(old('rw') == $i)>RW {{ $i }}</option>
                @endfor
            </select>
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
        Sudah punya akun? <a href="{{ route('login.owner') }}" class="font-semibold text-brand-900">Masuk</a>
    </p>
    <p class="mt-2 text-center text-xs text-brand-400">
        Ingin belanja saja? <a href="{{ route('register.customer') }}" class="font-semibold text-brand-700">Daftar sebagai Pelanggan</a>
    </p>
</x-layouts.guest>
