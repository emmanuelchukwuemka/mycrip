<x-guest-layout>
    <div class="min-h-screen bg-white flex">
        <!-- Left Side: Image -->
        <div class="hidden lg:block relative w-0 flex-1">
            <img class="absolute inset-0 h-full w-full object-cover" src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" alt="Luxury Real Estate">
            <div class="absolute inset-0 bg-indigo-900 opacity-20"></div>
        </div>

        <!-- Right Side: Form -->
        <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <div>
                    <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                        Create an account
                    </h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Already have an account?
                        <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                            Sign in
                        </a>
                    </p>
                </div>

                <div class="mt-8">
                    <div class="mt-6">
                        <form action="{{ route('register') }}" method="POST" class="space-y-6" enctype="multipart/form-data">
                            @csrf

                            <div>
                                <label class="text-base font-medium text-gray-900">Account Type</label>
                                <p class="text-sm leading-5 text-gray-500">Select how you want to use MyCrib Africa.</p>
                                <fieldset class="mt-4">
                                    <legend class="sr-only">Account Type</legend>
                                    <div class="space-y-4 sm:flex sm:items-center sm:space-y-0 sm:space-x-10">
                                        <div class="flex items-center">
                                            <input id="role_user" name="role" type="radio" value="user" checked class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                            <label for="role_user" class="ml-3 block text-sm font-medium text-gray-700">
                                                I am a Buyer / Renter
                                            </label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="role_agent" name="role" type="radio" value="agent" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                            <label for="role_agent" class="ml-3 block text-sm font-medium text-gray-700">
                                                I am an Agent
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>

                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">
                                    Full Name
                                </label>
                                <div class="mt-1">
                                    <input id="name" name="name" type="text" autocomplete="name" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">
                                    Email address
                                </label>
                                <div class="mt-1">
                                    <input id="email" name="email" type="email" autocomplete="email" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700">
                                    Password
                                </label>
                                <div class="mt-1">
                                    <input id="password" name="password" type="password" autocomplete="new-password" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                                    Confirm Password
                                </label>
                                <div class="mt-1">
                                    <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                            </div>

                            <!-- Agent Verification Document -->
                            <div id="agent-document-section" class="mt-4 hidden">
                                <label for="agent_verification_document" class="block text-sm font-medium text-gray-700">
                                    Agent Verification Document
                                </label>
                                <div class="mt-1">
                                    <input id="agent_verification_document" name="agent_verification_document" type="file" accept="image/*,.pdf" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                                <p class="mt-1 text-sm text-gray-600">Upload your identification document (ID card, license, etc.) for verification purposes.</p>
                            </div>

                            <div>
                                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Sign up
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for showing/hiding agent document section -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roleRadios = document.querySelectorAll('input[name="role"]');
            const agentDocumentSection = document.getElementById('agent-document-section');
            
            function toggleAgentDocumentSection() {
                const selectedRole = document.querySelector('input[name="role"]:checked').value;
                if (selectedRole === 'agent') {
                    agentDocumentSection.classList.remove('hidden');
                } else {
                    agentDocumentSection.classList.add('hidden');
                }
            }
            
            roleRadios.forEach(radio => {
                radio.addEventListener('change', toggleAgentDocumentSection);
            });
            
            // Initial check
            toggleAgentDocumentSection();
        });
    </script>
</x-guest-layout>
