@php
    $isEdit = (bool) $umkm;
@endphp

<x-layouts.app :title="$isEdit ? 'Edit UMKM' : 'Daftar UMKM'">
    <div
        x-data="{
            step: 1,
            totalSteps: 5,
            next() { if (this.step < this.totalSteps) this.step++ },
            back() { if (this.step > 1) this.step-- },
        }"
        class="space-y-5"
    >
        {{-- Header --}}
        <div class="flex items-center justify-between">
            <button type="button" @click="back()" x-show="step > 1" class="flex h-9 w-9 items-center justify-center rounded-full bg-white/80 shadow-card">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5 text-brand-900" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            </button>
            <h1 class="text-base font-bold text-brand-950">{{ $isEdit ? 'Edit UMKM' : 'Daftar UMKM' }}</h1>
            <span class="text-xs font-semibold text-brand-400" x-text="step + ' / ' + totalSteps"></span>
        </div>

        {{-- Step indicator --}}
        <div class="flex items-center gap-1.5">
            <template x-for="i in totalSteps" :key="i">
                <div class="h-1.5 flex-1 rounded-full" :class="i <= step ? 'bg-brand-900' : 'bg-brand-100'"></div>
            </template>
        </div>

        <form
            action="{{ $isEdit ? route('owner.umkm.update') : route('owner.umkm.store') }}"
            method="POST" enctype="multipart/form-data" class="space-y-5"
        >
            @csrf
            @if ($isEdit) @method('PUT') @endif

            {{-- STEP 1: Informasi UMKM --}}
            <div x-show="step === 1" x-cloak class="card space-y-4 p-4">
                <h2 class="flex items-center gap-2 text-sm font-bold text-brand-950">
                    <span class="flex h-6 w-6 items-center justify-center rounded-full bg-brand-50 text-xs">🏪</span>
                    Identitas UMKM
                </h2>

                <div>
                    <label class="field-label">Nama UMKM</label>
                    <input type="text" name="name" value="{{ old('name', $umkm->name ?? '') }}" class="input-field" placeholder="Contoh: Kedai Kopi Renggo" required>
                </div>
                <div>
                    <label class="field-label">Bidang Usaha</label>
                    <input type="text" name="business_field" value="{{ old('business_field', $umkm->business_field ?? '') }}" class="input-field" placeholder="Kuliner, kerajinan, dll." required>
                </div>
                <div>
                    <label class="field-label">Kategori</label>
                    <select name="category_id" class="input-field" required>
                        <option value="">Pilih kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id', $umkm->category_id ?? '') == $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="field-label">Deskripsi</label>
                    <textarea name="description" rows="4" class="input-field" placeholder="Ceritakan keunikan produk Anda..." required>{{ old('description', $umkm->description ?? '') }}</textarea>
                </div>
                <div>
                    <label class="field-label">Alamat Lengkap</label>
                    <input type="text" name="address" value="{{ old('address', $umkm->address ?? '') }}" class="input-field" placeholder="Jl. Raya No. 123..." required>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="field-label">RW</label>
                        <select name="rw" class="input-field" required>
                            <option value="">Pilih RW</option>
                            @for ($i = 1; $i <= 15; $i++)
                                <option value="{{ $i }}" @selected(old('rw', $umkm->rw ?? '') == $i)>RW {{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div></div>
                    <div>
                        <label class="field-label">Jam Buka</label>
                        <input type="time" name="opening_time" value="{{ old('opening_time', $umkm ? optional($umkm->opening_time)->format('H:i') : '08:00') }}" class="input-field" required>
                    </div>
                    <div>
                        <label class="field-label">Jam Tutup</label>
                        <input type="time" name="closing_time" value="{{ old('closing_time', $umkm ? optional($umkm->closing_time)->format('H:i') : '20:00') }}" class="input-field" required>
                    </div>
                </div>
            </div>

            {{-- STEP 2: Media Visual --}}
            <div x-show="step === 2" x-cloak class="card space-y-4 p-4">
                <h2 class="flex items-center gap-2 text-sm font-bold text-brand-950">
                    <span class="flex h-6 w-6 items-center justify-center rounded-full bg-brand-50 text-xs">🖼️</span>
                    Media Visual
                </h2>

                <div>
                    <label class="field-label">Cover Banner</label>
                    @if ($isEdit && $umkm->cover_path)
                        <img src="{{ $umkm->cover_path }}" class="mb-2 h-32 w-full rounded-2xl object-cover" alt="Cover saat ini">
                    @endif
                    <label class="flex h-28 w-full cursor-pointer flex-col items-center justify-center gap-1 rounded-2xl border-2 border-dashed border-brand-200 bg-brand-50/50 text-xs text-brand-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9m0 0l3 3m-3-3l-3 3m4.5-9H8.25A2.25 2.25 0 006 5.25v13.5A2.25 2.25 0 008.25 21h7.5A2.25 2.25 0 0018 18.75V9.75a2.25 2.25 0 00-.659-1.591L13.409 4.66A2.25 2.25 0 0011.818 4z"/></svg>
                        Upload Cover
                        <input type="file" name="cover" accept="image/*" class="hidden">
                    </label>
                </div>

                <div>
                    <label class="field-label">Galeri (maks. 4 foto)</label>
                    <div class="grid grid-cols-4 gap-2">
                        @foreach (['Galeri 1', 'Galeri 2', 'Galeri 3', 'Galeri 4'] as $i => $label)
                            <label class="flex h-16 cursor-pointer flex-col items-center justify-center gap-0.5 rounded-xl border-2 border-dashed border-brand-200 bg-brand-50/50 text-[10px] text-brand-400">
                                <span class="text-lg leading-none">+</span>
                                {{ $label }}
                                <input type="file" name="gallery[]" accept="image/*" class="hidden">
                            </label>
                        @endforeach
                    </div>
                    @if ($isEdit && $umkm->gallery->isNotEmpty())
                        <div class="mt-2 flex gap-2 overflow-x-auto">
                            @foreach ($umkm->gallery as $photo)
                                <img src="{{ $photo->path }}" class="h-14 w-14 shrink-0 rounded-xl object-cover" alt="Galeri">
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            {{-- STEP 3: Tautan --}}
            <div x-show="step === 3" x-cloak class="card space-y-4 p-4">
                <h2 class="flex items-center gap-2 text-sm font-bold text-brand-950">
                    <span class="flex h-6 w-6 items-center justify-center rounded-full bg-brand-50 text-xs">🔗</span>
                    Tautan Toko
                </h2>

                <div>
                    <label class="field-label">Nomor WhatsApp</label>
                    <input type="text" name="whatsapp" value="{{ old('whatsapp', $umkm->whatsapp ?? '') }}" class="input-field" placeholder="62812xxxxxxx" required>
                </div>
                <div>
                    <label class="field-label">Username Instagram</label>
                    <input type="text" name="instagram" value="{{ old('instagram', $umkm->instagram ?? '') }}" class="input-field" placeholder="@namatoko">
                </div>
                <div>
                    <label class="field-label">Link Google Maps</label>
                    <input type="url" name="gmaps_url" value="{{ old('gmaps_url', $umkm->gmaps_url ?? '') }}" class="input-field" placeholder="https://maps.google.com/...">
                </div>
            </div>

            {{-- STEP 4: Promo --}}
            <div x-show="step === 4" x-cloak class="card space-y-4 p-4">
                <h2 class="flex items-center gap-2 text-sm font-bold text-brand-950">
                    <span class="flex h-6 w-6 items-center justify-center rounded-full bg-brand-50 text-xs">🎉</span>
                    Promo (Opsional)
                </h2>
                <p class="text-xs text-brand-400">Lewati bagian ini jika belum ada promo. Anda bisa menambah promo lain kapan saja dari menu Promo.</p>

                <div>
                    <label class="field-label">Judul Promo</label>
                    <input type="text" name="promo_title" value="{{ old('promo_title') }}" class="input-field" placeholder="Diskon 20% Grand Opening">
                </div>
                <div>
                    <label class="field-label">Deskripsi Promo</label>
                    <textarea name="promo_description" rows="3" class="input-field" placeholder="Syarat & ketentuan promo...">{{ old('promo_description') }}</textarea>
                </div>
                <div>
                    <label class="field-label">Banner Promo</label>
                    <input type="file" name="promo_banner" accept="image/*" class="w-full text-xs text-brand-500 file:mr-3 file:rounded-xl file:border-0 file:bg-brand-50 file:px-3 file:py-2 file:text-xs file:font-semibold file:text-brand-700">
                </div>
            </div>

            {{-- STEP 5: Preview & Submit --}}
            <div x-show="step === 5" x-cloak class="card space-y-3 p-4">
                <h2 class="flex items-center gap-2 text-sm font-bold text-brand-950">
                    <span class="flex h-6 w-6 items-center justify-center rounded-full bg-brand-50 text-xs">✅</span>
                    Preview &amp; Submit
                </h2>
                <p class="text-sm text-brand-600">Periksa kembali informasi UMKM Anda sebelum {{ $isEdit ? 'menyimpan perubahan' : 'mendaftarkan UMKM' }}. Data akan langsung tampil di katalog Renggo setelah dikirim.</p>
                <div class="rounded-2xl bg-brand-50/60 p-4 text-xs text-brand-500">
                    Pastikan nama, deskripsi, dan kontak sudah benar. Anda tetap bisa mengedit UMKM kapan saja melalui menu Dashboard.
                </div>
            </div>

            {{-- Bottom actions --}}
            <div class="flex gap-3">
                <button type="button" @click="back()" x-show="step > 1" class="btn-secondary flex-1">Kembali</button>
                <button type="button" @click="next()" x-show="step < totalSteps" class="btn-primary flex-1">Lanjutkan</button>
                <button type="submit" x-show="step === totalSteps" class="btn-primary flex-1">
                    {{ $isEdit ? 'Simpan Perubahan' : 'Daftarkan UMKM' }}
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>
