<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>SIP-Sarpras - Sistem Informasi Peminjaman Sarana Prasarana</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobileMenu');
            const hamburger = document.getElementById('hamburger');
            mobileMenu.classList.toggle('hidden');
            hamburger.classList.toggle('active');
        }

        function closeMobileMenu() {
            const mobileMenu = document.getElementById('mobileMenu');
            const hamburger = document.getElementById('hamburger');
            mobileMenu.classList.add('hidden');
            hamburger.classList.remove('active');
        }

        function handleMulaiPinjam() {
            const isAuthenticated = false;
            if (isAuthenticated) {
                window.location.href = "/dashboard";
            } else {
                window.location.href = "/login";
            }
        }

        function handleLogin() {
            window.location.href = "/login";
        }
    </script>
    <style>
        /* 3D Effects */
        .card-3d {
            transform-style: preserve-3d;
            box-shadow: 10px 10px 30px rgba(0, 0, 0, 0.1), -5px -5px 15px rgba(255, 255, 255, 0.7);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        @media (min-width: 768px) {
            .card-3d {
                transform: perspective(1000px) rotateY(-3deg);
                box-shadow: 20px 20px 60px rgba(0, 0, 0, 0.15), -10px -10px 30px rgba(255, 255, 255, 0.7);
            }
            
            .card-3d-right {
                transform: perspective(1000px) rotateY(3deg);
                box-shadow: -20px 20px 60px rgba(0, 0, 0, 0.15), 10px -10px 30px rgba(255, 255, 255, 0.7);
            }
        }
        
        .card-3d:hover {
            transform: perspective(1000px) rotateY(0deg) translateZ(10px);
        }
        
        .text-3d {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .btn-3d {
            transform: translateZ(0);
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
            transition: all 0.3s ease;
        }
        
        .btn-3d:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
        }
        
        .btn-3d:active {
            transform: translateY(0);
        }
        
        .box-3d {
            transform-style: preserve-3d;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        
        .box-3d:hover {
            transform: translateY(-5px);
        }
        
        .section-height {
            min-height: 100vh;
            padding: 80px 0;
        }
        
        /* Navbar fixed */
        .navbar-fixed {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
            transition: all 0.3s ease;
        }

        /* ===== LOGO GEDE TAPI NAVBAR TETAP TIPIS =====
           Logo di-overflow keluar navbar atas & bawah pakai margin negatif.
           Navbar height-nya tetap ditentukan oleh py-2, bukan oleh logo. */
        .logo-wrap {
            display: flex;
            align-items: center;
            overflow: visible;
            /* margin negatif biar logo bisa menjulur keluar navbar */
            margin-top: -20px;
            margin-bottom: -20px;
        }

        .logo-img {
            height: 100px;   /* gede banget, keliatan jelas */
            width: auto;
            object-fit: contain;
            object-position: left center;
            border-radius: 0;
            box-shadow: none;
            border: none;
            position: relative;
            z-index: 10;     /* pastikan logo di atas elemen lain */
        }

        @media (min-width: 640px) {
            .logo-img {
                height: 110px;
            }
        }

        @media (min-width: 1024px) {
            .logo-img {
                height: 120px;
            }
            .logo-wrap {
                margin-top: -24px;
                margin-bottom: -24px;
            }
        }

        @media (max-width: 360px) {
            .logo-img {
                height: 80px;
            }
            .logo-wrap {
                margin-top: -16px;
                margin-bottom: -16px;
            }
            .brand-text { font-size: 1.1rem !important; }
            .nav-padding { padding-left: 0.75rem !important; padding-right: 0.75rem !important; }
            h1 { font-size: 1.8rem !important; }
        }
        
        /* Hamburger Icon Animation */
        .hamburger {
            cursor: pointer;
            width: 30px;
            height: 24px;
            position: relative;
            z-index: 60;
        }
        
        .hamburger span {
            display: block;
            position: absolute;
            height: 3px;
            width: 100%;
            background: #1e40af;
            border-radius: 3px;
            opacity: 1;
            left: 0;
            transform: rotate(0deg);
            transition: .25s ease-in-out;
        }
        
        .hamburger span:nth-child(1) { top: 0px; }
        .hamburger span:nth-child(2) { top: 10px; }
        .hamburger span:nth-child(3) { top: 20px; }
        
        .hamburger.active span:nth-child(1) {
            top: 10px;
            transform: rotate(135deg);
        }
        .hamburger.active span:nth-child(2) {
            opacity: 0;
            left: -60px;
        }
        .hamburger.active span:nth-child(3) {
            top: 10px;
            transform: rotate(-135deg);
        }
        
        #mobileMenu {
            transition: all 0.3s ease-in-out;
        }
        
        .image-container {
            width: 100%;
            height: 200px;
            overflow: hidden;
            border-radius: 0.75rem;
            background: linear-gradient(to bottom right, #2563eb, #1e40af);
        }
        
        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }
        
        html {
            scroll-padding-top: 80px;
        }
        
        @media (max-width: 640px) {
            .text-3d {
                text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
            }
            h1 {
                font-size: 2rem !important;
                line-height: 1.2 !important;
            }
            .container-padding {
                padding-left: 1rem !important;
                padding-right: 1rem !important;
            }
        }
        
        .card-max-width {
            max-width: 100%;
        }
        
        button, a {
            -webkit-tap-highlight-color: transparent;
        }
        button:active, a:active {
            opacity: 0.8;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-white font-sans antialiased overflow-x-hidden">
    
    <!-- Navbar -->
    <nav class="navbar-fixed fixed w-full top-0 z-50 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-2 md:py-2">
            <div class="flex justify-between items-center">
                <!-- Logo Besar tapi Navbar Tetap Kompak -->
                <div class="logo-wrap">
                    <img src="{{ asset('assets_public/sip.png')}}" alt="SIP-Sarpras Logo" class="logo-img">
                </div>
                
                <!-- Desktop Menu -->
                <div class="hidden lg:flex space-x-6 xl:space-x-8">
                    <a href="#home" class="text-gray-700 hover:text-blue-600 font-medium transition text-sm lg:text-base">Home</a>
                    <a href="#ketentuan" class="text-gray-700 hover:text-blue-600 font-medium transition text-sm lg:text-base">Ketentuan</a>
                </div>
                
                <!-- Desktop Auth Buttons -->
                <div class="hidden lg:flex items-center space-x-4">
                    <button onclick="handleLogin()" class="bg-blue-600 text-white px-5 xl:px-6 py-2 rounded-lg btn-3d font-semibold cursor-pointer text-sm xl:text-base whitespace-nowrap">
                        Login
                    </button>
                </div>
                
                <!-- Mobile Hamburger -->
                <div class="lg:hidden">
                    <div id="hamburger" class="hamburger" onclick="toggleMobileMenu()">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
            
            <!-- Mobile Menu -->
            <div id="mobileMenu" class="hidden lg:hidden mt-4 pb-4">
                <div class="flex flex-col space-y-3 bg-white rounded-lg shadow-lg p-4">
                    <a href="#home" onclick="closeMobileMenu()" class="text-gray-700 hover:text-blue-600 font-medium transition py-3 px-3 rounded hover:bg-blue-50 text-base">Home</a>
                    <a href="#ketentuan" onclick="closeMobileMenu()" class="text-gray-700 hover:text-blue-600 font-medium transition py-3 px-3 rounded hover:bg-blue-50 text-base">Ketentuan</a>
                    <div class="border-t pt-4 mt-2">
                        <button onclick="handleLogin()" class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg btn-3d font-semibold cursor-pointer text-base">
                            Login
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Section 1: Home -->
    <section id="home" class="section-height flex items-center justify-center pt-16 md:pt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                <div class="space-y-4 sm:space-y-6 text-center lg:text-left order-2 lg:order-1">
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-blue-900 text-3d leading-tight">
                        Sistem Informasi Peminjaman Sarpras
                    </h1>
                    <p class="text-base sm:text-lg md:text-xl text-gray-600 leading-relaxed max-w-2xl mx-auto lg:mx-0">
                        Kelola peminjaman sarana dan prasarana sekolah dengan mudah, cepat, dan terorganisir
                    </p>
                    <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center lg:justify-start">
                        <button onclick="handleMulaiPinjam()" class="bg-blue-600 text-white px-6 sm:px-8 py-3 sm:py-4 rounded-lg btn-3d font-semibold text-base sm:text-lg cursor-pointer w-full sm:w-auto active:scale-95 transition-transform">
                            Mulai Pinjam
                        </button>
                        <a href="#ketentuan" class="border-2 border-blue-600 text-blue-600 px-6 sm:px-8 py-3 sm:py-4 rounded-lg font-semibold text-base sm:text-lg hover:bg-blue-50 transition cursor-pointer w-full sm:w-auto text-center active:bg-blue-100">
                            Pelajari Lebih
                        </a>
                    </div>
                </div>
                
                <div class="flex justify-center order-1 lg:order-2">
                    <div class="card-3d bg-white p-5 sm:p-6 md:p-8 lg:p-10 rounded-2xl w-full max-w-md shadow-lg card-max-width">
                        <div class="space-y-4 sm:space-y-5 md:space-y-6">
                            <div class="box-3d bg-gradient-to-br from-blue-100 to-blue-200 p-4 sm:p-5 md:p-6 rounded-xl flex items-center gap-3 sm:gap-4">
                                <svg class="w-6 h-6 sm:w-7 sm:h-7 text-blue-700 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3l7 4v5c0 5-3.5 7.5-7 9-3.5-1.5-7-4-7-9V7l7-4z"/>
                                </svg>
                                <span class="text-blue-900 font-semibold text-sm sm:text-base md:text-lg">Gunakan fasilitas dengan bijak</span>
                            </div>
                            <div class="box-3d bg-gradient-to-br from-blue-100 to-blue-200 p-4 sm:p-5 md:p-6 rounded-xl flex items-center gap-3 sm:gap-4">
                                <svg class="w-6 h-6 sm:w-7 sm:h-7 text-blue-700 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5h6m-6 4h6m-6 4h6M7 3h10a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z"/>
                                </svg>
                                <span class="text-blue-900 font-semibold text-sm sm:text-base md:text-lg">Peminjaman tertib, kegiatan lancar</span>
                            </div>
                            <div class="box-3d bg-gradient-to-br from-blue-100 to-blue-200 p-4 sm:p-5 md:p-6 rounded-xl flex items-center gap-3 sm:gap-4">
                                <svg class="w-6 h-6 sm:w-7 sm:h-7 text-blue-700 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m-3-7a9 9 0 100 18 9 9 0 000-18z"/>
                                </svg>
                                <span class="text-blue-900 font-semibold text-sm sm:text-base md:text-lg">Jaga sarpras untuk bersama</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section: Ketentuan -->
    <section id="ketentuan" class="section-height flex items-center justify-center bg-white pt-16 md:pt-20">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="text-center mb-8 sm:mb-12">
                <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-blue-900 text-3d mb-3 sm:mb-4">
                    Ketentuan Peminjaman
                </h2>
                <p class="text-sm sm:text-base md:text-lg lg:text-xl text-gray-600">
                    Aturan dan prosedur yang harus dipatuhi dalam peminjaman sarpras
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 gap-5 sm:gap-6 lg:gap-8">
                <div class="card-3d bg-gradient-to-br from-blue-50 to-white p-5 sm:p-6 md:p-8 rounded-2xl border-2 border-blue-200">
                    <div class="space-y-4 sm:space-y-5 md:space-y-6">
                        <div class="flex items-start space-x-3 sm:space-x-4">
                            <div class="w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold text-base sm:text-lg md:text-xl box-3d flex-shrink-0">✓</div>
                            <div>
                                <h3 class="font-bold text-blue-900 text-sm sm:text-base md:text-lg mb-1">Kartu Identitas</h3>
                                <p class="text-gray-600 text-xs sm:text-sm md:text-base">Wajib menunjukkan kartu pelajar/guru yang masih berlaku</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3 sm:space-x-4">
                            <div class="w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold text-base sm:text-lg md:text-xl box-3d flex-shrink-0">✓</div>
                            <div>
                                <h3 class="font-bold text-blue-900 text-sm sm:text-base md:text-lg mb-1">Formulir Peminjaman</h3>
                                <p class="text-gray-600 text-xs sm:text-sm md:text-base">Mengisi formulir peminjaman dengan lengkap dan benar</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3 sm:space-x-4">
                            <div class="w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold text-base sm:text-lg md:text-xl box-3d flex-shrink-0">✓</div>
                            <div>
                                <h3 class="font-bold text-blue-900 text-sm sm:text-base md:text-lg mb-1">Persetujuan</h3>
                                <p class="text-gray-600 text-xs sm:text-sm md:text-base">Mendapat persetujuan dari penanggung jawab sarpras</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card-3d-right bg-gradient-to-br from-blue-50 to-white p-5 sm:p-6 md:p-8 rounded-2xl border-2 border-blue-200">
                    <div class="space-y-4 sm:space-y-5 md:space-y-6">
                        <div class="flex items-start space-x-3 sm:space-x-4">
                            <div class="w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 bg-red-600 rounded-lg flex items-center justify-center text-white font-bold text-base sm:text-lg md:text-xl box-3d flex-shrink-0">✗</div>
                            <div>
                                <h3 class="font-bold text-blue-900 text-sm sm:text-base md:text-lg mb-1">Kondisi Barang</h3>
                                <p class="text-gray-600 text-xs sm:text-sm md:text-base">Bertanggung jawab atas kerusakan atau kehilangan barang</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3 sm:space-x-4">
                            <div class="w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 bg-red-600 rounded-lg flex items-center justify-center text-white font-bold text-base sm:text-lg md:text-xl box-3d flex-shrink-0">✗</div>
                            <div>
                                <h3 class="font-bold text-blue-900 text-sm sm:text-base md:text-lg mb-1">Waktu Pengembalian</h3>
                                <p class="text-gray-600 text-xs sm:text-sm md:text-base">Denda keterlambatan Rp 5.000/hari untuk setiap barang</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3 sm:space-x-4">
                            <div class="w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 bg-red-600 rounded-lg flex items-center justify-center text-white font-bold text-base sm:text-lg md:text-xl box-3d flex-shrink-0">✗</div>
                            <div>
                                <h3 class="font-bold text-blue-900 text-sm sm:text-base md:text-lg mb-1">Pemindahtanganan</h3>
                                <p class="text-gray-600 text-xs sm:text-sm md:text-base">Dilarang memindahtangankan barang kepada pihak lain</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gradient-to-br from-blue-900 to-blue-800 text-white py-8 sm:py-10 md:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
                <div>
                    <div class="flex items-center space-x-2 sm:space-x-3 mb-3 sm:mb-4">
                        <div class="w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 bg-white rounded-lg flex items-center justify-center">
                            <span class="text-blue-900 font-bold text-lg sm:text-xl md:text-2xl">🏫</span>
                        </div>
                        <span class="text-base sm:text-lg md:text-xl font-bold">SMKN 1 Ciomas</span>
                    </div>
                    <p class="text-blue-200 text-xs sm:text-sm leading-relaxed">
                        Jalan Raya Laladon, Desa Laladon<br>
                        Kecamatan Ciomas, Kabupaten Bogor<br>
                        Jawa Barat
                    </p>
                </div>
                
                <div>
                    <h3 class="font-bold text-sm sm:text-base md:text-lg mb-3 sm:mb-4">Informasi Sarpras</h3>
                    <ul class="space-y-1.5 sm:space-y-2 text-blue-200 text-xs sm:text-sm">
                        <li>Jam Operasional: 07:00 - 16:00</li>
                        <li>Hari Kerja: Senin - Jumat</li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="font-bold text-sm sm:text-base md:text-lg mb-3 sm:mb-4">Kontak</h3>
                    <ul class="space-y-1.5 sm:space-y-2 text-blue-200 text-xs sm:text-sm break-words">
                        <li>📞 (0251)-7520933</li>
                        <li>📱 0896-1829-7321</li>
                        <li>✉️ smkn1_ciomas@yahoo.co.id</li>
                        <li>🌐 www.smkn1ciomas.sch.id</li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="font-bold text-sm sm:text-base md:text-lg mb-3 sm:mb-4">Quick Links</h3>
                    <ul class="space-y-1.5 sm:space-y-2 text-blue-200 text-xs sm:text-sm">
                        <li><a href="#home" class="hover:text-white transition block py-1">Home</a></li>
                        <li><a href="#ketentuan" class="hover:text-white transition block py-1">Ketentuan</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-blue-700 mt-6 sm:mt-8 pt-6 sm:pt-8 text-center text-blue-200 text-xs sm:text-sm">
                <p>&copy; 2026 SIP-Sarpras. Sistem Informasi Peminjaman Sarana Prasarana. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) {
                const mobileMenu = document.getElementById('mobileMenu');
                const hamburger = document.getElementById('hamburger');
                if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                    hamburger.classList.remove('active');
                }
            }
        });
    </script>
</body>
</html>