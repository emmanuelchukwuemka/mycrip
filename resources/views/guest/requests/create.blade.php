<x-app-layout>
    {{-- Full-page dark hero background --}}
    <div class="min-h-screen relative" style="background:linear-gradient(135deg,#001F3F 0%,#00152B 50%,#001a35 100%);">
        
        {{-- Decorative elements --}}
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-0 right-0 w-[600px] h-[600px] rounded-full opacity-[0.04]" style="background:radial-gradient(circle,#C6A664,transparent)"></div>
            <div class="absolute bottom-0 left-0 w-[400px] h-[400px] rounded-full opacity-[0.03]" style="background:radial-gradient(circle,#C6A664,transparent)"></div>
            <svg class="absolute inset-0 w-full h-full opacity-[0.02]">
                <defs><pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                    <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="0.5"/>
                </pattern></defs>
                <rect width="100%" height="100%" fill="url(#grid)"/>
            </svg>
        </div>

        <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-20">

            {{-- Page Header --}}
            <div class="text-center mb-16">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-xs font-bold uppercase tracking-[.15em] mb-6" style="background:rgba(198,166,100,0.15);color:#C6A664;border:1px solid rgba(198,166,100,0.25);">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    Buyer Wall
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-white mb-6 tracking-tight leading-[1.1]">
                    Post Your Property<br>
                    <span style="color:#C6A664">Request</span>
                </h1>
                <p class="text-lg text-white/40 max-w-xl mx-auto leading-relaxed">
                    Describe your dream property and let our verified agents bring you the perfect match.
                </p>
            </div>

            {{-- Main Form Card --}}
            <div class="bg-white rounded-[2rem] shadow-2xl overflow-hidden">
                <form action="{{ route('requests.store') }}" method="POST">
                    @csrf

                    {{-- SECTION 1: Property Type & Location --}}
                    <div class="p-8 md:p-12 border-b border-gray-100">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0" style="background:linear-gradient(135deg,#001F3F,#003366);">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-[#001F3F]">Property Type & Location</h3>
                                <p class="text-xs text-gray-400">What kind of property are you looking for?</p>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Category (Icon Card Selector) --}}
                            <div x-data="{ selected: '{{ old('category', 'apartment') }}' }">
                                <label class="block text-[11px] font-black text-gray-500 uppercase tracking-[.15em] mb-3 pl-1">Property Category <span class="text-[#C6A664]">*</span></label>
                                <input type="hidden" name="category" :value="selected" required>
                                <div class="grid grid-cols-3 sm:grid-cols-5 gap-2">
                                    <button type="button" @click="selected = 'apartment'" 
                                            :class="selected === 'apartment' ? 'border-[#C6A664] bg-[#C6A664]/5 ring-2 ring-[#C6A664]/20' : 'border-gray-100 bg-gray-50/80 hover:border-gray-200 hover:bg-white'"
                                            class="flex flex-col items-center gap-2 p-3 rounded-xl border-2 cursor-pointer transition-all duration-300">
                                        <svg class="w-6 h-6" :class="selected === 'apartment' ? 'text-[#C6A664]' : 'text-gray-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2 22V6l10-4 10 4v16M6 12h2m-2 4h2m4-4h2m-2 4h2"/></svg>
                                        <span class="text-[10px] font-bold" :class="selected === 'apartment' ? 'text-[#001F3F]' : 'text-gray-400'">Apartment</span>
                                    </button>
                                    <button type="button" @click="selected = 'house'" 
                                            :class="selected === 'house' ? 'border-[#C6A664] bg-[#C6A664]/5 ring-2 ring-[#C6A664]/20' : 'border-gray-100 bg-gray-50/80 hover:border-gray-200 hover:bg-white'"
                                            class="flex flex-col items-center gap-2 p-3 rounded-xl border-2 cursor-pointer transition-all duration-300">
                                        <svg class="w-6 h-6" :class="selected === 'house' ? 'text-[#C6A664]' : 'text-gray-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                        <span class="text-[10px] font-bold" :class="selected === 'house' ? 'text-[#001F3F]' : 'text-gray-400'">House</span>
                                    </button>
                                    <button type="button" @click="selected = 'land'" 
                                            :class="selected === 'land' ? 'border-[#C6A664] bg-[#C6A664]/5 ring-2 ring-[#C6A664]/20' : 'border-gray-100 bg-gray-50/80 hover:border-gray-200 hover:bg-white'"
                                            class="flex flex-col items-center gap-2 p-3 rounded-xl border-2 cursor-pointer transition-all duration-300">
                                        <svg class="w-6 h-6" :class="selected === 'land' ? 'text-[#C6A664]' : 'text-gray-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-6v8.25m.503 3.498l4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 00-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0z"/></svg>
                                        <span class="text-[10px] font-bold" :class="selected === 'land' ? 'text-[#001F3F]' : 'text-gray-400'">Land</span>
                                    </button>
                                    <button type="button" @click="selected = 'shop'" 
                                            :class="selected === 'shop' ? 'border-[#C6A664] bg-[#C6A664]/5 ring-2 ring-[#C6A664]/20' : 'border-gray-100 bg-gray-50/80 hover:border-gray-200 hover:bg-white'"
                                            class="flex flex-col items-center gap-2 p-3 rounded-xl border-2 cursor-pointer transition-all duration-300">
                                        <svg class="w-6 h-6" :class="selected === 'shop' ? 'text-[#C6A664]' : 'text-gray-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.15c0 .415.336.75.75.75z"/></svg>
                                        <span class="text-[10px] font-bold" :class="selected === 'shop' ? 'text-[#001F3F]' : 'text-gray-400'">Shop</span>
                                    </button>
                                    <button type="button" @click="selected = 'warehouse'" 
                                            :class="selected === 'warehouse' ? 'border-[#C6A664] bg-[#C6A664]/5 ring-2 ring-[#C6A664]/20' : 'border-gray-100 bg-gray-50/80 hover:border-gray-200 hover:bg-white'"
                                            class="flex flex-col items-center gap-2 p-3 rounded-xl border-2 cursor-pointer transition-all duration-300">
                                        <svg class="w-6 h-6" :class="selected === 'warehouse' ? 'text-[#C6A664]' : 'text-gray-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205l3 1m1.5.5l-1.5-.5M6.75 7.364V3h-3v18m3-13.636l10.5-3.819"/></svg>
                                        <span class="text-[10px] font-bold" :class="selected === 'warehouse' ? 'text-[#001F3F]' : 'text-gray-400'">Warehouse</span>
                                    </button>
                                </div>
                                @error('category') <p class="text-red-500 text-[10px] font-bold mt-2 pl-1">{{ $message }}</p> @enderror
                            </div>

                            {{-- Location --}}
                            <div>
                                <label class="block text-[11px] font-black text-gray-500 uppercase tracking-[.15em] mb-3 pl-1">Target Location <span class="text-[#C6A664]">*</span></label>
                                <div class="relative group">
                                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-[#C6A664] transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    </div>
                                    <input type="text" name="location" value="{{ old('location') }}" required 
                                           placeholder="e.g. Lekki Phase 1, Victoria Island, Abuja..."
                                           class="w-full pl-12 pr-5 py-4 rounded-xl border-2 border-gray-100 bg-gray-50/80 text-[#001F3F] font-semibold text-[15px] placeholder:text-gray-300 placeholder:font-normal
                                                  focus:bg-white focus:border-[#C6A664] focus:ring-4 focus:ring-[#C6A664]/10 outline-none transition-all duration-300
                                                  hover:border-gray-200 hover:bg-white">
                                </div>
                                @error('location') <p class="text-red-500 text-[10px] font-bold mt-2 pl-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    {{-- SECTION 2: Budget & Rooms --}}
                    <div class="p-8 md:p-12 border-b border-gray-100" style="background:linear-gradient(180deg,#FDFCF9 0%,#fff 100%);">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0" style="background:linear-gradient(135deg,#C6A664,#a8894e);">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-[#001F3F]">Budget & Room Preferences</h3>
                                <p class="text-xs text-gray-400">Optional, but helps agents find better matches.</p>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Price Range --}}
                            <div>
                                <label class="block text-[11px] font-black text-gray-500 uppercase tracking-[.15em] mb-3 pl-1">Budget Range (₦)</label>
                                <div class="flex items-center gap-3">
                                    <div class="relative flex-1 group">
                                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-300 font-bold text-sm group-focus-within:text-[#C6A664] transition-colors">₦</span>
                                        <input type="number" name="min_price" value="{{ old('min_price') }}" placeholder="Minimum"
                                               class="w-full pl-9 pr-4 py-4 rounded-xl border-2 border-gray-100 bg-gray-50/80 text-[#001F3F] font-semibold text-[15px] placeholder:text-gray-300 placeholder:font-normal
                                                      focus:bg-white focus:border-[#C6A664] focus:ring-4 focus:ring-[#C6A664]/10 outline-none transition-all duration-300
                                                      hover:border-gray-200 hover:bg-white">
                                    </div>
                                    <span class="text-gray-300 font-black text-lg">—</span>
                                    <div class="relative flex-1 group">
                                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-300 font-bold text-sm group-focus-within:text-[#C6A664] transition-colors">₦</span>
                                        <input type="number" name="max_price" value="{{ old('max_price') }}" placeholder="Maximum"
                                               class="w-full pl-9 pr-4 py-4 rounded-xl border-2 border-gray-100 bg-gray-50/80 text-[#001F3F] font-semibold text-[15px] placeholder:text-gray-300 placeholder:font-normal
                                                      focus:bg-white focus:border-[#C6A664] focus:ring-4 focus:ring-[#C6A664]/10 outline-none transition-all duration-300
                                                      hover:border-gray-200 hover:bg-white">
                                    </div>
                                </div>
                                @error('min_price') <p class="text-red-500 text-[10px] font-bold mt-2 pl-1">{{ $message }}</p> @enderror
                                @error('max_price') <p class="text-red-500 text-[10px] font-bold mt-2 pl-1">{{ $message }}</p> @enderror
                            </div>

                            {{-- Rooms --}}
                            <div>
                                <label class="block text-[11px] font-black text-gray-500 uppercase tracking-[.15em] mb-3 pl-1">Room Configuration</label>
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="relative group">
                                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-[#C6A664] transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                        </div>
                                        <input type="number" name="bedrooms" value="{{ old('bedrooms') }}" placeholder="Bedrooms"
                                               class="w-full pl-11 pr-4 py-4 rounded-xl border-2 border-gray-100 bg-gray-50/80 text-[#001F3F] font-semibold text-[15px] placeholder:text-gray-300 placeholder:font-normal placeholder:text-[13px]
                                                      focus:bg-white focus:border-[#C6A664] focus:ring-4 focus:ring-[#C6A664]/10 outline-none transition-all duration-300
                                                      hover:border-gray-200 hover:bg-white">
                                    </div>
                                    <div class="relative group">
                                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-[#C6A664] transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        </div>
                                        <input type="number" name="bathrooms" value="{{ old('bathrooms') }}" placeholder="Bathrooms"
                                               class="w-full pl-11 pr-4 py-4 rounded-xl border-2 border-gray-100 bg-gray-50/80 text-[#001F3F] font-semibold text-[15px] placeholder:text-gray-300 placeholder:font-normal placeholder:text-[13px]
                                                      focus:bg-white focus:border-[#C6A664] focus:ring-4 focus:ring-[#C6A664]/10 outline-none transition-all duration-300
                                                      hover:border-gray-200 hover:bg-white">
                                    </div>
                                </div>
                                @error('bedrooms') <p class="text-red-500 text-[10px] font-bold mt-2 pl-1">{{ $message }}</p> @enderror
                                @error('bathrooms') <p class="text-red-500 text-[10px] font-bold mt-2 pl-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    {{-- SECTION 3: Description --}}
                    <div class="p-8 md:p-12 border-b border-gray-100">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0" style="background:linear-gradient(135deg,#001F3F,#003366);">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-[#001F3F]">Describe Your Ideal Property</h3>
                                <p class="text-xs text-gray-400">Be specific — the more detail, the better the match.</p>
                            </div>
                        </div>
                        
                        <div class="relative">
                            <textarea name="description" rows="6" required 
                                      placeholder="Example: I'm looking for a 3-bedroom apartment in Lekki with 24/7 electricity, a swimming pool, gym access, and good road network. Preferably a gated estate with security. Budget is flexible for the right property..."
                                      class="w-full px-6 py-5 rounded-2xl border-2 border-gray-100 bg-gray-50/80 text-[#001F3F] font-medium text-[15px] leading-relaxed placeholder:text-gray-300 placeholder:font-normal placeholder:text-sm placeholder:leading-relaxed
                                             focus:bg-white focus:border-[#C6A664] focus:ring-4 focus:ring-[#C6A664]/10 outline-none transition-all duration-300 resize-none
                                             hover:border-gray-200 hover:bg-white">{{ old('description') }}</textarea>
                            <div class="absolute right-4 bottom-4 flex items-center gap-2">
                                <span class="text-[9px] font-bold text-gray-300 uppercase tracking-wider">Min 20 chars</span>
                            </div>
                        </div>
                        @error('description') <p class="text-red-500 text-[10px] font-bold mt-2 pl-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- SUBMIT SECTION --}}
                    <div class="p-8 md:p-12" style="background:linear-gradient(180deg,#FDFCF9 0%,#F5F3EF 100%);">
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-6">
                            <div class="text-center sm:text-left">
                                <div class="flex items-center gap-3 mb-2">
                                    <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:rgba(198,166,100,0.15);">
                                        <svg class="w-4 h-4 text-[#C6A664]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                    </div>
                                    <span class="text-sm font-bold text-[#001F3F]">Secure & Private</span>
                                </div>
                                <p class="text-xs text-gray-400 max-w-sm">Your details remain hidden. Agents contact you only through our secure chat.</p>
                            </div>

                            <div class="flex flex-col items-center gap-3">
                                <button type="submit" 
                                        class="group relative px-10 py-5 rounded-2xl text-white font-bold text-lg tracking-wide overflow-hidden transition-all duration-500 hover:shadow-2xl hover:-translate-y-1 active:translate-y-0"
                                        style="background:linear-gradient(135deg,#001F3F,#003366);">
                                    {{-- Hover shimmer --}}
                                    <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-700" style="background:linear-gradient(135deg,transparent 30%,rgba(198,166,100,0.3) 50%,transparent 70%);"></div>
                                    <span class="relative flex items-center gap-3">
                                        Publish to Buyer Wall
                                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                                    </span>
                                </button>
                                <a href="{{ route('requests.index') }}" class="text-xs font-semibold text-gray-400 hover:text-[#001F3F] transition-colors duration-200">
                                    ← Browse the Buyer Wall instead
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Trust indicators — visible white cards --}}
            <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-5">
                <div class="flex items-start gap-4 p-6 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/20 shadow-lg">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0 bg-[#C6A664] shadow-md">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-white">Privacy Protected</p>
                        <p class="text-xs text-white/60 mt-1 leading-relaxed">Your contact info stays hidden from the public.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4 p-6 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/20 shadow-lg">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0 bg-[#C6A664] shadow-md">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-white">Verified Agents Only</p>
                        <p class="text-xs text-white/60 mt-1 leading-relaxed">Only approved agents can view and respond.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4 p-6 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/20 shadow-lg">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0 bg-[#C6A664] shadow-md">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-white">Secure Chat</p>
                        <p class="text-xs text-white/60 mt-1 leading-relaxed">All communication through our internal system.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
