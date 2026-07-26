<x-guest-layout>
    <div class="min-h-screen flex" style="background: linear-gradient(to bottom right, #F5F5F5, #FFFFFF, #F5F5F5);">
        <!-- Left Side: Image -->
        <div class="hidden lg:block relative w-0 flex-1">
            <img class="absolute inset-0 h-full w-full object-cover" src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" alt="Modern Home">
            <div class="absolute inset-0" style="background-color: #A85C2E; opacity: 0.9;"></div>
            <div class="absolute inset-0 bg-black/20"></div>
            <!-- Logo Overlay -->
            <div class="absolute inset-0 flex items-center justify-center p-12">
                <div class="text-center">
                    <img src="{{ asset('images/icons/logo.png') }}" alt="Villa Africa" class="motion-logo w-2/3 h-auto max-w-md mx-auto brightness-0 invert drop-shadow-2xl">
                    <p class="mt-12 text-white text-2xl font-bold tracking-[0.3em] uppercase opacity-80 h-8">
                        <span id="typing-tagline" class="typing-cursor"></span>
                    </p>
                </div>
            </div>
            
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const taglines = [
                        "Premium Real Estate",
                        "Find Your Dream Home",
                        "Modern African Living"
                    ];
                    const el = document.getElementById('typing-tagline');
                    let taglineIndex = 0;
                    let charIndex = 0;
                    let isDeleting = false;
                    let typeSpeed = 150;

                    function type() {
                        if (!el) return;
                        
                        const currentTagline = taglines[taglineIndex];

                        if (isDeleting) {
                            el.textContent = currentTagline.substring(0, charIndex--);
                            typeSpeed = 80;
                        } else {
                            el.textContent = currentTagline.substring(0, charIndex++);
                            typeSpeed = 150;
                        }

                        if (!isDeleting && charIndex > currentTagline.length) {
                            isDeleting = true;
                            typeSpeed = 2000; // Pause at the end
                        } else if (isDeleting && charIndex < 0) {
                            isDeleting = false;
                            charIndex = 0;
                            taglineIndex = (taglineIndex + 1) % taglines.length;
                            typeSpeed = 500; // Pause before starting next tagline
                        }

                        setTimeout(type, typeSpeed);
                    }
                    type();
                });
            </script>
        </div>

        <!-- Right Side: Form -->
        <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24 scale-in-center">
            <style>
                @keyframes float {
                    0% { transform: translateY(0px) rotate(0deg); }
                    50% { transform: translateY(-20px) rotate(1deg); }
                    100% { transform: translateY(0px) rotate(0deg); }
                }
                @keyframes glow {
                    0%, 100% { filter: brightness(0) invert(1) drop-shadow(0 0 20px rgba(255, 255, 255, 0.4)); }
                    50% { filter: brightness(0) invert(1) drop-shadow(0 0 40px rgba(255, 255, 255, 0.7)); }
                }
                @keyframes reveal {
                    from { opacity: 0; transform: scale(0.8) translateY(20px); }
                    to { opacity: 1; transform: scale(1) translateY(0); }
                }
                @keyframes breathing {
                    0%, 100% { opacity: 0.4; transform: translateY(0px) scale(0.95); }
                    50% { opacity: 1; transform: translateY(-20px) scale(1.05); }
                }
                .motion-logo {
                    animation: breathing 5s ease-in-out infinite, glow 4s ease-in-out infinite;
                }
                .scale-in-center {
                    animation: reveal 1s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
                }
                .typing-cursor::after {
                    content: '|';
                    animation: blink 1s step-end infinite;
                    margin-left: 4px;
                    color: #2B1810;
                }
                @keyframes blink {
                    from, to { opacity: 1; }
                    50% { opacity: 0; }
                }
            </style>
            <div class="mx-auto w-full max-w-md lg:w-96">
                <div class="text-center mb-8">
                    <a href="{{ route('home') }}" class="inline-flex items-center transition-colors" style="color: #A85C2E;" onmouseover="this.style.color='#2B1810'" onmouseout="this.style.color='#A85C2E'">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Back to Home
                    </a>
                </div>
                
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 p-8">
                    <div class="text-center">
                        <h2 id="login-title" class="text-3xl font-bold text-gray-900 mb-2">
                            Welcome Back
                        </h2>
                        <p id="login-subtitle" class="text-gray-600 mb-6">
                            Sign in to your Villa Africa account
                        </p>

                        @if (session('status'))
                            <div class="mb-4 font-medium text-sm text-green-600">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm rounded-r-lg text-left">
                                <ul class="list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>



                    <form action="{{ route('login') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email Address
                            </label>
                            <input id="email" name="email" type="email" autocomplete="email" required 
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 bg-white/50 backdrop-blur-sm">
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                Password
                            </label>
                            <input id="password" name="password" type="password" autocomplete="current-password" required 
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 bg-white/50 backdrop-blur-sm">
                        </div>

                        <div class="flex items-center justify-between">
                            <label class="flex items-center">
                                <input type="checkbox" name="remember-me" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                <span class="ml-2 text-sm text-gray-600">Remember me</span>
                            </label>
                            
                            <a href="{{ route('password.request') }}" class="text-sm font-medium transition-colors" style="color: #A85C2E;" onmouseover="this.style.color='#2B1810'" onmouseout="this.style.color='#A85C2E'">
                                Forgot password?
                            </a>
                        </div>

                            <div>
                                <button type="submit" id="submit-btn" 
                                        class="w-full btn-auth text-white py-3 px-4 rounded-lg font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-[#A85C2E] focus:ring-offset-2">
                                    Sign In
                                </button>
                            </div>
                    </form>

                    <!-- Divider -->
                    <div class="relative my-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-200"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-white text-gray-500">Or continue with</span>
                        </div>
                    </div>

                    <!-- Google Sign In Button -->
                    <a href="{{ route('google.redirect') }}" class="w-full flex items-center justify-center px-4 py-3 border-2 border-gray-200 rounded-lg shadow-sm hover:shadow-md hover:border-gray-300 transition-all duration-200 group">
                        <svg class="w-5 h-5 mr-3" viewBox="0 0 24 24">
                            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 01-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z" fill="#4285F4"/>
                            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                        </svg>
                        <span class="text-sm font-semibold text-gray-700 group-hover:text-gray-900">Sign in with Google</span>
                    </a>

                    <div class="mt-8 pt-6 border-t border-gray-100">
                        <p class="text-sm text-gray-500 text-center mb-4 font-medium uppercase tracking-widest">Need an account?</p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <a href="{{ route('register', ['role' => 'user']) }}" 
                               class="flex items-center justify-center px-4 py-3 bg-[#A85C2E] text-white rounded-lg font-bold shadow-md hover:bg-[#2B1810] transition-all transform active:scale-95 text-sm uppercase tracking-wider">
                                Sign up as Buyer
                            </a>
                            <a href="{{ route('register', ['role' => 'agent']) }}" 
                               class="flex items-center justify-center px-4 py-3 border-2 border-[#2B1810] text-[#2B1810] rounded-lg font-bold shadow-sm hover:bg-[#2B1810] hover:text-white transition-all transform active:scale-95 text-sm uppercase tracking-wider">
                                Register as Agent
                            </a>
                        </div>
                    </div>
            </div>
        </div>
    </div>

</x-guest-layout>
