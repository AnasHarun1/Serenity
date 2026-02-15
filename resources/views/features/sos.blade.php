<x-app-layout>
    <div
        class="min-h-[calc(100vh-100px)] flex flex-col items-center justify-center p-6 relative overflow-hidden bg-red-50/30">

        <div class="absolute inset-0 pointer-events-none flex items-center justify-center">
            <div class="w-[500px] h-[500px] bg-red-500/5 rounded-full animate-ping"></div>
        </div>

        <div class="relative z-10 max-w-2xl w-full text-center space-y-8">

            <div>
                <div
                    class="w-20 h-20 bg-red-100 text-red-600 rounded-full flex items-center justify-center text-4xl mx-auto mb-6 shadow-xl shadow-red-100 border-4 border-white animate-bounce">
                    🆘
                </div>
                <h1 class="text-4xl font-extrabold text-slate-900 mb-2">Bantuan Darurat</h1>
                <p class="text-slate-500 text-lg">Kamu tidak sendirian. Bantuan selalu tersedia.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <a href="tel:119"
                    class="group relative overflow-hidden bg-red-600 text-white p-6 rounded-3xl shadow-lg shadow-red-200 hover:shadow-xl hover:bg-red-700 transition transform hover:-translate-y-1">
                    <div class="relative z-10 flex flex-col items-center gap-2">
                        <span class="text-3xl">🚑</span>
                        <span class="text-2xl font-bold">119</span>
                        <span class="text-xs uppercase tracking-widest opacity-80">Ambulans / Medis</span>
                    </div>
                    <div
                        class="absolute top-0 -left-[100%] w-full h-full bg-gradient-to-r from-transparent via-white/20 to-transparent transform skew-x-12 group-hover:animate-[shimmer_1s_infinite]">
                    </div>
                </a>

                <a href="tel:119"
                    class="group bg-white text-slate-800 border-2 border-red-100 p-6 rounded-3xl shadow-lg hover:border-red-300 transition transform hover:-translate-y-1">
                    <div class="flex flex-col items-center gap-2">
                        <span class="text-3xl">💙</span>
                        <span class="text-2xl font-bold">Layanan Konseling</span>
                        <span class="text-xs uppercase tracking-widest text-slate-400">Halo Kemenkes</span>
                    </div>
                </a>
            </div>

            <div class="bg-white rounded-[2rem] p-8 border border-slate-100 shadow-xl text-left">
                <h3 class="text-xl font-bold text-slate-800 mb-6 flex items-center gap-2">
                    <span class="w-2 h-6 bg-indigo-500 rounded-full"></span>
                    Teknik Grounding 5-4-3-2-1
                </h3>

                <div class="space-y-4">
                    <div class="flex items-center gap-4 p-3 rounded-2xl hover:bg-slate-50 transition">
                        <div
                            class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold">
                            5</div>
                        <p class="text-slate-600 font-medium">Sebutkan <span class="font-bold text-slate-800">5
                                benda</span> yang bisa kamu lihat.</p>
                    </div>
                    <div class="flex items-center gap-4 p-3 rounded-2xl hover:bg-slate-50 transition">
                        <div
                            class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold">
                            4</div>
                        <p class="text-slate-600 font-medium">Sentuh <span class="font-bold text-slate-800">4
                                benda</span> di sekitarmu.</p>
                    </div>
                    <div class="flex items-center gap-4 p-3 rounded-2xl hover:bg-slate-50 transition">
                        <div
                            class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center font-bold">
                            3</div>
                        <p class="text-slate-600 font-medium">Dengar <span class="font-bold text-slate-800">3
                                suara</span> di kejauhan.</p>
                    </div>
                    <div class="flex items-center gap-4 p-3 rounded-2xl hover:bg-slate-50 transition">
                        <div
                            class="w-10 h-10 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center font-bold">
                            2</div>
                        <p class="text-slate-600 font-medium">Cium <span class="font-bold text-slate-800">2 aroma</span>
                            di udara.</p>
                    </div>
                    <div class="flex items-center gap-4 p-3 rounded-2xl hover:bg-slate-50 transition">
                        <div
                            class="w-10 h-10 rounded-full bg-pink-100 text-pink-600 flex items-center justify-center font-bold">
                            1</div>
                        <p class="text-slate-600 font-medium">Rasakan <span class="font-bold text-slate-800">1
                                hal</span> tentang dirimu yang baik.</p>
                    </div>
                </div>
            </div>

            <div class="text-sm text-slate-400">
                <p>Jika kondisi memburuk, segera hubungi profesional atau pergi ke IGD terdekat.</p>
            </div>

        </div>
    </div>
</x-app-layout>