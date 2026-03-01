<x-agent-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Subscription Plans</h1>
            <p class="mt-2 text-gray-600">Choose a plan that fits your business needs</p>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        <!-- Current Subscription Info -->
        @if($currentSubscription)
            <div class="mb-8 bg-blue-50 border border-blue-200 rounded-lg p-6">
                <h2 class="text-xl font-semibold text-blue-900 mb-2">Current Subscription</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <p class="text-sm text-blue-700">Plan</p>
                        <p class="font-medium">{{ $currentSubscription->plan->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-blue-700">Status</p>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ ucfirst($currentSubscription->status) }}
                        </span>
                    </div>
                    <div>
                        <p class="text-sm text-blue-700">Expires</p>
                        <p class="font-medium">{{ $currentSubscription->end_date->format('M d, Y') }}</p>
                    </div>
                </div>
                @if($currentSubscription->isActive())
                    <form method="POST" action="{{ route('agent.subscription.cancel', $currentSubscription) }}" class="mt-4 inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                onclick="return confirm('Are you sure you want to cancel this subscription?')"
                                class="px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-colors">
                            Cancel Subscription
                        </button>
                    </form>
                @endif
            </div>
        @endif

        <!-- Subscription Plans -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($plans as $plan)
                <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900">{{ $plan->name }}</h3>
                        <p class="mt-2 text-gray-600">{{ $plan->description }}</p>
                        
                        <div class="mt-4">
                            <div class="text-3xl font-bold text-gray-900">{{ $plan->formatted_price }}</div>
                            <div class="text-gray-600">{{ $plan->interval_display }}</div>
                        </div>

                        <ul class="mt-6 space-y-2">
                            @foreach($plan->features as $feature)
                                <li class="flex items-center">
                                    <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="text-gray-600">{{ $feature }}</span>
                                </li>
                            @endforeach
                        </ul>

                        <form method="POST" action="{{ route('agent.subscribe', $plan) }}" class="mt-6">
                            @csrf
                            <button type="submit" 
                                    class="w-full px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                                @if($currentSubscription && $currentSubscription->plan_id == $plan->id)
                                    Current Plan
                                @else
                                    Subscribe Now
                                @endif
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Billing History Link -->
        <div class="mt-8">
            <a href="{{ route('agent.billing.history') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-600 text-white font-medium rounded-lg hover:bg-gray-700 transition-colors">
                View Billing History
            </a>
        </div>
    </div>
</x-agent-layout>