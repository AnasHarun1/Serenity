<x-chat-layout>
    <!-- Main Container: Full Height minus header to prevent scroll issues -->
    <div
        class="h-[calc(100vh-65px)] md:h-[calc(100vh-80px)] max-w-5xl mx-auto flex flex-col relative px-4 pb-4 md:px-6 md:pb-6 overflow-hidden">

        <!-- Background Blobs (Earth Tone) -->
        <div
            class="absolute top-1/4 left-1/4 w-96 h-96 bg-sage-300/20 rounded-full blur-[100px] pointer-events-none animate-pulse">
        </div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-terracotta-300/20 rounded-full blur-[100px] pointer-events-none animate-pulse"
            style="animation-delay: 2s;"></div>

        <!-- Chat Card Content -->
        <div
            class="flex-1 flex flex-col bg-white/90 backdrop-blur-2xl border border-earth-100 shadow-xl shadow-earth-900/5 rounded-[2rem] md:rounded-[2.5rem] overflow-hidden relative z-10 transition-all duration-500">

            <!-- Header -->
            <div
                class="px-6 py-4 border-b border-earth-100 flex justify-between items-center bg-beige-50/50 backdrop-blur-sm z-20 shrink-0">
                <div class="flex items-center gap-4">
                    <div class="relative group cursor-default">
                        <div
                            class="absolute inset-0 bg-gradient-to-tr from-terracotta-400 to-sage-500 rounded-2xl blur opacity-20 group-hover:opacity-40 transition duration-500">
                        </div>
                        <div
                            class="relative w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-2xl shadow-sm border border-earth-50 group-hover:scale-105 transition duration-300">
                            🌿
                        </div>
                        <!-- Validated Badge -->
                        <span class="absolute -bottom-1 -right-1 flex h-3.5 w-3.5">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                            <span
                                class="relative inline-flex rounded-full h-3.5 w-3.5 bg-green-500 border-2 border-white"></span>
                        </span>
                    </div>
                    <div>
                        <h2 class="text-lg font-serif font-bold text-earth-900 tracking-tight leading-tight">Teman
                            Cerita</h2>
                        <span
                            class="text-[10px] font-bold bg-sage-100 text-sage-700 px-2 py-0.5 rounded-full tracking-wide inline-block mt-0.5">ONLINE
                            24/7</span>
                    </div>
                </div>

                <form action="{{ route('chat.clear') }}" method="POST"
                    onsubmit="return confirm('Hapus semua percakapan?');">
                    @csrf
                    <button
                        class="group flex items-center gap-2 px-3 py-2 md:px-4 md:py-2 rounded-full bg-beige-100 text-earth-600 hover:bg-terracotta-50 hover:text-terracotta-600 transition border border-transparent hover:border-terracotta-100">
                        <span class="text-xs font-bold uppercase tracking-wider hidden sm:block">Reset</span>
                        <svg class="w-4 h-4 group-hover:rotate-90 transition duration-300" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                    </button>
                </form>
            </div>

            <!-- Chat Area (Flex-1 to take remaining space) -->
            <div x-data="{
                messages: [],
                newMessage: '',
                isLoading: false,
                init() {
                    this.scrollToBottom();
                },
                scrollToBottom() {
                    const container = document.getElementById('chat-container');
                    if (container) {
                        setTimeout(() => {
                            container.scrollTop = container.scrollHeight;
                        }, 100);
                    }
                },
                async sendMessage() {
                    if (!this.newMessage.trim()) return;
                    
                    const messageToSend = this.newMessage;
                    this.newMessage = '';
                    this.isLoading = true;
                    
                    const container = document.getElementById('chat-container');
                    const userMsgHTML = `
                        <div class='flex w-full justify-end animate-fade-in group relative z-10 mb-6'>
                            <div class='flex items-end max-w-[85%] md:max-w-[75%] gap-3'>
                                <div class='relative px-5 py-4 shadow-sm text-[15px] leading-relaxed bg-[#f05e35] text-white rounded-[2rem] rounded-tr-none shadow-orange-200/50 chat-bubble-user'>
                                    ${messageToSend.replace(/\n/g, '<br>')}
                                    <div class='text-[10px] mt-2 text-right font-bold uppercase tracking-wider opacity-80 text-orange-100'>
                                        Just now
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    
                    const emptyState = container.querySelector('.empty-state');
                    if(emptyState) emptyState.remove();

                    const msgDiv = document.createElement('div');
                    msgDiv.innerHTML = userMsgHTML;
                    container.appendChild(msgDiv.firstElementChild);
                    this.scrollToBottom();

                    // Focus input back on desktop, maybe not mobile to prevent keyboard flickering
                    // document.getElementById('messageInput').focus();

                    try {
                        const response = await fetch('{{ route('chat.send') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ message: messageToSend })
                        });

                        const data = await response.json();

                        if (data.status === 'success') {
                            const aiMsgHTML = `
                                <div class='flex w-full justify-start animate-fade-in group relative z-10 mb-6'>
                                    <div class='flex items-start max-w-[85%] md:max-w-[75%] gap-3'>
                                        <div class='w-8 h-8 md:w-10 md:h-10 rounded-2xl bg-sage-50 border border-sage-100 flex items-center justify-center text-lg shrink-0 shadow-sm mt-1'>🌿</div>
                                        <div class='relative px-5 py-4 shadow-sm text-[15px] leading-relaxed bg-white text-earth-800 border border-earth-100 rounded-[2rem] rounded-tl-none chat-bubble-ai'>
                                            ${data.ai_message.message.replace(/\n/g, '<br>')}
                                            <div class='text-[10px] mt-3 text-right font-bold uppercase tracking-wider opacity-40 text-earth-500'>
                                                ${data.ai_message.created_at}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                            const aiDiv = document.createElement('div');
                            aiDiv.innerHTML = aiMsgHTML;
                            container.appendChild(aiDiv.firstElementChild);
                            this.scrollToBottom();
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Gagal mengirim pesan. Silakan coba lagi.');
                    } finally {
                        this.isLoading = false;
                    }
                }
            }" x-init="init()" class="flex-1 flex flex-col overflow-hidden relative">

                <div id="chat-container"
                    class="flex-1 overflow-y-auto p-4 md:p-8 scroll-smooth relative overscroll-contain">
                    <!-- Texture Overlay -->
                    <div class="absolute inset-0 opacity-[0.4] pointer-events-none sticky top-0 h-full w-full"
                        style="background-image: url('https://www.transparenttextures.com/patterns/cream-paper.png'); mix-blend-mode: multiply;">
                    </div>

                    @if($messages->isEmpty())
                        <div
                            class="empty-state h-full flex flex-col items-center justify-center text-center animate-fade-in py-10 px-4">
                            <div
                                class="w-20 h-20 md:w-24 md:h-24 bg-gradient-to-br from-beige-100 to-white rounded-full flex items-center justify-center text-4xl md:text-5xl shadow-sm border border-beige-200 mb-6">
                                👋
                            </div>
                            <h3 class="text-2xl md:text-3xl font-serif text-earth-900 mb-3">Selamat Datang</h3>
                            <p class="text-earth-600 max-w-sm mx-auto leading-relaxed text-sm md:text-base">
                                Ruang ini aman dan didesain untuk mendengarkanmu. Ceritakan apa yang sedang kamu rasakan
                                hari ini.
                            </p>
                        </div>
                    @else
                        @foreach($messages as $msg)
                                    <div
                                        class="flex w-full {{ $msg->is_user ? 'justify-end' : 'justify-start' }} animate-fade-in group relative z-10 mb-6">
                                        <div
                                            class="flex {{ $msg->is_user ? 'items-end' : 'items-start' }} max-w-[85%] md:max-w-[75%] gap-3">

                                            @if(!$msg->is_user)
                                                <div
                                                    class="w-8 h-8 md:w-10 md:h-10 rounded-2xl bg-sage-50 border border-sage-100 flex items-center justify-center text-lg shrink-0 shadow-sm mt-1">
                                                    🌿</div>
                                            @endif

                                            <div class="relative px-5 py-4 shadow-sm text-[15px] leading-relaxed
                                            {{ $msg->is_user
                                                ? 'bg-[#f05e35] text-white rounded-[2rem] rounded-tr-none shadow-orange-200/50'
                                                : 'bg-white text-[#362214] border border-[#d6cec5] rounded-[2rem] rounded-tl-none' }}">

                                        {!! nl2br(e($msg->message)) !!}

                                        <div class="text-[10px] mt-3 text-right font-bold uppercase tracking-wider opacity-50 
                                                    {{ $msg->is_user ? 'text-orange-100' : 'text-[#a38f82]' }}">
                                            {{ $msg->created_at->format('H:i') }}
                                        </div>
                                    </div>        </div>
                                        </div>
                                    </div>
                        @endforeach
                    @endif
                    <!-- Spacer for easy scrolling -->
                    <div class="h-4"></div>
                </div>

                <!-- Input Area (Fixed at bottom of flex container) -->
                <div class="p-4 md:p-6 bg-white/80 border-t border-earth-100 relative z-20 backdrop-blur-md shrink-0">
                    <form @submit.prevent="sendMessage" class="relative group max-w-4xl mx-auto flex items-end gap-3">

                        <div
                            class="flex-1 relative bg-beige-50 rounded-3xl border border-earth-100 focus-within:border-terracotta-300 focus-within:bg-white transition-all duration-300 shadow-inner flex items-center">
                            <input id="messageInput" type="text" x-model="newMessage" :disabled="isLoading"
                                autocomplete="off" required placeholder="Ceritakan harimu..."
                                class="flex-1 bg-transparent border-none focus:ring-0 text-earth-900 placeholder-earth-400 font-medium h-12 md:h-14 px-4 md:px-6 text-base w-full focus:outline-none disabled:opacity-50">
                        </div>

                        <button type="submit" :disabled="isLoading"
                            class="w-12 h-12 md:w-14 md:h-14 bg-earth-900 text-beige-50 rounded-full flex items-center justify-center hover:bg-terracotta-500 transition duration-300 transform active:scale-95 shadow-lg shadow-earth-900/10 flex-shrink-0 disabled:opacity-50 disabled:cursor-not-allowed">
                            <div x-show="!isLoading">
                                <svg class="w-5 h-5 md:w-6 md:h-6 ml-0.5 group-hover:rotate-12 transition" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                            </div>
                            <div x-show="isLoading" class="hidden" :class="{ 'hidden': !isLoading }">
                                <svg class="animate-spin h-5 w-5 md:h-6 md:w-6 text-white"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                            </div>
                        </button>
                    </form>
                    <p class="text-center text-[10px] text-earth-400 mt-3 font-medium opacity-60 hidden md:block">
                        AI dilatih untuk mendukung, namun bukan pengganti pertolongan medis profesional.
                    </p>
                </div>
            </div>

        </div>
    </div>
</x-chat-layout>