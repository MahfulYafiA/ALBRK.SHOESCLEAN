# Frontend

Folder ini berisi konfigurasi frontend development menggunakan Vite serta asset CSS dan JavaScript.

## Menjalankan Frontend

```powershell
cd frontend
npm install
npm run dev
```

Frontend development server berjalan di:

```text
http://localhost:5173
```

Pada mode development, Vite dapat mem-proxy request ke backend Laravel di:

```text
http://127.0.0.1:8000
```

## Build Production

```powershell
cd frontend
npm run build
```

Hasil build akan digunakan Laravel sebagai asset production.
