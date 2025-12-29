<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('dsb.css') }}">
    <title>Balai Dimsum - Dashboard</title>
</head>
<body>
    <div class="bd-wrapper">
        <!-- SIDEBAR -->
        <div class="bd-sidebar" id="sidebarBD">
            <div class="bd-sidebar__judul">
                <div class="bd-sidebar__logo"><img src="./img/logodimsum.jpg" alt="Logo" width="52" height="52"></div>
                <span>Balai Dimsum</span>
            </div>
            <ul class="bd-menu">
                <li class="bd-menu__item">
                    <a href="/admin" class="bd-menu__link bd-menu__link--aktif"><img src="img/dbs.png"" alt=""> Dashboard</a>
                </li>
                <li class="bd-menu__item">
                    <a href="/penjualan" class="bd-menu__link"><img src="img/crt.png"" alt=""> Data penjualan</a>
                </li>
                <li class="bd-menu__item">
                    <a href="/stock" class="bd-menu__link"><img src="img/sb.png"" alt="">Update stock</a>
                </li>
                                <li class="bd-menu__item">
                    <a href="/pesanan" class="bd-menu__link"><img src="img/sb.png"" alt="">Pesanan</a>
                </li>
            </ul>
        </div>

        <!-- MAIN CONTENT -->
        <div class="bd-main" id="mainBD">
            <!-- HEADER -->
            <div class="bd-header">
                <div class="bd-header__kiri">
                    <button class="bd-header__tombol-menu" onclick="toggleSidebarBD()">☰</button>
                    <div class="bd-header__judul">Balai Dimsum Dashboard</div>
                </div>
                <div class="bd-header__kanan">
                    <button class="bd-header__notif"><img src="img/bl.png"" alt=""></button>
                    <div class="bd-user">
                        <div class="bd-user__avatar"></div>
                        <span class="bd-user__label">owner</span>
                    </div>
                </div>
            </div>

            <!-- KONTEN -->
            <div class="bd-konten">
                <!-- STAT CARDS -->
                     @yield('content')
            </div>
        </div>
    </div>

    <script>
        function toggleSidebarBD() {
            const sidebar = document.getElementById('sidebarBD');
            const main = document.getElementById('mainBD');
            
            sidebar.classList.toggle('bd-sidebar--tutup');
            main.classList.toggle('bd-main--sidebar-tutup');
        }
        const links = document.querySelectorAll('.bd-menu__link bd-menu__link--aktif');
        const currentLocation = window.location.pathname;

        links.forEach(link => {
             if (link.getAttribute('href') === currentLocation.split('/').pop()) {
             link.classList.add('active');
      }
    });
    </script>
</body>
</html>