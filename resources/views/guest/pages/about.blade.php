<x-app-layout title="About Us & How it Works | Villa Africa">
    <!-- Hero Section -->
    <div class="relative py-32 bg-[#A85C2E] text-white overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0 bg-[#A85C2E]">
            <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?ixlib=rb-4.0.3&auto=format&fit=crop&w=2075&q=80" alt="About Villa Africa" class="w-full h-full object-cover">
        </div>
        <!-- Navy Overlay -->
        <div class="absolute inset-0 z-0 bg-[#A85C2E] opacity-50 mix-blend-multiply"></div>
        
        <div class="absolute inset-0 opacity-20 z-0">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 40px 40px;"></div>
        </div>
        
        <div class="container mx-auto px-6 relative z-10 text-center">
            
            <!-- Breadcrumb Navigation -->
            <nav class="flex justify-center mb-8" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2 text-sm">
                    <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-white transition-colors">Home</a></li>
                    <li><span class="text-gray-500">/</span></li>
                    <li class="text-[#2B1810] font-semibold">About Us</li>
                </ol>
            </nav>

            <h1 class="text-5xl md:text-6xl font-black mb-6 tracking-tight">
                Redefining Real Estate <br>
                <span id="typing-text-about" style="color: #2B1810;" class="after:content-['|'] after:animate-ping after:text-[#2B1810] after:ml-1"></span>
            </h1>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const texts = ['with Intelligence', 'with Transparency', 'with Security', 'with Speed'];
                    const el = document.getElementById('typing-text-about');
                    let textIndex = 0;
                    let charIndex = 0;
                    let isTyping = true;
                    
                    function type() {
                        if (!el) return;
                        if (isTyping) {
                            if (charIndex < texts[textIndex].length) {
                                el.textContent += texts[textIndex].charAt(charIndex);
                                charIndex++;
                                setTimeout(type, 100);
                            } else {
                                isTyping = false;
                                setTimeout(type, 2000);
                            }
                        } else {
                            if (charIndex > 0) {
                                el.textContent = el.textContent.substring(0, el.textContent.length - 1);
                                charIndex--;
                                setTimeout(type, 50);
                            } else {
                                isTyping = true;
                                textIndex = (textIndex + 1) % texts.length;
                                setTimeout(type, 500);
                            }
                        }
                    }
                    type();
                });
            </script>
            <p class="text-xl text-gray-300 max-w-2xl mx-auto leading-relaxed">
                Villa Africa isn't just a property listing site. It's a secure, modern ecosystem designed to bring transparency and speed to the Nigerian real estate market.
            </p>
        </div>
    </div>

    <!-- Mission & Vision Section -->
    <div class="py-24 bg-gray-50 border-b border-gray-100">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
                <!-- Mission -->
                <div class="bg-white p-12 rounded-[2.5rem] shadow-xl border-t-4 border-[#A85C2E] transform hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-16 h-16 bg-[#A85C2E]/5 text-[#A85C2E] rounded-2xl flex items-center justify-center mb-8">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <h2 class="text-3xl font-black text-[#A85C2E] mb-6">Our Mission</h2>
                    <p class="text-gray-600 leading-relaxed text-lg">
                        To simplify and secure the real estate journey in Africa by leveraging cutting-edge technology, ensuring every property transaction is transparent, efficient, and free from fraud.
                    </p>
                </div>

                <!-- Vision -->
                <div class="bg-white p-12 rounded-[2.5rem] shadow-xl border-t-4 border-[#2B1810] transform hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-16 h-16 bg-[#2B1810]/10 text-[#2B1810] rounded-2xl flex items-center justify-center mb-8">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                    </div>
                    <h2 class="text-3xl font-black text-[#A85C2E] mb-6">Our Vision</h2>
                    <p class="text-gray-600 leading-relaxed text-lg">
                        To become the most trusted and innovative digital real estate marketplace across the continent, empowering buyers, renters, and professional agents to connect with absolute confidence.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Core Qualities Section -->
    <div class="py-24 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-black text-[#A85C2E] mb-4 uppercase tracking-tight">Why Choose Villa Africa?</h2>
                <div class="w-24 h-1.5 bg-[#2B1810] mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Quality 1: AI Fraud Detection -->
                <div class="p-8 bg-gray-50 rounded-3xl border border-gray-100 hover:shadow-xl transition-all group">
                    <div class="w-16 h-16 bg-red-100 text-red-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#A85C2E] mb-4">Smart Fraud Detection</h3>
                    <p class="text-gray-600 leading-relaxed text-sm">
                        Our proprietary AI algorithms scan listings for suspicious prices, duplicate photos, and scam-related keywords before they go live.
                    </p>
                </div>

                <!-- Quality 2: PWA / Mobile First -->
                <div class="p-8 bg-gray-50 rounded-3xl border border-gray-100 hover:shadow-xl transition-all group">
                    <div class="w-16 h-16 bg-indigo-100 text-indigo-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#A85C2E] mb-4">Mobile & Offline Ready</h3>
                    <p class="text-gray-600 leading-relaxed text-sm">
                        Install Villa Africa on your phone! Our PWA technology means you can browse properties offline and receive instant push notifications.
                    </p>
                </div>

                <!-- Quality 3: Verified Agents -->
                <div class="p-8 bg-gray-50 rounded-3xl border border-gray-100 hover:shadow-xl transition-all group">
                    <div class="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#A85C2E] mb-4">Verified Professionals</h3>
                    <p class="text-gray-600 leading-relaxed text-sm">
                        We don't just let anyone post. Agents must go through a verification process to ensure you're dealing with real professionals.
                    </p>
                </div>

                <!-- Quality 4: Transparent Market -->
                <div class="p-8 bg-gray-50 rounded-3xl border border-gray-100 hover:shadow-xl transition-all group">
                    <div class="w-16 h-16 bg-amber-100 text-amber-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#A85C2E] mb-4">Real-Time Insights</h3>
                    <p class="text-gray-600 leading-relaxed text-sm">
                        Transparency is key. We provide real-time market analytics and price indices to help you make the best investment decisions.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- How to Use Section -->
    <div class="py-24 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-black text-[#A85C2E] mb-4 uppercase tracking-tight">How It Works</h2>
                <p class="text-gray-500 font-medium">Getting started with Villa Africa is simple.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                <!-- For Buyers -->
                <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-gray-100">
                    <div class="flex items-center mb-8">
                        <div class="w-12 h-12 bg-[#2B1810] text-white rounded-2xl flex items-center justify-center mr-4 shadow-lg shadow-gold-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        </div>
                        <h3 class="text-2xl font-black text-[#A85C2E]">For House Hunters</h3>
                    </div>

                    <div class="space-y-8">
                        <div class="flex items-start">
                            <span class="w-8 h-8 rounded-xl bg-gray-100 text-[#A85C2E] font-black flex items-center justify-center shrink-0 mr-4">1</span>
                            <div>
                                <h4 class="font-bold text-[#A85C2E]">Browse & Filter</h4>
                                <p class="text-gray-500 text-sm mt-1">Search through thousands of listings with our smart filters to find your perfect home.</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <span class="w-8 h-8 rounded-xl bg-gray-100 text-[#A85C2E] font-black flex items-center justify-center shrink-0 mr-4">2</span>
                            <div>
                                <h4 class="font-bold text-[#A85C2E]">Check Fraud Flags</h4>
                                <p class="text-gray-500 text-sm mt-1">Our system flags suspicious listings automatically, helping you avoid scams immediately.</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <span class="w-8 h-8 rounded-xl bg-gray-100 text-[#A85C2E] font-black flex items-center justify-center shrink-0 mr-4">3</span>
                            <div>
                                <h4 class="font-bold text-[#A85C2E]">Connect Safely</h4>
                                <p class="text-gray-500 text-sm mt-1">Use our internal messaging system to chat with verified agents without exposing your private info.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- For Agents -->
                <div class="bg-[#A85C2E] p-10 rounded-[3rem] shadow-xl text-white">
                    <div class="flex items-center mb-8">
                        <div class="w-12 h-12 bg-white/10 backdrop-blur rounded-2xl flex items-center justify-center mr-4 border border-white/20">
                            <svg class="w-6 h-6 text-[#2B1810]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <h3 class="text-2xl font-black">For Real Estate Agents</h3>
                    </div>

                    <div class="space-y-8">
                        <div class="flex items-start">
                            <span class="w-8 h-8 rounded-xl bg-white/10 text-[#2B1810] font-black flex items-center justify-center shrink-0 mr-4 border border-white/20">1</span>
                            <div>
                                <h4 class="font-bold">Register & Verify</h4>
                                <p class="text-white/60 text-sm mt-1">Create your agent profile and upload your credentials to earn the 'Verified' trust badge.</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <span class="w-8 h-8 rounded-xl bg-white/10 text-[#2B1810] font-black flex items-center justify-center shrink-0 mr-4 border border-white/20">2</span>
                            <div>
                                <h4 class="font-bold">List with Confidence</h4>
                                <p class="text-white/60 text-sm mt-1">Upload properties and use our AI tools to generate professional descriptions in seconds.</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <span class="w-8 h-8 rounded-xl bg-white/10 text-[#2B1810] font-black flex items-center justify-center shrink-0 mr-4 border border-white/20">3</span>
                            <div>
                                <h4 class="font-bold">Track Your Success</h4>
                                <p class="text-white/60 text-sm mt-1">Access advanced analytics to see how many people are viewing and saving your properties.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Section -->
    <div class="py-20 bg-[#A85C2E] text-white overflow-hidden relative border-t-4 border-[#2B1810]">
        <div class="absolute inset-0 opacity-5">
            <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                <defs><pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="1"/></pattern></defs>
                <rect width="100%" height="100%" fill="url(#grid)" />
            </svg>
        </div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center divide-x divide-white/10">
                <div class="px-4">
                    <span class="block text-4xl md:text-5xl font-black text-[#2B1810] mb-2">{{ number_format($activePropertiesCount) }}+</span>
                    <span class="text-gray-300 font-medium uppercase tracking-wider text-sm">Active Properties</span>
                </div>
                <div class="px-4">
                    <span class="block text-4xl md:text-5xl font-black text-[#2B1810] mb-2">{{ number_format($verifiedAgentsCount) }}+</span>
                    <span class="text-gray-300 font-medium uppercase tracking-wider text-sm">Verified Agents</span>
                </div>
                <div class="px-4">
                    <span class="block text-4xl md:text-5xl font-black text-[#2B1810] mb-2">Zero</span>
                    <span class="text-gray-300 font-medium uppercase tracking-wider text-sm">Tolerance for Fraud</span>
                </div>
                <div class="px-4">
                    <span class="block text-4xl md:text-5xl font-black text-[#2B1810] mb-2">24/7</span>
                    <span class="text-gray-300 font-medium uppercase tracking-wider text-sm">Platform Access</span>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="py-24 bg-white text-center">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-black text-[#A85C2E] mb-8">Ready to find your dream home?</h2>
            <div class="flex flex-col sm:flex-row justify-center items-center space-y-4 sm:space-y-0 sm:space-x-6">
                <a href="{{ route('properties.index') }}" class="px-10 py-4 bg-[#A85C2E] text-white font-bold rounded-2xl hover:bg-[#002b56] transition-all shadow-xl shadow-blue-900/20">Explore Listings</a>
                <a href="{{ route('register') }}" class="px-10 py-4 border-2 border-[#A85C2E] text-[#A85C2E] font-bold rounded-2xl hover:bg-gray-50 transition-all">Join as an Agent</a>
            </div>
        </div>
    </div>
</x-app-layout>
