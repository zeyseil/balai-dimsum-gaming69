<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balai Dimsum</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;800&family=Jua&display=swap" rel="stylesheet">
    <link rel="stylesheet" href='style4.css'>

    <script>
function autoGrow(element) {
    element.style.height = "auto";
    element.style.height = element.scrollHeight + "px";
}
</script>
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

    <!-- GALERI PREVIEW -->
    <section class="gallery-box">
        <h2>Galeri</h2>
    
        <div class="gallery-slider">
        <div class="gallery-slides" id="gallerySlides">
            <img src="./img/display.png" alt="">
            <img src="./img/display2.jpg" alt="">
            <img src="./img/display3.jpg" alt="">
            <img src="./img/display4.jpeg" alt="">
            <img src="./img/display5.jpg" alt="">
        </div>

        <button class="gallery-nav prev" onclick="prevGallery()">‹</button>
        <button class="gallery-nav next" onclick="nextGallery()">›</button>
    </div>
    </section>

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
<!-- script untuk slider -->
<script>
let galleryIndex = 0;
const gallerySlides = document.getElementById('gallerySlides');
const galleryTotal = gallerySlides.children.length;
let autoSlideInterval;

// update posisi slide
function updateGallery() {
    gallerySlides.style.transform =
        `translateX(-${galleryIndex * 100}%)`;
}

// slide ke kanan
function nextGallery() {
    galleryIndex = (galleryIndex + 1) % galleryTotal;
    updateGallery();
    resetAutoSlide();
}

// slide ke kiri
function prevGallery() {
    galleryIndex = (galleryIndex - 1 + galleryTotal) % galleryTotal;
    updateGallery();
    resetAutoSlide();
}

// auto slide
function startAutoSlide() {
    autoSlideInterval = setInterval(() => {
        galleryIndex = (galleryIndex + 1) % galleryTotal;
        updateGallery();
    }, 3500);
}

// reset timer saat user klik
function resetAutoSlide() {
    clearInterval(autoSlideInterval);
    startAutoSlide();
}

// mulai otomatis saat halaman load
startAutoSlide();
</script>
</body>
</html>