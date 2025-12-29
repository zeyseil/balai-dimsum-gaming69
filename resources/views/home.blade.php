<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balai Dimsum</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;800&family=Jua&display=swap" rel="stylesheet">
    <style>
        a {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="logo">
    <img src="./img/logodimsum.jpg" alt="Logo">
</div>
            <nav>
                <a href="/">Home</a>
                <a href="/menu">Menu</a>
                <a href="/saran">Saran</a>
                <a href="/galeri">Galeri</a>
            </nav>
        </div>

        <!-- Hero Section -->
        <div class="hero-section">
            <div class="hero-overlay"></div>
            <div class="welcome-text">
                <h1>Selamat Datang di<br>Balai Dimsum</h1>
            </div>
        </div>

        <!-- About Section -->
        <div class="about-section">
            <div class="about-container">
                <div class="about-image">
                    <div class="about-left">
            <img src="img/logodimsum.jpg" class="about-logo" alt="Logo">
        </div>

                </div>
                <div class="about-content">
                    <h2>About Us</h2>
                    <p>Balai Dimsum adalah sebuah unit Usaha Mikro, Kecil, dan Menengah (UMKM) yang fokus menjual Dimsum Mentai, dengan harga murah tapi tidak murahan karena Dimsum Mentai ini dibuat dengan hati sehingga rasanya yang nikmat. Tentunya Dimsum yang kami produksi tidak menggunakan pengawet. Balai Dimsum terletak di Jalan Pasir Impun.</p>
                </div>
            </div>
        </div>

        <!-- Tagline Section -->
        <div class="tagline-section">
            <div class="dimsum-deco dimsum1">
                <img src="img/dimsum1.png"> 
            </div>
            <div class="dimsum-deco dimsum2">
                <img src="img/dimsum1.png">
            </div>
            <div class="tagline-banner">
                <h2>Dimsumkeun, let's try our signature mentai!</h2>
            </div>
        </div>

        <!-- Content Cards -->
         <div class="content-section">
            <div class="cards-container">
                <div class="card">
                    <div class="card-header">FOOD</div>
                    <div class="card-image food-image"></div>
                    <div class="card-text">
                        Nikmati kelezatan dimsum mentai kami yang dibuat dengan bahan-bahan segar dan berkualitas. Setiap gigitan memberikan sensasi rasa yang memanjakan lidah.
                    </div>
                    <a href="/menu">
                    <div class="card-button">
                        <span >Pesan Sekarang</span>
                    </div></a>
                </div>

                <div class="card">
                    <div class="card-header">OUTLET</div>
                    <div class="card-image outlet-image"></div>
                    <div class="card-text">
                        Kunjungi kami di BANDUNG TIMUR, Jl. Pasir Impun No. 28. Lokasi strategis dan mudah dijangkau untuk menikmati dimsum favorit Anda.
                    </div>
                    <a href="https://maps.app.goo.gl/uKkpyGTYmCJcB38RA"
                        target="_blank">
                       <div class="card-button">
                        <span>Baca Selengkapnya</span>
                    </div></a>
                </div>

                <div class="card">
                    <div class="card-header">GALERI</div>
                    <div class="card-image gallery-image"></div>
                    <div class="card-text">
                        Lihat berbagai foto produk dan momen spesial kami. Dari proses pembuatan hingga penyajian dimsum yang menggugah selera.
                    </div>
                    <a href="/galeri"><div class="card-button">
                        <span>Baca Selengkapnya</span>
                    </div></a>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer-bottom">
                <div class="copyright">Copyright 2025. All rights reserved.</div>
                <div class="footer-strip"></div>
        </div>
    </div>
</body>
</html>