<x-app-layout>
    <div class="min-h-[calc(100vh-100px)] flex items-center justify-center py-12 px-6">

        <div class="max-w-2xl w-full">

            <div class="mb-8">
                <a href="{{ route('capsule.index') }}"
                    class="inline-flex items-center gap-2 text-sm font-bold text-slate-400 hover:text-slate-800 dark:hover:text-white transition group">
                    <span
                        class="bg-white dark:bg-slate-800 p-2 rounded-full shadow-sm border border-slate-100 dark:border-slate-700 group-hover:-translate-x-1 transition">←</span>
                    Kembali ke Vault
                </a>
            </div>

            <div
                class="bg-white dark:bg-slate-900 rounded-[3rem] p-10 md:p-16 shadow-2xl shadow-slate-200/50 dark:shadow-none border border-slate-100 dark:border-slate-800 relative overflow-hidden animate-fade-in transition-colors duration-300">

                <div
                    class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-amber-300 via-yellow-400 to-amber-300">
                </div>

                <div
                    class="absolute top-10 right-10 text-9xl opacity-[0.03] dark:opacity-[0.05] pointer-events-none rotate-12 dark:text-white">
                    🔓
                </div>

                <div class="text-center mb-12 border-b border-slate-100 dark:border-slate-800 pb-10">
                    <span
                        class="inline-block px-4 py-1.5 bg-green-50 dark:bg-green-900/30 text-green-600 dark:text-green-400 text-[10px] font-bold uppercase tracking-[0.2em] rounded-full mb-6 border border-green-100 dark:border-green-800">
                        Berhasil Dibuka
                    </span>
                    <h1
                        class="text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white mb-6 leading-tight tracking-tight">
                        {{ $capsule->title }}
                    </h1>

                    <div
                        class="inline-flex flex-col sm:flex-row items-center justify-center gap-4 sm:gap-8 bg-slate-50 dark:bg-slate-800/50 px-8 py-4 rounded-3xl border border-slate-100 dark:border-slate-700">
                        <div class="text-center">
                            <span
                                class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Ditulis</span>
                            <span
                                class="font-mono text-sm font-bold text-slate-700 dark:text-slate-300">{{ $capsule->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="hidden sm:block h-8 w-px bg-slate-200 dark:bg-slate-700"></div>
                        <div class="text-center">
                            <span
                                class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Dibuka</span>
                            <span
                                class="font-mono text-sm font-bold text-amber-600 dark:text-amber-400">{{ now()->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>

                <div
                    class="prose prose-lg prose-slate dark:prose-invert mx-auto leading-loose font-serif text-slate-600 dark:text-slate-300">
                    <p
                        class="first-letter:text-6xl first-letter:font-bold first-letter:mr-3 first-letter:float-left first-letter:text-amber-500 dark:first-letter:text-amber-400">
                        {!! nl2br(e($capsule->content)) !!}
                    </p>
                </div>

                <div class="mt-20 pt-10 border-t border-slate-50 dark:border-slate-800 text-center">
                    <p class="text-slate-400 dark:text-slate-500 text-xs uppercase tracking-[0.3em] font-medium">
                        — Pesan dari masa lalu —
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>