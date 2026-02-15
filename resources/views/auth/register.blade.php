<x-guest-layout>
    <div class="mb-10 text-center">
        <h1 class="text-3xl font-serif font-bold text-earth-900">Buat Akun Baru 🚀</h1>
        <p class="text-earth-500 mt-2 font-medium">Mulai perjalanan kesehatan mentalmu hari ini.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div class="space-y-1">
            <label for="name" class="block text-sm font-bold text-earth-700 tracking-wide">Nama Lengkap</label>
            <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                class="w-full px-5 py-3.5 rounded-2xl bg-white border border-earth-100 focus:bg-white focus:border-terracotta-500 focus:ring-4 focus:ring-terracotta-500/10 transition duration-300 outline-none text-earth-900 placeholder-earth-300 shadow-sm"
                placeholder="Contoh: Budi Santoso">
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        <!-- Email -->
        <div class="space-y-1">
            <label for="email" class="block text-sm font-bold text-earth-700 tracking-wide">Email</label>
            <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username"
                class="w-full px-5 py-3.5 rounded-2xl bg-white border border-earth-100 focus:bg-white focus:border-terracotta-500 focus:ring-4 focus:ring-terracotta-500/10 transition duration-300 outline-none text-earth-900 placeholder-earth-300 shadow-sm"
                placeholder="nama@email.com">
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div class="space-y-1">
            <label for="password" class="block text-sm font-bold text-earth-700 tracking-wide">Password</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                class="w-full px-5 py-3.5 rounded-2xl bg-white border border-earth-100 focus:bg-white focus:border-terracotta-500 focus:ring-4 focus:ring-terracotta-500/10 transition duration-300 outline-none text-earth-900 placeholder-earth-300 shadow-sm"
                placeholder="Minimal 8 karakter">
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Confirm Password -->
        <div class="space-y-1">
            <label for="password_confirmation" class="block text-sm font-bold text-earth-700 tracking-wide">Konfirmasi
                Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required
                autocomplete="new-password"
                class="w-full px-5 py-3.5 rounded-2xl bg-white border border-earth-100 focus:bg-white focus:border-terracotta-500 focus:ring-4 focus:ring-terracotta-500/10 transition duration-300 outline-none text-earth-900 placeholder-earth-300 shadow-sm"
                placeholder="Ulangi password">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <button type="submit"
            class="w-full mt-4 py-4 px-6 rounded-2xl bg-earth-900 text-beige-50 font-bold text-lg hover:bg-terracotta-500 hover:shadow-lg hover:shadow-terracotta-500/20 transition duration-300 transform active:scale-95 flex items-center justify-center gap-2">
            <span>Daftar Sekarang</span>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6">
                </path>
            </svg>
        </button>

        <div class="text-center mt-8">
            <p class="text-sm text-earth-500">
                Sudah punya akun?
                <a href="{{ route('login') }}"
                    class="font-bold text-terracotta-500 hover:text-terracotta-600 transition hover:underline decoration-2 underline-offset-4">Masuk
                    di sini</a>
            </p>
        </div>
    </form>
</x-guest-layout>