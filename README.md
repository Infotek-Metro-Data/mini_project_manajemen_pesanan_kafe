# ☕ Sistem Manajemen Pesanan Kafe — Mini Project Laravel
---

## Deadline tanggal 24

## 🎯 Tujuan Pembelajaran

- Membangun sistem autentikasi dengan Laravel dan role-based access
- Membuat CRUD dengan relasi antar tabel (One-to-Many & Many-to-Many)
- Mengelola upload gambar dan validasi data
- Menggunakan Tailwind CSS untuk tampilan modern, bersih, dan responsif
- Mengaplikasikan konsep transaksi sederhana dalam database

---

## ☕ Deskripsi Singkat

Aplikasi memiliki tiga role pengguna:

| Role      | Hak Akses                                                                 |
|-----------|---------------------------------------------------------------------------|
| Admin     | Mengelola data menu dan pengguna                                          |
| Kasir     | Mencatat pesanan pelanggan dan memproses status pembayaran               |
| Pelanggan | Membuat pesanan dan melihat riwayat pesanan mereka                       |

---

## 🧱 Struktur Database

### 1. Tabel `users`

| Field     | Keterangan             |
|-----------|------------------------|
| id        | Primary Key            |
| name      | Nama pengguna          |
| email     | Unik                   |
| password  | Password terenkripsi   |
| role      | admin, kasir, pelanggan |

### 2. Tabel `kategori_menu`

| Field         | Keterangan                          |
|---------------|-------------------------------------|
| id            | Primary Key                         |
| nama_kategori | Nama kategori (Minuman, Makanan, Dessert) |

### 3. Tabel `menu`

| Field        | Keterangan                          |
|--------------|-------------------------------------|
| id           | Primary Key                         |
| kategori_id  | Relasi ke `kategori_menu`           |
| nama_menu    | Nama item                           |
| harga        | Integer                             |
| stok         | Integer                             |
| deskripsi    | Text (opsional)                     |
| foto         | Nama file gambar menu               |

### 4. Tabel `pesanan`

| Field        | Keterangan                          |
|--------------|-------------------------------------|
| id           | Primary Key                         |
| user_id      | ID pelanggan                        |
| tanggal      | Timestamp                           |
| total_harga  | Integer                             |
| status       | pending, dibayar, batal             |

### 5. Tabel `pesanan_detail`

| Field        | Keterangan                          |
|--------------|-------------------------------------|
| id           | Primary Key                         |
| pesanan_id   | Relasi ke `pesanan`                 |
| menu_id      | Relasi ke `menu`                    |
| jumlah       | Integer                             |
| subtotal     | Integer                             |

---

## ⚙️ Spesifikasi Fitur

### 1. 🔐 Autentikasi & Role

- Gunakan Laravel Breeze atau Fortify untuk login & register
- Role: admin, kasir, pelanggan
- Middleware untuk membatasi akses halaman sesuai role
- Admin dapat menambah user atau mengubah role

### 2. 📋 Manajemen Menu

- Hanya Admin yang dapat menambah, edit, dan hapus menu
- Upload foto menu ke `storage/app/public/menu`

#### Validasi:

- `nama_menu`, `kategori_id`, `harga`, dan `stok` wajib diisi
- `foto` wajib diupload saat tambah, opsional saat edit
- Format foto: jpg, jpeg, png maksimal 2MB

### 3. 🛒 Manajemen Pesanan

- Pelanggan dapat membuat pesanan (pilih menu dan jumlah)
- Kasir memproses pesanan (ubah status menjadi dibayar atau batal)
- Saat pesanan dibuat → stok menu berkurang otomatis
- Saat pesanan dibatalkan → stok kembali seperti semula

### 4. 📖 Riwayat Pesanan

- Pelanggan dapat melihat daftar pesanan miliknya
- Kasir dan Admin dapat melihat semua riwayat pesanan

### 5. 🎨 UI/UX dengan Tailwind CSS

- Semua tampilan menggunakan Tailwind CSS
- Komponen yang digunakan:

  - Layout dengan navbar dan sidebar responsif
  - Card untuk menampilkan menu (dengan foto dan harga)
  - Badge untuk status pesanan
  - Form modern dengan input validasi yang jelas

#### Halaman Minimal:

- Login / Register
- Dashboard (tergantung role)
- Data Menu (CRUD)
- Form Pesanan
- Riwayat Pesanan

---

## 💾 Relasi Tabel

- `users` → memiliki banyak `pesanan`
- `kategori_menu` → memiliki banyak `menu`
- `menu` → memiliki banyak `pesanan_detail`
- `pesanan` → memiliki banyak `pesanan_detail`
- `pesanan_detail` → milik `menu` dan `pesanan`

---

## 💡 Validasi Penting

- `harga` dan `stok` harus angka > 0
- `jumlah` pesanan tidak boleh melebihi `stok`
- Tidak boleh menambah menu tanpa kategori

---

## 🧠 Challenge 

- Filter kategori di halaman daftar menu
- Pencarian menu berdasarkan nama
- Notifikasi popup (SweetAlert) saat transaksi berhasil
- Fitur upload bukti pembayaran (gambar) oleh pelanggan

---
