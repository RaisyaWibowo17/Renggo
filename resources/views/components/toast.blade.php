@if (session('success') || session('error') || session('info') || $errors->any())
    <div
        x-data="{ show: true }"
        x-show="show"
        x-init="setTimeout(() => show = false, 4000)"
        x-transition
        class="fixed top-4 left-1/2 z-50 w-[calc(100%-2rem)] max-w-md -translate-x-1/2"
    >
        @if (session('success'))
            <div class="glass-strong flex items-center gap-2 rounded-2xl px-4 py-3 text-sm font-medium text-brand-900">
                <span class="text-accent-green">●</span> {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="glass-strong flex items-center gap-2 rounded-2xl px-4 py-3 text-sm font-medium text-rose-700">
                <span class="text-rose-500">●</span> {{ session('error') }}
            </div>
        @elseif (session('info'))
            <div class="glass-strong flex items-center gap-2 rounded-2xl px-4 py-3 text-sm font-medium text-brand-900">
                <span class="text-brand-500">●</span> {{ session('info') }}
            </div>
        @elseif ($errors->any())
            <div class="glass-strong rounded-2xl px-4 py-3 text-sm font-medium text-rose-700">
                <p class="mb-1 flex items-center gap-2"><span class="text-rose-500">●</span> Periksa kembali data Anda:</p>
                <ul class="list-inside list-disc space-y-0.5 pl-1 text-xs">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endif
