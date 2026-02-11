<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - Daftar Akun</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-image: url('{{ asset('assets_admin/img/bg.jpeg ') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        /* Overlay untuk memastikan readability */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.1);
            z-index: -1;
        }
        
        .input-focus:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(59, 130, 246, 0.3);
        }
        
        .image-float {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        html, body {
            height: 100%;
            overflow: hidden;
        }

        .container-wrapper {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: auto;
        }

        /* Mobile responsive - HIDE image on mobile */
        @media (max-width: 768px) {
            .right-section {
                display: none !important;
            }
            
            /* Adjust background for mobile */
            body {
                background-size: cover;
                background-position: center center;
            }
        }

        /* Desktop layout - card left, icon right */
        @media (min-width: 769px) {
            .register-container {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 2rem;
                max-width: 1200px;
                margin: 0 auto;
            }
            
            .left-section {
                flex: 0 0 auto;
                max-width: 420px;
                width: 100%;
            }
            
            .right-section {
                flex: 0 0 auto;
                max-width: 400px;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    
    <div class="container-wrapper p-3">
        
        <div class="register-container w-full">
            
            <!-- Left Side - Register Form Section -->
            <div class="left-section w-full max-w-md mx-auto md:mx-0">

                <!-- Register Card -->
                <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-100">
                    <div class="p-5 sm:p-6">
                        
                        <!-- Header inside card -->
                        <div class="text-center mb-4">
                            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">
                                Register
                            </h2>
                            <p class="mt-1 text-xs sm:text-sm text-gray-600">
                                Buat akun baru Anda
                            </p>
                        </div>
                        
                        <form method="POST" action="{{ route('register') }}" class="space-y-3">
                            @csrf
                            
                            <!-- Name Field -->
                            <div>
                                <label for="name" class="block text-xs font-semibold text-gray-700 mb-1">
                                    Nama
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-4 w-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <input 
                                        id="name" 
                                        name="name" 
                                        type="text" 
                                        required 
                                        autofocus
                                        autocomplete="name"
                                        value="{{ old('name') }}"
                                        class="input-focus appearance-none block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg text-sm text-gray-900 placeholder-gray-400 focus:outline-none transition duration-200 bg-gray-50"
                                        placeholder="Masukkan nama lengkap">
                                </div>
                                <x-input-error :messages="$errors->get('name')" class="mt-1" />
                            </div>

                            <!-- Email Field -->
                            <div>
                                <label for="email" class="block text-xs font-semibold text-gray-700 mb-1">
                                    Email
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-4 w-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                        </svg>
                                    </div>
                                    <input 
                                        id="email" 
                                        name="email" 
                                        type="email" 
                                        required
                                        autocomplete="username"
                                        value="{{ old('email') }}"
                                        class="input-focus appearance-none block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg text-sm text-gray-900 placeholder-gray-400 focus:outline-none transition duration-200 bg-gray-50"
                                        placeholder="nama@email.com">
                                </div>
                                <x-input-error :messages="$errors->get('email')" class="mt-1" />
                            </div>

                            <!-- Password Field -->
                            <div>
                                <label for="password" class="block text-xs font-semibold text-gray-700 mb-1">
                                    Password
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-4 w-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                    </div>
                                    <input 
                                        id="password" 
                                        name="password" 
                                        type="password" 
                                        required
                                        autocomplete="new-password"
                                        class="input-focus appearance-none block w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-lg text-sm text-gray-900 placeholder-gray-400 focus:outline-none transition duration-200 bg-gray-50"
                                        placeholder="••••••••">
                                    <button type="button" onclick="togglePassword('password')" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                        <svg id="eye-open-password" class="h-4 w-4 text-gray-400 hover:text-blue-500 transition duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        <svg id="eye-closed-password" class="h-4 w-4 text-gray-400 hover:text-blue-500 transition duration-200 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                        </svg>
                                    </button>
                                </div>
                                <x-input-error :messages="$errors->get('password')" class="mt-1" />
                            </div>

                            <!-- Confirm Password Field -->
                            <div>
                                <label for="password_confirmation" class="block text-xs font-semibold text-gray-700 mb-1">
                                    Konfirmasi Password
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-4 w-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                    </div>
                                    <input 
                                        id="password_confirmation" 
                                        name="password_confirmation" 
                                        type="password" 
                                        required
                                        autocomplete="new-password"
                                        class="input-focus appearance-none block w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-lg text-sm text-gray-900 placeholder-gray-400 focus:outline-none transition duration-200 bg-gray-50"
                                        placeholder="••••••••">
                                    <button type="button" onclick="togglePassword('password_confirmation')" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                        <svg id="eye-open-confirmation" class="h-4 w-4 text-gray-400 hover:text-blue-500 transition duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        <svg id="eye-closed-confirmation" class="h-4 w-4 text-gray-400 hover:text-blue-500 transition duration-200 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                        </svg>
                                    </button>
                                </div>
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                            </div>

                            <!-- Register Button -->
                            <div class="pt-1">
                                <button 
                                    type="submit"
                                    class="btn-hover w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-lg text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                                    <span class="flex items-center">
                                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                        </svg>
                                        {{ __('Register') }}
                                    </span>
                                </button>
                            </div>

                        </form>
                    </div>

                    <!-- Footer -->
                    <div class="px-5 sm:px-6 py-3 bg-gradient-to-r from-blue-50 to-indigo-50 border-t border-gray-100">
                        <p class="text-center text-xs text-gray-600">
                            Sudah punya akun? 
                            <a href="{{ route('login') }}" class="font-semibold text-blue-600 hover:text-blue-700 transition duration-200">
                                Login sekarang
                            </a>
                        </p>
                    </div>
                </div>

                <!-- Bottom Text -->
                <p class="text-center text-xs text-gray-500 mt-3">
                    © 2024 Your Company. Semua hak dilindungi.
                </p>
            </div>

            <!-- Right Side - Image Section (Hidden on Mobile, Shown on Tablet & Desktop) -->
            <div class="right-section hidden md:block">
                <div class="w-full px-2">
                    <img src="{{ asset('assets_public/regis.png')}}" alt="Register Icon" class="w-full image-float">
                </div>
            </div>
            
        </div>

    </div>

    <script>
        function togglePassword(fieldId) {
            const passwordInput = document.getElementById(fieldId);
            const eyeOpen = document.getElementById('eye-open-' + (fieldId === 'password' ? 'password' : 'confirmation'));
            const eyeClosed = document.getElementById('eye-closed-' + (fieldId === 'password' ? 'password' : 'confirmation'));
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                eyeOpen.classList.remove('hidden');
                eyeClosed.classList.add('hidden');
            }
        }
    </script>

</body>
</html>