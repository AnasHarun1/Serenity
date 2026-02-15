<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <div class="flex flex-col md:flex-row justify-between items-end mb-12 animate-fade-in gap-6">
            <div>
                <span class="text-xs font-bold tracking-widest text-amber-500 uppercase mb-2 block">Time Vault</span>
                <h1 class="text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight">Kapsul Waktu</h1>
                <p class="text-slate-500 dark:text-slate-400 mt-2 text-lg">Kirim pesan harapan untuk dirimu di masa depan.</p>
            </div>
            
            <a href="{{ route('capsule.create') }}" class="group relative inline-flex items-center justify-center px-8 py-3.5 font-bold text-white transition-all duration-200 bg-slate-900 dark:bg-amber-600 font-lg rounded-full hover:bg-slate-800 dark:hover:bg-amber-700 hover:shadow-xl hover:shadow-amber-900/20 hover:-translate-y-1 overflow-hidden">
                <span class="relative flex items-center gap-3">
                    <span class="text-xl">⏳</span> Buat Kapsul Baru
                </span>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($capsules as $c)
                @php
                    $isLocked = $c->scheduled_at->isFuture();
                @endphp

                <div class="group relative flex flex-col h-[380px] bg-white dark:bg-slate-900 rounded-[2.5rem] p-8 border border-slate-100 dark:border-slate-800 transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl hover:shadow-amber-500/10 animate-fade-in overflow-hidden">
                    
                    <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-amber-50 dark:from-amber-900/20 to-transparent rounded-bl-[100px] -mr-10 -mt-10 opacity-50 group-hover:scale-110 transition duration-700"></div>

                    <div class="relative z-10 mb-6 flex justify-between items-start">
                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-2xl shadow-sm transition-colors duration-300
                            {{ $isLocked ? 'bg-slate-50 dark:bg-slate-800 text-slate-400' : 'bg-amber-100 dark:bg-amber-900/50 text-amber-600 dark:text-amber-400' }}">
                            {{ $isLocked ? '🔒' : '🔓' }}
                        </div>
                        
                        @if($isLocked)
                            <div class="px-3 py-1 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 text-[10px] font-bold uppercase tracking-wider border border-slate-200 dark:border-slate-700">
                                Terkunci
                            </div>
                        @else
                            <div class="px-3 py-1 rounded-full bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 text-[10px] font-bold uppercase tracking-wider border border-green-200 dark:border-green-900 animate-pulse">
                                Siap Dibuka
                            </div>
                        @endif
                    </div>

                    <div class="relative z-10 flex-1">
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2 line-clamp-2 leading-tight group-hover:text-amber-600 dark:group-hover:text-amber-400 transition">
                            {{ $isLocked ? 'Pesan Terenkripsi' : $c->title }}
                        </h3>
                        
                        <div class="mt-4 flex items-center gap-2">
                            <div class="h-1 w-8 rounded-full {{ $isLocked ? 'bg-slate-200 dark:bg-slate-700' : 'bg-amber-400' }}"></div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">
                                {{ $isLocked ? 'Membuka Dalam' : 'Tersedia Sejak' }}
                            </p>
                        </div>
                        
                        <p class="text-2xl font-light text-slate-800 dark:text-slate-200 mt-1 font-mono">
                            {{ $isLocked ? $c->scheduled_at->diffForHumans() : $c->scheduled_at->format('d M Y') }}
                        </p>
                    </div>

                    <div class="relative z-10 pt-6 border-t border-slate-50 dark:border-slate-800 mt-auto">
                        @if($isLocked)
                            <button disabled class="w-full py-3 rounded-xl bg-slate-50 dark:bg-slate-800 text-slate-400 dark:text-slate-500 font-bold text-xs uppercase tracking-widest flex items-center justify-center gap-2 cursor-not-allowed">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                Menunggu Waktu
                            </button>
                        @else
                            <a href="{{ route('capsule.show', $c->id) }}" class="flex items-center justify-center w-full py-3 rounded-xl bg-slate-900 dark:bg-amber-600 text-white font-bold text-sm shadow-md hover:bg-amber-600 dark:hover:bg-amber-500 transition-colors duration-300 group-hover:shadow-lg">
                                Baca Pesan 💌
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach

            @if($capsules->isEmpty())
                <a href="{{ route('capsule.create') }}" class="group flex flex-col items-center justify-center h-[380px] rounded-[2.5rem] border-2 border-dashed border-slate-300 dark:border-slate-700 hover:border-amber-400 dark:hover:border-amber-500 hover:bg-amber-50/30 dark:hover:bg-amber-900/10 transition duration-300 cursor-pointer">
                    <div class="w-20 h-20 bg-white dark:bg-slate-800 rounded-full flex items-center justify-center text-4xl mb-4 shadow-sm group-hover:scale-110 transition text-slate-300 dark:text-slate-600 group-hover:text-amber-500">
                        +
                    </div>
                    <h3 class="text-lg font-bold text-slate-400 dark:text-slate-500 group-hover:text-amber-700 dark:group-hover:text-amber-400">Tulis Pesan Pertama</h3>
                </a>
            @endif
        </div>
    </div>
</x-app-layout>