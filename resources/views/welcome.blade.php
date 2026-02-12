<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIP-Sarpras - Sistem Informasi Peminjaman Sarana Prasarana</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Toggle mobile menu
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobileMenu');
            const hamburger = document.getElementById('hamburger');
            mobileMenu.classList.toggle('hidden');
            hamburger.classList.toggle('active');
        }

        // Close mobile menu when clicking a link
        function closeMobileMenu() {
            const mobileMenu = document.getElementById('mobileMenu');
            const hamburger = document.getElementById('hamburger');
            mobileMenu.classList.add('hidden');
            hamburger.classList.remove('active');
        }

        // Fungsi untuk handle klik tombol Mulai Pinjam
        function handleMulaiPinjam() {
            // Placeholder for authentication check
            // In production, replace with actual Laravel authentication
            const isAuthenticated = false;
            
            if (isAuthenticated) {
                window.location.href = "/dashboard";
            } else {
                window.location.href = "/login";
            }
        }

        // Fungsi untuk handle login
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
        
        .hamburger span:nth-child(1) {
            top: 0px;
        }
        
        .hamburger span:nth-child(2) {
            top: 10px;
        }
        
        .hamburger span:nth-child(3) {
            top: 20px;
        }
        
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
        
        /* Mobile menu animation */
        #mobileMenu {
            transition: all 0.3s ease-in-out;
        }
        
        /* Image container fix */
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
        
        /* Smooth scroll offset for fixed navbar */
        html {
            scroll-padding-top: 80px;
        }
        
        /* Responsive text sizes */
        @media (max-width: 640px) {
            .text-3d {
                text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
            }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-white font-sans">
    
    <!-- Navbar -->
    <nav class="navbar-fixed fixed w-full top-0 z-50 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-4">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <div class="flex items-center space-x-2 sm:space-x-3">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-blue-600 to-blue-800 rounded-lg flex items-center justify-center text-white font-bold text-lg sm:text-xl shadow-lg">
                        S
                    </div>
                    <span class="text-xl sm:text-2xl font-bold text-blue-800">SIP-Sarpras</span>
                </div>
                
                <!-- Desktop Menu -->
                <div class="hidden lg:flex space-x-6 xl:space-x-8">
                    <a href="#home" class="text-gray-700 hover:text-blue-600 font-medium transition">Home</a>
                    <a href="#about" class="text-gray-700 hover:text-blue-600 font-medium transition">About</a>
                    <a href="#barang" class="text-gray-700 hover:text-blue-600 font-medium transition">Barang</a>
                    <a href="#ketentuan" class="text-gray-700 hover:text-blue-600 font-medium transition">Ketentuan</a>
                    <a href="#pinjam-kembali" class="text-gray-700 hover:text-blue-600 font-medium transition">Pinjam Kembali</a>
                    <a href="#kontak" class="text-gray-700 hover:text-blue-600 font-medium transition">Kontak</a>
                </div>
                
                <!-- Desktop Auth Buttons -->
                <div class="hidden lg:flex items-center space-x-4">
                    <!-- Replace @auth/@endauth with actual authentication logic in production -->
                    <button onclick="handleLogin()" class="bg-blue-600 text-white px-4 xl:px-6 py-2 rounded-lg btn-3d font-semibold cursor-pointer text-sm xl:text-base">
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
                    <a href="#home" onclick="closeMobileMenu()" class="text-gray-700 hover:text-blue-600 font-medium transition py-2 px-3 rounded hover:bg-blue-50">Home</a>
                    <a href="#about" onclick="closeMobileMenu()" class="text-gray-700 hover:text-blue-600 font-medium transition py-2 px-3 rounded hover:bg-blue-50">About</a>
                    <a href="#barang" onclick="closeMobileMenu()" class="text-gray-700 hover:text-blue-600 font-medium transition py-2 px-3 rounded hover:bg-blue-50">Barang</a>
                    <a href="#ketentuan" onclick="closeMobileMenu()" class="text-gray-700 hover:text-blue-600 font-medium transition py-2 px-3 rounded hover:bg-blue-50">Ketentuan</a>
                    <a href="#pinjam-kembali" onclick="closeMobileMenu()" class="text-gray-700 hover:text-blue-600 font-medium transition py-2 px-3 rounded hover:bg-blue-50">Pinjam Kembali</a>
                    <a href="#kontak" onclick="closeMobileMenu()" class="text-gray-700 hover:text-blue-600 font-medium transition py-2 px-3 rounded hover:bg-blue-50">Kontak</a>
                    <div class="border-t pt-3 mt-2">
                        <button onclick="handleLogin()" class="w-full bg-blue-600 text-white px-6 py-2 rounded-lg btn-3d font-semibold cursor-pointer">
                            Login
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Section 1: Home -->
    <section id="home" class="section-height flex items-center justify-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                <!-- Text Content -->
                <div class="space-y-4 sm:space-y-6 text-center lg:text-left order-2 lg:order-1">
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-blue-900 text-3d leading-tight">
                        Sistem Informasi Peminjaman Sarpras
                    </h1>
                    <p class="text-base sm:text-lg md:text-xl text-gray-600 leading-relaxed">
                        Kelola peminjaman sarana dan prasarana sekolah dengan mudah, cepat, dan terorganisir
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <button onclick="handleMulaiPinjam()" class="bg-blue-600 text-white px-6 sm:px-8 py-3 sm:py-4 rounded-lg btn-3d font-semibold text-base sm:text-lg cursor-pointer w-full sm:w-auto">
                            Mulai Pinjam
                        </button>
                        <button onclick="window.location.href='#about'" class="border-2 border-blue-600 text-blue-600 px-6 sm:px-8 py-3 sm:py-4 rounded-lg font-semibold text-base sm:text-lg hover:bg-blue-50 transition cursor-pointer w-full sm:w-auto">
                            Pelajari Lebih
                        </button>
                    </div>
                </div>
                
               <!-- Motivation Card with Modern Icons -->
<div class="flex justify-center order-1 lg:order-2">
    <div class="card-3d bg-white p-6 sm:p-8 lg:p-12 rounded-2xl w-full max-w-md shadow-lg">

        <div class="space-y-4 sm:space-y-6">

            <!-- Bijak -->
            <div class="box-3d bg-gradient-to-br from-blue-100 to-blue-200 p-4 sm:p-6 rounded-xl flex items-center gap-4">
                <svg class="w-7 h-7 text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 3l7 4v5c0 5-3.5 7.5-7 9-3.5-1.5-7-4-7-9V7l7-4z"/>
                </svg>
                <span class="text-blue-900 font-semibold text-base sm:text-lg">
                    Gunakan fasilitas dengan bijak
                </span>
            </div>

            <!-- Tertib -->
            <div class="box-3d bg-gradient-to-br from-blue-100 to-blue-200 p-4 sm:p-6 rounded-xl flex items-center gap-4">
                <svg class="w-7 h-7 text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 5h6m-6 4h6m-6 4h6M7 3h10a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z"/>
                </svg>
                <span class="text-blue-900 font-semibold text-base sm:text-lg">
                    Peminjaman tertib, kegiatan lancar
                </span>
            </div>

            <!-- Tanggung Jawab -->
            <div class="box-3d bg-gradient-to-br from-blue-100 to-blue-200 p-4 sm:p-6 rounded-xl flex items-center gap-4">
                <svg class="w-7 h-7 text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12l2 2 4-4m-3-7a9 9 0 100 18 9 9 0 000-18z"/>
                </svg>
                <span class="text-blue-900 font-semibold text-base sm:text-lg">
                    Jaga sarpras untuk bersama
                </span>
            </div>

        </div>
    </div>
</div>


            </div>
        </div>
    </section>

    <!-- Section 2: About -->
    <section id="about" class="section-height flex items-center justify-center bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                <!-- Features Card -->
                <div class="flex justify-center order-2 lg:order-1">
                    <div class="card-3d-right bg-gradient-to-br from-blue-50 to-white p-6 sm:p-8 lg:p-12 rounded-2xl w-full max-w-md border-2 border-blue-200">
                        <div class="space-y-6 sm:space-y-8">
                            <div class="flex items-start space-x-3 sm:space-x-4">
                                <div class="w-12 h-12 sm:w-16 sm:h-16 bg-blue-600 rounded-xl flex items-center justify-center text-white text-xl sm:text-2xl font-bold box-3d flex-shrink-0">
                                    1
                                </div>
                                <div>
                                    <h3 class="font-bold text-blue-900 text-base sm:text-lg mb-1 sm:mb-2">Mudah Digunakan</h3>
                                    <p class="text-gray-600 text-sm sm:text-base">Interface intuitif dan user-friendly</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3 sm:space-x-4">
                                <div class="w-12 h-12 sm:w-16 sm:h-16 bg-blue-600 rounded-xl flex items-center justify-center text-white text-xl sm:text-2xl font-bold box-3d flex-shrink-0">
                                    2
                                </div>
                                <div>
                                    <h3 class="font-bold text-blue-900 text-base sm:text-lg mb-1 sm:mb-2">Real-time Tracking</h3>
                                    <p class="text-gray-600 text-sm sm:text-base">Monitor status barang secara langsung</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3 sm:space-x-4">
                                <div class="w-12 h-12 sm:w-16 sm:h-16 bg-blue-600 rounded-xl flex items-center justify-center text-white text-xl sm:text-2xl font-bold box-3d flex-shrink-0">
                                    3
                                </div>
                                <div>
                                    <h3 class="font-bold text-blue-900 text-base sm:text-lg mb-1 sm:mb-2">Laporan Lengkap</h3>
                                    <p class="text-gray-600 text-sm sm:text-base">Data terorganisir dengan baik</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Text Content -->
                <div class="space-y-4 sm:space-y-6 text-center lg:text-left order-1 lg:order-2">
                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-blue-900 text-3d">
                        Tentang SIP-Sarpras
                    </h2>
                    <p class="text-base sm:text-lg text-gray-600 leading-relaxed">
                        SIP-Sarpras adalah sistem informasi modern yang dirancang khusus untuk memudahkan pengelolaan peminjaman sarana dan prasarana di lingkungan sekolah.
                    </p>
                    <p class="text-base sm:text-lg text-gray-600 leading-relaxed">
                        Dengan fitur-fitur canggih dan antarmuka yang mudah digunakan, sistem ini membantu meningkatkan efisiensi dan transparansi dalam proses peminjaman barang sekolah.
                    </p>
                    <div class="grid grid-cols-2 gap-4 pt-4">
                        <div class="box-3d bg-blue-50 p-4 sm:p-6 rounded-xl border border-blue-200">
                            <div class="text-2xl sm:text-3xl font-bold text-blue-900">99%</div>
                            <div class="text-gray-600 mt-1 text-sm sm:text-base">Kepuasan User</div>
                        </div>
                        <div class="box-3d bg-blue-50 p-4 sm:p-6 rounded-xl border border-blue-200">
                            <div class="text-2xl sm:text-3xl font-bold text-blue-900">24/7</div>
                            <div class="text-gray-600 mt-1 text-sm sm:text-base">Akses Online</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 3: Barang -->
    <section id="barang" class="section-height flex items-center justify-center bg-gradient-to-br from-blue-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="text-center mb-8 sm:mb-12">
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-blue-900 text-3d mb-3 sm:mb-4">
                    Katalog Barang
                </h2>
                <p class="text-base sm:text-xl text-gray-600">
                    Lihat dan pinjam berbagai sarana prasarana yang tersedia
                </p>
            </div>
            
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                <!-- Card 1 --> 
                <div class="card-3d bg-white p-6 sm:p-8 rounded-2xl">
                    <div class="image-container mb-4 sm:mb-6">
                        <img src="{{ asset('assets_public/proyektor.jpg')}}" alt="Buku & Literatur" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-xl sm:text-2xl font-bold text-blue-900 mb-2 sm:mb-3">Proyektor</h3>
                    <p class="text-gray-600 mb-3 sm:mb-4 text-sm sm:text-base">Koleksi proyektor</p>
                    <div class="flex justify-between items-center">
                        <span class="text-blue-600 font-semibold text-sm sm:text-base">7 Items</span>
                        <button class="bg-blue-600 text-white px-3 sm:px-4 py-2 rounded-lg text-xs sm:text-sm btn-3d">Lihat</button>
                    </div>
                </div>
                
                <!-- Card 2 -->
                <div class="card-3d bg-white p-6 sm:p-8 rounded-2xl">
                    <div class="image-container mb-4 sm:mb-6">
                        <img src="{{ asset('assets_public/mic.jpg')}}" alt="Buku & Literatur" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-xl sm:text-2xl font-bold text-blue-900 mb-2 sm:mb-3">Mic</h3>
                    <p class="text-gray-600 mb-3 sm:mb-4 text-sm sm:text-base">Koleksi Mic</p>
                    <div class="flex justify-between items-center">
                        <span class="text-blue-600 font-semibold text-sm sm:text-base">10 Items</span>
                        <button class="bg-blue-600 text-white px-3 sm:px-4 py-2 rounded-lg text-xs sm:text-sm btn-3d">Lihat</button>
                    </div>
                </div>
                
                <!-- Card 3 -->
                <div class="card-3d bg-white p-6 sm:p-8 rounded-2xl">
                    <div class="image-container mb-4 sm:mb-6">
                        <img src="{{ asset('assets_public/stopkontak.jpg')}}" alt="Buku & Literatur" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-xl sm:text-2xl font-bold text-blue-900 mb-2 sm:mb-3">Stop kontak</h3>
                    <p class="text-gray-600 mb-3 sm:mb-4 text-sm sm:text-base">Koleksi stopkontak</p>
                    <div class="flex justify-between items-center">
                        <span class="text-blue-600 font-semibold text-sm sm:text-base">10 Items</span>
                        <button class="bg-blue-600 text-white px-3 sm:px-4 py-2 rounded-lg text-xs sm:text-sm btn-3d">Lihat</button>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

    <!-- Section 4: Ketentuan -->
    <section id="ketentuan" class="section-height flex items-center justify-center bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="text-center mb-8 sm:mb-12">
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-blue-900 text-3d mb-3 sm:mb-4">
                    Ketentuan Peminjaman
                </h2>
                <p class="text-base sm:text-xl text-gray-600">
                    Aturan dan prosedur yang harus dipatuhi dalam peminjaman sarpras
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 gap-6 sm:gap-8">
                <!-- Do's Card -->
                <div class="card-3d bg-gradient-to-br from-blue-50 to-white p-6 sm:p-8 rounded-2xl border-2 border-blue-200">
                    <div class="space-y-4 sm:space-y-6">
                        <div class="flex items-start space-x-3 sm:space-x-4">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold text-lg sm:text-xl box-3d flex-shrink-0">
                                ✓
                            </div>
                            <div>
                                <h3 class="font-bold text-blue-900 text-base sm:text-lg mb-1 sm:mb-2">Kartu Identitas</h3>
                                <p class="text-gray-600 text-sm sm:text-base">Wajib menunjukkan kartu pelajar/guru yang masih berlaku</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3 sm:space-x-4">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold text-lg sm:text-xl box-3d flex-shrink-0">
                                ✓
                            </div>
                            <div>
                                <h3 class="font-bold text-blue-900 text-base sm:text-lg mb-1 sm:mb-2">Formulir Peminjaman</h3>
                                <p class="text-gray-600 text-sm sm:text-base">Mengisi formulir peminjaman dengan lengkap dan benar</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3 sm:space-x-4">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold text-lg sm:text-xl box-3d flex-shrink-0">
                                ✓
                            </div>
                            <div>
                                <h3 class="font-bold text-blue-900 text-base sm:text-lg mb-1 sm:mb-2">Persetujuan</h3>
                                <p class="text-gray-600 text-sm sm:text-base">Mendapat persetujuan dari penanggung jawab sarpras</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Don'ts Card -->
                <div class="card-3d-right bg-gradient-to-br from-blue-50 to-white p-6 sm:p-8 rounded-2xl border-2 border-blue-200">
                    <div class="space-y-4 sm:space-y-6">
                        <div class="flex items-start space-x-3 sm:space-x-4">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-red-600 rounded-lg flex items-center justify-center text-white font-bold text-lg sm:text-xl box-3d flex-shrink-0">
                                ✗
                            </div>
                            <div>
                                <h3 class="font-bold text-blue-900 text-base sm:text-lg mb-1 sm:mb-2">Kondisi Barang</h3>
                                <p class="text-gray-600 text-sm sm:text-base">Bertanggung jawab atas kerusakan atau kehilangan barang</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3 sm:space-x-4">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-red-600 rounded-lg flex items-center justify-center text-white font-bold text-lg sm:text-xl box-3d flex-shrink-0">
                                ✗
                            </div>
                            <div>
                                <h3 class="font-bold text-blue-900 text-base sm:text-lg mb-1 sm:mb-2">Waktu Pengembalian</h3>
                                <p class="text-gray-600 text-sm sm:text-base">Denda keterlambatan Rp 5.000/hari untuk setiap barang</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3 sm:space-x-4">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-red-600 rounded-lg flex items-center justify-center text-white font-bold text-lg sm:text-xl box-3d flex-shrink-0">
                                ✗
                            </div>
                            <div>
                                <h3 class="font-bold text-blue-900 text-base sm:text-lg mb-1 sm:mb-2">Pemindahtanganan</h3>
                                <p class="text-gray-600 text-sm sm:text-base">Dilarang memindahtangankan barang kepada pihak lain</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 5: Pinjam Kembali -->
    <section id="pinjam-kembali" class="section-height flex items-center justify-center bg-gradient-to-br from-blue-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                <!-- Steps Content -->
                <div class="space-y-4 sm:space-y-6 order-2 lg:order-1">
                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-blue-900 text-3d text-center lg:text-left">
                        Prosedur Pinjam & Kembali
                    </h2>
                    <p class="text-base sm:text-lg text-gray-600 leading-relaxed text-center lg:text-left">
                        Ikuti langkah-langkah mudah untuk meminjam dan mengembalikan sarana prasarana sekolah
                    </p>
                    
                    <div class="space-y-3 sm:space-y-4">
                        <div class="box-3d bg-white p-4 sm:p-6 rounded-xl border-l-4 border-blue-600">
                            <div class="flex items-center space-x-3 sm:space-x-4">
                                <div class="w-8 h-8 sm:w-10 sm:h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-sm sm:text-base flex-shrink-0">1</div>
                                <div>
                                    <h3 class="font-bold text-blue-900 text-sm sm:text-base">Login ke Sistem</h3>
                                    <p class="text-gray-600 text-xs sm:text-sm">Masuk menggunakan akun Anda</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="box-3d bg-white p-4 sm:p-6 rounded-xl border-l-4 border-blue-600">
                            <div class="flex items-center space-x-3 sm:space-x-4">
                                <div class="w-8 h-8 sm:w-10 sm:h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-sm sm:text-base flex-shrink-0">2</div>
                                <div>
                                    <h3 class="font-bold text-blue-900 text-sm sm:text-base">Pilih Barang</h3>
                                    <p class="text-gray-600 text-xs sm:text-sm">Cari dan pilih barang yang ingin dipinjam</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="box-3d bg-white p-4 sm:p-6 rounded-xl border-l-4 border-blue-600">
                            <div class="flex items-center space-x-3 sm:space-x-4">
                                <div class="w-8 h-8 sm:w-10 sm:h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-sm sm:text-base flex-shrink-0">3</div>
                                <div>
                                    <h3 class="font-bold text-blue-900 text-sm sm:text-base">Ajukan Peminjaman</h3>
                                    <p class="text-gray-600 text-xs sm:text-sm">Isi formulir dan tunggu persetujuan</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="box-3d bg-white p-4 sm:p-6 rounded-xl border-l-4 border-blue-600">
                            <div class="flex items-center space-x-3 sm:space-x-4">
                                <div class="w-8 h-8 sm:w-10 sm:h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-sm sm:text-base flex-shrink-0">4</div>
                                <div>
                                    <h3 class="font-bold text-blue-900 text-sm sm:text-base">Ambil & Kembalikan</h3>
                                    <p class="text-gray-600 text-xs sm:text-sm">Ambil barang dan kembalikan tepat waktu</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Status Card -->
                <div class="flex justify-center order-1 lg:order-2">
                    <div class="card-3d-right bg-white p-6 sm:p-8 lg:p-10 rounded-2xl w-full max-w-md">
                        <h3 class="text-xl sm:text-2xl font-bold text-blue-900 mb-4 sm:mb-6 text-center">Status Peminjaman Anda</h3>
                        <div class="space-y-3 sm:space-y-4">
                            <div class="box-3d bg-gradient-to-r from-green-50 to-green-100 p-3 sm:p-4 rounded-lg border border-green-300">
                                <div class="flex justify-between items-center gap-2">
                                    <div class="min-w-0">
                                        <div class="font-bold text-green-900 text-sm sm:text-base truncate">Proyektor LCD</div>
                                        <div class="text-xs sm:text-sm text-green-700">Kembali: 15 Feb 2026</div>
                                    </div>
                                    <span class="bg-green-500 text-white px-2 sm:px-3 py-1 rounded-full text-xs font-semibold flex-shrink-0">Aktif</span>
                                </div>
                            </div>
                            
                            <div class="box-3d bg-gradient-to-r from-yellow-50 to-yellow-100 p-3 sm:p-4 rounded-lg border border-yellow-300">
                                <div class="flex justify-between items-center gap-2">
                                    <div class="min-w-0">
                                        <div class="font-bold text-yellow-900 text-sm sm:text-base truncate">Bola Basket</div>
                                        <div class="text-xs sm:text-sm text-yellow-700">Kembali: 12 Feb 2026</div>
                                    </div>
                                    <span class="bg-yellow-500 text-white px-2 sm:px-3 py-1 rounded-full text-xs font-semibold flex-shrink-0">H-1</span>
                                </div>
                            </div>
                            
                            <div class="box-3d bg-gradient-to-r from-blue-50 to-blue-100 p-3 sm:p-4 rounded-lg border border-blue-300">
                                <div class="flex justify-between items-center gap-2">
                                    <div class="min-w-0">
                                        <div class="font-bold text-blue-900 text-sm sm:text-base truncate">Mikroskop</div>
                                        <div class="text-xs sm:text-sm text-blue-700">Menunggu persetujuan</div>
                                    </div>
                                    <span class="bg-blue-500 text-white px-2 sm:px-3 py-1 rounded-full text-xs font-semibold flex-shrink-0">Proses</span>
                                </div>
                            </div>
                        </div>
                        
                        <button class="w-full bg-blue-600 text-white py-2 sm:py-3 rounded-lg mt-4 sm:mt-6 btn-3d font-semibold text-sm sm:text-base">
                            Lihat Semua Riwayat
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 6: Kontak -->
    <section id="kontak" class="section-height flex items-center justify-center bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="text-center mb-8 sm:mb-12">
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-blue-900 text-3d mb-3 sm:mb-4">
                    Hubungi Kami
                </h2>
                <p class="text-base sm:text-xl text-gray-600">
                    Ada pertanyaan? Kami siap membantu Anda
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 gap-8 sm:gap-12">
                <!-- Contact Info -->
                <div class="space-y-4 sm:space-y-6">
                    <div class="card-3d bg-gradient-to-br from-blue-50 to-white p-4 sm:p-6 rounded-xl border border-blue-200">
                        <div class="flex items-start space-x-3 sm:space-x-4">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-blue-600 rounded-lg flex items-center justify-center text-white text-lg sm:text-xl box-3d flex-shrink-0">
                                📍
                            </div>
                            <div>
                                <h3 class="font-bold text-blue-900 text-base sm:text-lg mb-1 sm:mb-2">Alamat</h3>
                                <p class="text-gray-600 text-sm sm:text-base">Jalan Raya Laladon, Desa Laladon, Kecamatan Ciomas, Kabupaten Bogor, Jawa Barat<br>
                        Jakarta Selatan 12345</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-3d bg-gradient-to-br from-blue-50 to-white p-4 sm:p-6 rounded-xl border border-blue-200">
                        <div class="flex items-start space-x-3 sm:space-x-4">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-blue-600 rounded-lg flex items-center justify-center text-white text-lg sm:text-xl box-3d flex-shrink-0">
                                📞
                            </div>
                            <div>
                                <h3 class="font-bold text-blue-900 text-base sm:text-lg mb-1 sm:mb-2">Telepon</h3>
                                <p class="text-gray-600 text-sm sm:text-base"> (0251) -7520933</p>
                                <p class="text-gray-600 text-sm sm:text-base"> 0896-1829-7321</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-3d bg-gradient-to-br from-blue-50 to-white p-4 sm:p-6 rounded-xl border border-blue-200">
                        <div class="flex items-start space-x-3 sm:space-x-4">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-blue-600 rounded-lg flex items-center justify-center text-white text-lg sm:text-xl box-3d flex-shrink-0">
                                ✉️
                            </div>
                            <div>
                                <h3 class="font-bold text-blue-900 text-base sm:text-lg mb-1 sm:mb-2">Email</h3>
                                <p class="text-gray-600 text-sm sm:text-base">smkn1_ciomas@yahoo.co.id</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Contact Form -->
                <div class="card-3d-right bg-white p-6 sm:p-8 rounded-2xl border-2 border-blue-200">
                    <h3 class="text-xl sm:text-2xl font-bold text-blue-900 mb-4 sm:mb-6">Kirim Pesan</h3>
                    <form class="space-y-3 sm:space-y-4">
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2 text-sm sm:text-base">Nama Lengkap</label>
                            <input type="text" class="w-full px-3 sm:px-4 py-2 sm:py-3 rounded-lg border-2 border-gray-300 focus:border-blue-600 focus:outline-none text-sm sm:text-base" placeholder="Masukkan nama Anda">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2 text-sm sm:text-base">Email</label>
                            <input type="email" class="w-full px-3 sm:px-4 py-2 sm:py-3 rounded-lg border-2 border-gray-300 focus:border-blue-600 focus:outline-none text-sm sm:text-base" placeholder="email@example.com">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2 text-sm sm:text-base">Pesan</label>
                            <textarea rows="4" class="w-full px-3 sm:px-4 py-2 sm:py-3 rounded-lg border-2 border-gray-300 focus:border-blue-600 focus:outline-none text-sm sm:text-base" placeholder="Tulis pesan Anda..."></textarea>
                        </div>
                        <button type="submit" class="w-full bg-blue-600 text-white py-2 sm:py-3 rounded-lg btn-3d font-semibold text-sm sm:text-base lg:text-lg">
                            Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gradient-to-br from-blue-900 to-blue-800 text-white py-8 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
                <div>
                    <div class="flex items-center space-x-2 sm:space-x-3 mb-3 sm:mb-4">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-white rounded-lg flex items-center justify-center">
                            <span class="text-blue-900 font-bold text-lg sm:text-xl">🏫</span>
                        </div>
                        <span class="text-lg sm:text-xl font-bold">Sekolah</span>
                    </div>
                    <p class="text-blue-200 text-xs sm:text-sm leading-relaxed">
                        SMKN 1 Ciomas<br>
                        Jalan Raya Laladon, Desa Laladon, Kecamatan Ciomas, Kabupaten Bogor, Jawa Barat<br>
                        Jakarta Selatan 12345
                    </p>
                </div>
                
                <div>
                    <h3 class="font-bold text-base sm:text-lg mb-3 sm:mb-4">Informasi Sarpras</h3>
                    <ul class="space-y-1 sm:space-y-2 text-blue-200 text-xs sm:text-sm">
                        <li>Jam Operasional: 07:00 - 16:00</li>
                        <li>Hari Kerja: Senin - Jumat</li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="font-bold text-base sm:text-lg mb-3 sm:mb-4">Kontak</h3>
                    <ul class="space-y-1 sm:space-y-2 text-blue-200 text-xs sm:text-sm">
                        <li>📞 (0251)-7520933</li>
                        <li>📱 0896-1829-7321</li>
                        <li>✉️ smkn1_ciomas@yahoo.co.id</li>
                        <li>🌐 www.smkn1ciomas.sch.id</li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="font-bold text-base sm:text-lg mb-3 sm:mb-4">Quick Links</h3>
                    <ul class="space-y-1 sm:space-y-2 text-blue-200 text-xs sm:text-sm">
                        <li><a href="#home" class="hover:text-white transition">Home</a></li>
                        <li><a href="#about" class="hover:text-white transition">About</a></li>
                        <li><a href="#barang" class="hover:text-white transition">Katalog Barang</a></li>
                        <li><a href="#ketentuan" class="hover:text-white transition">Ketentuan</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-blue-700 mt-6 sm:mt-8 pt-6 sm:pt-8 text-center text-blue-200 text-xs sm:text-sm">
                <p>&copy; 2026 SIP-Sarpras. Sistem Informasi Peminjaman Sarana Prasarana. All rights reserved.</p>
            </div>
        </div>
    </footer>

</body>
</html>