<x-app-layout>
    <div class="min-h-[calc(100vh-100px)] flex items-center justify-center py-12 px-4">

        <div class="w-full max-w-2xl">

            <div class="text-center mb-12 animate-fade-in">
                <span
                    class="inline-block p-4 rounded-2xl bg-white dark:bg-slate-800 shadow-sm text-4xl mb-4 border border-slate-100 dark:border-slate-700">📮</span>
                <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white">Tulis <span
                        class="text-amber-500">Masa Depan</span></h1>
                <p class="text-slate-500 dark:text-slate-400 mt-2 font-medium">Pesan ini akan dikunci aman sampai
                    tanggal yang kamu pilih.</p>
            </div>

            <div
                class="bg-white dark:bg-slate-800 rounded-[3rem] p-8 md:p-14 shadow-[0_30px_60px_-15px_rgba(0,0,0,0.05)] dark:shadow-none border border-slate-100 dark:border-slate-700 relative overflow-hidden animate-fade-in delay-100 transition-colors">

                <div
                    class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-amber-50 dark:from-amber-900/20 to-transparent rounded-bl-full -mr-10 -mt-10 pointer-events-none">
                </div>

                <form action="{{ route('capsule.store') }}" method="POST" class="relative z-10 space-y-8">
                    @csrf

                    <div class="group">
                        <label
                            class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-3 ml-1">Judul
                            Surat</label>
                        <input type="text" name="title" required placeholder="Judul..."
                            class="w-full py-3 bg-transparent border-b-2 border-slate-100 dark:border-slate-700 focus:border-slate-900 dark:focus:border-amber-500 focus:ring-0 text-xl font-bold text-slate-900 dark:text-white placeholder-slate-300 dark:placeholder-slate-600 transition-colors px-0">
                    </div>

                    <div>
                        <label
                            class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-3 ml-1">Tanggal
                            Buka</label>
                        <div class="relative">
                            <input type="date" name="scheduled_at" required
                                min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                class="w-full px-6 py-4 bg-slate-50 dark:bg-slate-900 border-0 rounded-2xl text-slate-800 dark:text-slate-200 font-mono font-medium focus:ring-2 focus:ring-slate-900 dark:focus:ring-amber-500 transition cursor-pointer">
                        </div>
                    </div>

                    <div>
                        <label
                            class="block text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-3 ml-1">Isi
                            Pesan</label>
                        <textarea name="content" rows="6" required
                            placeholder="Tuliskan harapanmu, kekhawatiranmu, atau pesan semangat..."
                            class="w-full p-6 bg-slate-50 dark:bg-slate-900 border-0 rounded-3xl text-slate-700 dark:text-slate-300 leading-relaxed placeholder-slate-300 dark:placeholder-slate-600 focus:ring-2 focus:ring-slate-900 dark:focus:ring-amber-500 transition resize-none"></textarea>
                    </div>

                    <div class="flex items-center gap-4 pt-4">
                        <a href="{{ route('capsule.index') }}"
                            class="px-4 py-2 font-bold text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition text-sm">Batal</a>

                        <button type="submit"
                            class="flex-1 px-8 py-4 bg-slate-900 dark:bg-amber-600 text-white rounded-2xl font-bold text-lg shadow-xl shadow-slate-900/20 hover:bg-slate-800 dark:hover:bg-amber-500 hover:shadow-amber-500/20 transition transform duration-300 hover:-translate-y-1 flex items-center justify-center gap-3 group">
                            <span>🔒 Kunci Pesan</span>
                            <svg class="w-5 h-5 text-slate-400 group-hover:text-white transition" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>