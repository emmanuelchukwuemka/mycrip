<x-agent-layout>
    <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-bold text-gray-900">Edit Profile</h1>
                    <p class="text-gray-600 mt-2">Update your agent profile information and professional details</p>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('agent.dashboard') }}" 
                       class="inline-flex items-center px-6 py-3 border border-gray-300 text-gray-700 bg-white rounded-lg hover:bg-gray-50 transition-all duration-200 shadow-sm">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Dashboard
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Form Container -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <!-- Header Banner -->
            <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 px-8 py-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-white text-2xl font-bold">Agent Information</h2>
                        <p class="text-indigo-100 text-sm mt-1">Manage your professional profile and contact details</p>
                    </div>
                    <div class="hidden md:block">
                        <svg class="w-16 h-16 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Form Content -->
            <form action="{{ route('agent.profile.update') }}" method="POST" class="p-8" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <!-- Profile Picture Section -->
                <div class="border-t border-gray-200 pt-8 mb-8">
                    <div class="flex flex-col md:flex-row items-center gap-8">
                        <div class="relative group">
                            <img src="{{ auth()->check() && auth()->user()->profile_photo_path ? asset('storage/' . auth()->user()->profile_photo_path) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name ?? 'Agent') . '&background=random&size=200' }}"
                                 alt="Profile Picture"
                                 class="h-32 w-32 rounded-full object-cover border-4 border-gray-200 shadow-lg group-hover:border-indigo-400 transition-all duration-300"
                                 id="profile-preview">
                            <div class="absolute -bottom-3 -right-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white p-3 rounded-full shadow-lg opacity-0 group-hover:opacity-100 transition-all duration-300 transform group-hover:scale-110">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                </svg>
                            </div>
                        </div>
                        
                        <div class="flex-1 space-y-4">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Profile Picture</h3>
                                <p class="text-gray-600 text-sm">Upload a professional photo that represents you to clients</p>
                            </div>
                            
                            <div class="flex items-center space-x-4">
                                <input type="file" name="profile_photo" id="profile_photo" accept="image/*"
                                       class="hidden"
                                       onchange="previewImage(event)">
                                <label for="profile_photo" 
                                       class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-medium rounded-lg hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105 shadow-lg cursor-pointer">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                    </svg>
                                    Upload Photo
                                </label>
                                <button type="button" 
                                        onclick="removeProfilePhoto()"
                                        class="inline-flex items-center px-6 py-3 border border-gray-300 text-gray-700 bg-white rounded-lg hover:bg-gray-50 transition-all duration-200 shadow-sm">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Remove
                                </button>
                            </div>
                            
                            <p class="text-sm text-gray-500">JPG, PNG or GIF up to 5MB. Recommended size: 400x400px</p>
                        </div>
                    </div>
                </div>

                <!-- Profile Information -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z"></path>
                                </svg>
                                Full Name
                            </label>
                            <input type="text" name="name" value="{{ auth()->user()->name ?? '' }}"
                                class="w-full px-4 py-4 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 placeholder-gray-400 text-lg"
                                placeholder="Your full name">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8h18M3 12h18M3 16h18"></path>
                                </svg>
                                Email Address
                            </label>
                            <input type="email" name="email" value="{{ auth()->user()->email ?? '' }}"
                                class="w-full px-4 py-4 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 placeholder-gray-400 text-lg"
                                placeholder="your.email@example.com">
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                Phone Number
                            </label>
                            <input type="tel" name="phone" value="{{ auth()->user()->phone ?? '' }}"
                                class="w-full px-4 py-4 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 placeholder-gray-400 text-lg"
                                placeholder="+234 800 000 0000">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                License Number
                            </label>
                            <input type="text" name="license_number" value="{{ auth()->user()->license_number ?? '' }}"
                                class="w-full px-4 py-4 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 placeholder-gray-400 text-lg"
                                placeholder="Real Estate License Number">
                        </div>
                    </div>
                </div>

                <!-- Professional Bio -->
                <div class="border-t border-gray-200 pt-8 mb-8">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                                Professional Bio
                            </label>
                            <textarea name="bio" rows="5"
                                class="w-full px-4 py-4 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 placeholder-gray-400 resize-none text-lg"
                                placeholder="Tell clients about your experience, specialties, and what makes you unique as a real estate agent...">{{ auth()->user()->bio ?? '' }}</textarea>
                            <p class="mt-2 text-sm text-gray-500">This bio will be displayed on your agent profile page</p>
                        </div>
                    </div>
                </div>

                <!-- Agent Promise Section -->
                <div class="border-t border-gray-200 pt-8 mb-8 bg-gradient-to-r from-indigo-50 to-purple-50 rounded-xl p-6">
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2 flex items-center">
                                <svg class="w-6 h-6 mr-3 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Agent Promise
                            </h3>
                            <p class="text-gray-600">This is your professional promise to clients. It will be prominently displayed on your profile and property listings.</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">Your Promise Statement</label>
                            <textarea name="agent_promise" rows="4"
                                class="w-full px-4 py-4 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 placeholder-gray-400 resize-none text-lg"
                                placeholder="e.g. 'I promise to find you the perfect home with exceptional service and local expertise'">{{ auth()->user()->agent_promise ?? '' }}</textarea>
                            <p class="mt-2 text-sm text-gray-500">This will appear on your profile and property listings</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-3 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Years of Experience
                                </label>
                                <input type="number" name="experience_years" value="{{ auth()->user()->experience_years ?? '' }}"
                                    class="w-full px-4 py-4 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 placeholder-gray-400 text-lg"
                                    placeholder="5">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-3 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                    </svg>
                                    Specialties
                                </label>
                                <input type="text" name="specialties" value="{{ auth()->user()->specialties ?? '' }}"
                                    class="w-full px-4 py-4 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200 placeholder-gray-400 text-lg"
                                    placeholder="Luxury Homes, First-time Buyers, Investment Properties">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Verification Status -->
                @if(auth()->check() && auth()->user()->is_verified)
                    <div class="border-t border-gray-200 pt-8 mb-8">
                        <div class="flex items-center space-x-4 bg-green-50 border border-green-200 rounded-lg p-6">
                            <div class="bg-green-100 p-3 rounded-full">
                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-green-900 text-lg">Verified Agent</h4>
                                <p class="text-green-700">Your profile has been verified by MyCrib. This badge appears on your listings and profile.</p>
                            </div>
                        </div>
                    </div>
                @elseif(auth()->check() && !auth()->user()->is_verified)
                    <div class="border-t border-gray-200 pt-8 mb-8">
                        <div class="flex items-center space-x-4 bg-yellow-50 border border-yellow-200 rounded-lg p-6">
                            <div class="bg-yellow-100 p-3 rounded-full">
                                <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-yellow-900 text-lg">Pending Verification</h4>
                                <p class="text-yellow-700">Submit your license documents for verification to unlock premium features and client trust.</p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Submit Section -->
                <div class="flex items-center justify-between pt-8 border-t border-gray-200">
                    <div class="text-sm text-gray-500">
                        Last updated: {{ auth()->check() && auth()->user()->updated_at ? auth()->user()->updated_at->format('M d, Y \a\t h:i A') : 'Never' }}
                    </div>
                    
                    <div class="flex space-x-4">
                        <a href="{{ route('agent.dashboard') }}" 
                           class="inline-flex items-center px-8 py-4 border border-gray-300 text-gray-700 bg-white rounded-lg hover:bg-gray-50 transition-all duration-200 shadow-sm">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Cancel
                        </a>
                        
                        <button type="submit"
                            class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-medium rounded-lg hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Update Profile
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript for Profile Picture -->
    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('profile-preview');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.add('ring-4', 'ring-indigo-400', 'ring-opacity-50');
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeProfilePhoto() {
            const preview = document.getElementById('profile-preview');
            const currentPhoto = preview.src;
            
            // Check if it's a generated avatar (ui-avatars.com)
            if (currentPhoto.includes('ui-avatars.com')) {
                alert('Cannot remove default avatar. Please upload a custom photo first.');
                return;
            }
            
            // Reset to default avatar
            const userName = "{{ auth()->user()->name ?? 'Agent' }}";
            preview.src = `https://ui-avatars.com/api/?name=${encodeURIComponent(userName)}&background=random&size=200`;
            preview.classList.remove('ring-4', 'ring-indigo-400', 'ring-opacity-50');
            
            // Clear the file input
            document.getElementById('profile_photo').value = '';
        }
    </script>
</x-agent-layout>
