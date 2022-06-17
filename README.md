# Pendahuluan

REST API sederhana menggunakan Lumen untuk menarik dan menyimpan data dari RajaOngkir.

# Ketentuan

Pastikan `composer`, `git`, 'CLI' dan tools pemprograman PHP lainnya sudah tersedia.

# Mendapatkan kode sumber

1. Clone dari Github `git clone https://github.com/cliexec/dottest.git`
2. Navigasi ke folder `cd dottest`

# Cara Instalasi

1. Buat database baru.
2. Buka file `.env` navigasi ke parameter database `DB_DATABASE`, `DB_USERNAME` dan `DB_PASSWORD` masing-masing isi dengan rincian database yang baru dibuat.
3. Buat tabel database jalankan `php artisan migrate`
4. Ambil dan simpan data provinsi dan kota dari RajaOngkir `php artisan fetch:provinces`
5. Jalankan server `php -S localhost:8001 -t public`

# Menentukan sumber data lokasi

Pada file `.env` definisikan `LOCATION_SOURCE=` default mengambil dari database. Set ke `LOCATION_SOURCE=rajaongkir` untuk fetch langsung dari API RajaOngkir.

# Membuat user

Jalankan perintah `php artisan create:user email=saya@gmail.com name=rahman token=123456` salin kode token yang muncul.

Argumen yang tersedia:

1. `email`
3. `name`
4. `token`

# Bermain dengan REST API

1. Perlihatkan provinsi berdasarkan id. Paste `http://localhost:8001/search/provinces?province_id=11&token=<sesuaikan dengan token ketika membuat user>` ke address bar browser. Nilai dari parameter `province_id` wajib, hanya menerima angka.
2. Perlihatkan kota berdasarkan id. Paste `http://localhost:8001/search/cities?city_id=14&token=<sesuaikan dengan token ketika membuat user>` ke address bar browser. Nilai dari parameter `city_id` wajib, hanya menerima angka.

# Catatan PENTING!

Tidak seharusnya file `.env` diikutkan dalam repository karena masalah kerahasiaan. Dikecualikan untuk project ini.