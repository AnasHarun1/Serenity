<x-app-layout>
    <div class="fixed top-0 left-0 h-1 bg-indigo-600 z-50 transition-all duration-300" id="progressBar"
        style="width: 0%"></div>

    <div class="max-w-3xl mx-auto py-10 px-6">

        <a href="{{ route('library.index') }}"
            class="inline-flex items-center text-slate-500 hover:text-indigo-600 font-medium mb-8 transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                </path>
            </svg>
            Kembali ke Pustaka
        </a>

        <article class="bg-white rounded-[2.5rem] p-8 md:p-12 shadow-xl border border-slate-100 animate-fade-in">

            <div class="text-center mb-10">
                <span
                    class="px-4 py-1.5 rounded-full bg-indigo-50 text-indigo-600 font-bold text-xs uppercase tracking-wider mb-6 inline-block">
                    {{ $article->category }}
                </span>
                <h1 class="text-3xl md:text-5xl font-extrabold text-slate-900 leading-tight mb-6">
                    {{ $article->title }}
                </h1>
                <div class="flex items-center justify-center gap-4 text-slate-400 text-sm">
                    <span>{{ $article->created_at->format('d M Y') }}</span>
                    <span>•</span>
                    <span>5 min read</span>
                </div>
            </div>

            <div class="rounded-3xl overflow-hidden shadow-lg mb-10">
                <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="w-full h-auto object-cover">
            </div>

            <div class="prose prose-lg prose-indigo mx-auto text-slate-600 leading-loose">
                {!! nl2br(e($article->content)) !!}
            </div>

            <div class="mt-16 p-8 bg-indigo-50 rounded-3xl border border-indigo-100 text-center">
                <p class="text-indigo-800 italic font-medium text-lg">"Kesehatan mental adalah perjalanan, bukan tujuan.
                    Ambil langkah kecil setiap hari."</p>
            </div>

        </article>
    </div>

    <script>
        window.onscroll = function () {
            let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            let scrolled = (winScroll / height) * 100;
            document.getElementById("progressBar").style.width = scrolled + "%";
        };
    </script>
</x-app-layout>