@php $isEdit = (bool) $promo; @endphp

<x-layouts.app :title="$isEdit ? 'Edit Promo' : 'Promo Baru'">
    <div class="space-y-5">
        <a href="{{ route('owner.promo.index') }}" class="flex items-center gap-1 text-sm font-medium text-brand-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            Kembali ke Promo
        </a>

        <h1 class="text-lg font-bold text-brand-950">{{ $isEdit ? 'Edit Promo' : 'Buat Promo Baru' }}</h1>

        <form
            action="{{ $isEdit ? route('owner.promo.update', $promo) : route('owner.promo.store') }}"
            method="POST" enctype="multipart/form-data" class="card space-y-4 p-4"
        >
            @csrf
            @if ($isEdit) @method('PUT') @endif

            <div>
                <label class="field-label">Judul Promo</label>
                <input type="text" name="title" value="{{ old('title', $promo->title ?? '') }}" class="input-field" required>
            </div>
            <div>
                <label class="field-label">Deskripsi Promo</label>
                <textarea name="description" rows="3" class="input-field" required>{{ old('description', $promo->description ?? '') }}</textarea>
            </div>
            <div>
                <label class="field-label">Banner Promo</label>
                @if ($isEdit && $promo->banner_path)
                    <img src="{{ $promo->banner_path }}" class="mb-2 h-28 w-full rounded-2xl object-cover" alt="Banner saat ini">
                @endif
                <input type="file" name="banner" accept="image/*" class="w-full text-xs text-brand-500 file:mr-3 file:rounded-xl file:border-0 file:bg-brand-50 file:px-3 file:py-2 file:text-xs file:font-semibold file:text-brand-700" @if(!$isEdit) required @endif>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="field-label">Mulai</label>
                    <input type="date" name="starts_at" value="{{ old('starts_at', optional($promo->starts_at ?? null)->format('Y-m-d')) }}" class="input-field">
                </div>
                <div>
                    <label class="field-label">Berakhir</label>
                    <input type="date" name="ends_at" value="{{ old('ends_at', optional($promo->ends_at ?? null)->format('Y-m-d')) }}" class="input-field">
                </div>
            </div>
            @if ($isEdit)
                <label class="flex items-center gap-2 text-sm text-brand-700">
                    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $promo->is_active)) class="rounded border-brand-200 text-brand-900 focus:ring-brand-300">
                    Promo aktif
                </label>
            @endif

            <button type="submit" class="btn-primary w-full">{{ $isEdit ? 'Simpan Perubahan' : 'Buat Promo' }}</button>
        </form>
    </div>
</x-layouts.app>
