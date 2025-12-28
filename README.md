## Cara konfigurasi

> [!WAJIB]
> **Konfigurasi:** clone repository, jalankan seperti biasa, jangan lupa masukan perintah php artisan migrate buat ngeintregasikan database, di .env nya setting sesuaikan seperti berikut:

``` 
APP_NAME=balai_dimsum
DB_CONNECTION=mysql
#.....    <- // hapus pagar setiap barisan dibawah barisan DB_CONNECTION tersebut
DB_DATABASE=balai_dimsum
)

```

setelah semua konfigurasi selesai dilakukan, silahkan membuka xampp atau laragon untuk menyalakan databasenya.  
