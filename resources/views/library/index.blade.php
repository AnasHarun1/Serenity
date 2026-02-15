<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">

        <div class="relative bg-slate-900 rounded-[2.5rem] p-8 md:p-12 overflow-hidden shadow-2xl mb-12 text-center">
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
                <div
                    class="absolute top-[-50%] left-[-20%] w-[600px] h-[600px] bg-indigo-600/30 rounded-full blur-[100px]">
                </div>
                <div
                    class="absolute bottom-[-50%] right-[-20%] w-[600px] h-[600px] bg-purple-600/30 rounded-full blur-[100px]">
                </div>
            </div>

            <div class="relative z-10">
                <span
                    class="inline-block py-1 px-3 rounded-full bg-white/10 border border-white/20 text-indigo-300 text-xs font-bold uppercase tracking-wider mb-4 backdrop-blur-md">
                    Pustaka Pintar
                </span>
                <h1 class="text-3xl md:text-5xl font-extrabold text-white mb-4 tracking-tight">
                    Wawasan Kesehatan Mental
                </h1>
                <p class="text-slate-300 text-lg mb-8 max-w-2xl mx-auto">
                    {{ $contextMessage }}
                </p>

                <form action="{{ route('library.index') }}" method="GET" class="max-w-xl mx-auto relative">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari topik (misal: Cemas, Tidur)..."
                        class="w-full pl-6 pr-14 py-4 rounded-full bg-white/10 border border-white/20 text-white placeholder-slate-400 focus:bg-white/20 focus:border-indigo-400 focus:ring-0 backdrop-blur-md transition shadow-lg">
                    <button type="submit"
                        class="absolute right-2 top-2 p-2 bg-indigo-600 text-white rounded-full hover:bg-indigo-500 transition shadow-md">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>

        <div class="flex flex-wrap justify-center gap-3 mb-10">
            <a href="{{ route('library.index') }}"
                class="px-5 py-2 rounded-full text-sm font-bold transition border {{ !request('category') ? 'bg-slate-900 text-white border-slate-900' : 'bg-white text-slate-600 border-slate-200 hover:border-indigo-300' }}">
                Semua
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('library.index', ['category' => $cat]) }}"
                    class="px-5 py-2 rounded-full text-sm font-bold transition border {{ request('category') == $cat ? 'bg-slate-900 text-white border-slate-900' : 'bg-white text-slate-600 border-slate-200 hover:border-indigo-300' }}">
                    {{ $cat }}
                </a>
            @endforeach
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($articles as $article)
                <a href="{{ route('library.show', $article->slug) }}"
                    class="group flex flex-col bg-white rounded-[2rem] overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-2 transition duration-300 border border-slate-100 h-full">

                    <div class="relative h-52 overflow-hidden">
                        <img src="{{ $article->image_url }}" alt="{{ $article->title }}"
                            class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent opacity-80">
                        </div>

                        <div class="absolute top-4 left-4">
                            <span
                                class="px-3 py-1 bg-white/90 backdrop-blur-md text-slate-800 text-[10px] font-bold uppercase rounded-lg shadow-sm">
                                {{ $article->category }}
                            </span>
                        </div>

                        @if($article->mood_tag == $recommendationTag && !request('category') && !request('search'))
                            <div class="absolute top-4 right-4">
                                <span
                                    class="px-3 py-1 bg-indigo-600 text-white text-[10px] font-bold uppercase rounded-lg shadow-md animate-pulse">
                                    Rekomendasi
                                </span>
                            </div>
                        @endif
                    </div>

                    <div class="p-6 flex-1 flex flex-col">
                        <h3
                            class="text-lg font-bold text-slate-800 mb-3 group-hover:text-indigo-600 transition line-clamp-2 leading-tight">
                            {{ $article->title }}
                        </h3>
                        <p class="text-slate-500 text-sm leading-relaxed line-clamp-3 mb-6 flex-1">
                            {{ Str::limit($article->content, 120) }}
                        </p>

                        <div
                            class="mt-auto pt-4 border-t border-slate-50 flex items-center justify-between text-xs font-medium text-slate-400">
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>5 min baca</span>
                            </div>
                            <span class="text-indigo-600 font-bold group-hover:underline">Baca Artikel &rarr;</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        @if($articles->isEmpty())
            <div class="text-center py-20">
                <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4 text-4xl">🔍
                </div>
                <h3 class="text-xl font-bold text-slate-800">Tidak ditemukan</h3>
                <p class="text-slate-500">Coba kata kunci atau kategori lain.</p>
                <a href="{{ route('library.index') }}"
                    class="inline-block mt-4 text-indigo-600 font-bold hover:underline">Reset Filter</a>
            </div>
        @endif
    </div>
</x-app-layout>