<x-app-layout>
    <div class="min-h-[calc(100vh-100px)] flex items-center justify-center py-12 px-4 relative overflow-hidden">

        <div
            class="absolute top-0 right-0 w-[500px] h-[500px] bg-indigo-100/40 dark:bg-indigo-900/20 rounded-full blur-[120px] pointer-events-none">
        </div>
        <div
            class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-purple-100/40 dark:bg-purple-900/20 rounded-full blur-[120px] pointer-events-none">
        </div>

        <div class="max-w-3xl w-full relative z-10">

            <div class="text-center mb-10">
                <span
                    class="px-4 py-1.5 rounded-full bg-white dark:bg-slate-800 border border-indigo-50 dark:border-slate-700 text-indigo-600 dark:text-indigo-400 text-[10px] font-extrabold uppercase tracking-widest shadow-sm">
                    Daily Check-in
                </span>
                <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 dark:text-white mt-4 mb-2 tracking-tight">
                    Bagaimana Kabarmu?</h1>
                <p class="text-slate-500 dark:text-slate-400 font-medium">Sadari emosimu, pahami dirimu.</p>
            </div>

            @if($todayMood)
                <div
                    class="bg-white dark:bg-slate-900 rounded-[3rem] p-12 text-center shadow-2xl shadow-indigo-100/50 dark:shadow-none border border-slate-100 dark:border-slate-800 animate-fade-in relative overflow-hidden">
                    <div
                        class="absolute inset-0 bg-gradient-to-b from-green-50/50 dark:from-green-900/20 to-transparent pointer-events-none">
                    </div>
                    <div class="relative z-10">
                        <div
                            class="w-24 h-24 bg-green-100 dark:bg-green-900/50 text-green-600 dark:text-green-400 rounded-full flex items-center justify-center text-5xl mx-auto mb-6 shadow-inner animate-[bounce_2s_infinite]">
                            🎉</div>
                        <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-2">Laporan Tersimpan!</h2>
                        <p class="text-slate-500 dark:text-slate-400 mb-8 max-w-md mx-auto">Terima kasih sudah peduli dengan
                            kesehatan mentalmu hari ini.</p>
                        <div class="flex justify-center gap-4">
                            <a href="{{ route('dashboard') }}"
                                class="px-8 py-3 bg-slate-900 dark:bg-indigo-600 text-white rounded-full font-bold hover:bg-slate-800 dark:hover:bg-indigo-500 transition shadow-lg">Dashboard</a>
                            <a href="{{ route('journal.create') }}"
                                class="px-8 py-3 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 border border-slate-200 dark:border-slate-700 rounded-full font-bold hover:bg-slate-50 dark:hover:bg-slate-700 transition">Tulis
                                Jurnal</a>
                        </div>
                    </div>
                </div>
            @else
                <div
                    class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl rounded-[3rem] shadow-2xl shadow-indigo-100/50 dark:shadow-none border border-white dark:border-slate-800 p-8 md:p-12 animate-fade-in transition-colors">
                    <form action="{{ route('mood.store') }}" method="POST" x-data="{ sleep: 7 }">
                        @csrf

                        <div class="mb-12">
                            <label
                                class="block text-center text-xs font-bold text-slate-400 uppercase tracking-widest mb-6">PILIH
                                EMOSI UTAMA</label>
                            <div class="flex justify-center gap-3 md:gap-5">
                                @php
                                    $emojis = [
                                        1 => ['icon' => '😖', 'label' => 'Buruk'],
                                        2 => ['icon' => '😔', 'label' => 'Sedih'],
                                        3 => ['icon' => '😐', 'label' => 'Biasa'],
                                        4 => ['icon' => '🙂', 'label' => 'Baik'],
                                        5 => ['icon' => '🤩', 'label' => 'Hebat'],
                                    ];
                                @endphp
                                @foreach($emojis as $val => $data)
                                    <label class="cursor-pointer group relative">
                                        <input type="radio" name="emoji_level" value="{{ $val }}" class="peer sr-only" required>
                                        <div
                                            class="w-16 h-20 md:w-24 md:h-32 bg-slate-50 dark:bg-slate-800 border-2 border-transparent rounded-[1.5rem] flex flex-col items-center justify-center gap-2 transition-all duration-300 
                                                    hover:bg-white dark:hover:bg-slate-700 hover:shadow-lg hover:-translate-y-1 
                                                    peer-checked:bg-slate-900 dark:peer-checked:bg-indigo-600 peer-checked:text-white peer-checked:shadow-xl peer-checked:scale-110 peer-checked:border-slate-900 dark:peer-checked:border-indigo-600">

                                            <span
                                                class="text-3xl md:text-5xl filter grayscale opacity-50 group-hover:grayscale-0 group-hover:opacity-100 peer-checked:grayscale-0 peer-checked:opacity-100 transition duration-300 transform group-hover:scale-110">
                                                {{ $data['icon'] }}
                                            </span>
                                            <span
                                                class="text-[10px] font-bold uppercase tracking-wider opacity-0 group-hover:opacity-100 peer-checked:opacity-100 transition text-slate-400 dark:text-slate-300 peer-checked:text-white dark:peer-checked:text-white">
                                                {{ $data['label'] }}
                                            </span>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-8 mb-10">
                            <div
                                class="bg-slate-50 dark:bg-slate-800 rounded-[2rem] p-6 border border-slate-100 dark:border-slate-700 transition-colors">
                                <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">Durasi
                                    Tidur</label>
                                <div class="flex items-end gap-2 mb-4">
                                    <span class="text-5xl font-black text-indigo-600 dark:text-indigo-400 tracking-tighter"
                                        x-text="sleep"></span>
                                    <span class="text-sm font-bold text-slate-400 mb-2">Jam</span>
                                </div>
                                <input type="range" name="sleep_hours" min="0" max="12" step="0.5" x-model="sleep"
                                    class="w-full h-3 bg-slate-200 dark:bg-slate-700 rounded-full appearance-none cursor-pointer accent-indigo-600 hover:accent-indigo-500 transition-all">
                            </div>

                            <div>
                                <label
                                    class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-4 text-center md:text-left">FAKTOR
                                    UTAMA</label>
                                <div class="flex flex-wrap gap-2 justify-center md:justify-start">
                                    @foreach(['Tugas 📚', 'Uang 💸', 'Keluarga 🏡', 'Cinta ❤️', 'Sehat 🏥', 'Masa Depan 🚀', 'Teman 👯'] as $tag)
                                        <label class="cursor-pointer group">
                                            <input type="checkbox" name="tags[]" value="{{ $tag }}" class="peer sr-only">
                                            <span
                                                class="inline-block px-4 py-2.5 rounded-xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 text-xs font-bold transition-all duration-200 hover:border-indigo-300 dark:hover:border-indigo-500 peer-checked:bg-indigo-600 peer-checked:text-white peer-checked:border-indigo-600 peer-checked:shadow-md transform peer-checked:scale-105 select-none">
                                                {{ $tag }}
                                            </span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="mb-10">
                            <label
                                class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2 ml-2">Catatan
                                Harian (Opsional)</label>
                            <textarea name="description" rows="2"
                                class="w-full bg-slate-50 dark:bg-slate-800 border-0 rounded-2xl p-5 text-slate-700 dark:text-slate-200 placeholder-slate-400 focus:bg-white dark:focus:bg-slate-700 focus:ring-2 focus:ring-indigo-100 dark:focus:ring-indigo-900 transition shadow-inner resize-none text-sm font-medium"
                                placeholder="Tulis hal menarik hari ini..."></textarea>
                        </div>

                        <button type="submit"
                            class="w-full py-4 bg-slate-900 dark:bg-indigo-600 text-white rounded-2xl font-bold text-lg hover:bg-slate-800 dark:hover:bg-indigo-500 transition duration-300 shadow-xl shadow-slate-900/20 dark:shadow-indigo-600/30 transform hover:-translate-y-1 active:scale-95 flex items-center justify-center gap-2 group">
                            <span>Simpan Laporan</span>
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </button>

                    </form>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>