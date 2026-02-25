<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8 selection:bg-[#C6A664] selection:text-white">
        <div class="max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="text-center mb-16 px-4">
                <h1 class="text-4xl md:text-5xl font-serif font-bold text-gray-900 mb-4">Privacy Policy</h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    At <span class="text-[#C6A664] font-semibold">MyCrib Africa</span>, your privacy is our priority. We are committed to protecting your personal data and being transparent about how we use it.
                </p>
                <div class="mt-8 inline-block">
                    <span class="text-xs font-semibold text-gray-400 uppercase tracking-widest border-b-2 border-[#C6A664] pb-1">
                        Effective Date: {{ date('F d, Y') }}
                    </span>
                </div>
            </div>

            <div class="flex flex-col lg:flex-row gap-12">
                <!-- Navigation Sidebar -->
                <aside class="lg:w-1/4">
                    <div class="sticky top-24 bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                        <h2 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-6">Table of Contents</h2>
                        <nav id="privacy-nav" class="space-y-4">
                            @foreach([
                                ['title' => 'Introduction', 'icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                                ['title' => 'Data Collection', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
                                ['title' => 'Data Usage', 'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'],
                                ['title' => 'Cookies Policy', 'icon' => 'M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z'],
                                ['title' => 'Security', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                                ['title' => 'Contact Us', 'icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z']
                            ] as $index => $item)
                                <a href="#section-{{ $index + 1 }}" class="flex items-center group text-gray-500 hover:text-[#C6A664] transition-colors duration-200">
                                    <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-[#C6A664]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"></path>
                                    </svg>
                                    <span class="text-sm font-medium">{{ $item['title'] }}</span>
                                </a>
                            @endforeach
                        </nav>
                        <div class="mt-10 pt-8 border-t border-gray-100">
                            <p class="text-xs text-gray-400 leading-relaxed">
                                Need a PDF version? <br>
                                <a href="#" class="text-[#C6A664] font-bold hover:underline">Download Documentation</a>
                            </p>
                        </div>
                    </div>
                </aside>

                <!-- Document Main Section -->
                <main class="lg:w-3/4">
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-8 md:p-12 lg:p-16">
                            
                            <!-- Introduction -->
                            <section id="section-1" class="scroll-mt-24 mb-16">
                                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <span class="w-8 h-8 rounded-lg bg-[#C6A664]/10 text-[#C6A664] flex items-center justify-center text-sm mr-4">01</span>
                                    Introduction
                                </h2>
                                <div class="prose prose-gray max-w-none text-gray-600 leading-relaxed space-y-4">
                                    <p>
                                        This Privacy Policy describes how MyCrib Africa (referred to as "we," "us," or "our") collects, uses, and shares your personal information when you visit or make a use of our services at www.mycrib.africa (the "Site").
                                    </p>
                                    <p>
                                        We values the trust you place in us and we are dedicated to protecting your information. By using our services, you agree to the collection and use of information in accordance with this policy.
                                    </p>
                                </div>
                            </section>

                            <!-- Data Collection -->
                            <section id="section-2" class="scroll-mt-24 mb-16">
                                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <span class="w-8 h-8 rounded-lg bg-[#C6A664]/10 text-[#C6A664] flex items-center justify-center text-sm mr-4">02</span>
                                    Information We Collect
                                </h2>
                                <div class="prose prose-gray max-w-none text-gray-600 leading-relaxed">
                                    <p class="mb-6">We collect several different types of information for various purposes to provide and improve our Service to you:</p>
                                    <ul class="space-y-4 list-none p-0">
                                        <li class="flex items-start">
                                            <div class="w-2 h-2 mt-2.5 rounded-full bg-[#C6A664] mr-4 flex-shrink-0"></div>
                                            <div>
                                                <strong class="text-gray-900">Personal Data:</strong> While using our Service, we may ask you to provide us with certain personally identifiable information that can be used to contact or identify you (e.g., email address, first and last name, phone number, address).
                                            </div>
                                        </li>
                                        <li class="flex items-start">
                                            <div class="w-2 h-2 mt-2.5 rounded-full bg-[#C6A664] mr-4 flex-shrink-0"></div>
                                            <div>
                                                <strong class="text-gray-900">Usage Data:</strong> We may also collect information how the Service is accessed and used (e.g., your computer's IP address, browser type, browser version, the pages of our Service that you visit).
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </section>

                            <!-- Data Usage -->
                            <section id="section-3" class="scroll-mt-24 mb-16">
                                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <span class="w-8 h-8 rounded-lg bg-[#C6A664]/10 text-[#C6A664] flex items-center justify-center text-sm mr-4">03</span>
                                    How We Use Your Data
                                </h2>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="p-6 rounded-2xl bg-gray-50 border border-gray-100">
                                        <h3 class="font-bold text-gray-900 mb-2">Service Delivery</h3>
                                        <p class="text-sm text-gray-600">To provide and maintain our Service, including monitoring the usage of our Service.</p>
                                    </div>
                                    <div class="p-6 rounded-2xl bg-gray-50 border border-gray-100">
                                        <h3 class="font-bold text-gray-900 mb-2">Communication</h3>
                                        <p class="text-sm text-gray-600">To contact you by email, telephone calls, SMS, or other equivalent forms of electronic communication.</p>
                                    </div>
                                    <div class="p-6 rounded-2xl bg-gray-50 border border-gray-100">
                                        <h3 class="font-bold text-gray-900 mb-2">Personalization</h3>
                                        <p class="text-sm text-gray-600">To provide you with news, special offers and general information about other goods and services.</p>
                                    </div>
                                    <div class="p-6 rounded-2xl bg-gray-50 border border-gray-100">
                                        <h3 class="font-bold text-gray-900 mb-2">Improvement</h3>
                                        <p class="text-sm text-gray-600">To gather analysis or valuable information so that we can improve our Service.</p>
                                    </div>
                                </div>
                            </section>

                            <!-- Cookies -->
                            <section id="section-4" class="scroll-mt-24 mb-16">
                                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <span class="w-8 h-8 rounded-lg bg-[#C6A664]/10 text-[#C6A664] flex items-center justify-center text-sm mr-4">04</span>
                                    Cookies and Tracking
                                </h2>
                                <div class="prose prose-gray max-w-none text-gray-600 leading-relaxed">
                                    <p>
                                        We use cookies and similar tracking technologies to track the activity on our Service and hold certain information. Cookies are files with small amount of data which may include an anonymous unique identifier. You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent.
                                    </p>
                                </div>
                            </section>

                            <!-- Security -->
                            <section id="section-5" class="scroll-mt-24 mb-16">
                                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <span class="w-8 h-8 rounded-lg bg-[#C6A664]/10 text-[#C6A664] flex items-center justify-center text-sm mr-4">05</span>
                                    Data Security
                                </h2>
                                <div class="bg-[#fdfbf7] border-l-4 border-[#C6A664] p-6 rounded-r-2xl">
                                    <p class="text-gray-700 italic">
                                        "The security of your data is important to us, but remember that no method of transmission over the Internet, or method of electronic storage is 100% secure. While we strive to use commercially acceptable means to protect your Personal Data, we cannot guarantee its absolute security."
                                    </p>
                                </div>
                            </section>

                            <!-- Contact -->
                            <section id="section-6" class="scroll-mt-24">
                                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <span class="w-8 h-8 rounded-lg bg-[#C6A664]/10 text-[#C6A664] flex items-center justify-center text-sm mr-4">06</span>
                                    Contact Us
                                    <div class="ml-auto flex space-x-2">
                                        <div class="w-2 h-2 rounded-full bg-[#C6A664]"></div>
                                        <div class="w-2 h-2 rounded-full bg-[#C6A664]/50"></div>
                                        <div class="w-2 h-2 rounded-full bg-[#C6A664]/20"></div>
                                    </div>
                                </h2>
                                <div class="bg-gray-900 rounded-2xl p-8 text-white relative overflow-hidden">
                                    <div class="relative z-10">
                                        <p class="text-gray-400 mb-6 text-lg">If you have any questions about this Privacy Policy, please contact us:</p>
                                        <div class="space-y-4">
                                            <a href="mailto:privacy@mycrib.africa" class="flex items-center text-[#C6A664] hover:text-[#d4b97a] transition-colors">
                                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                                <span class="font-bold">privacy@mycrib.africa</span>
                                            </a>
                                            <div class="flex items-center text-gray-400">
                                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                                <span>Lagos, Nigeria</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Decorative pattern -->
                                    <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 bg-[#C6A664]/10 rounded-full blur-3xl"></div>
                                </div>
                            </section>

                        </div>
                    </div>
                    
                    <div class="mt-12 text-center text-gray-400 text-sm">
                        <p>&copy; {{ date('Y') }} MyCrib Africa. All rights reserved.</p>
                    </div>
                </main>
            </div>
        </div>
    </div>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Crimson+Pro:ital,wght@0,400;0,700;1,400&family=Inter:wght@400;500;600;700&display=swap');
        
        .font-serif {
            font-family: 'Crimson Pro', serif;
        }
        
        body {
            font-family: 'Inter', sans-serif;
        }

        html {
            scroll-behavior: smooth;
        }

        #privacy-nav a {
            position: relative;
        }

        #privacy-nav a::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -2px;
            width: 0;
            height: 2px;
            background-color: #C6A664;
            transition: width 0.3s ease;
        }

        #privacy-nav a:hover::after {
            width: 100%;
        }

        /* Responsive adjustments */
        @media (max-width: 1024px) {
            .sticky {
                position: relative;
                top: 0;
                margin-bottom: 2rem;
            }
        }
    </style>
</x-app-layout>

