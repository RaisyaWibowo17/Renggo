<x-layouts.app title="Ganti Password">
    <div class="space-y-5">
        <a href="{{ route('profile.edit') }}" class="flex items-center gap-1 text-sm font-medium text-brand-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            Kembali ke Profil
        </a>

        <h1 class="text-lg font-bold text-brand-950">Ganti Password</h1>

        <form action="{{ route('profile.password.update') }}" method="POST" class="card space-y-4 p-4">
            @csrf
            @method('PUT')

            <div>
                <label class="field-label">Password Saat Ini</label>
                <input type="password" name="current_password" class="input-field" required>
            </div>
            <div>
                <label class="field-label">Password Baru</label>
                <input type="password" name="password" class="input-field" required>
            </div>
            <div>
                <label class="field-label">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" class="input-field" required>
            </div>

            <button type="submit" class="btn-primary w-full">Simpan Password Baru</button>
        </form>
    </div>
</x-layouts.app>
