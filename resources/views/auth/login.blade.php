<x-guest-layout>
    <div class="mb-10 text-center">
        <h1 class="text-3xl font-serif font-bold text-earth-900">Selamat Datang 👋</h1>
        <p class="text-earth-500 mt-2 font-medium">Masuk untuk melanjutkan perjalananmu.</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email -->
        <div class="space-y-2">
            <label for="email" class="block text-sm font-bold text-earth-700 tracking-wide">Email</label>
            <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                class="w-full px-5 py-3.5 rounded-2xl bg-white border border-earth-100 focus:bg-white focus:border-terracotta-500 focus:ring-4 focus:ring-terracotta-500/10 transition duration-300 outline-none text-earth-900 placeholder-earth-300 shadow-sm"
                placeholder="nama@email.com">
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div class="space-y-2">
            <div class="flex justify-between items-center">
                <label for="password" class="block text-sm font-bold text-earth-700 tracking-wide">Password</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                        class="text-xs font-bold text-terracotta-500 hover:text-terracotta-600 transition">
                        Lupa Password?
                    </a>
                @endif
            </div>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="w-full px-5 py-3.5 rounded-2xl bg-white border border-earth-100 focus:bg-white focus:border-terracotta-500 focus:ring-4 focus:ring-terracotta-500/10 transition duration-300 outline-none text-earth-900 placeholder-earth-300 shadow-sm"
                placeholder="••••••••">
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Remember Me -->
        <div class="block">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input id="remember_me" type="checkbox"
                    class="rounded-lg border-earth-200 text-terracotta-500 shadow-sm focus:ring-terracotta-500 transition cursor-pointer"
                    name="remember">
                <span class="ms-2 text-sm text-earth-600 font-medium group-hover:text-earth-800 transition">Ingat saya
                    di perangkat ini</span>
            </label>
        </div>

        <button type="submit"
            class="w-full py-4 px-6 rounded-2xl bg-earth-900 text-beige-50 font-bold text-lg hover:bg-terracotta-500 hover:shadow-lg hover:shadow-terracotta-500/20 transition duration-300 transform active:scale-95 flex items-center justify-center gap-2">
            <span>Masuk Sekarang</span>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3">
                </path>
            </svg>
        </button>

        <div class="text-center mt-8">
            <p class="text-sm text-earth-500">
                Belum punya akun?
                <a href="{{ route('register') }}"
                    class="font-bold text-terracotta-500 hover:text-terracotta-600 transition hover:underline decoration-2 underline-offset-4">Daftar
                    Gratis</a>
            </p>
        </div>
    </form>
</x-guest-layout>