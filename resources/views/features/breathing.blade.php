<x-app-layout>
    <div class="-mt-8 -mx-4 sm:-mx-6 lg:-mx-8 min-h-screen flex flex-col items-center justify-center relative overflow-hidden bg-black text-white selection:bg-indigo-500/30"
        x-data="breathingApp()">

        <div class="absolute inset-0 pointer-events-none overflow-hidden">
            <div class="absolute top-[-20%] left-[10%] w-[1000px] h-[1000px] bg-indigo-600/20 rounded-full blur-[150px] animate-pulse"
                style="animation-duration: 8s"></div>
            <div class="absolute bottom-[-20%] right-[10%] w-[800px] h-[800px] bg-purple-900/20 rounded-full blur-[150px] animate-pulse"
                style="animation-duration: 12s"></div>

            <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,transparent_0%,#000000_90%)]"></div>
        </div>

        <div class="relative z-10 w-full max-w-2xl px-6 flex flex-col items-center justify-between py-12 min-h-[80vh]">

            <div class="text-center space-y-2 mb-8 transition-all duration-700"
                :class="{ 'opacity-50 translate-y-[-20px]': isRunning }">
                <div
                    class="inline-flex items-center gap-2 text-indigo-400 text-[10px] font-bold tracking-[0.3em] uppercase mb-2">
                    <span class="w-1.5 h-1.5 bg-indigo-500 rounded-full animate-pulse"></span> Mindfulness
                </div>
                <h1 class="text-3xl md:text-4xl font-light tracking-tight text-white/90">Ruang Bernapas</h1>
            </div>

            <div class="flex p-1 bg-white/5 backdrop-blur-xl border border-white/10 rounded-full mb-12 transition-all duration-500 shadow-2xl"
                :class="{ 'opacity-0 pointer-events-none scale-95': isRunning }">

                <button @click="selectMode('relax')"
                    class="px-6 py-2 rounded-full text-xs font-bold transition-all duration-300 flex items-center gap-2"
                    :class="mode === 'relax' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/40' : 'text-slate-400 hover:text-white hover:bg-white/5'">
                    <span>🌙</span> Relax
                </button>

                <button @click="selectMode('focus')"
                    class="px-6 py-2 rounded-full text-xs font-bold transition-all duration-300 flex items-center gap-2"
                    :class="mode === 'focus' ? 'bg-teal-600 text-white shadow-lg shadow-teal-500/40' : 'text-slate-400 hover:text-white hover:bg-white/5'">
                    <span>🎯</span> Focus
                </button>

                <button @click="selectMode('balance')"
                    class="px-6 py-2 rounded-full text-xs font-bold transition-all duration-300 flex items-center gap-2"
                    :class="mode === 'balance' ? 'bg-rose-600 text-white shadow-lg shadow-rose-500/40' : 'text-slate-400 hover:text-white hover:bg-white/5'">
                    <span>⚖️</span> Balance
                </button>
            </div>

            <div class="relative w-[320px] h-[320px] flex items-center justify-center">

                <div class="absolute inset-0 border border-white/5 rounded-full scale-110"></div>
                <div
                    class="absolute inset-0 border border-white/5 rounded-full scale-125 border-dashed opacity-30 animate-[spin_60s_linear_infinite]">
                </div>

                <div class="absolute inset-0 rounded-full border border-white/20 transition-all duration-[3000ms] ease-in-out"
                    :class="[borderColor, circleScale, opacityClass]"></div>

                <div class="absolute inset-0 rounded-full blur-[80px] transition-all duration-[3000ms] ease-in-out mix-blend-screen"
                    :class="[bgGradient, circleScale, 'opacity-60']"></div>

                <div class="relative w-full h-full rounded-full flex flex-col items-center justify-center backdrop-blur-sm transition-all duration-[3000ms] ease-in-out z-20 border border-white/10 shadow-[0_0_50px_rgba(0,0,0,0.5)]"
                    :class="[bgGradient, circleScale]">

                    <span class="text-5xl mb-3 transition-transform duration-500 drop-shadow-lg"
                        x-text="currentIcon"></span>
                    <span class="text-3xl font-light tracking-[0.2em] text-white drop-shadow-2xl"
                        x-text="statusText">SIAP</span>
                    <span class="text-xs text-white/80 mt-2 font-mono tracking-widest font-bold" x-show="isRunning"
                        x-text="timerText"></span>
                </div>
            </div>

            <div class="mt-16">
                <button @click="toggleSession()"
                    class="group relative px-8 py-3 rounded-full overflow-hidden bg-white text-black font-bold text-sm tracking-wider transition-all duration-300 hover:scale-105 hover:shadow-[0_0_40px_rgba(255,255,255,0.4)]">
                    <span class="relative z-10 flex items-center gap-2">
                        <span x-show="!isRunning">▶ MULAI LATIHAN</span>
                        <span x-show="isRunning">⏹ BERHENTI</span>
                    </span>
                </button>
            </div>

            <p class="mt-8 text-[10px] text-slate-600 uppercase tracking-widest opacity-60">Health-AI Wellness Engine
            </p>

        </div>
    </div>

    <script>
        function breathingApp() {
            return {
                mode: 'relax',
                isRunning: false,
                statusText: 'SIAP',
                timerText: '',
                circleScale: 'scale-50', // Mulai kecil
                opacityClass: 'opacity-50',
                bgGradient: 'bg-gradient-to-b from-indigo-600 to-indigo-800',
                borderColor: 'border-indigo-500',
                currentIcon: '🌙',
                cycleInterval: null,

                selectMode(newMode) {
                    if (this.isRunning) return;
                    this.mode = newMode;
                    if (newMode === 'relax') {
                        this.bgGradient = 'bg-gradient-to-b from-indigo-600 to-indigo-800';
                        this.borderColor = 'border-indigo-500';
                        this.currentIcon = '🌙';
                    } else if (newMode === 'focus') {
                        this.bgGradient = 'bg-gradient-to-b from-teal-600 to-teal-800';
                        this.borderColor = 'border-teal-500';
                        this.currentIcon = '🎯';
                    } else {
                        this.bgGradient = 'bg-gradient-to-b from-rose-600 to-rose-800';
                        this.borderColor = 'border-rose-500';
                        this.currentIcon = '⚖️';
                    }
                },

                toggleSession() {
                    this.isRunning ? this.stop() : this.start();
                },

                start() {
                    this.isRunning = true;
                    this.runCycle();
                },

                stop() {
                    this.isRunning = false;
                    this.statusText = 'SIAP';
                    this.timerText = '';
                    this.circleScale = 'scale-50';
                    this.opacityClass = 'opacity-50';
                    clearTimeout(this.cycleInterval);
                },

                async runCycle() {
                    while (this.isRunning) {
                        if (this.mode === 'relax') await this.pattern478();
                        else if (this.mode === 'focus') await this.patternBox();
                        else await this.patternResonance();
                    }
                },

                wait(ms) {
                    return new Promise(resolve => {
                        this.cycleInterval = setTimeout(resolve, ms);
                    });
                },

                async animate(text, scale, timeLabel, duration) {
                    this.statusText = text;
                    this.circleScale = scale;
                    this.timerText = timeLabel;
                    this.opacityClass = 'opacity-100';
                    await this.wait(duration);
                },

                // 4-7-8
                async pattern478() {
                    await this.animate('TARIK', 'scale-100', 'Inhale (4s)', 4000);
                    if (!this.isRunning) return;
                    await this.animate('TAHAN', 'scale-100', 'Hold (7s)', 7000);
                    if (!this.isRunning) return;
                    await this.animate('HEMBUS', 'scale-50', 'Exhale (8s)', 8000);
                },

                // Box 4-4-4-4
                async patternBox() {
                    await this.animate('TARIK', 'scale-100', 'Inhale (4s)', 4000);
                    if (!this.isRunning) return;
                    await this.animate('TAHAN', 'scale-100', 'Hold (4s)', 4000);
                    if (!this.isRunning) return;
                    await this.animate('HEMBUS', 'scale-50', 'Exhale (4s)', 4000);
                    if (!this.isRunning) return;
                    await this.animate('TAHAN', 'scale-50', 'Hold (4s)', 4000);
                },

                // Resonance 5-5
                async patternResonance() {
                    await this.animate('TARIK', 'scale-100', 'Inhale (5s)', 5000);
                    if (!this.isRunning) return;
                    await this.animate('HEMBUS', 'scale-50', 'Exhale (5s)', 5000);
                }
            }
        }
    </script>
</x-app-layout>