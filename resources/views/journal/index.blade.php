<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="flex flex-col md:flex-row justify-between items-end mb-10 animate-fade-in gap-4">
            <div>
                <span class="text-xs font-bold tracking-widest text-indigo-500 uppercase mb-2 block">My Stories</span>
                <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight">Jurnal Pintar</h1>
                <p class="text-slate-500 mt-2 text-lg">Setiap cerita memiliki makna. AI membantumu memahaminya.</p>
            </div>
            <a href="{{ route('journal.create') }}"
                class="group relative inline-flex items-center justify-center px-8 py-3 font-bold text-white transition-all duration-200 bg-slate-900 font-lg rounded-full hover:bg-slate-800 hover:shadow-lg hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-900">
                <span>+ Tulis Cerita</span>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($journals as $j)
                <a href="{{ route('journal.show', $j->id) }}"
                    class="group relative flex flex-col h-[450px] rounded-[2.5rem] overflow-hidden transition-all duration-500 hover:shadow-2xl hover:shadow-indigo-500/20 hover:-translate-y-2 bg-white">

                    <div class="absolute inset-0 z-0">
                        <img src="https://picsum.photos/seed/{{ $j->id }}/600/800?blur=2" alt="Cover"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 opacity-90"
                            onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name=Journal&background=6366f1&color=fff&size=512'; this.parentElement.classList.add('bg-indigo-600');">

                        <div
                            class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/60 to-transparent opacity-90">
                        </div>
                    </div>

                    <div class="relative z-10 flex flex-col h-full p-8 text-white">

                        <div class="flex justify-between items-start">
                            <span
                                class="px-3 py-1 text-[10px] font-bold uppercase tracking-widest bg-white/20 backdrop-blur-md rounded-lg border border-white/10">
                                {{ $j->created_at->format('d M') }}
                            </span>

                            @php
                                $sentimentColor = match ($j->detected_sentiment) {
                                    'Positif' => 'bg-green-500/80 text-green-50 shadow-[0_0_15px_rgba(34,197,94,0.5)]',
                                    'Negatif' => 'bg-red-500/80 text-red-50 shadow-[0_0_15px_rgba(239,68,68,0.5)]',
                                    default => 'bg-blue-500/80 text-blue-50 shadow-[0_0_15px_rgba(59,130,246,0.5)]',
                                };
                            @endphp
                            <span
                                class="px-3 py-1 text-[10px] font-extrabold uppercase tracking-widest rounded-full backdrop-blur-md {{ $sentimentColor }}">
                                {{ $j->detected_sentiment }}
                            </span>
                        </div>

                        <div class="flex-1"></div>

                        <div class="transform transition-all duration-500 translate-y-4 group-hover:translate-y-0">
                            <h3
                                class="text-2xl font-bold leading-tight mb-3 line-clamp-2 text-white group-hover:text-indigo-200 transition">
                                {{ $j->title }}
                            </h3>

                            <div
                                class="relative pl-4 border-l-2 border-indigo-500/50 mb-4 opacity-80 group-hover:opacity-100 transition">
                                <p class="text-sm font-light italic leading-relaxed line-clamp-2">
                                    "{{ $j->ai_summary }}"
                                </p>
                            </div>

                            <div
                                class="flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-indigo-300 opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100">
                                Baca Selengkapnya <span class="text-lg">→</span>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach

            <a href="{{ route('journal.create') }}"
                class="group relative flex flex-col items-center justify-center h-[450px] rounded-[2.5rem] border-2 border-dashed border-slate-300 hover:border-indigo-400 hover:bg-indigo-50/50 transition-all duration-300 bg-slate-50 cursor-pointer">
                <div
                    class="w-16 h-16 rounded-full bg-white shadow-sm flex items-center justify-center text-3xl mb-4 group-hover:scale-110 transition group-hover:shadow-md text-slate-300 group-hover:text-indigo-500">
                    +
                </div>
                <span class="font-bold text-slate-400 group-hover:text-indigo-600">Tambah Jurnal Baru</span>
            </a>
        </div>
    </div>
</x-app-layout>