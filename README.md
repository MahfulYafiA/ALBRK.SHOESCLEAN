# ALBRK Shoesclean

ALBRK Shoesclean adalah aplikasi reservasi dan pengelolaan layanan cuci sepatu berbasis Laravel. Aplikasi ini mendukung alur pelanggan, admin, kasir, dan superadmin.

## Fitur

- Pelanggan dapat memilih satu atau beberapa layanan dalam satu reservasi. Harga dihitung dari gabungan layanan terpilih dikalikan jumlah pasang sepatu.
- Reservasi menyimpan setiap layanan sebagai detail terpisah, lalu menampilkan semua layanan pada riwayat pelanggan, antrean admin, dan laporan.
- Pelanggan dapat memantau status reservasi dari menunggu hingga selesai.
- Admin dapat memperbarui status pesanan. Pesanan berstatus selesai tetap berada di antrean sampai ditandai sudah diambil.
- Aplikasi menyediakan pengelolaan katalog layanan, pengguna, kasir offline, pembayaran, dan laporan omzet.

## Arsitektur

Project ini merupakan Laravel monolith modular dengan pemisahan layer dan pendekatan MVVM.

```text
Route -> Controller -> ViewModel -> Service -> Repository -> Model -> Database
                           |
                           v
                         View
```

- `Controller` menerima request dan memilih alur proses.
- `ViewModel` menyiapkan data untuk tampilan.
- `Service` berisi logika bisnis.
- `Repository` menangani akses data.
- `Model` merepresentasikan tabel database.
- `View` menampilkan halaman Blade.

## Struktur Folder

```text
albrkshoesclean/
|-- app/                      # Controller, model, service, repository, dan ViewModel
|-- bootstrap/                # Bootstrap Laravel
|-- config/                   # Konfigurasi Laravel
|-- database/                 # Migration, seeder, dan factory
|-- public/                   # Document root web server
|-- resources/views/          # Tampilan Blade
|-- routes/                   # Definisi route aplikasi
|-- storage/                  # Cache, log, dan upload runtime
|-- tests/                    # Test aplikasi
|-- artisan
|-- composer.json
`-- package.json
```

## Menjalankan untuk Development

Persyaratan utama: PHP 8.2+, Composer, Node.js, npm, dan MySQL.

Jalankan dari folder project:

```powershell
composer install
Copy-Item .env.example .env # jika file .env belum ada
php artisan key:generate
npm install
```

Sesuaikan koneksi database pada `.env`, lalu jalankan migrasi dan data awal:

```powershell
php artisan migrate --seed
```

Jalankan Laravel dan Vite:

```powershell
composer run dev
```

Website tersedia di `http://127.0.0.1:8000`.

## Database

Contoh konfigurasi MySQL pada `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=albrk_shoescare
DB_USERNAME=root
DB_PASSWORD=
```

Jalankan migrasi baru dengan:

```powershell
php artisan migrate
```

Untuk menghapus seluruh tabel dan membangun ulang database beserta seed, gunakan `php artisan migrate:fresh --seed`. Perintah ini menghapus data yang ada.

## Build Production

```powershell
npm install
npm run build
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Atur `.env` production, termasuk `APP_ENV=production`, `APP_DEBUG=false`, dan `APP_URL` sesuai domain aplikasi.
