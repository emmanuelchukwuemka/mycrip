<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Recovery Codes</h1>
                <p class="mt-2 text-gray-600">Store these codes in a secure location</p>
            </div>

            <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
                <div class="p-8">
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-8">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-yellow-700">
                                    <strong>Important:</strong> Each recovery code can only be used once. Store them securely and never share them.
                                </p>
                            </div>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        @foreach($user2fa->recovery_codes as $index => $code)
                            <div class="flex items-center justify-between bg-gray-50 p-4 rounded-lg border">
                                <code class="text-lg font-mono font-bold text-gray-800 tracking-wider">
                                    {{ $code }}
                                </code>
                                <span class="text-xs text-gray-500">
                                    #{{ $index + 1 }}
                                </span>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t border-gray-200 pt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">How to use recovery codes:</h3>
                        <ul class="space-y-2 text-gray-600">
                            <li class="flex items-start">
                                <span class="text-green-500 mr-2">✓</span>
                                <span>Use these codes when you can't access your authenticator app</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-green-500 mr-2">✓</span>
                                <span>Each code can only be used once</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-green-500 mr-2">✓</span>
                                <span>Store them in a password manager or secure physical location</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-red-500 mr-2">✗</span>
                                <span>Never share these codes with anyone</span>
                            </li>
                        </ul>
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="flex flex-col sm:flex-row gap-4">
                            <form method="POST" action="{{ route('2fa.regenerate') }}" class="flex-1">
                                @csrf
                                <div class="mb-4">
                                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                        Confirm your password to regenerate codes
                                    </label>
                                    <input type="password" name="password" id="password" required
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    @error('password')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <button type="submit"
                                        onclick="return confirm('This will invalidate all current recovery codes. Are you sure?')"
                                        class="w-full sm:w-auto px-6 py-3 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors">
                                    Regenerate Recovery Codes
                                </button>
                            </form>

                            <div class="flex-1">
                                <button onclick="window.print()"
                                        class="w-full sm:w-auto px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors mb-3">
                                    Print Codes
                                </button>
                                <a href="{{ route('2fa.setup') }}"
                                   class="w-full sm:w-auto inline-block text-center px-6 py-3 bg-gray-600 text-white font-medium rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                                    Back to 2FA Setup
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 text-center">
                <a href="{{ route('dashboard') }}" class="text-blue-600 hover:text-blue-500 font-medium">
                    ← Back to Dashboard
                </a>
            </div>
        </div>
    </div>

    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            .print-area, .print-area * {
                visibility: visible;
            }
            .print-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
        }
    </style>
</x-app-layout>