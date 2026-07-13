# ALBRK Shoesclean

ALBRK Shoesclean adalah sistem informasi reservasi layanan cuci sepatu berbasis Laravel. Sistem ini dibuat untuk kebutuhan tugas akhir dengan fokus pada reservasi pelanggan, manajemen layanan, antrean, pembayaran, laporan, dan pengelolaan pengguna.

## Ringkasan Arsitektur

Project ini menggunakan Laravel dengan pemisahan layer secara modular dan menerapkan pendekatan MVVM.

Alur utama aplikasi:

```text
Route -> Controller -> ViewModel -> Service -> Repository -> Model -> Database
                           |
                           v
                         View
```

Penjelasan singkat:

- `Controller` menerima request dan memilih alur proses.
- `ViewModel` menyiapkan data yang dibutuhkan tampilan.
- `Service` berisi business logic aplikasi.
- `Repository` menangani akses data ke database.
- `Model` merepresentasikan tabel database.
- `View` menampilkan data ke pengguna.

## Struktur Folder

```text
albrkshoesclean/
|-- backend/                  # Backend Laravel dan layer business logic
|-- frontend/                 # Asset frontend, Vite, dan target view
|-- app/                      # Core aplikasi Laravel
|-- bootstrap/                # Bootstrap Laravel
|-- config/                   # Konfigurasi Laravel
|-- database/                 # Migration, seeder, factory
|-- public/                   # Document root web server
|-- routes/                   # Definisi route aplikasi
|-- storage/                  # Cache, log, upload runtime
|-- tests/                    # Test aplikasi
|-- artisan
`-- composer.json
```

Catatan: project ini adalah Laravel monolith modular, bukan microservice dan bukan SPA penuh. Pemisahan frontend/backend dilakukan untuk memperjelas layer, command development, dan tanggung jawab kode.

## Menjalankan Project Untuk Development

Terminal backend:

```powershell
cd backend
php artisan serve
```

Jika Windows menolak temporary file, jalankan:

```powershell
cd backend
.\start-backend.ps1
```

Terminal frontend:

```powershell
cd frontend
npm install
npm run dev
```

Website dapat dibuka melalui:

```text
http://localhost:5173
```

atau langsung melalui Laravel:

```text
http://127.0.0.1:8000
```

Untuk demo tugas akhir, jalur paling stabil adalah `http://127.0.0.1:8000` dengan Vite tetap berjalan di terminal frontend.

## Database

Sesuaikan konfigurasi database di `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=albrk_shoeclean
DB_USERNAME=root
DB_PASSWORD=
```

Jalankan migrasi:

```powershell
php artisan migrate
```

Jika ingin reset data demo:

```powershell
php artisan migrate:fresh --seed
```

## Build Production

Build asset frontend:

```powershell
cd frontend
npm install
npm run build
```

Optimasi Laravel:

```powershell
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Konfigurasi `.env` production:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://domain-kamu.com
```
