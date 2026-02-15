<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Health-AI | Chat</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Serif+Display:ital@0;1&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>

    <!-- Custom Earth Tone Assets -->
    <link rel="stylesheet" href="{{ asset('css/earth-theme.css') }}">
    <script src="{{ asset('js/earth-ui.js') }}" defer></script>

    <script>
        tailwind.config = {
            darkMode: 'class', // Aktifkan Dark Mode via Class
            theme: {
                extend: {
                    fontFamily: { sans: ['"Plus Jakarta Sans"', 'sans-serif'] },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-out forwards',
                        'pulse-slow': 'pulse 3s infinite',
                        'blob': 'blob 7s infinite'
                    },
                    keyframes: {
                        fadeIn: { '0%': { opacity: '0', transform: 'translateY(10px)' }, '100%': { opacity: '1', transform: 'translateY(0)' } },
                        blob: {
                            '0%': { transform: 'translate(0px, 0px) scale(1)' },
                            '33%': { transform: 'translate(30px, -50px) scale(1.1)' },
                            '66%': { transform: 'translate(-20px, 20px) scale(0.9)' },
                            '100%': { transform: 'translate(0px, 0px) scale(1)' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        /* Base Styles */
        body {
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        [x-cloak] {
            display: none !important;
        }

        /* Privacy Blur */
        .privacy-mode .sensitive {
            filter: blur(8px);
            transition: filter 0.3s ease;
            opacity: 0.8;
        }

        .privacy-mode .sensitive:hover {
            filter: blur(0);
            opacity: 1;
        }
    </style>
</head>

<body
    class="antialiased text-[#3b322b] bg-[#fdfcf8] dark:bg-[#343d37] dark:text-[#fdfcf8] relative transition-colors duration-300 overflow-hidden"
    x-data="{ 
          privacy: localStorage.getItem('privacy_mode') === 'true',
          musicOn: localStorage.getItem('music_on') === 'true',
          darkMode: localStorage.getItem('theme') === 'dark',
          
          initApp() {
              // Init Music
              const audio = document.getElementById('bg-music');
              if(this.musicOn) { 
                  audio.volume = 0.3; 
                  audio.play().catch(e => console.log('Autoplay blocked'));
              }
              // Init Dark Mode
              if (this.darkMode) {
                  document.documentElement.classList.add('dark');
              } else {
                  document.documentElement.classList.remove('dark');
              }
          },
          
          toggleMusic() {
              const audio = document.getElementById('bg-music');
              this.musicOn = !this.musicOn;
              localStorage.setItem('music_on', this.musicOn);
              this.musicOn ? audio.play() : audio.pause();
          },

          toggleTheme() {
              this.darkMode = !this.darkMode;
              localStorage.setItem('theme', this.darkMode ? 'dark' : 'light');
              if (this.darkMode) {
                  document.documentElement.classList.add('dark');
              } else {
                  document.documentElement.classList.remove('dark');
              }
          }
      }" x-init="$watch('privacy', val => localStorage.setItem('privacy_mode', val)); initApp();"
    @click.once="if(musicOn) document.getElementById('bg-music').play()" :class="{ 'privacy-mode': privacy }">

    <audio id="bg-music" loop>
        <source
            src="https://cdn.pixabay.com/download/audio/2022/05/27/audio_1808fbf07a.mp3?filename=lofi-study-112191.mp3"
            type="audio/mpeg">
    </audio>

    <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none dark:hidden">
        <div
            class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-[#dbe5db] rounded-full mix-blend-multiply filter blur-3xl opacity-40 animate-blob">
        </div>
        <div
            class="absolute top-[-10%] right-[-10%] w-96 h-96 bg-[#f3d9d5] rounded-full mix-blend-multiply filter blur-3xl opacity-40 animate-blob animation-delay-2000">
        </div>
    </div>

    <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none hidden dark:block">
        <div
            class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-sage-900 rounded-full blur-[100px] opacity-20 animate-pulse">
        </div>
        <div
            class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-earth-800 rounded-full blur-[100px] opacity-20 animate-pulse">
        </div>
    </div>

    <div class="h-screen flex flex-col overflow-hidden">
        @include('layouts.navigation')

        <!-- Main Content Area: Use flex-1 to verify full height usage -->
        <main class="flex-1 w-full h-full relative overflow-hidden">
            {{ $slot }}
        </main>
    </div>
</body>

</html>