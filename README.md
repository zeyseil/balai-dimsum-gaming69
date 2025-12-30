## Cara konfigurasi

> [!WAJIB]
> **Konfigurasi:** clone repository, jalankan 'composer install' dan 'php artisan key:generate', copy file .env.example menjadi .env, jangan lupa masukan perintah php artisan migrate untuk ngeintegrasikan database, terakhir di .env nya konfigurasi disesuaikan seperti berikut:

``` 
APP_NAME=balai_dimsum
DB_CONNECTION=mysql
#.....    <- // hapus pagar setiap barisan dibawah barisan DB_CONNECTION tersebut
DB_DATABASE=balai_dimsum
```

setelah semua konfigurasi selesai dilakukan, silahkan membuka xampp atau laragon untuk menyalakan databasenya.

**NOTE:** jika gambar tidak pada database tidak tampil jalankan perintah 'php artisan storage:link'.
