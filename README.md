<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Cara Installasi

Berikut adalah cara installasi untuk menjalankan survey kepuasan pelanggan, bisa di clone ataupun di download langsung. Setelah berhasil maka masuk ke terminal, dan masuk ke direktory folder

- Ketik "composer install", tunggu sampe selesai
- Sambil menunggu selesai, bisa mengubah di direktory folder, .env.lokal di rename menjadi .env
- Edit .env pada bagian APP_URL disesuaikan dengan URL yang nantinya akan di jalankan untuk aplikasi
- Edit .env pada bagian database : DB_HOST (host database) DB_PORT (port database) DB_DATABASE (nama database) DB_USERNAME (username database. default: root) DB_PASSWORD (password database. kosongkan apabila tidak di password)
- Jika sudah selesai, kembali ke terminal
- Ketik "php artisan key:generate", tunggu sampe selesai
- Ketik "php artisan migrate --seed", tunggu sampe selesai.
- Ketik "php artisan storage:link", tunggu sampe selesai.

Setelah selesai, coba buka URL untuk membuka aplikasi tersebut. Jika berhasil maka akan diarahkan ke tampilan login. untuk awal user: admin@gmail.com dan password: password

Done

Jika diarahkan untuk memasukkan aktivation kode, bisa menghubungi: cs.retech@gmail.com dengan membayar license.

## Menu Aplikasi

Berikut adalah beberapa menu yang terdapat di dalam aplikasi

- Menu Dashboard
- Menu Profile
- Menu Laporan
- Menu Layanan
- Menu Pertanyaan
- Menu Pengaturan Pengguna (Administrator)
- Menu Pengaturan Instansi (Administrator)
- Menu Pengaturan PIN (Administrator)

Untuk mengakses menu yang masuk kategori Administrator dibutuhkan License Kode.

### Menu Dashboard

Melihat analytic setiap harinya survey yang masuk tidak terbatas pada beberapa layanan dan pertanyaan. Jadi data yang ditampilkan adalah akumulasi semua survey yang masuk pada hari itu.

Grafik yang ditampilkan adalah Grafik Dougnout (Donat) dan Bar (Batang).

### Menu Profile

Menampilkan data pribadi tentang user yang telah login. menampilkan beberapa attribute seperti : 

- Nama Pengguna
- Email
- Level Access
- Bergabung Sejak

Di menu ini juga kita dapat mengkonfigurasi data profile dan merequest untuk mengganti password akun

### Menu Laporan

Menu untuk melihat dan memfilter data menjadi sebuah laporan dalam bentuk grafik dan tabel

### Menu Layanan

Untuk mengkonfigurasi layanan yang tersedia di aplikasi

### Menu Pertanyaan

Untuk mengkonfigurasi pertanyaan dan layanan yang tersedia di aplikasi

### Pengaturan Pengguna

Untuk mengkonfigurasi pengguna, seperti menambahkan akun, mengedit akun user, mereset password akun user, dan menghapus akun user.

### Pengaturan Instansi

Untuk mengkonfigurasi nama instansi yang menggunakan aplikasi Survey Kepuasan Pelanggan. menu ini kita bisa menambahkan lebih dari satu instansi, dan jika kita ingin mengubah instansi tersebut bisa mengubah statusnya menjadi aktif.

Instansi yang sudah ada bisa di edit dan dihapus, untuk beberapa masukan yang bisa dikonfigurasi antara lain:

- Nama Instansi
- Alamat Instansi
- Informasi Instansi (akan menjadi text yang akan tampil di running text)
- Alamat Email
- Nomor Telp
- Logo 
- Ukuran Logo

Jangan lupa mengubah status nya menjadi aktif supaya antarmuka survey berubah sesuai dengan instansi yang aktif.

### Pengaturan PIN

Untuk melihat dan mengkonfigurasi PIN. PIN disini digunakan sebagai akses untuk masuk ke Antarmuka Survey.
Antarmuka survey terdiri atas Nama Layanan, Pertanyaan Layanan dan Kategori.

Kategori Survey ini dibagi menjadi 3, yaitu:
- Cukup Puas
- Puas
- Sangat Puas

## Penutup

Jika anda tertarik pada aplikasi ini, bisa menghubungi kontak email: cs.retech@gmail.com. Kami akan pandu sampai aplikasi berjalan dengan baik.

Recommendation: 
Upload aplikasi ini di Online Hosting agar pengalaman aplikasi bisa menjadi lebih baik.
