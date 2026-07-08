<x-layouts.app title="Profil Saya">
    <div class="space-y-5">
        <div class="flex items-center gap-3">
            <div class="flex h-16 w-16 items-center justify-center overflow-hidden rounded-3xl bg-brand-100 shadow-card">
                @if ($user->profile_photo_url)
                    <img src="{{ $user->profile_photo_url }}" class="h-full w-full object-cover" alt="{{ $user->name }}">
                @else
                    <span class="text-xl font-bold text-brand-700">{{ mb_substr($user->name, 0, 1) }}</span>
                @endif
            </div>
            <div>
                <h1 class="text-lg font-bold text-brand-950">{{ $user->name }}</h1>
                <p class="pill mt-1 bg-brand-50 text-brand-700">{{ $user->isOwner() ? 'Pemilik UMKM' : 'Pelanggan' }}</p>
            </div>
        </div>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="card space-y-4 p-4">
            @csrf
            @method('PATCH')

            <div>
                <label class="field-label">Nama</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="input-field" required>
            </div>
            <div>
                <label class="field-label">Username</label>
                <input type="text" name="username" value="{{ old('username', $user->username) }}" class="input-field" required>
            </div>
            @if ($user->isCustomer())
                <div>
                    <label class="field-label">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="input-field">
                </div>
            @endif
            <div>
                <label class="field-label">Nomor HP</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="input-field" required>
            </div>
            @if ($user->isOwner())
                <div>
                    <label class="field-label">RW</label>
                    <select name="rw" class="input-field">
                        @for ($i = 1; $i <= 15; $i++)
                            <option value="{{ $i }}" @selected(old('rw', $user->rw) == $i)>RW {{ $i }}</option>
                        @endfor
                    </select>
                </div>
            @endif
            <div>
                <label class="field-label">Ganti Foto Profil</label>
                <input type="file" name="profile_photo" accept="image/*" class="w-full text-xs text-brand-500 file:mr-3 file:rounded-xl file:border-0 file:bg-brand-50 file:px-3 file:py-2 file:text-xs file:font-semibold file:text-brand-700">
            </div>

            <button type="submit" class="btn-primary w-full">Simpan Perubahan</button>
        </form>

        <a href="{{ route('profile.password') }}" class="btn-secondary w-full">Ganti Password</a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-ghost w-full justify-center text-rose-600">Keluar</button>
        </form>
    </div>
</x-layouts.app>
