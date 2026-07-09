@props([
    'name',
    'label' => null,
    'accept' => 'image/*',
    'preview' => null,
    'required' => false,
    'height' => 'h-32',
    'hint' => null,
])

<div x-data="{
        preview: @js($preview),
        fileName: '',
        onChange(event) {
            const file = event.target.files[0];
            if (!file) { this.fileName = ''; return; }
            this.fileName = file.name;
            this.preview = URL.createObjectURL(file);
        },
     }"
>
    @if ($label)
        <label class="field-label">{{ $label }}</label>
    @endif

    <label class="group relative flex {{ $height }} w-full cursor-pointer flex-col items-center justify-center gap-1.5 overflow-hidden rounded-3xl border-2 border-dashed border-brand-200 bg-brand-50/60 text-xs text-brand-400 transition hover:border-brand-400 hover:bg-brand-50">
        <template x-if="preview">
            <img :src="preview" class="absolute inset-0 h-full w-full object-cover" alt="Preview">
        </template>

        <template x-if="preview">
            <span class="absolute inset-0 flex items-center justify-center bg-brand-950/0 text-white opacity-0 transition group-hover:bg-brand-950/40 group-hover:opacity-100">
                <span class="pill bg-white/90 text-brand-900">Ganti Foto</span>
            </span>
        </template>

        <template x-if="!preview">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9m0 0l3 3m-3-3l-3 3m4.5-9H8.25A2.25 2.25 0 006 5.25v13.5A2.25 2.25 0 008.25 21h7.5A2.25 2.25 0 0018 18.75V9.75a2.25 2.25 0 00-.659-1.591L13.409 4.66A2.25 2.25 0 0011.818 4z"/></svg>
        </template>
        <span x-show="!preview">{{ $slot->isEmpty() ? 'Upload Foto' : $slot }}</span>

        <input
            type="file"
            name="{{ $name }}"
            accept="{{ $accept }}"
            @change="onChange($event)"
            @if ($required) required @endif
            class="hidden"
        >
    </label>

    @if ($hint)
        <p class="mt-1 text-[11px] text-brand-400">{{ $hint }}</p>
    @endif
</div>