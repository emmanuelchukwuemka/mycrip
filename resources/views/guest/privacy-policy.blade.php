<x-app-layout>
    <div class="min-h-screen" style="background: linear-gradient(to bottom right, #F5F5F5, #FFFFFF, #F5F5F5);">
        <!-- Hero Section -->
        <div class="relative overflow-hidden">
            <div class="absolute inset-0" style="background-color: #001F3F; opacity: 0.05;"></div>
            <div class="absolute inset-0">
                <div class="absolute top-0 right-0 w-96 h-96 rounded-full mix-blend-multiply filter blur-3xl opacity-10" style="background-color: #C6A664;"></div>
                <div class="absolute bottom-0 left-0 w-96 h-96 rounded-full mix-blend-multiply filter blur-3xl opacity-10" style="background-color: #001F3F;"></div>
            </div>
            <div class="relative max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
                <div class="text-center">
                    <div class="inline-flex items-center px-4 py-2 rounded-full bg-white/80 backdrop-blur-sm border border-white/20 shadow-lg">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #C6A664;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                        <span class="text-sm font-medium text-gray-700">Your Privacy Matters</span>
                    </div>
                    <h1 class="mt-6 text-5xl md:text-6xl lg:text-7xl font-bold text-gray-900 tracking-tight">
                        Privacy
                        <span class="bg-clip-text text-transparent" style="background: linear-gradient(to right, #001F3F, #C6A664); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Policy</span>
                    </h1>
                    <p class="mt-6 max-w-3xl mx-auto text-xl md:text-2xl text-gray-600 leading-relaxed">
                        We are committed to protecting your personal information and being transparent about how we use it.
                    </p>
                    <p class="mt-4 text-sm text-gray-500">Last updated: {{ date('F j, Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Privacy Policy Content -->
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">
            <div class="space-y-8">

                <!-- Section 1: Introduction -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="inline-flex items-center justify-center h-12 w-12 rounded-xl text-white shadow-lg" style="background-color: #001F3F;">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">1. Introduction</h2>
                            <p class="text-gray-600 leading-relaxed">
                                Welcome to <strong>MyCrib Africa</strong>. We respect your privacy and are committed to protecting your personal data. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website and use our services, including browsing property listings, contacting agents, and creating an account.
                            </p>
                            <p class="text-gray-600 leading-relaxed mt-3">
                                By accessing or using our platform, you agree to the terms of this Privacy Policy. If you do not agree, please discontinue use of our services.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Information We Collect -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="inline-flex items-center justify-center h-12 w-12 rounded-xl text-white shadow-lg" style="background-color: #C6A664;">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">2. Information We Collect</h2>
                            <p class="text-gray-600 leading-relaxed mb-4">We may collect the following types of information:</p>
                            <div class="space-y-4">
                                <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                                    <h3 class="font-semibold text-gray-800 mb-2">Personal Information</h3>
                                    <ul class="text-gray-600 space-y-1 ml-4 list-disc">
                                        <li>Full name, email address, and phone number</li>
                                        <li>Account credentials (username and encrypted password)</li>
                                        <li>Profile information and preferences</li>
                                    </ul>
                                </div>
                                <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                                    <h3 class="font-semibold text-gray-800 mb-2">Property-Related Information</h3>
                                    <ul class="text-gray-600 space-y-1 ml-4 list-disc">
                                        <li>Property search queries and saved listings</li>
                                        <li>Inquiry messages sent to agents</li>
                                        <li>Property listing details (for agents)</li>
                                    </ul>
                                </div>
                                <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                                    <h3 class="font-semibold text-gray-800 mb-2">Technical Information</h3>
                                    <ul class="text-gray-600 space-y-1 ml-4 list-disc">
                                        <li>IP address, browser type, and device information</li>
                                        <li>Pages visited, time spent, and navigation patterns</li>
                                        <li>Cookies and similar tracking technologies</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 3: How We Use Your Information -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="inline-flex items-center justify-center h-12 w-12 rounded-xl text-white shadow-lg" style="background-color: #001F3F;">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">3. How We Use Your Information</h2>
                            <p class="text-gray-600 leading-relaxed mb-4">We use the information we collect for the following purposes:</p>
                            <ul class="text-gray-600 space-y-3">
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #C6A664;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    To provide, operate, and maintain our property listing platform
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #C6A664;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    To facilitate communication between property seekers and agents
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #C6A664;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    To personalize your experience and show relevant property listings
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #C6A664;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    To send important updates, newsletters, and promotional content (with your consent)
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #C6A664;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    To detect, prevent, and address fraud, security issues, and technical problems
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #C6A664;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    To comply with legal obligations and enforce our terms of service
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Section 4: Cookies -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="inline-flex items-center justify-center h-12 w-12 rounded-xl text-white shadow-lg" style="background-color: #C6A664;">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">4. Cookies & Tracking Technologies</h2>
                            <p class="text-gray-600 leading-relaxed mb-4">
                                We use cookies and similar tracking technologies to enhance your browsing experience. Cookies are small data files stored on your device that help us remember your preferences and understand how you use our platform.
                            </p>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="bg-gray-50 rounded-xl p-4 border border-gray-100 text-center">
                                    <div class="font-semibold text-gray-800 mb-1">Essential</div>
                                    <p class="text-sm text-gray-600">Required for the website to function properly</p>
                                </div>
                                <div class="bg-gray-50 rounded-xl p-4 border border-gray-100 text-center">
                                    <div class="font-semibold text-gray-800 mb-1">Analytics</div>
                                    <p class="text-sm text-gray-600">Help us understand how visitors interact with our site</p>
                                </div>
                                <div class="bg-gray-50 rounded-xl p-4 border border-gray-100 text-center">
                                    <div class="font-semibold text-gray-800 mb-1">Preferences</div>
                                    <p class="text-sm text-gray-600">Remember your settings and personalization choices</p>
                                </div>
                            </div>
                            <p class="text-gray-600 leading-relaxed mt-4">
                                You can manage your cookie preferences through your browser settings. Please note that disabling certain cookies may affect the functionality of our platform.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Section 5: Information Sharing -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="inline-flex items-center justify-center h-12 w-12 rounded-xl text-white shadow-lg" style="background-color: #001F3F;">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">5. Information Sharing & Disclosure</h2>
                            <p class="text-gray-600 leading-relaxed mb-4">
                                We do not sell your personal information. We may share your data only in the following circumstances:
                            </p>
                            <ul class="text-gray-600 space-y-3">
                                <li class="flex items-start">
                                    <span class="inline-flex items-center justify-center h-6 w-6 rounded-full text-white text-xs font-bold mr-3 mt-0.5 flex-shrink-0" style="background-color: #001F3F;">1</span>
                                    <span><strong>With Property Agents:</strong> When you submit an inquiry, your contact details are shared with the relevant agent to facilitate communication.</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="inline-flex items-center justify-center h-6 w-6 rounded-full text-white text-xs font-bold mr-3 mt-0.5 flex-shrink-0" style="background-color: #001F3F;">2</span>
                                    <span><strong>Service Providers:</strong> We may share data with trusted third-party service providers who assist us in operating our platform (e.g., hosting, analytics).</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="inline-flex items-center justify-center h-6 w-6 rounded-full text-white text-xs font-bold mr-3 mt-0.5 flex-shrink-0" style="background-color: #001F3F;">3</span>
                                    <span><strong>Legal Compliance:</strong> We may disclose information when required by law, court order, or governmental regulations.</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="inline-flex items-center justify-center h-6 w-6 rounded-full text-white text-xs font-bold mr-3 mt-0.5 flex-shrink-0" style="background-color: #001F3F;">4</span>
                                    <span><strong>Business Transfers:</strong> In the event of a merger, acquisition, or sale of assets, your information may be transferred as part of the transaction.</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Section 6: Data Security -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="inline-flex items-center justify-center h-12 w-12 rounded-xl text-white shadow-lg" style="background-color: #C6A664;">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">6. Data Security</h2>
                            <p class="text-gray-600 leading-relaxed mb-4">
                                We implement industry-standard security measures to protect your personal information, including:
                            </p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="flex items-center bg-gray-50 rounded-xl p-4 border border-gray-100">
                                    <svg class="w-8 h-8 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #C6A664;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                    <div>
                                        <div class="font-semibold text-gray-800">SSL Encryption</div>
                                        <p class="text-sm text-gray-600">Data transmitted securely</p>
                                    </div>
                                </div>
                                <div class="flex items-center bg-gray-50 rounded-xl p-4 border border-gray-100">
                                    <svg class="w-8 h-8 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #C6A664;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                    <div>
                                        <div class="font-semibold text-gray-800">Encrypted Storage</div>
                                        <p class="text-sm text-gray-600">Passwords securely hashed</p>
                                    </div>
                                </div>
                                <div class="flex items-center bg-gray-50 rounded-xl p-4 border border-gray-100">
                                    <svg class="w-8 h-8 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #C6A664;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                                    </svg>
                                    <div>
                                        <div class="font-semibold text-gray-800">Access Controls</div>
                                        <p class="text-sm text-gray-600">Restricted data access</p>
                                    </div>
                                </div>
                                <div class="flex items-center bg-gray-50 rounded-xl p-4 border border-gray-100">
                                    <svg class="w-8 h-8 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #C6A664;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                    </svg>
                                    <div>
                                        <div class="font-semibold text-gray-800">Regular Audits</div>
                                        <p class="text-sm text-gray-600">Continuous security reviews</p>
                                    </div>
                                </div>
                            </div>
                            <p class="text-gray-600 leading-relaxed mt-4">
                                While we strive to protect your information, no method of transmission over the Internet or electronic storage is 100% secure. We cannot guarantee absolute security.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Section 7: Your Rights -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="inline-flex items-center justify-center h-12 w-12 rounded-xl text-white shadow-lg" style="background-color: #001F3F;">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">7. Your Rights</h2>
                            <p class="text-gray-600 leading-relaxed mb-4">
                                Depending on your location, you may have the following rights regarding your personal data:
                            </p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <div class="flex items-center p-3 bg-gray-50 rounded-lg border border-gray-100">
                                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #001F3F;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <span class="text-gray-700 text-sm"><strong>Access</strong> your personal data</span>
                                </div>
                                <div class="flex items-center p-3 bg-gray-50 rounded-lg border border-gray-100">
                                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #001F3F;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    <span class="text-gray-700 text-sm"><strong>Correct</strong> inaccurate data</span>
                                </div>
                                <div class="flex items-center p-3 bg-gray-50 rounded-lg border border-gray-100">
                                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #001F3F;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    <span class="text-gray-700 text-sm"><strong>Delete</strong> your account</span>
                                </div>
                                <div class="flex items-center p-3 bg-gray-50 rounded-lg border border-gray-100">
                                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #001F3F;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                                    </svg>
                                    <span class="text-gray-700 text-sm"><strong>Opt out</strong> of marketing</span>
                                </div>
                                <div class="flex items-center p-3 bg-gray-50 rounded-lg border border-gray-100">
                                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #001F3F;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                    </svg>
                                    <span class="text-gray-700 text-sm"><strong>Export</strong> your data</span>
                                </div>
                                <div class="flex items-center p-3 bg-gray-50 rounded-lg border border-gray-100">
                                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #001F3F;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-gray-700 text-sm"><strong>Restrict</strong> processing</span>
                                </div>
                            </div>
                            <p class="text-gray-600 leading-relaxed mt-4">
                                To exercise any of these rights, please contact us using the details provided below.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Section 8: Children's Privacy -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="inline-flex items-center justify-center h-12 w-12 rounded-xl text-white shadow-lg" style="background-color: #C6A664;">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">8. Children's Privacy</h2>
                            <p class="text-gray-600 leading-relaxed">
                                Our services are not directed to individuals under the age of 18. We do not knowingly collect personal information from children. If we become aware that we have collected data from a child without proper parental consent, we will take steps to delete that information promptly.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Section 9: Changes to This Policy -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="inline-flex items-center justify-center h-12 w-12 rounded-xl text-white shadow-lg" style="background-color: #001F3F;">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">9. Changes to This Policy</h2>
                            <p class="text-gray-600 leading-relaxed">
                                We may update this Privacy Policy from time to time to reflect changes in our practices or for legal, regulatory, or operational reasons. When we make changes, we will update the "Last updated" date at the top of this page. We encourage you to review this Privacy Policy periodically for any changes.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Section 10: Contact Us -->
                <div class="rounded-2xl shadow-lg border border-gray-100 p-8 hover:shadow-xl transition-shadow duration-300" style="background: linear-gradient(135deg, #001F3F, #00152B);">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="inline-flex items-center justify-center h-12 w-12 rounded-xl text-white shadow-lg" style="background-color: #C6A664;">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-white mb-4">10. Contact Us</h2>
                            <p class="text-gray-300 leading-relaxed mb-6">
                                If you have any questions, concerns, or requests regarding this Privacy Policy or how we handle your personal data, please don't hesitate to reach out:
                            </p>
                            <div class="space-y-4">
                                <div class="flex items-center text-gray-300">
                                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #C6A664;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    <span>support@mycribafrica.com</span>
                                </div>
                                <div class="flex items-center text-gray-300">
                                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #C6A664;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>www.mycribafrica.com</span>
                                </div>
                            </div>
                            <div class="mt-8">
                                <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105" style="background-color: #C6A664;" onmouseover="this.style.backgroundColor='#B89654'" onmouseout="this.style.backgroundColor='#C6A664'">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                    </svg>
                                    Back to Home
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
