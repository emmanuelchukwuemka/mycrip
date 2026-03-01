<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div class="text-center">
                <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                    Two-Factor Authentication
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    Enter your authentication code to continue
                </p>
            </div>

            <div class="bg-white shadow-xl rounded-2xl p-8">
                <div class="text-center mb-8">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-blue-100">
                        <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Authentication Required</h3>
                    <p class="mt-2 text-sm text-gray-600">
                        Open your two-factor authentication app to get your verification code.
                    </p>
                </div>

                @if(session('resent'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">
                        {{ session('resent') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('2fa.verify.post') }}" class="space-y-6">
                    @csrf
                    <div>
                        <label for="code" class="block text-sm font-medium text-gray-700 mb-2">
                            Authentication Code
                        </label>
                        <input id="code" name="code" type="text" required 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 text-center text-lg tracking-widest"
                               placeholder="123456"
                               maxlength="10"
                               autocomplete="off">
                        <p class="mt-2 text-xs text-gray-500">
                            Enter 6-digit code from your app or 10-character recovery code
                        </p>
                    </div>

                    <div class="space-y-4">
                        <button type="submit" 
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                            Verify
                        </button>
                        
                        <button type="button" 
                                onclick="document.getElementById('code').value = '';"
                                class="w-full flex justify-center py-3 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                            Clear Code
                        </button>
                    </div>
                </form>

                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="text-center">
                        <h4 class="text-sm font-medium text-gray-900 mb-3">Need help?</h4>
                        <div class="space-y-2 text-sm text-gray-600">
                            <p>• Use a recovery code if you can't access your authenticator app</p>
                            <p>• Each recovery code can only be used once</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <form method="POST" action="{{ route('logout') }}" class="inline-block">
                    @csrf
                    <button type="submit" class="text-sm font-medium text-gray-600 hover:text-gray-500">
                        Sign out of all devices
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>