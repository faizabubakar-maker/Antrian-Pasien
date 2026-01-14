# Sistem Antrian Pasien (Laravel)

Aplikasi berbasis **Laravel** untuk mengelola antrian pasien di klinik/rumah sakit sederhana.  
Terdapat **2 role utama**: **Admin** dan **User (Pasien)**.

---

## Fitur Utama

##User (Pasien)
- Register & Login
- Melihat dashboard antrian pribadi
- Mendaftar antrian dokter
- Melihat nomor dan tanggal kunjungan
- Membatalkan antrian (jika masih WAITING)

## Admin
- Login sebagai admin
- Kelola Poli (CRUD)
- Kelola Dokter (CRUD + Jadwal)
- Melihat seluruh antrian pasien
- Filter antrian berdasarkan tanggal
- Update status antrian:
  - WAITING
  - CALLED
  - DONE
  - CANCELED
- Panggil nomor antrian berikutnya per dokter

---

## Teknologi yang Digunakan
- PHP 8.x
- Laravel 10.x
- MySQL
- Blade Template
- CSS Custom

---

## Cara Install & Menjalankan Project

## Clone Repository
```bash
git clone https://github.com/username/antrian-pasien.git
cd antrian-pasien

## Instal dependency
composer install

## Copy file environment
cp .env.example .env

## konfigurasi database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=antrian_pasien
DB_USERNAME=root
DB_PASSWORD=

## Generate app key
php artisan key:generate

## migrasi database
php artisan migrate

## jalankan seeder
php artisan db:seed

## jalankan server
php artisan serve

##  akses browser
http://127.0.0.1:8000

## Akun Admin
Email    : admin@gmail.com
Password : password
Role     : admin

## Akun User
Email    : user@gmail.com
Password : password
Role     : user


## Alur Penggunaan
## Admin
	1.	Login sebagai admin
	2.	Masuk ke Dashboard Admin
	3.	Kelola:
	•	Poli (CRUD)
	•	Dokter & jadwal (CRUD + edit nama/jam/hari)
	•	Antrian pasien
	4.	Filter antrian berdasarkan tanggal
	5.	Panggil antrian pasien sesuai dokter
	6.	Update status antrian (WAITING, CALLED, DONE, CANCELED)

## User
	1.	Register / Login
	2.	Masuk ke Dashboard User
	3.	Daftar antrian:
	•	Pilih dokter
	•	Pilih tanggal kunjungan
	•	Isi keluhan
	4.	Dapat nomor antrian otomatis
	5.	Pantau status antrian
	6.	Batalkan antrian jika status masih WAITING"# Antrian-Pasien" 
