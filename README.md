# Renggo — Ruang Digital UMKM Desa

Katalog digital UMKM desa berbasis **Laravel 12 + Blade + Tailwind CSS**, dengan penyimpanan file di **Supabase Storage** dan database **PostgreSQL (Supabase)**.

Mobile-first, desain glassmorphism ringan bernuansa biru terang, mengikuti desain Figma yang dilampirkan.

---

## 1. Tech Stack

- Laravel 12 (PHP 8.3+)
- Blade (tanpa React/Vue/Inertia/Livewire/Filament)
- Tailwind CSS + Vite
- PostgreSQL (Supabase)
- Supabase Storage (REST API via `App\Services\SupabaseStorageService`)
- Eloquent ORM, Form Request Validation, Laravel session-based Authentication
- Alpine.js (untuk interaksi ringan: multi-step form, toast, rating input) — tetap Blade, Alpine hanya progressive enhancement

## 2. Instalasi

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
```

## 3. Konfigurasi Supabase

### 3.1 Database (Postgres)

Di dashboard Supabase Anda: **Project Settings → Database → Connection string**, salin host & password, lalu isi `.env`:

```env
DB_CONNECTION=pgsql
DB_HOST=db.xxxxxxxxxxxx.supabase.co
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=your-database-password
DB_SSLMODE=require
```

### 3.2 Storage Bucket

Di dashboard Supabase: **Storage → Create bucket**, buat bucket bernama `umkm` dan set sebagai **Public bucket** (agar foto profil, cover, galeri, dan banner promo bisa diakses langsung lewat URL publik).

Isi `.env`:

```env
SUPABASE_URL=https://xxxxxxxxxxxx.supabase.co
SUPABASE_ANON_KEY=your-anon-key
SUPABASE_SERVICE_ROLE_KEY=your-service-role-key
SUPABASE_STORAGE_BUCKET=umkm
```

> Upload file **tidak** melalui Laravel filesystem driver bawaan, melainkan langsung memanggil Supabase Storage REST API lewat Guzzle (`App\Services\SupabaseStorageService`), karena API Supabase Storage berbeda dari driver S3 standar. Semua path yang tersimpan di database sudah berupa URL publik lengkap.

## 4. Migrate & Seed

```bash
php artisan migrate
php artisan db:seed
```

Seeder otomatis membuat:

- 15 kategori (Kuliner, Fashion, Kerajinan, Pertanian, Jasa, dll.)
- 20 UMKM dummy
- ~50 review dummy
- 10 promo dummy
- 2 akun demo agar bisa langsung login tanpa daftar:

| Role      | Username / Email          | Password   |
|-----------|----------------------------|------------|
| Owner     | `demo_owner`                | `password` |
| Pelanggan | `pelanggan@renggo.test`     | `password` |

## 5. Menjalankan Project

Jalankan di dua terminal terpisah:

```bash
php artisan serve
```

```bash
npm run dev
```

Buka `http://localhost:8000`.

## 6. Struktur Folder

```
app/
  Http/
    Controllers/
      Auth/            → Register & Login (Customer + Owner)
      Owner/            → Dashboard, UMKM (multi-step), Promo
      HomeController, UmkmController, FavoriteController, ReviewController, ProfileController
    Middleware/          → EnsureUserIsOwner, EnsureUserIsCustomer, LogActivity
    Requests/            → Form Request validation per aksi
  Models/                → User, Umkm, Category, Photo, Review, Favorite, Promo, ActivityLog
  Policies/              → UmkmPolicy, ReviewPolicy, PromoPolicy
  Services/
    SupabaseStorageService → upload/hapus file ke Supabase Storage
    StatisticService        → hitung statistik dashboard owner
    UmkmSearchService       → pencarian, filter kategori, unggulan, terbaru

database/
  migrations/            → users, categories, umkms, photos, reviews, favorites, promos, activity_logs
  seeders/                → CategorySeeder, UmkmSeeder
  factories/              → UserFactory, UmkmFactory, ReviewFactory, PromoFactory, CategoryFactory

resources/
  views/
    components/           → bottom-nav, umkm-card, category-pill, rating-stars, search-bar, toast
    components/layouts/    → app.blade.php (shell + bottom nav), guest.blade.php (auth pages)
    auth/                  → register-customer, register-owner, login-customer, login-owner
    owner/                 → dashboard, umkm/form (5-step), promo/index, promo/form
    umkm/                  → search (explore), detail, favorites
    profile/               → edit, change-password
  css/app.css              → Tailwind + komponen glassmorphism (glass, card, btn-primary, dll.)
  js/app.js                 → Alpine.js init

routes/web.php             → seluruh route aplikasi
```

## 7. Alur Peran (Role)

- **Pelanggan**: daftar/masuk lewat email, jelajahi katalog, cari & filter kategori, simpan favorit, tulis 1 review per UMKM (bisa diedit), kelola profil.
- **Pemilik UMKM**: daftar/masuk lewat username, mengisi **Form Pendaftaran UMKM 5 langkah** (Informasi → Media Visual → Tautan → Promo → Preview & Submit) yang dikirim dalam satu submit, mengelola promo, dan melihat dashboard statistik (total view, favorit, review, rating rata-rata, daftar aktivitas).

## 8. Catatan Implementasi

- Form pendaftaran UMKM multi-step dirender dalam **satu halaman** dan dinavigasi secara client-side dengan Alpine.js (`x-show`/`x-cloak`), lalu dikirim sebagai **satu POST request** — sesuai instruksi "tanpa Livewire/Inertia", sambil tetap memberi UX step-by-step sesuai Figma.
- Review dibatasi 1 per pelanggan per UMKM lewat unique constraint database (`umkm_id`, `user_id`) + pengecekan di controller.
- Statistik "jumlah kunjungan halaman" dicatat otomatis oleh middleware `LogActivity` setiap kali halaman detail UMKM dibuka.
- Warna & komponen glassmorphism (biru terang, rounded corners besar, soft shadow) didefinisikan sebagai utility class di `resources/css/app.css` (`.glass`, `.glass-strong`, `.card`, `.btn-primary`, dll.) supaya konsisten di semua halaman.
