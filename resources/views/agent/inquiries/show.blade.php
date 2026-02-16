<x-agent-layout>
    <div class="max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-bold text-gray-900">Inquiry Details</h1>
                    <p class="text-gray-600 mt-2">View and respond to client inquiry</p>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('agent.inquiries.index') }}" 
                       class="inline-flex items-center px-6 py-3 border border-gray-300 text-gray-700 bg-white rounded-lg hover:bg-gray-50 transition-all duration-200 shadow-sm">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Inquiries
                    </a>
                </div>
            </div>
        </div>

        <!-- Inquiry Details -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Inquiry Information -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Client Info Card -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="px-8 py-6 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-white text-2xl font-bold">Client Information</h2>
                                <p class="text-indigo-100 text-sm mt-1">Details about the person who made the inquiry</p>
                            </div>
                            <div class="bg-white bg-opacity-20 p-3 rounded-full">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="p-8">
                        <div class="flex items-center space-x-6">
                            <div class="flex-shrink-0">
                                <div class="h-20 w-20 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white text-2xl font-bold">
                                    JD
                                </div>
                            </div>
                            <div class="flex-1">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">John Doe</h3>
                                        <p class="text-gray-600">Client Name</p>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">john@example.com</h3>
                                        <p class="text-gray-600">Email Address</p>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">+234 800 000 0000</h3>
                                        <p class="text-gray-600">Phone Number</p>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">Lagos, Nigeria</h3>
                                        <p class="text-gray-600">Location</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Property Info Card -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="px-8 py-6 bg-gradient-to-r from-green-600 via-blue-600 to-teal-600">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-white text-2xl font-bold">Property Information</h2>
                                <p class="text-green-100 text-sm mt-1">Details about the property being inquired about</p>
                            </div>
                            <div class="bg-white bg-opacity-20 p-3 rounded-full">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" 
                                     alt="Property Image" 
                                     class="w-full h-64 object-cover rounded-lg shadow-lg">
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900">Modern Apartment in Lekki</h3>
                                <p class="text-gray-600 mt-2">3 Bedrooms, 2 Bathrooms</p>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-bold text-gray-900">₦15,000,000</div>
                                <div class="text-gray-600">For Sale</div>
                            </div>
                            <div class="md:col-span-2">
                                <div class="grid grid-cols-3 gap-4 text-center">
                                    <div>
                                        <div class="text-lg font-semibold text-gray-900">3</div>
                                        <div class="text-gray-600">Bedrooms</div>
                                    </div>
                                    <div>
                                        <div class="text-lg font-semibold text-gray-900">2</div>
                                        <div class="text-gray-600">Bathrooms</div>
                                    </div>
                                    <div>
                                        <div class="text-lg font-semibold text-gray-900">150</div>
                                        <div class="text-gray-600">sqm</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Message Card -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="px-8 py-6 bg-gradient-to-r from-orange-600 via-red-600 to-pink-600">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-white text-2xl font-bold">Inquiry Message</h2>
                                <p class="text-orange-100 text-sm mt-1">The message sent by the client</p>
                            </div>
                            <div class="bg-white bg-opacity-20 p-3 rounded-full">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="p-8">
                        <div class="bg-gray-50 rounded-lg p-6">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 h-12 w-12 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white font-semibold">
                                    JD
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center space-x-4 mb-2">
                                        <h4 class="text-lg font-semibold text-gray-900">John Doe</h4>
                                        <span class="text-sm text-gray-500">2 hours ago</span>
                                    </div>
                                    <p class="text-gray-700 leading-relaxed">
                                        I'm interested in viewing this property. Can we schedule a viewing this weekend? 
                                        I would like to see the property in person before making any decisions. 
                                        Please let me know what times are available.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions Sidebar -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Status Card -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Inquiry Status</h3>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-center py-8">
                            <span class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                New Inquiry
                            </span>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between text-sm text-gray-600">
                                <span>Received:</span>
                                <span>2 hours ago</span>
                            </div>
                            <div class="flex items-center justify-between text-sm text-gray-600">
                                <span>Property:</span>
                                <span>Modern Apartment</span>
                            </div>
                            <div class="flex items-center justify-between text-sm text-gray-600">
                                <span>Priority:</span>
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full">High</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Quick Actions</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <button class="w-full inline-flex items-center px-4 py-3 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition-colors duration-200 shadow-lg">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Send Email Response
                        </button>
                        
                        <button class="w-full inline-flex items-center px-4 py-3 border border-gray-300 text-gray-700 bg-white font-medium rounded-lg hover:bg-gray-50 transition-colors duration-200">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            Call Client
                        </button>
                        
                        <button class="w-full inline-flex items-center px-4 py-3 border border-gray-300 text-gray-700 bg-white font-medium rounded-lg hover:bg-gray-50 transition-colors duration-200">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                            </svg>
                            Schedule Viewing
                        </button>
                        
                        <button class="w-full inline-flex items-center px-4 py-3 border border-gray-300 text-gray-700 bg-white font-medium rounded-lg hover:bg-gray-50 transition-colors duration-200">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Mark as Read
                        </button>
                    </div>
                </div>

                <!-- Related Properties -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Related Properties</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="space-y-3">
                            <div class="flex items-center space-x-3">
                                <div class="h-12 w-12 bg-gray-200 rounded-lg"></div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">Similar Apartment</div>
                                    <div class="text-xs text-gray-500">Lekki, Lagos</div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="h-12 w-12 bg-gray-200 rounded-lg"></div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">Nearby Property</div>
                                    <div class="text-xs text-gray-500">Victoria Island</div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="h-12 w-12 bg-gray-200 rounded-lg"></div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">Budget Option</div>
                                    <div class="text-xs text-gray-500">Ikeja, Lagos</div>
                                </div>
                            </div>
                        </div>
                        <button class="w-full mt-4 inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 bg-white font-medium rounded-lg hover:bg-gray-50 transition-colors duration-200 text-sm">
                            View All Properties
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-agent-layout>