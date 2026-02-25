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
                    <a href="{{ route('login') }}" class="inline-flex items-center transition-colors" style="color: #001F3F;" onmouseover="this.style.color='#C6A664'" onmouseout="this.style.color='#001F3F'">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Login
                    </a>
                </div>
                
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 p-8">
                    <div class="text-center">
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">
                            Reset Password
                        </h2>
                        <p class="text-gray-600 mb-6">
                            Enter your email to receive a password reset link
                        </p>

                        @if (session('status'))
                            <div class="mb-4 font-medium text-sm text-green-600 p-4 bg-green-50 rounded-lg">
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

                    <form action="{{ route('password.email') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email Address
                            </label>
                            <input id="email" name="email" type="email" autocomplete="email" required 
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#001F3F] focus:border-transparent transition-all duration-200 bg-white/50 backdrop-blur-sm"
                                   value="{{ old('email') }}">
                        </div>

                        <div>
                            <button type="submit" 
                                    class="w-full btn-auth text-white py-3 px-4 rounded-lg font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-[#001F3F] focus:ring-offset-2"
                                    style="background-color: #001F3F;">
                                Send Reset Link
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
