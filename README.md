# Toko Kopi Padma — Web Ordering System

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

---

# Tech Stack

- PHP (Native)
- MySQL
- Bootstrap 5
- HTML, CSS, JavaScript
- XAMPP / MAMP
- phpMyAdmin

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

# Troubleshooting

### ⚠️ Error: `Connection refused` (MAMP)

Gunakan port 8889:

```php
mysqli_connect("127.0.0.1", "root", "root", "padma_db", 8889);
```

### ⚠️ phpMyAdmin tidak muncul

Gunakan URL:

```
http://localhost:8888/phpmyadmin
```

Atau

```
http://localhost:8888/phpmyadmin5
```

### ⚠️ Gambar tidak muncul

Pastikan file berada di:

```
assets/img/
```

### ⚠️ Keranjang kosong saat checkout

Tambahkan:

```php
session_start();
```

di bagian paling atas file terkait.

---

# Deployment

1. Upload folder `padma/` ke **public_html**
2. Buat database MySQL di cPanel
3. Import file `padma_db.sql`
4. Edit `config/db.php` dengan credential hosting:

```php
$host = "localhost";
$user = "user_hosting";
$pass = "password_hosting";
$db   = "nama_database";
```
