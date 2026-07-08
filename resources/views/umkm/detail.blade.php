<x-layouts.app :title="$umkm->name">
    <div class="-mx-4 -mt-5">
        {{-- Cover Banner --}}
        <div class="relative h-56 w-full bg-gradient-to-br from-brand-200 to-brand-400">
            @if ($umkm->cover_path)
                <img src="{{ $umkm->cover_path }}" alt="{{ $umkm->name }}" class="h-full w-full object-cover">
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-black/10"></div>

            <div class="absolute inset-x-4 top-4 flex items-center justify-between">
                <a href="{{ url()->previous() ?: route('home') }}" class="flex h-9 w-9 items-center justify-center rounded-full bg-white/85 text-brand-900 shadow-card">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                </a>
                <div class="flex items-center gap-2">
                    @auth
                        @if (auth()->user()->isCustomer())
                            <form action="{{ route('favorite.toggle', $umkm) }}" method="POST">
                                @csrf
                                <button type="submit" class="flex h-9 w-9 items-center justify-center rounded-full bg-white/85 shadow-card {{ $isFavorited ? 'text-rose-500' : 'text-brand-900' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="{{ $isFavorited ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                </button>
                            </form>
                        @endif
                    @endauth
                    <span class="flex h-9 w-9 items-center justify-center rounded-full bg-white/85 text-brand-900 shadow-card">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342a3 3 0 100-2.684m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 8.658a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"/></svg>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="-mt-6 space-y-5">
        {{-- Info card --}}
        <div class="card p-4">
            <div class="flex items-start justify-between gap-2">
                <div>
                    <span class="pill bg-brand-50 text-brand-700">{{ $umkm->category->name }}</span>
                    <h1 class="mt-2 text-xl font-bold text-brand-950">{{ $umkm->name }}</h1>
                    <p class="mt-1 flex items-center gap-1 text-xs text-brand-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        {{ $umkm->address }}
                    </p>
                </div>
                <div class="text-right shrink-0">
                    <x-rating-stars :rating="$umkm->rating_average" size="lg" />
                    <p class="mt-0.5 text-[11px] text-brand-400">{{ $umkm->review_count }}+ Ulasan</p>
                </div>
            </div>

            <p class="mt-3 text-sm leading-relaxed text-brand-700">{{ $umkm->description }}</p>

            <div class="mt-4 grid grid-cols-3 divide-x divide-brand-50 rounded-2xl bg-brand-50/60 py-3 text-center">
                <div>
                    <p class="text-sm font-bold text-brand-950">{{ $umkm->gallery->count() }}+</p>
                    <p class="text-[11px] text-brand-500">Produk</p>
                </div>
                <div>
                    <p class="text-sm font-bold text-brand-950">{{ $umkm->favorite_count }}</p>
                    <p class="text-[11px] text-brand-500">Favorit</p>
                </div>
                <div>
                    <p class="text-sm font-bold text-brand-950">{{ $umkm->view_count }}</p>
                    <p class="text-[11px] text-brand-500">Dilihat</p>
                </div>
            </div>

            <div class="mt-4 flex items-center justify-between rounded-2xl bg-brand-50/60 px-4 py-2.5 text-xs text-brand-700">
                <span class="flex items-center gap-1.5 font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Jam Operasional
                </span>
                <span class="font-semibold text-brand-900">
                    {{ optional($umkm->opening_time)->format('H:i') }} - {{ optional($umkm->closing_time)->format('H:i') }}
                </span>
            </div>

            <div class="mt-3 flex gap-2">
                @if ($umkm->whatsapp)
                    <a href="https://wa.me/{{ preg_replace('/\D/', '', $umkm->whatsapp) }}" target="_blank" class="pill flex-1 justify-center bg-emerald-50 text-emerald-700">WhatsApp</a>
                @endif
                @if ($umkm->instagram)
                    <a href="https://instagram.com/{{ ltrim($umkm->instagram, '@') }}" target="_blank" class="pill flex-1 justify-center bg-pink-50 text-pink-700">Instagram</a>
                @endif
                @if ($umkm->gmaps_url)
                    <a href="{{ $umkm->gmaps_url }}" target="_blank" class="pill flex-1 justify-center bg-brand-50 text-brand-700">Maps</a>
                @endif
            </div>
        </div>

        {{-- Promo Aktif --}}
        @if ($umkm->activePromos->isNotEmpty())
            <div>
                <h2 class="mb-2 text-sm font-bold text-brand-950">Promo Aktif</h2>
                <div class="no-scrollbar flex gap-3 overflow-x-auto pb-1">
                    @foreach ($umkm->activePromos as $promo)
                        <div class="w-64 shrink-0 overflow-hidden rounded-2xl bg-gradient-to-br from-accent-amber/90 to-orange-400 text-white shadow-card">
                            @if ($promo->banner_path)
                                <img src="{{ $promo->banner_path }}" class="h-24 w-full object-cover" alt="{{ $promo->title }}">
                            @endif
                            <div class="p-3">
                                <p class="text-sm font-bold">{{ $promo->title }}</p>
                                <p class="mt-0.5 line-clamp-2 text-xs text-white/90">{{ $promo->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Galeri --}}
        @if ($umkm->gallery->isNotEmpty())
            <div>
                <div class="mb-2 flex items-center justify-between">
                    <h2 class="text-sm font-bold text-brand-950">Galeri Produk</h2>
                    <span class="text-xs text-brand-400">{{ $umkm->gallery->count() }} Foto</span>
                </div>
                <div class="no-scrollbar flex gap-2 overflow-x-auto pb-1">
                    @foreach ($umkm->gallery as $photo)
                        <img src="{{ $photo->path }}" class="h-28 w-28 shrink-0 rounded-2xl object-cover shadow-card" alt="Galeri {{ $umkm->name }}">
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Ulasan Pelanggan --}}
        <div>
            <div class="mb-2 flex items-center justify-between">
                <h2 class="text-sm font-bold text-brand-950">Ulasan Pelanggan</h2>
                <span class="text-xs text-brand-400">{{ $umkm->review_count }} Ulasan</span>
            </div>

            <div class="space-y-3">
                @forelse ($umkm->reviews as $review)
                    <div class="card p-3.5">
                        <div class="flex items-start justify-between gap-2">
                            <div class="flex items-center gap-2">
                                <div class="flex h-8 w-8 items-center justify-center rounded-full bg-brand-100 text-xs font-bold text-brand-700">
                                    {{ mb_substr($review->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-brand-950">{{ $review->user->name }}</p>
                                    <p class="text-[11px] text-brand-400">{{ $review->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <x-rating-stars :rating="$review->rating" />
                        </div>
                        <p class="mt-2 text-sm text-brand-700">{{ $review->comment }}</p>
                        @if ($review->photo_path)
                            <img src="{{ $review->photo_path }}" class="mt-2 h-20 w-20 rounded-xl object-cover" alt="Foto ulasan">
                        @endif
                    </div>
                @empty
                    <p class="text-sm text-brand-400">Belum ada ulasan untuk UMKM ini.</p>
                @endforelse
            </div>
        </div>

        {{-- Form review --}}
        @auth
            @if (auth()->user()->isCustomer())
                <div class="card p-4">
                    <h2 class="mb-3 text-sm font-bold text-brand-950">{{ $myReview ? 'Edit Ulasan Anda' : 'Tulis Ulasan' }}</h2>
                    <form
                        action="{{ $myReview ? route('review.update', $myReview) : route('review.store', $umkm) }}"
                        method="POST" enctype="multipart/form-data" class="space-y-3"
                        x-data="{ rating: {{ $myReview->rating ?? 5 }} }"
                    >
                        @csrf
                        @if ($myReview) @method('PUT') @endif

                        <div class="flex gap-1">
                            <template x-for="star in [1,2,3,4,5]" :key="star">
                                <button type="button" @click="rating = star">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" :class="star <= rating ? 'fill-accent-amber text-accent-amber' : 'fill-none text-brand-200'" viewBox="0 0 20 20" stroke="currentColor">
                                        <path d="M10 1.5l2.6 5.27 5.82.85-4.21 4.1 1 5.8L10 14.9l-5.21 2.74 1-5.8-4.21-4.1 5.82-.85L10 1.5z"/>
                                    </svg>
                                </button>
                            </template>
                        </div>
                        <input type="hidden" name="rating" x-bind:value="rating">

                        <textarea name="comment" rows="3" class="input-field" placeholder="Bagaimana pengalaman Anda?">{{ old('comment', $myReview->comment ?? '') }}</textarea>

                        <input type="file" name="photo" accept="image/*" class="w-full text-xs text-brand-500 file:mr-3 file:rounded-xl file:border-0 file:bg-brand-50 file:px-3 file:py-2 file:text-xs file:font-semibold file:text-brand-700">

                        <button type="submit" class="btn-primary w-full">{{ $myReview ? 'Simpan Perubahan' : 'Kirim Ulasan' }}</button>
                    </form>
                </div>
            @endif
        @else
            <a href="{{ route('login.customer') }}" class="btn-secondary w-full">Masuk untuk menulis ulasan</a>
        @endauth
    </div>
</x-layouts.app>
