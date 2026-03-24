{{-- ══════════════════════════════════════════════════════════════════════════
     FLOATING AI CHAT ASSISTANT
     A sleek, slide-up chat widget powered by Gemini AI.
     ══════════════════════════════════════════════════════════════════════════ --}}
<div x-data="aiChatWidget()" x-cloak>

    {{-- FLOATING BUTTON --}}
    <button @click="toggleChat()"
            class="fixed bottom-6 right-6 z-50 group"
            :class="open ? 'scale-0 opacity-0 pointer-events-none' : 'scale-100 opacity-100'"
            style="transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);">
        <div class="relative">
            {{-- Pulse ring --}}
            <div class="absolute inset-0 rounded-2xl animate-ping opacity-20" style="background:#C6A664;animation-duration:2s;"></div>
            {{-- Button --}}
            <div class="relative w-16 h-16 rounded-2xl flex items-center justify-center shadow-2xl transition-all duration-300 group-hover:shadow-[0_8px_30px_rgba(198,166,100,0.4)] group-hover:-translate-y-1 group-hover:scale-105"
                 style="background:linear-gradient(135deg,#001F3F,#003366);">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.455 2.456L21.75 6l-1.036.259a3.375 3.375 0 00-2.455 2.456z"/>
                </svg>
                {{-- Gold accent dot --}}
                <div class="absolute -top-1 -right-1 w-4 h-4 rounded-full flex items-center justify-center text-[8px] font-black text-white" style="background:#C6A664;">AI</div>
            </div>
        </div>
    </button>

    {{-- CHAT PANEL --}}
    <div class="fixed bottom-6 right-6 z-50 w-[380px] max-w-[calc(100vw-2rem)]"
         x-show="open"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-8 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 translate-y-8 scale-95"
         style="display:none;">

        <div class="rounded-3xl overflow-hidden shadow-[0_25px_60px_rgba(0,0,0,0.3)] border border-white/10 flex flex-col" style="height:520px;">

            {{-- Header --}}
            <div class="relative px-5 py-4 flex items-center justify-between flex-shrink-0" style="background:linear-gradient(135deg,#001F3F,#003366);">
                <div class="absolute inset-0 opacity-10" style="background:radial-gradient(circle at 20% 50%,#C6A664,transparent 60%);"></div>
                <div class="relative flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background:rgba(198,166,100,0.2);border:1px solid rgba(198,166,100,0.3);">
                        <svg class="w-5 h-5" style="color:#C6A664" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-white leading-none">MyCrib AI</h4>
                        <p class="text-[10px] mt-0.5 font-semibold" style="color:#C6A664;">Property Assistant</p>
                    </div>
                </div>
                <button @click="toggleChat()" class="relative w-8 h-8 rounded-lg flex items-center justify-center text-white/50 hover:text-white hover:bg-white/10 transition-all">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
                </button>
            </div>

            {{-- Messages Area --}}
            <div class="flex-1 overflow-y-auto px-4 py-4 space-y-4 bg-[#F8F7F4]" x-ref="chatMessages" id="aiChatMessages">
                {{-- Welcome message --}}
                <template x-if="messages.length === 0">
                    <div class="space-y-4">
                        <div class="flex gap-2.5">
                            <div class="w-7 h-7 rounded-lg flex-shrink-0 flex items-center justify-center" style="background:linear-gradient(135deg,#001F3F,#003366);">
                                <svg class="w-3.5 h-3.5" style="color:#C6A664" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z"/></svg>
                            </div>
                            <div class="bg-white rounded-2xl rounded-tl-md px-4 py-3 shadow-sm border border-gray-100 max-w-[85%]">
                                <p class="text-sm text-gray-700 leading-relaxed">Hi! 👋 I'm <strong>MyCrib AI</strong>, your real estate assistant. I can help you:</p>
                                <ul class="mt-2 space-y-1.5 text-xs text-gray-500">
                                    <li class="flex items-center gap-2">
                                        <span class="w-1 h-1 rounded-full bg-[#C6A664] flex-shrink-0"></span>
                                        Find properties in any location
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span class="w-1 h-1 rounded-full bg-[#C6A664] flex-shrink-0"></span>
                                        Understand pricing & neighborhoods
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span class="w-1 h-1 rounded-full bg-[#C6A664] flex-shrink-0"></span>
                                        Navigate the MyCrib platform
                                    </li>
                                </ul>
                            </div>
                        </div>
                        {{-- Quick prompts --}}
                        <div class="flex flex-wrap gap-2 pl-9">
                            <button @click="sendQuickPrompt('What areas in Lagos are best for renting?')" class="text-[11px] font-semibold px-3 py-1.5 rounded-full border border-gray-200 bg-white text-gray-600 hover:border-[#C6A664] hover:text-[#C6A664] transition-all">
                                🏙️ Best areas in Lagos?
                            </button>
                            <button @click="sendQuickPrompt('How do I post a property request on the Buyer Wall?')" class="text-[11px] font-semibold px-3 py-1.5 rounded-full border border-gray-200 bg-white text-gray-600 hover:border-[#C6A664] hover:text-[#C6A664] transition-all">
                                📋 How to use Buyer Wall?
                            </button>
                            <button @click="sendQuickPrompt('What should I look for when renting an apartment in Nigeria?')" class="text-[11px] font-semibold px-3 py-1.5 rounded-full border border-gray-200 bg-white text-gray-600 hover:border-[#C6A664] hover:text-[#C6A664] transition-all">
                                💡 Renting tips
                            </button>
                        </div>
                    </div>
                </template>

                {{-- Chat messages --}}
                <template x-for="(msg, idx) in messages" :key="idx">
                    <div :class="msg.role === 'user' ? 'flex justify-end' : 'flex gap-2.5'">
                        {{-- AI avatar (only for AI messages) --}}
                        <template x-if="msg.role === 'assistant'">
                            <div class="w-7 h-7 rounded-lg flex-shrink-0 flex items-center justify-center mt-0.5" style="background:linear-gradient(135deg,#001F3F,#003366);">
                                <svg class="w-3.5 h-3.5" style="color:#C6A664" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z"/></svg>
                            </div>
                        </template>
                        <div :class="msg.role === 'user'
                            ? 'bg-[#001F3F] text-white rounded-2xl rounded-tr-md px-4 py-3 max-w-[80%] shadow-sm'
                            : 'bg-white rounded-2xl rounded-tl-md px-4 py-3 shadow-sm border border-gray-100 max-w-[85%]'">
                            <p class="text-sm leading-relaxed whitespace-pre-wrap" :class="msg.role === 'user' ? 'text-white/90' : 'text-gray-700'" x-text="msg.content"></p>
                        </div>
                    </div>
                </template>

                {{-- Typing indicator --}}
                <div x-show="loading" class="flex gap-2.5">
                    <div class="w-7 h-7 rounded-lg flex-shrink-0 flex items-center justify-center" style="background:linear-gradient(135deg,#001F3F,#003366);">
                        <svg class="w-3.5 h-3.5" style="color:#C6A664" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z"/></svg>
                    </div>
                    <div class="bg-white rounded-2xl rounded-tl-md px-4 py-3 shadow-sm border border-gray-100">
                        <div class="flex items-center gap-1.5">
                            <div class="w-2 h-2 rounded-full bg-gray-300 animate-bounce" style="animation-delay:0ms"></div>
                            <div class="w-2 h-2 rounded-full bg-gray-300 animate-bounce" style="animation-delay:150ms"></div>
                            <div class="w-2 h-2 rounded-full bg-gray-300 animate-bounce" style="animation-delay:300ms"></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Input Area --}}
            <div class="flex-shrink-0 p-3 bg-white border-t border-gray-100">
                <form @submit.prevent="sendMessage()" class="flex items-center gap-2">
                    <div class="flex-1 relative">
                        <input x-model="input" x-ref="chatInput"
                               type="text" 
                               placeholder="Ask me anything about properties..."
                               :disabled="loading"
                               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-100 text-sm text-gray-800 placeholder:text-gray-400
                                      focus:bg-white focus:border-[#C6A664] focus:ring-2 focus:ring-[#C6A664]/10 outline-none transition-all duration-200"
                               autocomplete="off">
                    </div>
                    <button type="submit" 
                            :disabled="!input.trim() || loading"
                            class="w-11 h-11 rounded-xl flex items-center justify-center transition-all duration-300 flex-shrink-0"
                            :class="input.trim() && !loading 
                                ? 'text-white shadow-lg hover:-translate-y-0.5' 
                                : 'bg-gray-100 text-gray-300 cursor-not-allowed'"
                            :style="input.trim() && !loading ? 'background:linear-gradient(135deg,#001F3F,#003366)' : ''">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"/>
                        </svg>
                    </button>
                </form>
                <p class="text-center text-[9px] text-gray-300 mt-2 font-medium">Powered by AI · May produce inaccurate info</p>
            </div>
        </div>
    </div>
</div>

<script>
function aiChatWidget() {
    return {
        open: false,
        input: '',
        loading: false,
        messages: [],

        toggleChat() {
            this.open = !this.open;
            if (this.open) {
                this.$nextTick(() => {
                    this.$refs.chatInput?.focus();
                    this.scrollToBottom();
                });
            }
        },

        sendQuickPrompt(text) {
            this.input = text;
            this.sendMessage();
        },

        async sendMessage() {
            const text = this.input.trim();
            if (!text || this.loading) return;

            // Add user message
            this.messages.push({ role: 'user', content: text });
            this.input = '';
            this.loading = true;
            this.$nextTick(() => this.scrollToBottom());

            try {
                const response = await fetch('{{ route("ai.chat") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        message: text,
                        history: this.messages.slice(0, -1).map(m => ({
                            role: m.role === 'user' ? 'user' : 'assistant',
                            content: m.content,
                        })),
                    }),
                });

                const data = await response.json();
                this.messages.push({ role: 'assistant', content: data.reply });
            } catch (err) {
                this.messages.push({ role: 'assistant', content: 'Sorry, I\'m having trouble connecting. Please try again.' });
            } finally {
                this.loading = false;
                this.$nextTick(() => {
                    this.scrollToBottom();
                    this.$refs.chatInput?.focus();
                });
            }
        },

        scrollToBottom() {
            const el = this.$refs.chatMessages;
            if (el) el.scrollTop = el.scrollHeight;
        }
    };
}
</script>

<style>
[x-cloak] { display: none !important; }
</style>
