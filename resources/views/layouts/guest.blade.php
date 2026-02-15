<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Serenity') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Serif+Display:ital@0;1&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>

    <!-- Custom Earth Tone Assets -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        serif: ['"DM Serif Display"', 'serif'],
                    },
                    colors: {
                        sage: {
                            50: '#f2f7f2',
                            100: '#e1ebe1',
                            200: '#c5d9c5',
                            300: '#9ebf9e',
                            400: '#759448',
                            500: '#5c7538',
                            600: '#4a5e2d',
                            900: '#334023',
                            950: '#1a2612',
                        },
                        beige: {
                            50: '#fdfcf8',
                            100: '#f7f7f3',
                            200: '#f0f0e6',
                            500: '#d9d9b8',
                            900: '#42423e',
                        },
                        earth: {
                            100: '#ebe6e1',
                            200: '#d6cec5',
                            300: '#beafa3',
                            500: '#8a766a',
                            700: '#544741',
                            800: '#362214',
                            900: '#2b1b10',
                            950: '#1a0f08',
                        },
                        terracotta: {
                            50: '#fff5f0',
                            500: '#f05e35',
                            600: '#db441d',
                        }
                    },
                    animation: {
                        'blob': 'blob 10s infinite',
                        'float': 'float 6s ease-in-out infinite'
                    },
                    keyframes: {
                        blob: {
                            '0%': { transform: 'translate(0px, 0px) scale(1)' },
                            '33%': { transform: 'translate(30px, -50px) scale(1.1)' },
                            '66%': { transform: 'translate(-20px, 20px) scale(0.9)' },
                            '100%': { transform: 'translate(0px, 0px) scale(1)' },
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-20px)' },
                        }
                    }
                }
            }
        }
    </script>
</head>

<body class="font-sans antialiased text-earth-900 bg-beige-50 selection:bg-terracotta-500 selection:text-white">

    <div class="min-h-screen flex flex-col lg:flex-row">

        <!-- Left Side: Form Container -->
        <div
            class="w-full lg:w-1/2 flex flex-col justify-center items-center p-6 lg:p-24 relative bg-beige-50 overflow-hidden min-h-screen lg:min-h-0">
            <!-- Background Orbs (Mobile/Desktop) -->
            <div
                class="absolute top-[-10%] left-[-10%] w-64 h-64 bg-sage-200 rounded-full blur-3xl opacity-40 animate-blob mix-blend-multiply">
            </div>
            <div
                class="absolute bottom-[-10%] right-[-10%] w-64 h-64 bg-terracotta-200 rounded-full blur-3xl opacity-40 animate-blob animation-delay-2000 mix-blend-multiply">
            </div>

            <div class="w-full max-w-md space-y-8 relative z-10">
                <!-- Logo -->
                <div class="flex justify-center mb-8">
                    <a href="/" class="flex items-center gap-3 group">
                        <div
                            class="w-12 h-12 rounded-2xl bg-gradient-to-br from-terracotta-500 to-sage-600 flex items-center justify-center text-2xl shadow-lg group-hover:scale-110 transition duration-500">
                            🌿
                        </div>
                        <span class="text-2xl font-serif font-bold text-earth-900 tracking-tight">Serenity</span>
                    </a>
                </div>

                <!-- Form Content Slot -->
                <div
                    class="bg-white/50 backdrop-blur-sm p-6 rounded-3xl border border-white/60 shadow-xl shadow-earth-900/5 lg:bg-transparent lg:shadow-none lg:border-none lg:p-0">
                    {{ $slot }}
                </div>

                <!-- Footer -->
                <div class="mt-8 text-center text-xs text-earth-400 font-medium">
                    &copy; {{ date('Y') }} Serenity Wellness Companion.
                </div>
            </div>
        </div>

        <!-- Right Side: Visual/Branding (Desktop Only) -->
        <div class="hidden lg:flex w-1/2 relative bg-earth-900 overflow-hidden items-center justify-center">

            <!-- Texture Overlay -->
            <div class="absolute inset-0 opacity-20 mix-blend-overlay"
                style="background-image: url('https://www.transparenttextures.com/patterns/cream-paper.png');">
            </div>

            <!-- Abstract Shapes -->
            <div
                class="absolute top-1/4 left-1/4 w-96 h-96 bg-sage-800 rounded-full blur-[128px] opacity-60 animate-pulse">
            </div>
            <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-terracotta-900 rounded-full blur-[128px] opacity-60 animate-pulse"
                style="animation-delay: 2s;"></div>

            <!-- Content -->
            <div class="relative z-10 text-center px-12 animate-float">
                <div
                    class="w-24 h-24 bg-white/10 backdrop-blur-lg rounded-3xl mx-auto mb-8 flex items-center justify-center text-5xl shadow-2xl border border-white/20 ring-1 ring-white/30">
                    🧘‍♀️
                </div>
                <h2 class="text-4xl font-serif font-bold text-beige-50 mb-6 drop-shadow-sm tracking-tight">Temukan
                    Ketenanganmu</h2>
                <p class="text-lg text-beige-200 leading-relaxed max-w-lg mx-auto font-light">
                    "Kesehatan mental bukanlah tujuan akhir, melainkan sebuah proses perjalanan. Mari berjalan bersama."
                </p>

                <!-- Quote Card -->
                <div
                    class="mt-14 p-6 bg-white/5 backdrop-blur-md rounded-2xl border border-white/10 max-w-sm mx-auto transform rotate-2 hover:rotate-0 transition duration-500 shadow-2xl">
                    <div class="flex items-center gap-4 mb-3">
                        <div
                            class="w-10 h-10 rounded-full bg-terracotta-500 flex items-center justify-center text-white font-serif font-bold text-xl shadow-md">
                            S</div>
                        <div class="text-left">
                            <p class="text-sm font-bold text-beige-50">Serenity AI</p>
                            <p class="text-xs text-beige-200">Wellness Companion</p>
                        </div>
                    </div>
                    <p class="text-sm text-beige-100 italic">"Kamu tidak harus menghadapinya sendirian. Aku di sini
                        untuk mendengarkan."</p>
                </div>
            </div>
        </div>

    </div>
</body>

</html>