<x-agent-layout>
    <div class="max-w-4xl mx-auto space-y-12 animate-in fade-in slide-in-from-bottom-4 duration-700 pb-20 text-center">
        
        <!-- Header Section -->
        <div class="space-y-6">
            <h1 class="text-5xl font-black text-gray-900 tracking-tighter">How can we help?</h1>
            <p class="text-xl text-gray-500 max-w-2xl mx-auto leading-relaxed">Search our knowledge base or browse the categories below for instant answers.</p>
            
            <div class="relative max-w-xl mx-auto mt-10">
                <input type="text" class="w-full px-8 py-5 rounded-3xl border border-gray-100 shadow-xl focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 transition-all duration-300 outline-none placeholder:text-gray-300 text-lg" placeholder="Search for answers...">
                <div class="absolute inset-y-0 right-8 flex items-center text-gray-400">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
            </div>
        </div>

        <!-- FAQ Content -->
        <div class="space-y-16 text-left">
            @forelse($faqs as $category => $items)
                <div class="space-y-6">
                    <h2 class="text-xs font-black uppercase text-amber-500 tracking-[0.3em] ml-2">{{ $category }}</h2>
                    <div class="grid grid-cols-1 gap-4">
                        @foreach($items as $faq)
                            <div x-data="{ open: false }" class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden transition-all duration-300" :class="open ? 'shadow-xl ring-2 ring-amber-500/10 border-amber-500/20' : ''">
                                <button @click="open = !open" class="w-full p-8 text-left flex items-center justify-between gap-6">
                                    <span class="text-lg font-bold text-gray-900 leading-tight">{{ $faq->question }}</span>
                                    <div class="flex-shrink-0 w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center transition-transform duration-500" :class="open ? 'rotate-180 bg-amber-50 text-amber-500' : 'text-gray-300'">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                    </div>
                                </button>
                                <div x-show="open" x-collapse style="display: none">
                                    <div class="px-8 pb-8 pt-2">
                                        <div class="h-px w-full bg-gray-50 mb-6"></div>
                                        <p class="text-gray-500 leading-relaxed">{{ $faq->answer }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="py-24 text-center">
                    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">No frequently asked questions available</h3>
                    <p class="text-gray-400 text-sm mt-2">Check back soon for more information.</p>
                </div>
            @endforelse
        </div>

        <!-- Contact Support Footer -->
        <div class="bg-gray-50 rounded-[3rem] p-12 border border-gray-100">
            <h2 class="text-2xl font-black text-gray-900 mb-2">Still need help?</h2>
            <p class="text-gray-500 mb-8 font-medium">If you couldn't find your answer, our support team is available 24/7.</p>
            <div class="flex flex-wrap items-center justify-center gap-4">
                <a href="{{ route('support.tickets.create') }}" class="px-10 py-4 bg-[#001F3F] text-white rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-[#002d5c] hover:shadow-xl transition-all duration-300">
                    Contact Specialist
                </a>
                <a href="mailto:support@mycrip.com" class="px-10 py-4 bg-white text-gray-700 border border-gray-100 rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-gray-50 hover:shadow-lg transition-all duration-300">
                    Email Direct
                </a>
            </div>
        </div>

    </div>
</x-agent-layout>
