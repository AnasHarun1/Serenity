<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Serenity | Mental Wellness Companion</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=DM+Serif+Display:ital@0;1&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/earth-theme.css') }}">

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        serif: ['"DM Serif Display"', 'serif'],
                    },
                    colors: {
                        sage: { 50: '#f2f7f2', 100: '#e1ebe1', 200: '#c5d9c5', 300: '#9ebf9e', 400: '#95B365', 500: '#759448', 600: '#5c7538', 700: '#4a5e2d', 800: '#3d4d27', 900: '#334023' },
                        terracotta: { 50: '#fff5f0', 100: '#ffe8de', 200: '#ffd3bf', 300: '#ffb599', 400: '#FF8A5C', 500: '#f05e35', 600: '#db441d' },
                        beige: { 50: '#fbfbf9', 100: '#f7f7f3', 200: '#f0f0e6', 500: '#FAFAF5', 900: '#42423e' },
                        earth: { 50: '#f6f4f2', 800: '#362214', 900: '#2b1b10' },
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'fade-in-up': 'fadeInUp 1s ease-out forwards',
                    },
                    keyframes: {
                        float: { '0%, 100%': { transform: 'translateY(0)' }, '50%': { transform: 'translateY(-15px)' } },
                        fadeInUp: { '0%': { opacity: '0', transform: 'translateY(20px)' }, '100%': { opacity: '1', transform: 'translateY(0)' } },
                    }
                }
            }
        }
    </script>
</head>

<body
    class="antialiased bg-beige-50 text-earth-900 overflow-x-hidden selection:bg-terracotta-200 selection:text-earth-900">

    <!-- Navigation -->
    <div class="fixed top-0 left-0 right-0 z-50 flex justify-center px-4 pt-6">
        <nav
            class="bg-white/70 backdrop-blur-xl border border-white/40 shadow-sm rounded-full px-6 py-3 flex items-center gap-8 md:gap-12 transition-all hover:bg-white/90">
            <a href="#" class="flex items-center gap-2.5 group">
                <div
                    class="w-10 h-10 bg-terracotta-500 rounded-full flex items-center justify-center text-white text-xl shadow-lg shadow-terracotta-500/30 group-hover:scale-110 transition duration-300">
                    🌿</div>
                <span
                    class="font-serif text-2xl font-bold text-earth-900 tracking-tight hidden sm:block">Serenity</span>
            </a>

            <div class="hidden md:flex items-center gap-8 text-sm font-bold text-earth-800/70 tracking-wide">
                <a href="#about" class="hover:text-terracotta-600 transition">Tentang</a>
                <a href="#fitur" class="hover:text-terracotta-600 transition">Fitur</a>
            </div>

            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="px-6 py-2.5 bg-earth-900 text-white text-sm font-bold rounded-full hover:bg-earth-800 transition shadow-lg shadow-earth-900/20">Dashboard</a>
                @else
                    <a href="{{ route('login') }}"
                        class="text-sm font-bold text-earth-800 hover:text-terracotta-600 transition">Masuk</a>
                    <a href="{{ route('register') }}"
                        class="px-6 py-2.5 bg-terracotta-500 text-white text-sm font-bold rounded-full hover:bg-terracotta-600 transition hover:shadow-lg hover:shadow-terracotta-500/30 transform hover:-translate-y-0.5">Daftar</a>
                @endauth
            </div>
        </nav>
    </div>

    <!-- Hero Section -->
    <section class="relative z-10 pt-32 pb-20 lg:pt-48 lg:pb-32 px-6 overflow-hidden">
        <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">

            <!-- Text Content -->
            <div class="text-center lg:text-left order-2 lg:order-1 relative z-20">
                <div
                    class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-sage-100/80 border border-sage-200 text-sage-800 text-[11px] font-bold uppercase tracking-widest mb-8 animate-fade-in-up">
                    <span class="w-2 h-2 rounded-full bg-sage-500 animate-pulse"></span>
                    AI Mental Wellness Companion
                </div>

                <h1 class="text-5xl lg:text-8xl font-serif text-earth-900 leading-[1.05] mb-8 animate-fade-in-up"
                    style="animation-delay: 0.1s;">
                    Temukan <br>
                    <span class="italic text-terracotta-500 relative inline-block">
                        Ketenangan
                        <svg class="absolute w-full h-3 -bottom-1 left-0 text-terracotta-300 opacity-40"
                            viewBox="0 0 100 10" preserveAspectRatio="none">
                            <path d="M0 5 Q 50 10 100 5" stroke="currentColor" stroke-width="8" fill="none" />
                        </svg>
                    </span> <br>
                    Dalam Diri.
                </h1>

                <p class="text-lg text-earth-800/70 mb-10 leading-relaxed max-w-lg mx-auto lg:mx-0 animate-fade-in-up"
                    style="animation-delay: 0.2s;">
                    Di tengah hiruk pikuk dunia, <strong>Serenity</strong> hadir sebagai ruang aman Anda.
                    Jurnal pintar bertenaga AI yang mendengar tanpa menghakimi, memahami emosi, dan menemani perjalanan
                    batin Anda.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start animate-fade-in-up"
                    style="animation-delay: 0.3s;">
                    <a href="{{ route('register') }}"
                        class="px-8 py-4 bg-earth-900 text-beige-50 font-bold rounded-full text-lg hover:shadow-xl hover:shadow-earth-900/20 hover:bg-earth-800 transition transform hover:-translate-y-1">
                        Mulai Perjalanan &rarr;
                    </a>
                    <a href="#about"
                        class="px-8 py-4 bg-white text-earth-900 border border-earth-200 font-bold rounded-full text-lg hover:bg-beige-50 transition">
                        Kenalan Dulu
                    </a>
                </div>
            </div>

            <!-- Hero Image -->
            <div class="relative order-1 lg:order-2 mb-12 lg:mb-0 animate-float">
                <div
                    class="relative w-full max-w-[500px] mx-auto aspect-[4/5] rounded-[3rem] overflow-hidden shadow-2xl shadow-earth-900/10 border-8 border-white transform rotate-2">
                    <img src="{{ asset('images/hero-serenity.png') }}" alt="Woman writing journal in nature"
                        class="w-full h-full object-cover">

                    <!-- Floating Quote Card -->
                    <div
                        class="absolute bottom-8 left-8 right-8 bg-white/90 backdrop-blur-md p-6 rounded-2xl border border-white/50 shadow-lg">
                        <p class="font-serif text-xl text-earth-900 italic mb-2">"Hari ini aku merasa lebih lega..."</p>
                        <div class="flex items-center gap-3">
                            <div class="w-2 h-2 rounded-full bg-green-500"></div>
                            <span class="text-xs font-bold text-earth-500 uppercase tracking-widest">Mood Terdeteksi:
                                Tenang</span>
                        </div>
                    </div>
                </div>

                <!-- Decorative Elements -->
                <div
                    class="absolute -z-10 top-10 -right-10 w-64 h-64 bg-terracotta-200 rounded-full blur-3xl opacity-30">
                </div>
                <div class="absolute -z-10 -bottom-10 -left-10 w-64 h-64 bg-sage-200 rounded-full blur-3xl opacity-30">
                </div>
            </div>
        </div>
    </section>

    <!-- About Section (New) -->
    <section id="about" class="py-24 bg-white relative overflow-hidden">
        <div class="max-w-4xl mx-auto px-6 text-center relative z-10">
            <span class="text-terracotta-500 font-bold tracking-[0.2em] uppercase text-xs mb-4 block">Cerita Kami</span>
            <h2 class="text-4xl md:text-5xl font-serif text-earth-900 mb-8 leading-tight">Mengapa Serenity Ada?</h2>

            <div class="prose prose-lg prose-p:text-earth-800/80 prose-headings:font-serif mx-auto">
                <p class="mb-6">
                    Kita hidup di era notifikasi tanpa henti. Kecemasan seringkali datang bukan karena masalah besar,
                    tapi tumpukan pikiran yang tak tersalurkan.
                </p>
                <p class="mb-8 font-medium italic text-xl text-earth-900">
                    "Kesehatan mental bukanlah tujuan akhir, tapi sebuah perjalanan."
                </p>
                <p>
                    <strong>Serenity</strong> diciptakan bukan untuk menggantikan profesional medis, tapi sebagai
                    sahabat digital yang selalu ada di saku Anda.
                    Menggunakan kecerdasan buatan Gemini, kami membantu Anda memetakan emosi, merangkai kata saat lidah
                    keluh, dan menemukan pola dalam keseharian Anda.
                    Ini adalah ruang aman Anda. Pribadi. Tenang. Mengerti.
                </p>
            </div>

            <div class="mt-12 grid grid-cols-3 gap-8 border-t border-earth-100 pt-12 max-w-2xl mx-auto">
                <div>
                    <div class="text-4xl font-serif text-earth-900 mb-1">10k+</div>
                    <div class="text-xs font-bold text-earth-500 uppercase tracking-widest">Jurnal Tertulis</div>
                </div>
                <div>
                    <div class="text-4xl font-serif text-earth-900 mb-1">24/7</div>
                    <div class="text-xs font-bold text-earth-500 uppercase tracking-widest">Teman Cerita</div>
                </div>
                <div>
                    <div class="text-4xl font-serif text-earth-900 mb-1">100%</div>
                    <div class="text-xs font-bold text-earth-500 uppercase tracking-widest">Privasi Aman</div>
                </div>
            </div>
        </div>

        <!-- Background Texture -->
        <div class="absolute inset-0 opacity-[0.4] pointer-events-none"
            style="background-image: url('https://www.transparenttextures.com/patterns/cream-paper.png');"></div>
    </section>

    <!-- Features Section -->
    <section id="fitur" class="py-24 bg-beige-50 relative border-t border-earth-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-20 max-w-3xl mx-auto">
                <span class="text-terracotta-500 font-bold tracking-[0.2em] uppercase text-xs mb-3 block">Fitur
                    Unggulan</span>
                <h2 class="text-4xl md:text-5xl font-serif text-earth-900 mb-6">Pendamping Kesehatan Mental Anda</h2>
                <p class="text-lg text-earth-800/70 leading-relaxed">
                    Kami menggabungkan empati dan teknologi untuk menciptakan alat yang benar-benar mengerti apa yang
                    Anda rasakan.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 lg:gap-12">
                <!-- Feature 1 -->
                <div
                    class="group relative bg-white p-10 rounded-[2.5rem] shadow-sm hover:shadow-xl hover:shadow-terracotta-500/10 transition duration-500 border border-earth-100 overflow-hidden">
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-terracotta-100 rounded-bl-[100px] -mr-10 -mt-10 transition-transform group-hover:scale-110">
                    </div>

                    <div class="relative z-10">
                        <div
                            class="w-16 h-16 bg-beige-50 rounded-2xl flex items-center justify-center text-3xl mb-8 group-hover:-translate-y-2 transition duration-300">
                            💬
                        </div>
                        <h3 class="text-2xl font-serif text-earth-900 mb-4">Teman Cerita AI</h3>
                        <p class="text-earth-600 leading-relaxed mb-6">
                            Seperti berbicara dengan sahabat lama yang bijak. AI kami mendengarkan keluh kesah Anda 24/7
                            tanpa menghakimi, memberikan respon yang menenangkan.
                        </p>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div
                    class="group relative bg-white p-10 rounded-[2.5rem] shadow-sm hover:shadow-xl hover:shadow-sage-500/10 transition duration-500 border border-earth-100 overflow-hidden">
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-sage-100 rounded-bl-[100px] -mr-10 -mt-10 transition-transform group-hover:scale-110">
                    </div>

                    <div class="relative z-10">
                        <div
                            class="w-16 h-16 bg-beige-50 rounded-2xl flex items-center justify-center text-3xl mb-8 group-hover:-translate-y-2 transition duration-300">
                            🧠
                        </div>
                        <h3 class="text-2xl font-serif text-earth-900 mb-4">Analisis Tren Mood</h3>
                        <p class="text-earth-600 leading-relaxed mb-6">
                            Pahami diri Anda lebih dalam. Grafik visual yang indah membantu Anda melihat pola emosi
                            mingguan dan bulanan, mendeteksi pemicu stres sejak dini.
                        </p>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div
                    class="group relative bg-white p-10 rounded-[2.5rem] shadow-sm hover:shadow-xl hover:shadow-earth-500/10 transition duration-500 border border-earth-100 overflow-hidden">
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-earth-100 rounded-bl-[100px] -mr-10 -mt-10 transition-transform group-hover:scale-110">
                    </div>

                    <div class="relative z-10">
                        <div
                            class="w-16 h-16 bg-beige-50 rounded-2xl flex items-center justify-center text-3xl mb-8 group-hover:-translate-y-2 transition duration-300">
                            📓
                        </div>
                        <h3 class="text-2xl font-serif text-earth-900 mb-4">Jurnal Sentimen</h3>
                        <p class="text-earth-600 leading-relaxed mb-6">
                            Tuliskan apa saja. Biarkan Serenity menganalisis nuansa emosional tulisan Anda dan
                            memberikan afirmasi positif yang sesuai dengan perasaan saat itu.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Technology / Trust Section (Simplified) -->
    <section id="teknologi" class="py-24 bg-earth-900 relative overflow-hidden text-center">
        <!-- Abstract Bg -->
        <div class="absolute inset-0 opacity-10"
            style="background-image: radial-gradient(#d6cec5 1px, transparent 1px); background-size: 32px 32px;"></div>

        <div class="max-w-5xl mx-auto px-6 relative z-10">
            <h2 class="text-3xl md:text-4xl font-serif text-beige-100 mb-12">Dibangun dengan Kepercayaan & Keamanan</h2>

            <div class="flex flex-wrap justify-center gap-6 md:gap-10">
                <!-- Trust Badge 1 -->
                <div
                    class="bg-white/5 backdrop-blur-sm border border-white/10 px-8 py-6 rounded-3xl flex flex-col items-center gap-4 hover:bg-white/10 transition group">
                    <span class="text-4xl group-hover:scale-110 transition">🔒</span>
                    <div>
                        <div class="text-beige-50 font-bold text-lg">Privasi Dijamin</div>
                        <div class="text-earth-300 text-xs uppercase tracking-wider mt-1">End-to-End Encrypted</div>
                    </div>
                </div>

                <!-- Trust Badge 2 -->
                <div
                    class="bg-white/5 backdrop-blur-sm border border-white/10 px-8 py-6 rounded-3xl flex flex-col items-center gap-4 hover:bg-white/10 transition group">
                    <span class="text-4xl group-hover:scale-110 transition">⚡</span>
                    <div>
                        <div class="text-beige-50 font-bold text-lg">Respon Real-time</div>
                        <div class="text-earth-300 text-xs uppercase tracking-wider mt-1">Gemini AI Engine</div>
                    </div>
                </div>

                <!-- Trust Badge 3 -->
                <div
                    class="bg-white/5 backdrop-blur-sm border border-white/10 px-8 py-6 rounded-3xl flex flex-col items-center gap-4 hover:bg-white/10 transition group">
                    <span class="text-4xl group-hover:scale-110 transition">🛡️</span>
                    <div>
                        <div class="text-beige-50 font-bold text-lg">Ruang Aman</div>
                        <div class="text-earth-300 text-xs uppercase tracking-wider mt-1">No Judgment Zone</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-[#1a0f08] text-beige-100 py-20 border-t border-earth-900/50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-12 mb-16">
                <div class="col-span-1 md:col-span-2">
                    <a href="#" class="flex items-center gap-3 mb-6">
                        <div
                            class="w-12 h-12 bg-terracotta-600 rounded-full flex items-center justify-center text-white text-2xl shadow-lg shadow-terracotta-900/50">
                            🌿</div>
                        <span class="text-3xl font-serif font-bold text-beige-50">Serenity</span>
                    </a>
                    <p class="text-earth-400 leading-relaxed max-w-md text-lg">
                        Sebuah ruang digital untuk bernapas, bercerita, dan bertumbuh.
                        Kami percaya setiap perasaan valid dan layak didengar.
                    </p>
                </div>

                <div>
                    <h4 class="font-bold text-white mb-6 uppercase tracking-widest text-xs">Jelajahi</h4>
                    <ul class="space-y-4 text-earth-400">
                        <li><a href="#" class="hover:text-terracotta-400 transition">Beranda</a></li>
                        <li><a href="#about" class="hover:text-terracotta-400 transition">Tentang Kami</a></li>
                        <li><a href="#fitur" class="hover:text-terracotta-400 transition">Fitur Unggulan</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-terracotta-400 transition">Masuk Akun</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-white mb-6 uppercase tracking-widest text-xs">Hubungi</h4>
                    <ul class="space-y-4 text-earth-400">
                        <li>hello@serenity.app</li>
                        <li>Instagram: @serenity_id</li>
                        <li>Jakarta, Indonesia</li>
                    </ul>
                </div>
            </div>

            <div
                class="pt-8 border-t border-earth-900 flex flex-col md:flex-row justify-between items-center gap-6 text-sm text-earth-500">
                <p>&copy; {{ date('Y') }} Serenity Mental Wellness. All rights reserved.</p>
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                    <span>System Operational</span>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>