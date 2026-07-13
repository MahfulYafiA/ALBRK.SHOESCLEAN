# Backend

Folder ini digunakan sebagai pintu masuk backend Laravel dan target pemisahan layer backend.

## Menjalankan Backend

```powershell
cd backend
php artisan serve
```

Jika muncul error temporary file Windows, gunakan script berikut:

```powershell
cd backend
.\start-backend.ps1
```

atau:

```powershell
cd backend
.\start-backend.bat
```

Backend berjalan di:

```text
http://127.0.0.1:8000
```

## Isi Backend

Layer backend utama pada project ini meliputi:

- Controller
- ViewModel
- Service
- Repository
- Model
- DTO
- Request Validation
- Enum

Catatan: project ini tetap berbasis Laravel, sehingga beberapa folder core Laravel seperti `config`, `routes`, `database`, `bootstrap`, `storage`, dan `public` tetap berada di root project agar kompatibel dengan struktur Laravel.
