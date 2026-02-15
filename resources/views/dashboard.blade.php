<x-app-layout>
    <!-- Background Texture Overlay -->
    <div class="fixed inset-0 z-[-1] opacity-[0.03] pointer-events-none mix-blend-multiply"
        style="background-image: url('https://www.transparenttextures.com/patterns/cream-paper.png'); background-size: 200px;">
    </div>

    <div class="relative max-w-6xl mx-auto space-y-12">

        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 animate-fade-in">
            <div class="relative">
                <div
                    class="absolute -left-12 -top-10 text-[8rem] opacity-5 select-none font-serif text-[#C04000] rotate-[-10deg]">
                    ✨</div>
                <h1
                    class="text-5xl md:text-6xl font-black text-[#260d00] dark:text-[#f5f0e1] tracking-tight font-serif leading-tight">
                    Selamat Pagi,<br>
                    <span class="relative inline-block text-[#7C9082]">
                        {{ explode(' ', Auth::user()->name)[0] }}
                        <svg class="absolute w-full h-3 -bottom-1 left-0 text-[#C04000] opacity-30" viewBox="0 0 100 10"
                            preserveAspectRatio="none">
                            <path d="M0 5 Q 50 10 100 5" stroke="currentColor" stroke-width="8" fill="none" />
                        </svg>
                    </span>
                </h1>
                <p class="text-[#595149] dark:text-[#a3968c] mt-4 text-xl font-medium max-w-lg leading-relaxed">
                    Siap untuk menjalani hari ini dengan tenang? Ingat, <span class="italic text-[#7C9082]">satu langkah
                        kecil</span> sudah cukup.
                </p>
            </div>

            <!-- Streak Badge -->
            <div
                class="flex items-center gap-4 bg-[#fdfcf8]/80 dark:bg-[#343d37]/80 backdrop-blur-md px-6 py-3 rounded-2xl border border-[#dbe5db] shadow-xl shadow-[#7C9082]/10 transform hover:-translate-y-1 transition duration-300">
                <div class="relative">
                    <span class="text-3xl animate-bounce">🔥</span>
                    <div class="absolute inset-0 bg-orange-400 blur-lg opacity-20"></div>
                </div>
                <div>
                    <div class="text-xs font-bold text-[#8A7E72] uppercase tracking-widest">Streak</div>
                    <div class="text-2xl font-black text-[#C04000]">{{ Auth::user()->streak ?? 0 }} Hari</div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            <!-- LEFT COLUMN: Mood & Activity (Large) -->
            <div class="lg:col-span-8 space-y-8">

                <!-- Mood Tracker Card -->
                <div
                    class="relative rounded-[3rem] overflow-hidden group shadow-2xl shadow-[#7C9082]/20 transition-all duration-500 hover:shadow-[#7C9082]/30">
                    <!-- Dynamic Background -->
                    <div class="absolute inset-0 bg-[#7C9082] dark:bg-[#2d3f2d]"></div>
                    <div class="absolute inset-0 bg-gradient-to-br from-[#9db49d] to-[#7C9082] opacity-90"></div>
                    <!-- Decorative Circles -->
                    <div
                        class="absolute top-[-20%] right-[-10%] w-[300px] h-[300px] rounded-full bg-[#fdfcf8] opacity-10 blur-3xl group-hover:scale-110 transition duration-1000">
                    </div>
                    <div
                        class="absolute bottom-[-20%] left-[-10%] w-[250px] h-[250px] rounded-full bg-[#343d37] opacity-10 blur-3xl">
                    </div>

                    <div
                        class="relative p-10 flex flex-col md:flex-row gap-8 items-center justify-between text-[#fdfcf8]">
                        <div class="flex-1 text-center md:text-left space-y-4">
                            <div
                                class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#fdfcf8]/20 border border-[#fdfcf8]/20 text-sm font-bold tracking-wide backdrop-blur-sm">
                                <span>🌿</span> MOOD HARI INI
                            </div>

                            @if($todayMood)
                                @php
                                    $labels = [1 => 'Berat', 2 => 'Sedih', 3 => 'Netral', 4 => 'Baik', 5 => 'Luar Biasa'];
                                    $emojis = [1 => '⛈️', 2 => '🌧️', 3 => '☁️', 4 => '🌤️', 5 => '☀️'];
                                @endphp
                                <div>
                                    <h2 class="text-6xl font-serif font-bold mb-2 drop-shadow-sm">
                                        {{ $labels[$todayMood->emoji_level] }}</h2>
                                    <p
                                        class="text-[#eef2ee] text-lg font-medium italic sensitive leading-relaxed opacity-90">
                                        "{{ Str::limit($todayMood->description ?? 'Tanpa catatan', 80) }}"
                                    </p>
                                </div>
                                <div class="flex gap-3 justify-center md:justify-start pt-2">
                                    <div class="flex flex-col items-center p-3 bg-[#fdfcf8]/10 rounded-2xl min-w-[80px]">
                                        <span class="text-xs uppercase opacity-70 mb-1">Tidur</span>
                                        <span class="font-bold text-xl">{{ $todayMood->sleep_hours ?? '-' }}h</span>
                                    </div>
                                    <div class="flex flex-col items-center p-3 bg-[#fdfcf8]/10 rounded-2xl min-w-[80px]">
                                        <span class="text-xs uppercase opacity-70 mb-1">Tags</span>
                                        <span
                                            class="font-bold text-xl">{{ count(explode(',', $todayMood->tags ?? '')) }}</span>
                                    </div>
                                </div>
                            @else
                                <div>
                                    <h2 class="text-4xl font-serif font-bold mb-3">Apa kabar hatimu?</h2>
                                    <p class="text-[#eef2ee] text-lg opacity-90">Luangkan 30 detik untuk mendengarkan diri
                                        sendiri.</p>
                                </div>
                                <a href="{{ route('mood.create') }}"
                                    class="group/btn inline-flex items-center gap-3 bg-[#fdfcf8] text-[#343d37] px-8 py-4 rounded-full font-bold text-lg hover:bg-[#F5F5DC] transition transform hover:scale-105 shadow-xl">
                                    Mulai Check-in
                                    <span class="group-hover/btn:translate-x-1 transition">→</span>
                                </a>
                            @endif
                        </div>

                        <!-- Illustration -->
                        <div class="relative w-48 h-48 flex-shrink-0">
                            @if($todayMood)
                                <div class="absolute inset-0 bg-[#fdfcf8] rounded-full opacity-20 blur-2xl animate-pulse">
                                </div>
                                <div
                                    class="text-[10rem] leading-none absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 filter drop-shadow-2xl animate-float">
                                    {{ $emojis[$todayMood->emoji_level] }}
                                </div>
                            @else
                                <div class="absolute inset-0 bg-[#fdfcf8] rounded-full opacity-10 blur-xl"></div>
                                <div
                                    class="text-[8rem] leading-none absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 opacity-30 grayscale rotate-12">
                                    🌱
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Mood Chart (Clean Minimalist) -->
                <div
                    class="bg-white dark:bg-[#343d37] rounded-[2.5rem] p-8 shadow-sm border border-[#eef2ee] dark:border-[#4f5c53]">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h3 class="text-xl font-bold text-[#3b322b] dark:text-[#fdfcf8] font-serif">Grafik Emosi
                            </h3>
                            <p class="text-sm text-[#8A7E72]">7 hari terakhir</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 rounded-full bg-[#7C9082]"></div>
                            <span class="text-xs font-bold text-[#7C9082] uppercase">Stabil</span>
                        </div>
                    </div>
                    <div class="h-64 relative">
                        @if(count($chartLabels) > 0)
                            <canvas id="moodChart"></canvas>
                        @else
                            <div class="absolute inset-0 flex flex-col items-center justify-center text-[#dcd6d0]">
                                <svg class="w-12 h-12 mb-3 opacity-50" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                    </path>
                                </svg>
                                <p class="text-sm font-medium">Belum cukup data</p>
                            </div>
                        @endif
                    </div>
                </div>

            </div>

            <!-- RIGHT COLUMN: Daily Mission & Actions -->
            <div class="lg:col-span-4 space-y-6">

                <!-- Daily Mission (Paper Style) -->
                <div class="relative group">
                    <div
                        class="absolute inset-0 bg-[#C04000] rounded-[2.5rem] rotate-3 opacity-10 group-hover:rotate-6 transition duration-500">
                    </div>
                    <div
                        class="relative bg-[#fdfcf8] dark:bg-[#260d00] rounded-[2.5rem] p-8 border border-[#e5b3ac]/30 shadow-xl shadow-[#C04000]/5 flex flex-col h-full justify-between">
                        <div class="absolute top-0 right-0 p-6 opacity-10">
                            <svg width="64" height="64" viewBox="0 0 24 24" fill="currentColor" class="text-[#C04000]">
                                <path
                                    d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" />
                            </svg>
                        </div>

                        <div>
                            <span
                                class="inline-block px-3 py-1 bg-[#fff5f0] text-[#C04000] text-[10px] font-black uppercase tracking-widest rounded mb-4">Misi
                                Harian</span>

                            @if(isset($dailyMission) && $dailyMission)
                                <p
                                    class="text-2xl font-serif font-bold text-[#343d37] dark:text-[#fdfcf8] leading-tight mb-4">
                                    "{{ $dailyMission->mission_text }}"
                                </p>
                                <div class="h-1 w-20 bg-[#C04000]/20 rounded-full"></div>
                            @else
                                <div class="text-center py-8">
                                    <p class="text-[#8A7E72] italic">Check-in dulu untuk buka misi rahasia.</p>
                                </div>
                            @endif
                        </div>

                        <div class="mt-8 flex justify-between items-center">
                            <div class="text-xs font-bold text-[#C04000] uppercase">AI Coach</div>
                            <div
                                class="w-10 h-10 rounded-full bg-[#faedeb] flex items-center justify-center text-[#C04000]">
                                🎯</div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions Grid -->
                <div class="grid grid-cols-2 gap-4">
                    <a href="{{ route('chat.index') }}"
                        class="col-span-1 bg-[#eef2ee] dark:bg-[#343d37] p-6 rounded-[2rem] hover:bg-[#dbe5db] transition group border border-transparent hover:border-[#7C9082]/20">
                        <div class="text-3xl mb-3 transform group-hover:scale-110 transition duration-300">💬</div>
                        <div class="font-bold text-[#343d37] dark:text-[#fdfcf8]">Curhat</div>
                        <div class="text-[10px] text-[#7C9082] uppercase font-bold mt-1">Teman Bicara</div>
                    </a>
                    <a href="{{ route('journal.index') }}"
                        class="col-span-1 bg-[#fdfcf8] dark:bg-[#343d37] p-6 rounded-[2rem] hover:bg-[#fff5f0] transition group border border-transparent hover:border-[#C04000]/20 shadow-sm">
                        <div class="text-3xl mb-3 transform group-hover:scale-110 transition duration-300">📓</div>
                        <div class="font-bold text-[#343d37] dark:text-[#fdfcf8]">Jurnal</div>
                        <div class="text-[10px] text-[#C04000] uppercase font-bold mt-1">Tulis Konsep</div>
                    </a>
                </div>

                <!-- Report Link -->
                <a href="{{ route('report.download') }}"
                    class="block p-6 bg-[#260d00] dark:bg-[#1a0900] rounded-[2rem] text-[#fdfcf8] shadow-lg group relative overflow-hidden">
                    <div class="absolute inset-0 bg-white/5 opacity-0 group-hover:opacity-10 transition"></div>
                    <div class="flex items-center justify-between relative z-10">
                        <div>
                            <div class="font-bold text-lg">Laporan Bulanan</div>
                            <div class="text-[#a3968c] text-sm">Download PDF</div>
                        </div>
                        <div
                            class="bg-white/20 w-10 h-10 rounded-full flex items-center justify-center group-hover:rotate-90 transition">
                            ↓
                        </div>
                    </div>
                </a>

            </div>
        </div>
    </div>

    <!-- Chart Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('moodChart');
            if (ctx) {
                const isDark = document.documentElement.classList.contains('dark');
                const gradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 300);
                gradient.addColorStop(0, 'rgba(124, 144, 130, 0.5)'); // #7C9082
                gradient.addColorStop(1, 'rgba(124, 144, 130, 0.0)');

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: @json($chartLabels),
                        datasets: [{
                            label: 'Mood',
                            data: @json($chartData),
                            borderColor: '#7C9082',
                            backgroundColor: gradient,
                            borderWidth: 4,
                            tension: 0.4,
                            pointBackgroundColor: '#fdfcf8',
                            pointBorderColor: '#7C9082',
                            pointBorderWidth: 3,
                            pointRadius: 6,
                            pointHoverRadius: 9
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false }, tooltip: { backgroundColor: '#343d37', titleFont: { family: 'serif' } } },
                        scales: {
                            y: { display: false, min: 0.5, max: 5.5 },
                            x: { grid: { display: false }, ticks: { color: isDark ? '#a3968c' : '#8A7E72', font: { family: 'Plus Jakarta Sans', size: 11 } } }
                        }
                    }
                });
            }
        });
    </script>
</x-app-layout>