<x-app-layout>
    <div class="max-w-6xl mx-auto py-8">

        <div class="text-center mb-12 animate-fade-in">
            <h1 class="text-4xl font-extrabold text-slate-800 mb-2">Fokus & Relaksasi</h1>
            <p class="text-slate-500 text-lg">Pilih suasana suaramu untuk belajar, tidur, atau menenangkan diri.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <div class="sound-card group bg-white rounded-[2rem] p-6 border border-slate-100 shadow-lg hover:shadow-xl transition cursor-pointer relative overflow-hidden"
                onclick="toggleSound('rain', this)">
                <div class="absolute inset-0 bg-blue-50 opacity-0 group-hover:opacity-100 transition duration-500">
                </div>
                <div class="relative z-10 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-14 h-14 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center text-3xl">
                            🌧️</div>
                        <div>
                            <h3 class="font-bold text-slate-800 text-lg">Hujan Deras</h3>
                            <p class="text-xs text-slate-500 font-medium status-text">Tap untuk memutar</p>
                        </div>
                    </div>
                    <div
                        class="w-10 h-10 rounded-full bg-slate-900 text-white flex items-center justify-center shadow-md icon-play transition-transform group-hover:scale-110">
                        <svg class="w-5 h-5 ml-0.5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z" />
                        </svg>
                    </div>
                    <div class="hidden icon-pause flex gap-1 items-end h-6">
                        <span class="w-1 bg-blue-500 rounded-full animate-[bounce_1s_infinite] h-3"></span>
                        <span class="w-1 bg-blue-500 rounded-full animate-[bounce_1.2s_infinite] h-5"></span>
                        <span class="w-1 bg-blue-500 rounded-full animate-[bounce_0.8s_infinite] h-4"></span>
                    </div>
                </div>
                <audio id="audio-rain" loop
                    src="https://actions.google.com/sounds/v1/weather/rain_heavy_loud.ogg"></audio>
            </div>

            <div class="sound-card group bg-white rounded-[2rem] p-6 border border-slate-100 shadow-lg hover:shadow-xl transition cursor-pointer relative overflow-hidden"
                onclick="toggleSound('forest', this)">
                <div class="absolute inset-0 bg-green-50 opacity-0 group-hover:opacity-100 transition duration-500">
                </div>
                <div class="relative z-10 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-14 h-14 rounded-2xl bg-green-100 text-green-600 flex items-center justify-center text-3xl">
                            🌲</div>
                        <div>
                            <h3 class="font-bold text-slate-800 text-lg">Hutan Alami</h3>
                            <p class="text-xs text-slate-500 font-medium status-text">Tap untuk memutar</p>
                        </div>
                    </div>
                    <div
                        class="w-10 h-10 rounded-full bg-slate-900 text-white flex items-center justify-center shadow-md icon-play transition-transform group-hover:scale-110">
                        <svg class="w-5 h-5 ml-0.5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z" />
                        </svg>
                    </div>
                    <div class="hidden icon-pause flex gap-1 items-end h-6">
                        <span class="w-1 bg-green-500 rounded-full animate-[bounce_1s_infinite] h-3"></span>
                        <span class="w-1 bg-green-500 rounded-full animate-[bounce_1.2s_infinite] h-5"></span>
                        <span class="w-1 bg-green-500 rounded-full animate-[bounce_0.8s_infinite] h-4"></span>
                    </div>
                </div>
                <audio id="audio-forest" loop
                    src="https://actions.google.com/sounds/v1/relax/forest_sounds.ogg"></audio>
            </div>

            <div class="sound-card group bg-white rounded-[2rem] p-6 border border-slate-100 shadow-lg hover:shadow-xl transition cursor-pointer relative overflow-hidden"
                onclick="toggleSound('fire', this)">
                <div class="absolute inset-0 bg-orange-50 opacity-0 group-hover:opacity-100 transition duration-500">
                </div>
                <div class="relative z-10 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-14 h-14 rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-3xl">
                            🔥</div>
                        <div>
                            <h3 class="font-bold text-slate-800 text-lg">Api Unggun</h3>
                            <p class="text-xs text-slate-500 font-medium status-text">Tap untuk memutar</p>
                        </div>
                    </div>
                    <div
                        class="w-10 h-10 rounded-full bg-slate-900 text-white flex items-center justify-center shadow-md icon-play transition-transform group-hover:scale-110">
                        <svg class="w-5 h-5 ml-0.5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z" />
                        </svg>
                    </div>
                    <div class="hidden icon-pause flex gap-1 items-end h-6">
                        <span class="w-1 bg-orange-500 rounded-full animate-[bounce_1s_infinite] h-3"></span>
                        <span class="w-1 bg-orange-500 rounded-full animate-[bounce_1.2s_infinite] h-5"></span>
                        <span class="w-1 bg-orange-500 rounded-full animate-[bounce_0.8s_infinite] h-4"></span>
                    </div>
                </div>
                <audio id="audio-fire" loop src="https://actions.google.com/sounds/v1/ambiences/fireplace.ogg"></audio>
            </div>

            <div class="sound-card group bg-white rounded-[2rem] p-6 border border-slate-100 shadow-lg hover:shadow-xl transition cursor-pointer relative overflow-hidden"
                onclick="toggleSound('night', this)">
                <div class="absolute inset-0 bg-indigo-50 opacity-0 group-hover:opacity-100 transition duration-500">
                </div>
                <div class="relative z-10 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-14 h-14 rounded-2xl bg-indigo-100 text-indigo-600 flex items-center justify-center text-3xl">
                            🌙</div>
                        <div>
                            <h3 class="font-bold text-slate-800 text-lg">Malam Sunyi</h3>
                            <p class="text-xs text-slate-500 font-medium status-text">Tap untuk memutar</p>
                        </div>
                    </div>
                    <div
                        class="w-10 h-10 rounded-full bg-slate-900 text-white flex items-center justify-center shadow-md icon-play transition-transform group-hover:scale-110">
                        <svg class="w-5 h-5 ml-0.5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z" />
                        </svg>
                    </div>
                    <div class="hidden icon-pause flex gap-1 items-end h-6">
                        <span class="w-1 bg-indigo-500 rounded-full animate-[bounce_1s_infinite] h-3"></span>
                        <span class="w-1 bg-indigo-500 rounded-full animate-[bounce_1.2s_infinite] h-5"></span>
                        <span class="w-1 bg-indigo-500 rounded-full animate-[bounce_0.8s_infinite] h-4"></span>
                    </div>
                </div>
                <audio id="audio-night" loop
                    src="https://actions.google.com/sounds/v1/weather/outdoor_rain.ogg"></audio>
            </div>

            <div class="sound-card group bg-white rounded-[2rem] p-6 border border-slate-100 shadow-lg hover:shadow-xl transition cursor-pointer relative overflow-hidden"
                onclick="toggleSound('cafe', this)">
                <div class="absolute inset-0 bg-amber-50 opacity-0 group-hover:opacity-100 transition duration-500">
                </div>
                <div class="relative z-10 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-14 h-14 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center text-3xl">
                            ☕</div>
                        <div>
                            <h3 class="font-bold text-slate-800 text-lg">Suasana Kafe</h3>
                            <p class="text-xs text-slate-500 font-medium status-text">Tap untuk memutar</p>
                        </div>
                    </div>
                    <div
                        class="w-10 h-10 rounded-full bg-slate-900 text-white flex items-center justify-center shadow-md icon-play transition-transform group-hover:scale-110">
                        <svg class="w-5 h-5 ml-0.5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z" />
                        </svg>
                    </div>
                    <div class="hidden icon-pause flex gap-1 items-end h-6">
                        <span class="w-1 bg-amber-500 rounded-full animate-[bounce_1s_infinite] h-3"></span>
                        <span class="w-1 bg-amber-500 rounded-full animate-[bounce_1.2s_infinite] h-5"></span>
                        <span class="w-1 bg-amber-500 rounded-full animate-[bounce_0.8s_infinite] h-4"></span>
                    </div>
                </div>
                <audio id="audio-cafe" loop
                    src="https://actions.google.com/sounds/v1/ambiences/coffee_shop.ogg"></audio>
            </div>

            <div class="sound-card group bg-white rounded-[2rem] p-6 border border-slate-100 shadow-lg hover:shadow-xl transition cursor-pointer relative overflow-hidden"
                onclick="toggleSound('ocean', this)">
                <div class="absolute inset-0 bg-cyan-50 opacity-0 group-hover:opacity-100 transition duration-500">
                </div>
                <div class="relative z-10 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-14 h-14 rounded-2xl bg-cyan-100 text-cyan-600 flex items-center justify-center text-3xl">
                            🌊</div>
                        <div>
                            <h3 class="font-bold text-slate-800 text-lg">Ombak Pantai</h3>
                            <p class="text-xs text-slate-500 font-medium status-text">Tap untuk memutar</p>
                        </div>
                    </div>
                    <div
                        class="w-10 h-10 rounded-full bg-slate-900 text-white flex items-center justify-center shadow-md icon-play transition-transform group-hover:scale-110">
                        <svg class="w-5 h-5 ml-0.5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z" />
                        </svg>
                    </div>
                    <div class="hidden icon-pause flex gap-1 items-end h-6">
                        <span class="w-1 bg-cyan-500 rounded-full animate-[bounce_1s_infinite] h-3"></span>
                        <span class="w-1 bg-cyan-500 rounded-full animate-[bounce_1.2s_infinite] h-5"></span>
                        <span class="w-1 bg-cyan-500 rounded-full animate-[bounce_0.8s_infinite] h-4"></span>
                    </div>
                </div>
                <audio id="audio-ocean" loop src="https://actions.google.com/sounds/v1/relax/ocean_waves.ogg"></audio>
            </div>

        </div>
    </div>

    <script>
        let currentAudio = null;
        let currentCard = null;

        function toggleSound(id, cardElement) {
            const audioElement = document.getElementById('audio-' + id);
            const playIcon = cardElement.querySelector('.icon-play');
            const pauseIcon = cardElement.querySelector('.icon-pause');
            const statusText = cardElement.querySelector('.status-text');

            // Jika audio yang diklik sedang main -> PAUSE
            if (currentAudio === audioElement && !audioElement.paused) {
                audioElement.pause();
                resetUI(cardElement);
                currentAudio = null;
                return;
            }

            // Jika ada audio lain yang main -> STOP yang lama
            if (currentAudio && currentAudio !== audioElement) {
                currentAudio.pause();
                currentAudio.currentTime = 0;
                resetUI(currentCard); // Reset kartu yang lama
            }

            // PLAY audio baru
            audioElement.play();
            currentAudio = audioElement;
            currentCard = cardElement;

            // Update UI Aktif
            playIcon.classList.add('hidden');
            pauseIcon.classList.remove('hidden');
            statusText.innerText = "Sedang memutar...";
            statusText.classList.add('text-indigo-600', 'font-bold');
            cardElement.classList.add('ring-2', 'ring-indigo-500', 'ring-offset-2');
        }

        function resetUI(card) {
            if (!card) return;
            const play = card.querySelector('.icon-play');
            const pause = card.querySelector('.icon-pause');
            const status = card.querySelector('.status-text');

            play.classList.remove('hidden');
            pause.classList.add('hidden');
            status.innerText = "Tap untuk memutar";
            status.classList.remove('text-indigo-600', 'font-bold');
            card.classList.remove('ring-2', 'ring-indigo-500', 'ring-offset-2');
        }
    </script>
</x-app-layout>