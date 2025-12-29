## Cara konfigurasi

> [WAJIB]
> **Konfigurasi:** clone repository, jalankan 'composer install', copy file .env.example menjadi .env, jangan lupa masukan perintah php artisan migrate untuk ngeintregasikan database, terakhir di .env nya konfigurasi disesuaikan seperti berikut:

``` 
APP_NAME=balai_dimsum
DB_CONNECTION=mysql
#.....    <- // hapus pagar setiap barisan dibawah barisan DB_CONNECTION tersebut
DB_DATABASE=balai_dimsum
```

setelah semua konfigurasi selesai dilakukan, silahkan membuka xampp atau laragon untuk menyalakan databasenya.
