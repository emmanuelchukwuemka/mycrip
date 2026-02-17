<x-guest-layout>
    <div class="min-h-screen flex" style="background: linear-gradient(to bottom right, #F5F5F5, #FFFFFF, #F5F5F5);">
        <!-- Left Side: Image -->
        <div class="hidden lg:block relative w-0 flex-1">
            <img class="absolute inset-0 h-full w-full object-cover" src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" alt="Modern Home">
            <div class="absolute inset-0" style="background-color: #001F3F; opacity: 0.9;"></div>
            <div class="absolute inset-0 bg-black/20"></div>
        </div>

        <!-- Right Side: Form -->
        <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
            <div class="mx-auto w-full max-w-md lg:w-96">
                <div class="text-center mb-8">
                    <a href="{{ route('home') }}" class="inline-flex items-center transition-colors" style="color: #001F3F;" onmouseover="this.style.color='#C6A664'" onmouseout="this.style.color='#001F3F'">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Back to Home
                    </a>
                </div>
                
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 p-8">
                    <div class="text-center">
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">
                            Welcome Back
                        </h2>
                        <p class="text-gray-600 mb-8">
                            Sign in to your MyCrib Africa account
                        </p>
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
                            
                            <a href="#" class="text-sm font-medium transition-colors" style="color: #001F3F;" onmouseover="this.style.color='#C6A664'" onmouseout="this.style.color='#001F3F'">
                                Forgot password?
                            </a>
                        </div>

                            <div>
<button type="submit" 
                                    class="w-full btn-auth text-white py-3 px-4 rounded-lg font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-[#001F3F] focus:ring-offset-2">
                                Sign In
                            </button>
                            </div>
                    </form>

                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-600">
                            Don't have an account? 
                            <a href="{{ route('register') }}" class="font-medium transition-colors" style="color: #001F3F;" onmouseover="this.style.color='#C6A664'" onmouseout="this.style.color='#001F3F'">
                                Sign up for free
                            </a>
                        </p>
                    </div>
            </div>
        </div>
    </div>
</x-guest-layout>
