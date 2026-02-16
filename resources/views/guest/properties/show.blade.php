<x-app-layout>
    <div class="bg-gray-100 min-h-screen py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <nav class="flex mb-6" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-4">
                    <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-gray-500">Home</a></li>
                    <li><span class="text-gray-300">/</span></li>
                    <li><a href="{{ route('properties.index') }}" class="text-gray-400 hover:text-gray-500">Properties</a></li>
                    <li><span class="text-gray-300">/</span></li>
                    <li class="text-gray-600 font-medium">Modern Apartment in Lagos</li>
                </ol>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <!-- Image Gallery -->
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
                        <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80" alt="Main Image" class="w-full h-96 object-cover">
                        <div class="p-4 grid grid-cols-4 gap-4">
                            <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80" class="w-full h-24 object-cover rounded cursor-pointer hover:opacity-75">
                            <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80" class="w-full h-24 object-cover rounded cursor-pointer hover:opacity-75">
                            <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80" class="w-full h-24 object-cover rounded cursor-pointer hover:opacity-75">
                            <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80" class="w-full h-24 object-cover rounded cursor-pointer hover:opacity-75 relative">
                        </div>
                    </div>

                    <!-- Details -->
                    <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <h1 class="text-3xl font-bold text-gray-900">Modern Apartment in Lagos</h1>
                                <p class="text-gray-500 mt-2 flex items-center">
                                    <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    123 Victoria Island, Lagos, Nigeria
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="text-3xl font-bold text-indigo-600">₦1.5M</p>
                                <p class="text-gray-500">per year</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-6 mb-8 border-t border-b py-6 text-center">
                            <div>
                                <span class="block text-2xl font-bold text-gray-800">3</span>
                                <span class="text-gray-500">Bedrooms</span>
                            </div>
                            <div>
                                <span class="block text-2xl font-bold text-gray-800">2</span>
                                <span class="text-gray-500">Bathrooms</span>
                            </div>
                            <div>
                                <span class="block text-2xl font-bold text-gray-800">120</span>
                                <span class="text-gray-500">Sqm</span>
                            </div>
                        </div>

                        <div class="prose max-w-none text-gray-700">
                            <h3 class="text-xl font-semibold mb-4">Description</h3>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                            </p>
                            <p class="mt-4">
                                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </p>
                        </div>

                        <div class="mt-8">
                            <h3 class="text-xl font-semibold mb-4">Features</h3>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                <div class="flex items-center text-gray-600">
                                    <svg class="h-5 w-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    Swimming Pool
                                </div>
                                <div class="flex items-center text-gray-600">
                                    <svg class="h-5 w-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    24/7 Security
                                </div>
                                <div class="flex items-center text-gray-600">
                                    <svg class="h-5 w-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    Gymnasium
                                </div>
                                <div class="flex items-center text-gray-600">
                                    <svg class="h-5 w-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    Parking Space
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Map (Placeholder) -->
                    <div class="bg-gray-200 rounded-lg shadow-lg h-96 flex items-center justify-center">
                        <span class="text-gray-500 font-semibold">Map Integration Placeholder</span>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-lg p-6 sticky top-8">
                        <div class="flex items-center mb-6">
                            <img class="h-16 w-16 rounded-full object-cover mr-4" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Agent">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">John Doe</h3>
                                <p class="text-sm text-gray-500">Verified Agent</p>
                                <div class="flex mt-1 text-yellow-400">
                                    ★★★★★ <span class="text-gray-400 text-xs ml-1">(12 reviews)</span>
                                </div>
                            </div>
                        </div>

                        <form>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Your Name</label>
                                <input type="text" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                                <input type="tel" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                                <textarea rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">I am interested in this property...</textarea>
                            </div>
                            <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-2 px-4 rounded-md hover:bg-indigo-700 transition duration-150">
                                Send Inquiry
                            </button>
                        </form>
                        
                        <div class="mt-6 border-t pt-6 text-center">
                            <a href="#" class="text-indigo-600 font-medium hover:text-indigo-800">View Agent Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
