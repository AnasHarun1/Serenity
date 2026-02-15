<nav x-data="{ mobileOpen: false, scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)"
    :class="{'bg-[#fdfcf8]/80 dark:bg-[#343d37]/80 backdrop-blur-xl border-b border-[#C04000]/10 dark:border-[#7C9082]/10 shadow-sm': scrolled, 'bg-transparent border-transparent': !scrolled}"
    class="sticky top-0 z-50 transition-all duration-300 w-full">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-24">

            <div class="shrink-0 flex items-center">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                    <div
                        class="relative flex items-center justify-center w-12 h-12 rounded-2xl bg-[#C04000] text-[#fdfcf8] shadow-lg shadow-[#C04000]/30 group-hover:scale-110 transition duration-300 rotate-3 group-hover:rotate-6">
                        <span class="text-2xl filter drop-shadow-md">🌿</span>
                    </div>
                    <div class="hidden lg:block">
                        <span
                            class="text-2xl font-black text-[#3b322b] dark:text-[#f5f0e1] tracking-tighter leading-none font-serif">Serenity</span>
                        <span
                            class="text-[10px] font-bold text-[#7C9082] block tracking-[0.2em] uppercase mt-0.5">Wellness
                            Companion</span>
                    </div>
                </a>
            </div>

            <div
                class="hidden md:flex items-center justify-center space-x-2 bg-[#fdfcf8]/60 dark:bg-[#343d37]/60 backdrop-blur-md border border-[#fdfcf8]/50 dark:border-[#7C9082]/20 p-2 rounded-full shadow-sm shadow-[#dbe5db]/50 dark:shadow-none">
                @php
                    $navBase = "px-6 py-2.5 text-sm font-bold rounded-full transition-all duration-300 flex items-center gap-2";
                    $navActive = "bg-[#3b322b] dark:bg-[#fdfcf8] text-[#fdfcf8] dark:text-[#3b322b] shadow-md transform scale-105";
                    $navInactive = "text-[#8A7E72] dark:text-[#a3968c] hover:text-[#C04000] dark:hover:text-[#C04000] hover:bg-[#fdfcf8] dark:hover:bg-[#4e4239]";
                @endphp

                <a href="{{ route('dashboard') }}"
                    class="{{ $navBase }} {{ request()->routeIs('dashboard') ? $navActive : $navInactive }}">
                    <span>📊</span> Dashboard
                </a>
                <a href="{{ route('chat.index') }}"
                    class="{{ $navBase }} {{ request()->routeIs('chat.*') ? $navActive : $navInactive }}">
                    <span>💬</span> Chat
                </a>

                <div class="relative" x-data="{ openFitur: false }">
                    <button @click="openFitur = !openFitur" @click.outside="openFitur = false"
                        class="px-6 py-2.5 text-sm font-bold rounded-full transition-all duration-300 flex items-center gap-2 text-[#8A7E72] dark:text-[#a3968c] hover:text-[#C04000] dark:hover:text-[#C04000] hover:bg-[#fdfcf8] dark:hover:bg-[#4e4239]">
                        <span>🚀</span> Fitur Lain
                        <svg class="w-3 h-3 transition-transform" :class="{'rotate-180': openFitur}" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>

                    <div x-show="openFitur" x-transition.origin.top style="display: none;"
                        class="absolute top-16 left-0 w-64 bg-[#fdfcf8] dark:bg-[#3b322b] rounded-3xl shadow-xl shadow-[#8A7E72]/10 border border-[#fdfcf8] dark:border-[#4e4239] py-3 z-50 overflow-hidden ring-1 ring-black/5">
                        <a href="{{ route('journal.index') }}"
                            class="block px-6 py-3 text-sm text-[#595149] dark:text-[#a3968c] hover:bg-[#fff5f0] dark:hover:bg-[#C04000]/20 hover:text-[#C04000] font-bold transition">📓
                            Jurnal Pintar</a>
                        <a href="{{ route('library.index') }}"
                            class="block px-6 py-3 text-sm text-[#595149] dark:text-[#a3968c] hover:bg-[#fff5f0] dark:hover:bg-[#C04000]/20 hover:text-[#C04000] font-bold transition">📚
                            Pustaka</a>
                        <a href="{{ route('capsule.index') }}"
                            class="block px-6 py-3 text-sm text-[#595149] dark:text-[#a3968c] hover:bg-[#fff5f0] dark:hover:bg-[#C04000]/20 hover:text-[#C04000] font-bold transition">⏳
                            Time Capsule</a>
                        <a href="{{ route('features.breathing') }}"
                            class="block px-6 py-3 text-sm text-[#595149] dark:text-[#a3968c] hover:bg-[#fff5f0] dark:hover:bg-[#C04000]/20 hover:text-[#C04000] font-bold transition">🧘‍♂️
                            Relaksasi</a>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3">

                <button @click="toggleMusic()"
                    class="hidden md:flex items-center justify-center w-10 h-10 rounded-full border transition duration-200 bg-[#fdfcf8] dark:bg-[#3b322b] border-[#dcd6d0] dark:border-[#4e4239] hover:border-[#C04000]/50 text-[#8A7E72] hover:text-[#C04000]"
                    :class="musicOn ? 'bg-[#fff5f0] dark:bg-[#C04000]/20 border-[#C04000] text-[#C04000] animate-pulse-slow' : ''"
                    title="Musik Latar">
                    <span x-show="!musicOn">🔇</span><span x-show="musicOn">🎵</span>
                </button>

                <button @click="toggleTheme()"
                    class="hidden md:flex items-center justify-center w-10 h-10 rounded-full border transition duration-200 bg-[#fdfcf8] dark:bg-[#3b322b] border-[#dcd6d0] dark:border-[#4e4239] hover:border-amber-300 hover:text-amber-500"
                    :title="darkMode ? 'Mode Terang' : 'Mode Gelap'">
                    <svg x-show="darkMode" class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z">
                        </path>
                    </svg>
                    <svg x-show="!darkMode" class="w-5 h-5 text-[#8A7E72]" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z">
                        </path>
                    </svg>
                </button>

                @if(Route::has('features.sos'))
                    <a href="{{ route('features.sos') }}"
                        class="hidden md:flex items-center justify-center w-10 h-10 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 rounded-full border border-red-100 dark:border-red-900 hover:bg-red-600 hover:text-white transition font-bold text-xs shadow-sm hover:shadow-red-200 animate-pulse"
                        title="Bantuan Darurat">🆘</a>
                @endif

                <div class="hidden md:flex items-center relative" x-data="{ openProfile: false }">
                    <button @click="openProfile = !openProfile" @click.outside="openProfile = false"
                        class="flex items-center gap-2 pl-1 pr-1 py-1 bg-[#fdfcf8] dark:bg-[#3b322b] border border-[#dcd6d0] dark:border-[#4e4239] rounded-full hover:shadow-md transition cursor-pointer">
                        <div
                            class="w-8 h-8 rounded-full bg-[#7C9082] dark:bg-[#7C9082] flex items-center justify-center text-white font-bold border-2 border-[#fdfcf8] dark:border-[#3b322b]">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    </button>
                    <div x-show="openProfile" x-transition.origin.top.right style="display: none;"
                        class="absolute right-0 top-14 w-56 bg-[#fdfcf8] dark:bg-[#3b322b] rounded-3xl shadow-xl shadow-[#8A7E72]/10 border border-[#fdfcf8] dark:border-[#4e4239] py-3 z-50 overflow-hidden ring-1 ring-black/5">
                        <div class="px-6 py-3 border-b border-[#f0eeeb] dark:border-[#4e4239] mb-1">
                            <p class="text-xs text-[#8A7E72]">Signed in as</p>
                            <p class="font-bold text-[#3b322b] dark:text-[#f5f0e1] truncate">{{ Auth::user()->name }}
                            </p>
                        </div>
                        <a href="{{ route('profile.edit') }}"
                            class="block px-6 py-3 text-sm text-[#595149] dark:text-[#a3968c] hover:bg-[#fff5f0] dark:hover:bg-[#C04000]/20 hover:text-[#C04000] font-bold transition">Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="block px-6 py-3 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 font-bold">Log
                                Out</a>
                        </form>
                    </div>
                </div>

                <div class="md:hidden flex items-center">
                    <button @click="mobileOpen = !mobileOpen"
                        class="p-2 text-[#595149] dark:text-[#a3968c] hover:bg-[#f0eeeb] dark:hover:bg-[#4e4239] rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileOpen" x-transition.opacity style="display: none;" @click="mobileOpen = false"
        class="fixed inset-0 bg-[#3b322b]/60 backdrop-blur-sm z-40 md:hidden"></div>

    <div x-show="mobileOpen" x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="-translate-y-full" x-transition:enter-end="translate-y-0"
        x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="translate-y-0"
        x-transition:leave-end="-translate-y-full" style="display: none;"
        class="fixed top-0 left-0 right-0 bg-[#fdfcf8] dark:bg-[#343d37] z-50 rounded-b-[2.5rem] shadow-2xl overflow-hidden md:hidden border-b border-[#f0eeeb] dark:border-[#4e4239]">

        <div class="p-8 space-y-4">
            <div class="flex justify-between items-center mb-8">
                <span class="font-black text-xl text-[#3b322b] dark:text-[#f5f0e1] font-serif">Menu</span>
                <div class="flex gap-2">
                    <button @click="toggleTheme()"
                        class="p-2 rounded-full border bg-[#fbf9f2] dark:bg-[#3b322b] dark:border-[#4e4239]"
                        :class="darkMode ? 'text-amber-400' : 'text-[#8A7E72]'">
                        <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                        <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z">
                            </path>
                        </svg>
                    </button>
                    <button @click="mobileOpen = false"
                        class="p-2 bg-[#f0eeeb] dark:bg-[#4e4239] rounded-full text-[#8A7E72]"><svg class="w-5 h-5"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg></button>
                </div>
            </div>

            <a href="{{ route('dashboard') }}"
                class="flex items-center gap-4 p-4 rounded-2xl bg-[#fbf9f2] dark:bg-[#3b322b] text-[#3b322b] dark:text-[#f5f0e1] font-bold shadow-sm">
                <span>📊</span> Dashboard
            </a>
            <a href="{{ route('chat.index') }}"
                class="flex items-center gap-4 p-4 rounded-2xl bg-[#fbf9f2] dark:bg-[#3b322b] text-[#3b322b] dark:text-[#f5f0e1] font-bold shadow-sm">
                <span>💬</span> Chat
            </a>
            <!-- Mood Deleted as Requested -->

            <div class="pl-4 pt-4 border-l-2 border-[#f0eeeb] dark:border-[#4e4239] space-y-3">
                <p class="text-xs font-bold text-[#8A7E72] uppercase tracking-widest mb-2">Eksplorasi</p>
                <a href="{{ route('journal.index') }}"
                    class="block py-2 text-[#595149] dark:text-[#a3968c] font-bold">📓 Jurnal Pintar</a>
                <a href="{{ route('features.sos') }}" class="block py-2 text-red-500 font-bold">🆘 Bantuan Darurat</a>
            </div>

            <div class="pt-8 mt-6 border-t border-[#f0eeeb] dark:border-[#4e4239]">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full py-4 rounded-2xl bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 font-bold">Log
                        Out</button>
                </form>
            </div>
        </div>
    </div>
</nav>