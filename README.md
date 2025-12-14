# Toko Kopi Padma | Web Ordering System

Di bawah ini adalah versi local/development dari produk web app toko kopi padma.

[Documentation Video](https://drive.google.com/drive/folders/1Ko6eR8Xzw-88C54Uj3uZkVH6iOkjgB07)

Toko Kopi Padma adalah aplikasi web sederhana untuk pemesanan menu cafe.  
Aplikasi ini dibuat menggunakan **Native PHP**, **MySQL**, **HTML**, **CSS**, **JavaScript**, dan **Bootstrap 5**.

Fitur utama mencakup:

- Halaman Customer (Home, Menu, Cart, Checkout, About)
- Sistem keranjang belanja (session)
- Pemesanan & nomor antrean otomatis
- Upload foto menu
- Admin Panel lengkap:
  - Login admin (password hashed)
  - CRUD Menu (Tambah, Edit, Hapus)
  - Daftar pesanan pelanggan
- Integrasi API Payment Gateway Midtrans

---

# Fitur Customer

- **Home page:** Hero section, promo, CTA
- **Halaman Menu:** List kategori & item menu
- **Add to Cart:** Menggunakan PHP session
- **Cart:** Menampilkan item + total harga
- **Checkout:** Input nama, WA, dine-in/takeaway
- **Nomor antrean otomatis**
- **Halaman sukses pesanan**
- **About Page**

---

# Fitur Admin

- Login admin dengan hashed password
- Tambah menu baru (upload gambar)
- Edit menu
- Hapus menu
- Lihat seluruh daftar menu
- Lihat daftar pesanan pelanggan
- Setiap pesanan memiliki nomor antrean

---

# Tech Stack

- PHP (Native)
- MySQL
- Bootstrap 5
- HTML, CSS, JavaScript
- XAMPP / MAMP
- phpMyAdmin

---

## Laporan Proyek

### 1. Frontend & Backend Development

#### Frontend

Frontend menggunakan tect stack sebagai berikut:

- HTML
- CSS
- JavaScript
- Bootstrap 5

Fitur frontend meliputi:

- Home page (hero section & CTA)
- Halaman menu
- Keranjang belanja (cart)
- Checkout
- Halaman sukses pemesanan
- About page

Tampilan dibuat responsif agar dapat diakses pada perangkat desktop maupun mobile.

#### Backend

Backend dikembangkan menggunakan **PHP Native** dengan fitur:

- PHP Session untuk cart
- Pemrosesan checkout
- Autentikasi admin
- CRUD menu
- Manajemen pesanan dan nomor antrean otomatis

Struktur backend dipisahkan antara halaman customer, admin, dan konfigurasi database.

---

### 2. Database Implementation

Database menggunakan **MySQL** dan dibuat melalui **phpMyAdmin**.

Tabel utama:

- `admin` : data admin (password di-hash)
- `menu` : data menu kopi
- `orders` : data pesanan pelanggan
- `order_items` : detail item pesanan

Relasi database:

- Satu pesanan memiliki banyak item
- Penomoran antrean otomatis berdasarkan urutan pesanan

---

### 3. Integrasi API

Aplikasi mengintegrasikan **Midtrans Payment Gateway API** untuk menangani proses pembayaran secara online.

Fitur utama integrasi meliputi:

- Generate transaksi pembayaran
- Redirect / popup ke halaman pembayaran Midtrans (Snap)
- Penyimpanan status transaksi

Integrasi dilakukan menggunakan **library resmi Midtrans PHP**, dengan **Server Key disimpan di backend** untuk menjaga keamanan data.

---

## 3.1 Persiapan Akun Midtrans

1. Daftar akun Midtrans melalui:
   https://dashboard.midtrans.com

2. Masuk ke **Midtrans Dashboard** dan gunakan **Sandbox Environment** untuk pengujian.

3. Buka menu: **Settings --> Access Keys**

4. Salin:
   - **Server Key (Sandbox)**
   - **Client Key (Sandbox)**

---

## 3.2 Instalasi Library Midtrans PHP

Library Midtrans diinstall menggunakan **Composer**.

Jalankan perintah berikut di root project:

```bash
composer require midtrans/midtrans-php
```

Setelah berhasil, folder `vendor/` akan otomatis terbentuk.

---

## 3.3 Konfigurasi Environment & Keamanan API Key

Untuk menjaga keamanan, API Key **tidak disimpan langsung di source code** dan **tidak di-commit ke GitHub**.

### 3.3.1 Membuat File Environment

Buat file berikut:

```
config/.env.php
```

Isi file:

```php
<?php
return [
    "MIDTRANS_SERVER_KEY" => "SB-Mid-server-XXXXXXXX",
    "MIDTRANS_CLIENT_KEY" => "SB-Mid-client-XXXXXXXX",
];
```

Tambahkan file ini ke `.gitignore`:

```gitignore
config/.env.php
```

---

## 3.4 Konfigurasi Midtrans PHP (Backend)

Buat file konfigurasi Midtrans:

```
config/midtrans.php
```

```php
<?php
require_once __DIR__ . '/../vendor/autoload.php';

$env = include __DIR__ . '/.env.php';

\Midtrans\Config::$serverKey = $env['MIDTRANS_SERVER_KEY'];
\Midtrans\Config::$clientKey = $env['MIDTRANS_CLIENT_KEY'];

\Midtrans\Config::$isProduction = false;
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;

function midtrans_client_key() {
    global $env;
    return $env['MIDTRANS_CLIENT_KEY'];
}
```

---

## 3.5 Proses Pembuatan Transaksi

Saat pelanggan melakukan checkout, sistem akan:

1. Menyimpan data pesanan ke database dengan status **pending**
2. Membuat `order_id` unik
3. Mengirim request ke Midtrans untuk mendapatkan **Snap Token**

Backend menggunakan method:

```php
\Midtrans\Snap::getSnapToken($params);
```

Snap Token dikirim ke frontend dalam format JSON.

---

## 3.6 Proses Pembayaran di Frontend

Pada halaman checkout, aplikasi memanggil **Midtrans Snap JavaScript**:

```html
<script
  src="https://app.sandbox.midtrans.com/snap/snap.js"
  data-client-key="<?= midtrans_client_key() ?>"
></script>
```

Saat tombol **Bayar** ditekan, Snap akan muncul sebagai popup pembayaran:

di checkout.php

```javascript
snap.pay(json.snap_token, {
  onSuccess: () =>
    (window.location.href = "checkout_success.php?id=" + json.order_id),
  onPending: () => alert("Menunggu pembayaran…"),
  onError: () => alert("Pembayaran gagal"),
});
```

---

## 3.7 Penyimpanan Status Transaksi

- Status transaksi awal disimpan sebagai **pending**
- Jika pembayaran berhasil, status diperbarui menjadi **success**
- Data transaksi tersimpan di tabel `orders` pada database MySQL

---

## 3.8 Keamanan Integrasi API

Langkah-langkah keamanan yang dilakukan:

- Server Key hanya digunakan di backend
- Client Key tidak di-hardcode di frontend
- File `.env.php` tidak disimpan di repository
- Menggunakan library resmi Midtrans PHP

Dengan konfigurasi ini, integrasi Midtrans akan terjaga keynya dan aman jika ingin di-push ke github / di-deploy untuk production.

---

### 4. Pengujian (Testing)

Pengujian dilakukan menggunakan metode **black-box testing**, meliputi:

- Input form checkout
- Keranjang belanja
- Login admin
- CRUD menu
- Nomor antrean otomatis
- Integrasi Midtrans

Hasil pengujian menunjukkan seluruh fitur utama berjalan sesuai kebutuhan.

Hasil pengujian dapat dilihat [di sini.](https://drive.google.com/drive/folders/1Ko6eR8Xzw-88C54Uj3uZkVH6iOkjgB07)

---

## Diagram Sistem

### Alur Sistem

1. Customer membuka website
2. Customer memilih menu
3. Menu ditambahkan ke cart (session)
4. Customer melakukan checkout
5. Sistem menghasilkan nomor antrean
6. Data pesanan disimpan ke database
7. Admin melihat pesanan melalui dashboard

---

## User Guide

### Customer

1. Buka website Toko Kopi Padma
2. Pilih menu yang tersedia
3. Klik **Add to Cart**
4. Buka halaman Cart
5. Klik **Checkout**
6. Isi data:
   - Nama
   - Nomor WhatsApp
   - Tipe pesanan (Dine-in / Takeaway)
7. Konfirmasi pesanan
8. Dapatkan nomor antrean

---

### Admin

1. Login ke halaman admin
2. Tambah menu baru (upload gambar)
3. Edit menu
4. Hapus menu
5. Lihat daftar pesanan pelanggan
6. Pantau nomor antrean

---

# Cara Menjalankan Project

## A. Menjalankan di XAMPP (Windows / Linux)

### 1. Install XAMPP

https://www.apachefriends.org/

### 2. Pindahkan folder project ke:

```
C:/xampp/htdocs/padma/
```

### 3. Jalankan **Apache** dan **MySQL** di XAMPP Control Panel

### 4. Buka phpMyAdmin

```
http://localhost/phpmyadmin
```

### 5. Import database

- Klik tab **Import**
- Pilih file: `sql/padma_db.sql`
- Klik **Import**

### 6. Sesuaikan koneksi database

Edit file `config/db.php`:

```php
$host = "127.0.0.1";
$user = "root";
$pass = ""; // Default password MySQL di XAMPP biasanya kosong
$db   = "padma_db";

$conn = mysqli_connect($host, $user, $pass, $db);
```

### 7. Jalankan aplikasi

```
http://localhost/padma/
```

---

## B. Menjalankan di MAMP (MacOS)

### 1. nstall MAMP

https://www.mamp.info/

### 2. Pindahkan project ke:

```
/Applications/MAMP/htdocs/padma/
```

### 3. Jalankan server MAMP

### 4. Buka phpMyAdmin

```
http://localhost:8888/phpmyadmin
```

### 5. Import database `padma_db.sql`

### 6. Sesuaikan koneksi database

Edit file `config/db.php`:

```php
$host = "127.0.0.1";
$user = "root";
$pass = "root";  // default password MySQL di MAMP
$db   = "padma_db";
$port = 8889;     // port MySQL default MAMP

$conn = mysqli_connect($host, $user, $pass, $db, $port);
```

### 7. Jalankan project

```
http://localhost:8888/padma/
```

---

# Membuat Akun Admin Awal

1. Jalankan file berikut di browser:

```
http://localhost/padma/admin/create_admin.php
```

Atau

```
http://localhost:8888/padma/admin/create_admin.php
```

2. Admin default akan dibuat:

- Email: **admin@padma.test**
- Password: **admin123**

3. Setelah akun admin berhasil dibuat, **hapus file `create_admin.php`** untuk keamanan.

4. Login admin:

```
http://localhost/padma/admin/login.php
```

Atau

```
http://localhost:8888/padma/admin/login.php
```

---

# Deployment

Karena kami mengalami kendala saay deployment, hasil website kami bisa dilihat melalui [video berikut.](https://drive.google.com/drive/folders/1Ko6eR8Xzw-88C54Uj3uZkVH6iOkjgB07)
