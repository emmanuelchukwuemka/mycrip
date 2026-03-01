<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div class="text-center">
                <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                    Set up Two-Factor Authentication
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    Scan the QR code with your authenticator app
                </p>
            </div>

            <div class="bg-white shadow-xl rounded-2xl p-8">
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                @if(!$user2fa->enabled)
                    <div class="text-center mb-8">
                        <div class="mb-6">
                            {!! $inlineUrl !!}
                        </div>
                        
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-600 mb-2">Manual entry code:</p>
                            <code class="text-lg font-mono bg-white px-3 py-2 rounded border">
                                {{ $user2fa->secret }}
                            </code>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('2fa.enable') }}" class="space-y-6">
                        @csrf
                        <div>
                            <label for="code" class="block text-sm font-medium text-gray-700 mb-2">
                                Enter 6-digit code from your authenticator app
                            </label>
                            <input id="code" name="code" type="text" required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                   placeholder="123456"
                                   maxlength="6">
                            @error('code')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <button type="submit" 
                                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                                Enable Two-Factor Authentication
                            </button>
                        </div>
                    </form>

                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Recovery Codes</h3>
                        <p class="text-sm text-gray-600 mb-4">
                            Store these recovery codes in a secure location. They can be used to access your account if you lose your phone.
                        </p>
                        <div class="grid grid-cols-2 gap-2 bg-gray-50 p-4 rounded-lg">
                            @foreach($user2fa->recovery_codes as $code)
                                <code class="text-sm font-mono bg-white px-2 py-1 rounded border text-center">
                                    {{ $code }}
                                </code>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="text-center">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">2FA is already enabled</h3>
                        <p class="text-gray-600 mb-6">Your account is protected with two-factor authentication.</p>
                        
                        <div class="space-y-3">
                            <a href="{{ route('2fa.recovery') }}" 
                               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                View Recovery Codes
                            </a>
                            
                            <form method="POST" action="{{ route('2fa.disable') }}" class="inline-block">
                                @csrf
                                <button type="submit" 
                                        onclick="return confirm('Are you sure you want to disable 2FA? This will reduce your account security.')"
                                        class="ml-3 inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    Disable 2FA
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>

            <div class="text-center">
                <a href="{{ route('dashboard') }}" class="text-sm font-medium text-blue-600 hover:text-blue-500">
                    ← Back to Dashboard
                </a>
            </div>
        </div>
    </div>
</x-app-layout>