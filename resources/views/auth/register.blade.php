<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50 flex">
        <!-- Left Side: Image -->
        <div class="hidden lg:block relative w-0 flex-1">
            <img class="absolute inset-0 h-full w-full object-cover" src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" alt="Luxury Real Estate">
            <div class="absolute inset-0 bg-gradient-to-r from-indigo-600/80 to-purple-600/80"></div>
            <div class="absolute inset-0 bg-black/20"></div>
        </div>

        <!-- Right Side: Form -->
        <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
            <div class="mx-auto w-full max-w-md lg:w-96">
                <div class="text-center mb-8">
                    <a href="{{ route('home') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-700 transition-colors">
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
                        <p class="text-gray-600 mb-8">
                            Create your account to get started
                        </p>
                    </div>

                    <form action="{{ route('register') }}" method="POST" class="space-y-6" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Account Type</label>
                            <p class="text-sm text-gray-600 mb-4">Select how you want to use MyCrib Africa</p>
                            <div class="grid grid-cols-2 gap-4">
                                <label class="relative cursor-pointer group">
                                    <input type="radio" name="role" value="user" checked class="sr-only peer">
                                    <div class="p-4 border-2 border-gray-200 rounded-lg peer-checked:border-indigo-500 peer-checked:bg-indigo-50/50 transition-all duration-200 group-hover:border-gray-300">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 w-6 h-6 bg-indigo-100 rounded-full flex items-center justify-center mr-3">
                                                <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
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
                                    <input type="radio" name="role" value="agent" class="sr-only peer">
                                    <div class="p-4 border-2 border-gray-200 rounded-lg peer-checked:border-indigo-500 peer-checked:bg-indigo-50/50 transition-all duration-200 group-hover:border-gray-300">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 w-6 h-6 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                                <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
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
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 bg-white/50 backdrop-blur-sm">
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                                Confirm Password
                            </label>
                            <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required 
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 bg-white/50 backdrop-blur-sm">
                        </div>

                        <!-- Agent Profile Picture -->
                        <div id="agent-profile-section" class="mt-4 hidden">
                            <label for="profile_picture" class="block text-sm font-medium text-gray-700 mb-2">
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
                                    <input id="profile_picture" name="profile_picture" type="file" accept="image/*" 
                                           class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 bg-white/50 backdrop-blur-sm">
                                    <p class="mt-2 text-sm text-gray-600">Upload a professional profile picture for your agent account.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Agent Verification Document -->
                        <div id="agent-document-section" class="mt-4 hidden">
                            <label for="agent_verification_document" class="block text-sm font-medium text-gray-700 mb-2">
                                Agent Verification Document
                            </label>
                            <input id="agent_verification_document" name="agent_verification_document" type="file" accept="image/*,.pdf" 
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 bg-white/50 backdrop-blur-sm">
                            <p class="mt-2 text-sm text-gray-600">Upload your identification document (ID card, license, etc.) for verification purposes.</p>
                        </div>

                        <div>
<button type="submit" 
                                    class="w-full btn-auth text-white py-3 px-4 rounded-lg font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-[#001F3F] focus:ring-offset-2">
                                Create Account
                            </button>
                        </div>
                    </form>

                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-600">
                            Already have an account? 
                            <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-700 transition-colors">
                                Sign in here
                            </a>
                        </p>
                    </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for showing/hiding agent sections and profile preview -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roleRadios = document.querySelectorAll('input[name="role"]');
            const agentProfileSection = document.getElementById('agent-profile-section');
            const agentDocumentSection = document.getElementById('agent-document-section');
            const profilePictureInput = document.getElementById('profile_picture');
            const profilePreview = document.getElementById('profile-preview');
            
            function toggleAgentSections() {
                const selectedRole = document.querySelector('input[name="role"]:checked').value;
                if (selectedRole === 'agent') {
                    agentProfileSection.classList.remove('hidden');
                    agentDocumentSection.classList.remove('hidden');
                } else {
                    agentProfileSection.classList.add('hidden');
                    agentDocumentSection.classList.add('hidden');
                    // Reset preview when switching away from agent
                    profilePreview.innerHTML = '<svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>';
                }
            }
            
            // Profile picture preview functionality
            if (profilePictureInput) {
                profilePictureInput.addEventListener('change', function(e) {
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
