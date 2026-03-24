<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8 selection:bg-[#C6A664] selection:text-white">
        <div class="max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="text-center mb-16 px-4">
                <h1 class="text-4xl md:text-5xl font-serif font-bold text-gray-900 mb-4">Privacy Policy & Terms of Service</h1>
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
                        <nav id="privacy-nav" class="space-y-3">
                            @foreach([
                                ['title' => 'Acceptance of Terms',           'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                                ['title' => 'Eligibility & Accounts',        'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
                                ['title' => 'Permitted Platform Use',         'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
                                ['title' => 'Property Listings',             'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
                                ['title' => 'Payments & Fees',               'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                                ['title' => 'Intellectual Property',          'icon' => 'M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4'],
                                ['title' => 'Data Collection & Usage',       'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'],
                                ['title' => 'Cookies & Tracking',            'icon' => 'M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z'],
                                ['title' => 'Disclaimers & Liability',       'icon' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z'],
                                ['title' => 'Third-Party Services',          'icon' => 'M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1'],
                                ['title' => 'Data Security',                 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                                ['title' => 'Termination',                   'icon' => 'M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636'],
                                ['title' => 'Governing Law & Disputes',      'icon' => 'M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3'],
                                ['title' => 'Your Rights',                   'icon' => 'M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z'],
                                ['title' => 'Contact Us',                    'icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
                            ] as $index => $item)
                                <a href="#section-{{ $index + 1 }}" class="flex items-center group text-gray-500 hover:text-[#C6A664] transition-colors duration-200">
                                    <span class="w-5 h-5 rounded text-[9px] font-black flex items-center justify-center mr-3 bg-gray-100 text-gray-400 group-hover:bg-[#C6A664]/10 group-hover:text-[#C6A664] transition-all">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                    <span class="text-[12px] font-semibold">{{ $item['title'] }}</span>
                                </a>
                            @endforeach
                        </nav>
                    </div>
                </aside>

                <!-- Document Main Section -->
                <main class="lg:w-3/4">
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-8 md:p-12 lg:p-16">
                            
                            <!-- 01: Acceptance of Terms -->
                            <section id="section-1" class="scroll-mt-24 mb-16">
                                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <span class="w-8 h-8 rounded-lg bg-[#C6A664]/10 text-[#C6A664] flex items-center justify-center text-sm mr-4">01</span>
                                    Acceptance of Terms
                                </h2>
                                <div class="prose prose-gray max-w-none text-gray-600 leading-relaxed space-y-4">
                                    <p>By accessing, browsing, or using the MyCrib Africa platform (the "Platform"), including the website at <strong>www.mycrib.africa</strong> and the MyCrib mobile application, you acknowledge that you have read, understood, and agree to be bound by these Terms of Service and our Privacy Policy.</p>
                                    <p>If you do not agree with any part of these terms, you must discontinue use of the Platform immediately. We reserve the right to modify these terms at any time. Continued use of the Platform after changes constitutes acceptance of the updated terms.</p>
                                    <div class="bg-amber-50 border border-amber-100 rounded-2xl p-5 mt-4">
                                        <p class="text-sm text-amber-800 flex items-start gap-3">
                                            <svg class="w-5 h-5 text-amber-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            <span>These Terms constitute a legally binding agreement between you and MyCrib Africa. Please review them carefully before using our services.</span>
                                        </p>
                                    </div>
                                </div>
                            </section>

                            <!-- 02: Eligibility & Accounts -->
                            <section id="section-2" class="scroll-mt-24 mb-16">
                                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <span class="w-8 h-8 rounded-lg bg-[#C6A664]/10 text-[#C6A664] flex items-center justify-center text-sm mr-4">02</span>
                                    Eligibility & Accounts
                                </h2>
                                <div class="prose prose-gray max-w-none text-gray-600 leading-relaxed space-y-4">
                                    <p>To create an account on MyCrib Africa, you must:</p>
                                    <ul class="space-y-3 list-none p-0">
                                        @foreach([
                                            'Be at least 18 years of age or the age of legal majority in your jurisdiction.',
                                            'Provide accurate, current, and complete information during registration.',
                                            'Maintain and promptly update your account information to keep it accurate.',
                                            'Be responsible for safeguarding your password and for all activities under your account.',
                                            'Notify us immediately of any unauthorized use of your account.',
                                        ] as $item)
                                        <li class="flex items-start">
                                            <div class="w-2 h-2 mt-2.5 rounded-full bg-[#C6A664] mr-4 flex-shrink-0"></div>
                                            <span>{{ $item }}</span>
                                        </li>
                                        @endforeach
                                    </ul>
                                    <p>We reserve the right to suspend or terminate accounts that violate these terms, provide false information, or engage in fraudulent activity.</p>
                                </div>
                            </section>

                            <!-- 03: Permitted Platform Use -->
                            <section id="section-3" class="scroll-mt-24 mb-16">
                                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <span class="w-8 h-8 rounded-lg bg-[#C6A664]/10 text-[#C6A664] flex items-center justify-center text-sm mr-4">03</span>
                                    Permitted Platform Use
                                </h2>
                                <div class="prose prose-gray max-w-none text-gray-600 leading-relaxed space-y-4">
                                    <p>MyCrib Africa grants you a limited, non-exclusive, non-transferable, and revocable license to access and use the Platform for its intended purposes. You agree <strong>not</strong> to:</p>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                        @foreach([
                                            'Use the Platform for any unlawful purpose or in violation of any applicable law.',
                                            'Scrape, crawl, or harvest data from the Platform without written consent.',
                                            'Impersonate any person or entity, or misrepresent your affiliation.',
                                            'Upload, transmit, or distribute malicious code, viruses, or harmful material.',
                                            'Interfere with or disrupt the integrity or performance of the Platform.',
                                            'Attempt to gain unauthorized access to the Platform or its related systems.',
                                            'Post false, misleading, or fraudulent property listings.',
                                            'Use automated systems (bots) to access the Platform without permission.',
                                        ] as $item)
                                        <div class="flex items-start gap-3 p-4 rounded-xl bg-red-50/50 border border-red-100/50">
                                            <svg class="w-4 h-4 text-red-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                            <span class="text-xs text-gray-600">{{ $item }}</span>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </section>

                            <!-- 04: Property Listings -->
                            <section id="section-4" class="scroll-mt-24 mb-16">
                                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <span class="w-8 h-8 rounded-lg bg-[#C6A664]/10 text-[#C6A664] flex items-center justify-center text-sm mr-4">04</span>
                                    Property Listings
                                </h2>
                                <div class="prose prose-gray max-w-none text-gray-600 leading-relaxed space-y-4">
                                    <p>Agents and property owners who list properties on MyCrib Africa are responsible for:</p>
                                    <ul class="space-y-3 list-none p-0">
                                        @foreach([
                                            'Ensuring all listing information is accurate, complete, and up-to-date, including pricing, location, images, and property features.',
                                            'Having the legal right and authorization to list the property for sale or rent.',
                                            'Removing or updating listings promptly once a property is no longer available.',
                                            'Complying with all applicable real estate laws and regulations in Nigeria.',
                                            'MyCrib Africa does not guarantee the accuracy of any listing and is not a party to any transaction between buyers, renters, and agents.',
                                        ] as $item)
                                        <li class="flex items-start">
                                            <div class="w-2 h-2 mt-2.5 rounded-full bg-[#C6A664] mr-4 flex-shrink-0"></div>
                                            <span>{{ $item }}</span>
                                        </li>
                                        @endforeach
                                    </ul>
                                    <p>We reserve the right to remove any listing that violates our guidelines or is reported as fraudulent, without prior notice.</p>
                                </div>
                            </section>

                            <!-- 05: Payments & Fees -->
                            <section id="section-5" class="scroll-mt-24 mb-16">
                                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <span class="w-8 h-8 rounded-lg bg-[#C6A664]/10 text-[#C6A664] flex items-center justify-center text-sm mr-4">05</span>
                                    Payments & Fees
                                </h2>
                                <div class="prose prose-gray max-w-none text-gray-600 leading-relaxed space-y-4">
                                    <p>Certain services on MyCrib Africa may require payment, including but not limited to:</p>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                                        <div class="p-6 rounded-2xl bg-gray-50 border border-gray-100">
                                            <h3 class="font-bold text-gray-900 mb-2">Agent Subscriptions</h3>
                                            <p class="text-sm text-gray-600">Monthly or annual plans for agents to access premium listing tools, analytics, and enhanced visibility.</p>
                                        </div>
                                        <div class="p-6 rounded-2xl bg-gray-50 border border-gray-100">
                                            <h3 class="font-bold text-gray-900 mb-2">Listing Promotions</h3>
                                            <p class="text-sm text-gray-600">One-time fees to boost or feature a property listing in search results and the homepage.</p>
                                        </div>
                                        <div class="p-6 rounded-2xl bg-gray-50 border border-gray-100">
                                            <h3 class="font-bold text-gray-900 mb-2">Verification Services</h3>
                                            <p class="text-sm text-gray-600">Land title and document verification services provided through trusted third-party partners.</p>
                                        </div>
                                        <div class="p-6 rounded-2xl bg-gray-50 border border-gray-100">
                                            <h3 class="font-bold text-gray-900 mb-2">Refund Policy</h3>
                                            <p class="text-sm text-gray-600">All payments are processed via Paystack. Refunds are subject to our review and may take 5–10 business days.</p>
                                        </div>
                                    </div>
                                    <p class="mt-4">All fees are displayed in Nigerian Naira (₦) and are inclusive of applicable taxes unless otherwise stated. MyCrib Africa is not responsible for bank charges, currency conversion fees, or transaction failures outside our control.</p>
                                </div>
                            </section>

                            <!-- 06: Intellectual Property -->
                            <section id="section-6" class="scroll-mt-24 mb-16">
                                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <span class="w-8 h-8 rounded-lg bg-[#C6A664]/10 text-[#C6A664] flex items-center justify-center text-sm mr-4">06</span>
                                    Intellectual Property
                                </h2>
                                <div class="prose prose-gray max-w-none text-gray-600 leading-relaxed space-y-4">
                                    <p>All content on the MyCrib Africa Platform — including but not limited to text, graphics, logos, icons, images, software, the MyCrib brand, and the underlying code — is the exclusive property of MyCrib Africa or its content suppliers and is protected by Nigerian and international intellectual property laws.</p>
                                    <p>By uploading content (such as listing photos or descriptions), you grant MyCrib Africa a non-exclusive, worldwide, royalty-free license to use, display, reproduce, and distribute such content solely for the purpose of operating and promoting the Platform.</p>
                                    <p>You retain ownership of your original content but agree not to upload content that infringes upon the intellectual property rights of others.</p>
                                </div>
                            </section>

                            <!-- 07: Data Collection & Usage -->
                            <section id="section-7" class="scroll-mt-24 mb-16">
                                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <span class="w-8 h-8 rounded-lg bg-[#C6A664]/10 text-[#C6A664] flex items-center justify-center text-sm mr-4">07</span>
                                    Data Collection & Usage
                                </h2>
                                <div class="prose prose-gray max-w-none text-gray-600 leading-relaxed">
                                    <p class="mb-6">We collect several types of information for various purposes to provide and improve our Service to you:</p>
                                    <ul class="space-y-4 list-none p-0">
                                        <li class="flex items-start">
                                            <div class="w-2 h-2 mt-2.5 rounded-full bg-[#C6A664] mr-4 flex-shrink-0"></div>
                                            <div>
                                                <strong class="text-gray-900">Personal Data:</strong> Email address, full name, phone number, address, profile photos, and government-issued IDs (for agent verification).
                                            </div>
                                        </li>
                                        <li class="flex items-start">
                                            <div class="w-2 h-2 mt-2.5 rounded-full bg-[#C6A664] mr-4 flex-shrink-0"></div>
                                            <div>
                                                <strong class="text-gray-900">Usage Data:</strong> IP address, browser type and version, pages visited, time and date of visit, time spent on pages, device identifiers, and diagnostic data.
                                            </div>
                                        </li>
                                        <li class="flex items-start">
                                            <div class="w-2 h-2 mt-2.5 rounded-full bg-[#C6A664] mr-4 flex-shrink-0"></div>
                                            <div>
                                                <strong class="text-gray-900">Location Data:</strong> Approximate location based on IP address to provide localized property search results.
                                            </div>
                                        </li>
                                        <li class="flex items-start">
                                            <div class="w-2 h-2 mt-2.5 rounded-full bg-[#C6A664] mr-4 flex-shrink-0"></div>
                                            <div>
                                                <strong class="text-gray-900">Transaction Data:</strong> Payment information processed through Paystack, subscription history, and billing records.
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                                        <div class="p-6 rounded-2xl bg-gray-50 border border-gray-100">
                                            <h3 class="font-bold text-gray-900 mb-2">Service Delivery</h3>
                                            <p class="text-sm text-gray-600">To provide and maintain our Platform, process transactions, and monitor usage.</p>
                                        </div>
                                        <div class="p-6 rounded-2xl bg-gray-50 border border-gray-100">
                                            <h3 class="font-bold text-gray-900 mb-2">Communication</h3>
                                            <p class="text-sm text-gray-600">To contact you about updates, security alerts, promotions, and support matters.</p>
                                        </div>
                                        <div class="p-6 rounded-2xl bg-gray-50 border border-gray-100">
                                            <h3 class="font-bold text-gray-900 mb-2">Personalization</h3>
                                            <p class="text-sm text-gray-600">To provide personalized property recommendations and tailored content.</p>
                                        </div>
                                        <div class="p-6 rounded-2xl bg-gray-50 border border-gray-100">
                                            <h3 class="font-bold text-gray-900 mb-2">Improvement & Analytics</h3>
                                            <p class="text-sm text-gray-600">To gather analytics and insights so we can improve the Platform experience.</p>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <!-- 08: Cookies & Tracking -->
                            <section id="section-8" class="scroll-mt-24 mb-16">
                                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <span class="w-8 h-8 rounded-lg bg-[#C6A664]/10 text-[#C6A664] flex items-center justify-center text-sm mr-4">08</span>
                                    Cookies & Tracking
                                </h2>
                                <div class="prose prose-gray max-w-none text-gray-600 leading-relaxed space-y-4">
                                    <p>We use cookies and similar tracking technologies to track activity on our Platform and store certain information. Technologies used include:</p>
                                    <ul class="space-y-3 list-none p-0">
                                        <li class="flex items-start"><div class="w-2 h-2 mt-2.5 rounded-full bg-[#C6A664] mr-4 flex-shrink-0"></div><div><strong class="text-gray-900">Session Cookies:</strong> Essential for operating the Platform (e.g., maintaining your login session).</div></li>
                                        <li class="flex items-start"><div class="w-2 h-2 mt-2.5 rounded-full bg-[#C6A664] mr-4 flex-shrink-0"></div><div><strong class="text-gray-900">Preference Cookies:</strong> Remember your settings, preferences, and language choices.</div></li>
                                        <li class="flex items-start"><div class="w-2 h-2 mt-2.5 rounded-full bg-[#C6A664] mr-4 flex-shrink-0"></div><div><strong class="text-gray-900">Analytics Cookies:</strong> Help us understand how visitors interact with our Platform to improve the user experience.</div></li>
                                    </ul>
                                    <p>You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent. However, if you do not accept cookies, you may not be able to use some features of our Platform.</p>
                                </div>
                            </section>

                            <!-- 09: Disclaimers & Limitation of Liability -->
                            <section id="section-9" class="scroll-mt-24 mb-16">
                                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <span class="w-8 h-8 rounded-lg bg-[#C6A664]/10 text-[#C6A664] flex items-center justify-center text-sm mr-4">09</span>
                                    Disclaimers & Limitation of Liability
                                </h2>
                                <div class="prose prose-gray max-w-none text-gray-600 leading-relaxed space-y-4">
                                    <div class="bg-[#fdfbf7] border-l-4 border-[#C6A664] p-6 rounded-r-2xl">
                                        <p class="text-gray-700 font-semibold">THE PLATFORM IS PROVIDED ON AN "AS IS" AND "AS AVAILABLE" BASIS WITHOUT WARRANTIES OF ANY KIND, EITHER EXPRESS OR IMPLIED.</p>
                                    </div>
                                    <p>MyCrib Africa does not warrant that:</p>
                                    <ul class="space-y-3 list-none p-0">
                                        <li class="flex items-start"><div class="w-2 h-2 mt-2.5 rounded-full bg-[#C6A664] mr-4 flex-shrink-0"></div><span>The Platform will function uninterrupted, secure, or error-free.</span></li>
                                        <li class="flex items-start"><div class="w-2 h-2 mt-2.5 rounded-full bg-[#C6A664] mr-4 flex-shrink-0"></div><span>Any property listing information is accurate, reliable, or complete.</span></li>
                                        <li class="flex items-start"><div class="w-2 h-2 mt-2.5 rounded-full bg-[#C6A664] mr-4 flex-shrink-0"></div><span>The results obtained from the Platform will meet your expectations.</span></li>
                                        <li class="flex items-start"><div class="w-2 h-2 mt-2.5 rounded-full bg-[#C6A664] mr-4 flex-shrink-0"></div><span>Any defects or errors in the Platform will be corrected.</span></li>
                                    </ul>
                                    <p>In no event shall MyCrib Africa, its directors, employees, partners, agents, or affiliates be liable for any indirect, incidental, special, consequential, or punitive damages, including lost profits, data, or goodwill, arising from your use of the Platform.</p>
                                </div>
                            </section>

                            <!-- 10: Third-Party Services -->
                            <section id="section-10" class="scroll-mt-24 mb-16">
                                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <span class="w-8 h-8 rounded-lg bg-[#C6A664]/10 text-[#C6A664] flex items-center justify-center text-sm mr-4">10</span>
                                    Third-Party Services
                                </h2>
                                <div class="prose prose-gray max-w-none text-gray-600 leading-relaxed space-y-4">
                                    <p>The Platform may contain links to or integrations with third-party services not operated by MyCrib Africa. These include:</p>
                                    <ul class="space-y-3 list-none p-0">
                                        <li class="flex items-start"><div class="w-2 h-2 mt-2.5 rounded-full bg-[#C6A664] mr-4 flex-shrink-0"></div><div><strong class="text-gray-900">Paystack:</strong> For secure payment processing (payments, subscriptions, and refunds).</div></li>
                                        <li class="flex items-start"><div class="w-2 h-2 mt-2.5 rounded-full bg-[#C6A664] mr-4 flex-shrink-0"></div><div><strong class="text-gray-900">Google Services:</strong> For authentication (Google Sign-In), maps, and AI-powered features.</div></li>
                                        <li class="flex items-start"><div class="w-2 h-2 mt-2.5 rounded-full bg-[#C6A664] mr-4 flex-shrink-0"></div><div><strong class="text-gray-900">Leaflet Maps:</strong> For property location display and interactive map features.</div></li>
                                    </ul>
                                    <p>We have no control over, and assume no responsibility for, the content, privacy policies, or practices of any third-party services. We strongly advise you to read the terms and privacy policies of any third-party services you interact with.</p>
                                </div>
                            </section>

                            <!-- 11: Data Security -->
                            <section id="section-11" class="scroll-mt-24 mb-16">
                                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <span class="w-8 h-8 rounded-lg bg-[#C6A664]/10 text-[#C6A664] flex items-center justify-center text-sm mr-4">11</span>
                                    Data Security
                                </h2>
                                <div class="prose prose-gray max-w-none text-gray-600 leading-relaxed space-y-4">
                                    <div class="bg-[#fdfbf7] border-l-4 border-[#C6A664] p-6 rounded-r-2xl">
                                        <p class="text-gray-700 italic">"The security of your data is important to us, but remember that no method of transmission over the Internet, or method of electronic storage is 100% secure. While we strive to use commercially acceptable means to protect your Personal Data, we cannot guarantee its absolute security."</p>
                                    </div>
                                    <p>We implement industry-standard security measures including:</p>
                                    <ul class="space-y-3 list-none p-0">
                                        <li class="flex items-start"><div class="w-2 h-2 mt-2.5 rounded-full bg-[#C6A664] mr-4 flex-shrink-0"></div><span>SSL/TLS encryption for all data transmitted between your device and our servers.</span></li>
                                        <li class="flex items-start"><div class="w-2 h-2 mt-2.5 rounded-full bg-[#C6A664] mr-4 flex-shrink-0"></div><span>Bcrypt hashing for password storage — we never store passwords in plain text.</span></li>
                                        <li class="flex items-start"><div class="w-2 h-2 mt-2.5 rounded-full bg-[#C6A664] mr-4 flex-shrink-0"></div><span>Two-factor authentication (2FA) available for all user accounts.</span></li>
                                        <li class="flex items-start"><div class="w-2 h-2 mt-2.5 rounded-full bg-[#C6A664] mr-4 flex-shrink-0"></div><span>Regular security audits and vulnerability assessments.</span></li>
                                    </ul>
                                </div>
                            </section>

                            <!-- 12: Termination -->
                            <section id="section-12" class="scroll-mt-24 mb-16">
                                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <span class="w-8 h-8 rounded-lg bg-[#C6A664]/10 text-[#C6A664] flex items-center justify-center text-sm mr-4">12</span>
                                    Termination
                                </h2>
                                <div class="prose prose-gray max-w-none text-gray-600 leading-relaxed space-y-4">
                                    <p>We may terminate or suspend your account and access to the Platform immediately, without prior notice or liability, for any reason, including if you breach these Terms. Reasons for termination include but are not limited to:</p>
                                    <ul class="space-y-3 list-none p-0">
                                        <li class="flex items-start"><div class="w-2 h-2 mt-2.5 rounded-full bg-[#C6A664] mr-4 flex-shrink-0"></div><span>Violations of these Terms of Service or Privacy Policy.</span></li>
                                        <li class="flex items-start"><div class="w-2 h-2 mt-2.5 rounded-full bg-[#C6A664] mr-4 flex-shrink-0"></div><span>Posting fraudulent or misleading property listings.</span></li>
                                        <li class="flex items-start"><div class="w-2 h-2 mt-2.5 rounded-full bg-[#C6A664] mr-4 flex-shrink-0"></div><span>Engaging in illegal activities or harassment of other users.</span></li>
                                        <li class="flex items-start"><div class="w-2 h-2 mt-2.5 rounded-full bg-[#C6A664] mr-4 flex-shrink-0"></div><span>Non-payment of fees or subscription charges.</span></li>
                                    </ul>
                                    <p>Upon termination, your right to use the Platform will cease immediately. You may request deletion of your data as outlined in the "Your Rights" section below.</p>
                                </div>
                            </section>

                            <!-- 13: Governing Law & Disputes -->
                            <section id="section-13" class="scroll-mt-24 mb-16">
                                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <span class="w-8 h-8 rounded-lg bg-[#C6A664]/10 text-[#C6A664] flex items-center justify-center text-sm mr-4">13</span>
                                    Governing Law & Disputes
                                </h2>
                                <div class="prose prose-gray max-w-none text-gray-600 leading-relaxed space-y-4">
                                    <p>These Terms shall be governed and construed in accordance with the laws of the <strong>Federal Republic of Nigeria</strong>, without regard to its conflict of law provisions.</p>
                                    <p>Any dispute arising out of or in connection with these Terms, including any question regarding their existence, validity, or termination, shall be resolved as follows:</p>
                                    <ol class="space-y-3 list-none p-0">
                                        <li class="flex items-start"><span class="w-6 h-6 rounded-full bg-[#C6A664]/10 text-[#C6A664] flex items-center justify-center text-xs font-bold mr-3 flex-shrink-0">1</span><span><strong>Negotiation:</strong> The parties shall first attempt to resolve the dispute amicably through direct negotiation within 30 days.</span></li>
                                        <li class="flex items-start"><span class="w-6 h-6 rounded-full bg-[#C6A664]/10 text-[#C6A664] flex items-center justify-center text-xs font-bold mr-3 flex-shrink-0">2</span><span><strong>Mediation:</strong> If negotiation fails, the dispute shall be referred to mediation under the Lagos Multi-Door Courthouse.</span></li>
                                        <li class="flex items-start"><span class="w-6 h-6 rounded-full bg-[#C6A664]/10 text-[#C6A664] flex items-center justify-center text-xs font-bold mr-3 flex-shrink-0">3</span><span><strong>Arbitration:</strong> If mediation fails, the dispute shall be finally settled by arbitration in Lagos, Nigeria, in accordance with the Arbitration and Conciliation Act.</span></li>
                                    </ol>
                                </div>
                            </section>

                            <!-- 14: Your Rights -->
                            <section id="section-14" class="scroll-mt-24 mb-16">
                                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <span class="w-8 h-8 rounded-lg bg-[#C6A664]/10 text-[#C6A664] flex items-center justify-center text-sm mr-4">14</span>
                                    Your Rights
                                </h2>
                                <div class="prose prose-gray max-w-none text-gray-600 leading-relaxed space-y-4">
                                    <p>Under the Nigeria Data Protection Regulation (NDPR) and applicable privacy laws, you have the right to:</p>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                        @foreach([
                                            ['title' => 'Access', 'desc' => 'Request a copy of the personal data we hold about you.'],
                                            ['title' => 'Rectification', 'desc' => 'Request correction of inaccurate or incomplete personal data.'],
                                            ['title' => 'Erasure', 'desc' => 'Request deletion of your personal data ("right to be forgotten").'],
                                            ['title' => 'Restriction', 'desc' => 'Request restriction of processing of your personal data.'],
                                            ['title' => 'Portability', 'desc' => 'Request transfer of your data to another service provider.'],
                                            ['title' => 'Objection', 'desc' => 'Object to processing of your personal data for marketing purposes.'],
                                        ] as $right)
                                        <div class="p-5 rounded-2xl bg-gray-50 border border-gray-100">
                                            <h3 class="font-bold text-gray-900 mb-1 text-sm">Right to {{ $right['title'] }}</h3>
                                            <p class="text-xs text-gray-600">{{ $right['desc'] }}</p>
                                        </div>
                                        @endforeach
                                    </div>
                                    <p class="mt-4">To exercise any of these rights, please contact us at <a href="mailto:privacy@mycrib.africa" class="text-[#C6A664] font-semibold hover:underline">privacy@mycrib.africa</a>. We will respond within 30 days.</p>
                                </div>
                            </section>

                            <!-- 15: Contact Us -->
                            <section id="section-15" class="scroll-mt-24">
                                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <span class="w-8 h-8 rounded-lg bg-[#C6A664]/10 text-[#C6A664] flex items-center justify-center text-sm mr-4">15</span>
                                    Contact Us
                                    <div class="ml-auto flex space-x-2">
                                        <div class="w-2 h-2 rounded-full bg-[#C6A664]"></div>
                                        <div class="w-2 h-2 rounded-full bg-[#C6A664]/50"></div>
                                        <div class="w-2 h-2 rounded-full bg-[#C6A664]/20"></div>
                                    </div>
                                </h2>
                                <div class="bg-gray-900 rounded-2xl p-8 text-white relative overflow-hidden">
                                    <div class="relative z-10">
                                        <p class="text-gray-400 mb-6 text-lg">If you have any questions about this Privacy Policy or Terms of Service, please contact us:</p>
                                        <div class="space-y-4">
                                            <a href="mailto:privacy@mycrib.africa" class="flex items-center text-[#C6A664] hover:text-[#d4b97a] transition-colors">
                                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                                <span class="font-bold">privacy@mycrib.africa</span>
                                            </a>
                                            <a href="mailto:support@mycrib.africa" class="flex items-center text-[#C6A664] hover:text-[#d4b97a] transition-colors">
                                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                                <span class="font-bold">support@mycrib.africa</span>
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
