<x-app-layout>
    <!-- Professional Clean Hero Section -->
    <div class="bg-white border-b" style="border-color: #C6A664;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center max-w-3xl mx-auto">
                <p class="text-sm font-semibold uppercase tracking-wide mb-4" style="color: #C6A664;">Our Team</p>
                <h1 class="text-4xl md:text-5xl font-bold mb-6" style="color: #001F3F;">
                    Professional Real Estate Agents
                </h1>
                <p class="text-lg leading-relaxed" style="color: #1A1A1A;">
                    Work with experienced, licensed professionals dedicated to helping you achieve your real estate goals with integrity and expertise.
                </p>
            </div>
            
            <!-- Professional Stats Bar -->
            <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8 max-w-4xl mx-auto">
                <div class="text-center">
                    <div class="text-3xl font-bold mb-1" style="color: #001F3F;">{{ $agents->total() }}</div>
                    <div class="text-sm font-medium" style="color: #1A1A1A;">Licensed Agents</div>
                </div>
                <div class="text-center border-x" style="border-color: #C6A664;">
                    <div class="text-3xl font-bold mb-1" style="color: #001F3F;">15+ Years</div>
                    <div class="text-sm font-medium" style="color: #1A1A1A;">Average Experience</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold mb-1" style="color: #001F3F;">98%</div>
                    <div class="text-sm font-medium" style="color: #1A1A1A;">Client Satisfaction</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Agent Grid Section -->
    <div class="py-16" style="background-color: #FFFFFF;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($agents as $agent)
                    <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden border" style="border-color: #C6A664;">
                        <!-- Professional Agent Photo -->
                        <div class="relative h-64" style="background-color: #F5F5F5;">
                            <img 
                                class="w-full h-full object-cover" 
                                src="{{ $agent->agent_image_url ?? 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" 
                                alt="{{ $agent->name }}"
                            >
                            <!-- Subtle Professional Badge -->
                            <div class="absolute top-4 right-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-md text-xs font-medium bg-white shadow-sm border" style="color: #001F3F; border-color: #C6A664;">
                                    <svg class="w-3 h-3 mr-1" style="color: #C6A664;" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    Verified
                                </span>
                            </div>
                        </div>

                        <!-- Agent Information -->
                        <div class="p-6">
                            <!-- Name & Title -->
                            <div class="mb-4">
                                <h3 class="text-xl font-semibold mb-1" style="color: #001F3F;">
                                    {{ $agent->name }}
                                </h3>
                                <p class="text-sm font-medium" style="color: #C6A664;">Licensed Real Estate Agent</p>
                            </div>

                            <!-- Credentials -->
                            <div class="mb-4 pb-4 border-b" style="border-color: #C6A664;">
                                <div class="flex items-center text-sm mb-2" style="color: #1A1A1A;">
                                    <svg class="w-4 h-4 mr-2" style="color: #C6A664;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>License #RE-{{ rand(100000, 999999) }}</span>
                                </div>
                                <div class="flex items-center text-sm" style="color: #1A1A1A;">
                                    <svg class="w-4 h-4 mr-2" style="color: #C6A664;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    <span>{{ rand(8, 15) }}+ Years Experience</span>
                                </div>
                            </div>
                            
                            <!-- Specializations -->
                            <div class="mb-4">
                                <p class="text-xs font-semibold uppercase tracking-wide mb-2" style="color: #C6A664;">Specializations</p>
                                <div class="flex flex-wrap gap-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium" style="background-color: #F5F5F5; color: #001F3F;">
                                        Residential Sales
                                    </span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium" style="background-color: #F5F5F5; color: #001F3F;">
                                        Commercial
                                    </span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium" style="background-color: #F5F5F5; color: #001F3F;">
                                        Investment
                                    </span>
                                </div>
                            </div>

                            <!-- Contact Information -->
                            <div class="space-y-2 mb-4">
                                @if($agent->email)
                                    <a href="mailto:{{ $agent->email }}" class="flex items-center text-sm transition-colors" style="color: #1A1A1A;" onmouseover="this.style.color='#001F3F'" onmouseout="this.style.color='#1A1A1A'">
                                        <svg class="w-4 h-4 mr-2" style="color: #C6A664;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                        <span class="truncate">{{ $agent->email }}</span>
                                    </a>
                                @endif
                                
                                @if($agent->agent_phone)
                                    <a href="tel:{{ $agent->agent_phone }}" class="flex items-center text-sm transition-colors" style="color: #1A1A1A;" onmouseover="this.style.color='#001F3F'" onmouseout="this.style.color='#1A1A1A'">
                                        <svg class="w-4 h-4 mr-2" style="color: #C6A664;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                        <span>{{ $agent->agent_phone }}</span>
                                    </a>
                                @endif
                                
                                @if($agent->agent_whatsapp)
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $agent->agent_whatsapp) }}" target="_blank" class="flex items-center text-sm transition-colors" style="color: #1A1A1A;" onmouseover="this.style.color='#C6A664'" onmouseout="this.style.color='#1A1A1A'">
                                        <svg class="w-4 h-4 mr-2" style="color: #C6A664;" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                        </svg>
                                        <span>{{ $agent->agent_whatsapp }}</span>
                                    </a>
                                @endif
                            </div>

                            <!-- Contact Actions -->
                            <div class="grid grid-cols-3 gap-2">
                                @if($agent->agent_whatsapp)
                                    <a 
                                        href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $agent->agent_whatsapp) }}" 
                                        target="_blank"
                                        class="flex flex-col items-center justify-center px-3 py-2.5 text-white text-xs font-medium rounded-md transition-colors duration-200"
                                        style="background-color: #C6A664;"
                                        onmouseover="this.style.backgroundColor='#B89654'" 
                                        onmouseout="this.style.backgroundColor='#C6A664'"
                                        title="WhatsApp"
                                    >
                                        <svg class="w-5 h-5 mb-1" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                        </svg>
                                        <span>WhatsApp</span>
                                    </a>
                                @endif
                                
                                @if($agent->email)
                                    <a 
                                        href="mailto:{{ $agent->email }}" 
                                        class="flex flex-col items-center justify-center px-3 py-2.5 text-white text-xs font-medium rounded-md transition-colors duration-200"
                                        style="background-color: #001F3F;"
                                        onmouseover="this.style.backgroundColor='#00152B'" 
                                        onmouseout="this.style.backgroundColor='#001F3F'"
                                        title="Email"
                                    >
                                        <svg class="w-5 h-5 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                        <span>Email</span>
                                    </a>
                                @endif
                                
                                @if($agent->agent_phone)
                                    <a 
                                        href="tel:{{ $agent->agent_phone }}" 
                                        class="flex flex-col items-center justify-center px-3 py-2.5 text-white text-xs font-medium rounded-md transition-colors duration-200"
                                        style="background-color: #000000;"
                                        onmouseover="this.style.backgroundColor='#1A1A1A'" 
                                        onmouseout="this.style.backgroundColor='#000000'"
                                        title="Call"
                                    >
                                        <svg class="w-5 h-5 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                        <span>Call</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16">
                        <div class="bg-white rounded-lg p-12 shadow-sm border max-w-2xl mx-auto" style="border-color: #C6A664;">
                            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full mb-6" style="background-color: #F5F5F5;">
                                <svg class="h-8 w-8" style="color: #001F3F;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold mb-2" style="color: #001F3F;">No Agents Currently Available</h3>
                            <p class="mb-6" style="color: #1A1A1A;">Our team of licensed real estate professionals will be listed here soon. Please check back or contact our office for assistance.</p>
                            <div class="flex gap-3 justify-center">
                                <a href="{{ route('home') }}" class="inline-flex items-center px-5 py-2.5 border text-sm font-medium rounded-md transition-colors duration-200" style="color: #001F3F; border-color: #C6A664; background-color: #FFFFFF;" onmouseover="this.style.backgroundColor='#F5F5F5'" onmouseout="this.style.backgroundColor='#FFFFFF'">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                    </svg>
                                    Return Home
                                </a>
                                <a href="#" class="inline-flex items-center px-5 py-2.5 text-sm font-medium rounded-md text-white transition-colors duration-200" style="background-color: #001F3F;" onmouseover="this.style.backgroundColor='#00152B'" onmouseout="this.style.backgroundColor='#001F3F'">
                                    Contact Office
                                </a>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
            
            <!-- Pagination -->
            @if($agents->hasPages())
                <div class="mt-12 flex justify-center">
                    <div class="bg-white rounded-lg shadow-sm border px-4 py-3" style="border-color: #C6A664;">
                        {{ $agents->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Professional CTA Section -->
    <div class="bg-white border-t py-16" style="border-color: #C6A664;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-4" style="color: #001F3F;">Ready to Get Started?</h2>
            <p class="text-lg mb-8 max-w-2xl mx-auto" style="color: #1A1A1A;">
                Connect with one of our professional agents today to discuss your real estate needs.
            </p>
            <div class="flex gap-4 justify-center">
                <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 border text-base font-medium rounded-md transition-colors duration-200" style="color: #001F3F; border-color: #C6A664; background-color: #FFFFFF;" onmouseover="this.style.backgroundColor='#F5F5F5'" onmouseout="this.style.backgroundColor='#FFFFFF'">
                    Browse Properties
                </a>
                <a href="#" class="inline-flex items-center px-6 py-3 text-base font-medium rounded-md text-white transition-colors duration-200" style="background-color: #001F3F;" onmouseover="this.style.backgroundColor='#00152B'" onmouseout="this.style.backgroundColor='#001F3F'">
                    Schedule Consultation
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
