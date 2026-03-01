<x-guest-layout>
    <div class="min-h-screen flex" style="background: linear-gradient(to bottom right, #F5F5F5, #FFFFFF, #F5F5F5);">
        <!-- Left Side: Image -->
        <div class="hidden lg:block relative w-0 flex-1">
            <img class="absolute inset-0 h-full w-full object-cover" src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" alt="Luxury Real Estate">
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
                            Join MyCrib Africa
                        </h2>
                        <p class="text-gray-600 mb-6">
                            Create your account to get started
                        </p>

                        @if ($errors->any())
                            <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm rounded-r-lg">
                                <ul class="list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>

                    <form action="{{ route('register') }}" method="POST" class="space-y-6" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Account Type</label>
                            <p class="text-sm text-gray-600 mb-4">Select how you want to use MyCrib Africa</p>
                            <div class="grid grid-cols-2 gap-4">
                                <label class="relative cursor-pointer group">
                                    <input type="radio" name="role" value="user" {{ request()->get('role') !== 'agent' ? 'checked' : '' }} class="sr-only peer">
                                    <div class="p-4 border-2 border-gray-200 rounded-lg peer-checked:bg-indigo-50/50 transition-all duration-200 group-hover:border-gray-300" style="" onmouseenter="if(!this.previousElementSibling.checked) this.style.borderColor='#C6A664'" onmouseleave="if(!this.previousElementSibling.checked) this.style.borderColor=''" data-checked-border="#001F3F" data-checked-bg="rgba(0, 31, 63, 0.05)">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 w-6 h-6 rounded-full flex items-center justify-center mr-3" style="background-color: #F5F5F5;">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="color: #001F3F;">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="font-medium text-gray-900">Buyer / Renter</div>
                                                <div class="text-sm text-gray-600">Find your dream property</div>
                                            </div>
                                        </div>
                                    </div>
                                </label>

                                <label class="relative cursor-pointer group">
                                    <input type="radio" name="role" value="agent" {{ request()->get('role') === 'agent' ? 'checked' : '' }} class="sr-only peer">
                                    <div class="p-4 border-2 border-gray-200 rounded-lg peer-checked:bg-indigo-50/50 transition-all duration-200 group-hover:border-gray-300" style="" onmouseenter="if(!this.previousElementSibling.checked) this.style.borderColor='#C6A664'" onmouseleave="if(!this.previousElementSibling.checked) this.style.borderColor=''" data-checked-border="#001F3F" data-checked-bg="rgba(0, 31, 63, 0.05)">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 w-6 h-6 rounded-full flex items-center justify-center mr-3" style="background-color: #F5F5F5;">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="color: #C6A664;">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="font-medium text-gray-900">Real Estate Agent</div>
                                                <div class="text-sm text-gray-600">List and manage properties</div>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                Full Name
                            </label>
                            <input id="name" name="name" type="text" autocomplete="name" required 
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 bg-white/50 backdrop-blur-sm">
                        </div>

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
                            <input id="password" name="password" type="password" autocomplete="new-password" required 
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 bg-white/50 backdrop-blur-sm"
                                   oninput="checkPasswordStrength(this.value)">
                            
                            <!-- Password Strength Indicator -->
                            <div id="password-strength" class="mt-2 hidden">
                                <div class="flex space-x-1 mb-2">
                                    <div class="strength-bar flex-1 h-1.5 rounded-full bg-gray-200"></div>
                                    <div class="strength-bar flex-1 h-1.5 rounded-full bg-gray-200"></div>
                                    <div class="strength-bar flex-1 h-1.5 rounded-full bg-gray-200"></div>
                                    <div class="strength-bar flex-1 h-1.5 rounded-full bg-gray-200"></div>
                                </div>
                                <p id="strength-text" class="text-xs text-gray-500"></p>
                            </div>
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                                Confirm Password
                            </label>
                            <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required 
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 bg-white/50 backdrop-blur-sm"
                                   oninput="checkPasswordMatch()">
                            <p id="password-match" class="mt-1 text-xs hidden"></p>
                        </div>

                        <!-- Agent Details Section (Only shown for agents) -->
                        <div id="agent-profile-section" class="mt-4 hidden space-y-4">
                            <!-- NIN -->
                            <div>
                                <label for="agent_id_number" class="block text-sm font-medium text-gray-700 mb-2">
                                    NIN (National Identification Number)
                                </label>
                                <input id="agent_id_number" name="agent_id_number" type="text" 
                                       class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 bg-white/50 backdrop-blur-sm">
                            </div>

                            <!-- Phone -->
                            <div>
                                <label for="agent_phone" class="block text-sm font-medium text-gray-700 mb-2">
                                    Agent Phone Number
                                </label>
                                <input id="agent_phone" name="agent_phone" type="text" 
                                       class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 bg-white/50 backdrop-blur-sm">
                            </div>

                            <!-- Profile Picture -->
                            <div>
                                <label for="agent_image" class="block text-sm font-medium text-gray-700 mb-2">
                                    Profile Picture
                                </label>

                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <div id="profile-preview" class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center overflow-hidden">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <input id="agent_image" name="agent_image" type="file" accept="image/*" 
                                           class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 bg-white/50 backdrop-blur-sm">
                                    <p class="mt-2 text-sm text-gray-600">Upload a professional profile picture for your agent account.</p>
                            </div>
                        </div>
                        </div>
                        </div>

                        <!-- Agent Verification Document -->
                        <div id="agent-document-section" class="mt-4 hidden">
                            <label for="agent_id_document" class="block text-sm font-medium text-gray-700 mb-2">
                                Agent Verification Document
                            </label>
                            <input id="agent_id_document" name="agent_id_document" type="file" accept="image/*,.pdf" 
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 bg-white/50 backdrop-blur-sm">
                            <p class="mt-2 text-sm text-gray-600">Upload your identification document (ID card, license, etc.) for verification purposes.</p>
                        </div>

                        <div>
                            <button type="submit" id="submit-btn" 
                                    class="w-full btn-auth text-white py-3 px-4 rounded-lg font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-[#001F3F] focus:ring-offset-2">
                                Create Account
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
                        <span class="text-sm font-semibold text-gray-700 group-hover:text-gray-900">Sign up with Google</span>
                    </a>

                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-600">
                            Already have an account? 
                            <a href="{{ route('login') }}" class="font-medium transition-colors" style="color: #001F3F;" onmouseover="this.style.color='#C6A664'" onmouseout="this.style.color='#001F3F'">
                                Sign in here
                            </a>
                        </p>
                    </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for showing/hiding agent sections and profile preview -->
    <script>
        // Password strength checking
        function checkPasswordStrength(password) {
            const strengthIndicator = document.getElementById('password-strength');
            const strengthBars = document.querySelectorAll('.strength-bar');
            const strengthText = document.getElementById('strength-text');
            
            if (!password) {
                strengthIndicator.classList.add('hidden');
                return;
            }
            
            strengthIndicator.classList.remove('hidden');
            
            // Calculate strength score (0-4)
            let score = 0;
            
            // Length check
            if (password.length >= 8) score++;
            
            // Uppercase letter
            if (/[A-Z]/.test(password)) score++;
            
            // Lowercase letter
            if (/[a-z]/.test(password)) score++;
            
            // Number
            if (/[0-9]/.test(password)) score++;
            
            // Special character
            if (/[!@#$%^&*()\-_=+{}|\[\]:;"\'<>?,.\/]/.test(password)) score++;
            
            // Weak passwords
            const weakPasswords = ['password', '12345678', 'qwertyui', 'letmein123', 'welcome123', 'admin123'];
            if (weakPasswords.includes(password.toLowerCase())) {
                score = Math.min(score, 1);
            }
            
            // Update visual indicator
            strengthBars.forEach((bar, index) => {
                if (index < score) {
                    // Color based on strength
                    if (score <= 2) {
                        bar.classList.remove('bg-gray-200', 'bg-yellow-400', 'bg-green-500');
                        bar.classList.add('bg-red-500');
                    } else if (score <= 3) {
                        bar.classList.remove('bg-gray-200', 'bg-red-500', 'bg-green-500');
                        bar.classList.add('bg-yellow-400');
                    } else {
                        bar.classList.remove('bg-gray-200', 'bg-red-500', 'bg-yellow-400');
                        bar.classList.add('bg-green-500');
                    }
                } else {
                    bar.classList.remove('bg-red-500', 'bg-yellow-400', 'bg-green-500');
                    bar.classList.add('bg-gray-200');
                }
            });
            
            // Update text
            const strengthLabels = ['Very Weak', 'Weak', 'Fair', 'Good', 'Strong'];
            const strengthColors = ['text-red-600', 'text-red-600', 'text-yellow-600', 'text-yellow-600', 'text-green-600'];
            
            strengthText.textContent = strengthLabels[Math.min(score, 4)];
            strengthText.className = `text-xs ${strengthColors[Math.min(score, 4)]}`;
        }
        
        function checkPasswordMatch() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            const matchText = document.getElementById('password-match');
            
            if (!confirmPassword) {
                matchText.classList.add('hidden');
                return;
            }
            
            matchText.classList.remove('hidden');
            
            if (password === confirmPassword) {
                matchText.textContent = 'Passwords match';
                matchText.className = 'mt-1 text-xs text-green-600';
            } else {
                matchText.textContent = 'Passwords do not match';
                matchText.className = 'mt-1 text-xs text-red-600';
            }
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            const roleRadios = document.querySelectorAll('input[name="role"]');
            const agentProfileSection = document.getElementById('agent-profile-section');
            const agentDocumentSection = document.getElementById('agent-document-section');
            const agentImageInput = document.getElementById('agent_image');
            const profilePreview = document.getElementById('profile-preview');
            
            function toggleAgentSections() {
                const selectedRole = document.querySelector('input[name="role"]:checked').value;
                const submitBtn = document.getElementById('submit-btn');
                
                if (selectedRole === 'agent') {
                    agentProfileSection.classList.remove('hidden');
                    agentDocumentSection.classList.remove('hidden');
                    submitBtn.innerText = 'Register as Agent';
                } else {
                    agentProfileSection.classList.add('hidden');
                    agentDocumentSection.classList.add('hidden');
                    submitBtn.innerText = 'Sign up as Buyer';
                    // Reset preview when switching away from agent
                    profilePreview.innerHTML = '<svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>';
                }
            }
            
            // Profile picture preview functionality
            if (agentImageInput) {
                agentImageInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            profilePreview.innerHTML = '<img src="' + e.target.result + '" class="w-full h-full object-cover">';
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }
            
            roleRadios.forEach(radio => {
                radio.addEventListener('change', toggleAgentSections);
            });
            
            // Initial check
            toggleAgentSections();
        });
    </script>
</x-guest-layout>
