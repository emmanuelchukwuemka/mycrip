<x-agent-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Billing History</h1>
            <p class="mt-2 text-gray-600">Track your subscription payments and activity</p>
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

        <div class="bg-white shadow overflow-hidden sm:rounded-md">
            <ul class="divide-y divide-gray-200">
                @forelse($subscriptions as $subscription)
                    <li class="px-6 py-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $subscription->plan->name }}
                                </div>
                                <div class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($subscription->isActive())
                                        bg-green-100 text-green-800
                                    @elseif($subscription->isCancelled())
                                        bg-yellow-100 text-yellow-800
                                    @elseif($subscription->isExpired())
                                        bg-red-100 text-red-800
                                    @else
                                        bg-gray-100 text-gray-800
                                    @endif">
                                    {{ ucfirst($subscription->status) }}
                                </div>
                            </div>
                            <div class="text-sm text-gray-500">
                                {{ $subscription->created_at->format('M d, Y') }}
                            </div>
                        </div>
                        
                        <div class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                            <div>
                                <p class="text-gray-500">Amount</p>
                                <p class="font-medium">{{ $subscription->formatted_amount }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500">Start Date</p>
                                <p class="font-medium">{{ $subscription->start_date->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500">End Date</p>
                                <p class="font-medium">{{ $subscription->end_date->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500">Interval</p>
                                <p class="font-medium">{{ ucfirst($subscription->interval) }}</p>
                            </div>
                        </div>
                        
                        @if($subscription->cancelled_at)
                            <div class="mt-2 text-sm text-gray-500">
                                Cancelled on: {{ $subscription->cancelled_at->format('M d, Y') }}
                            </div>
                        @endif
                    </li>
                @empty
                    <li class="px-6 py-12 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No billing history</h3>
                        <p class="mt-1 text-sm text-gray-500">
                            Get started by subscribing to a plan to see your billing history here.
                        </p>
                        <div class="mt-6">
                            <a href="{{ route('agent.billing.plans') }}" 
                               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                                Browse Plans
                            </a>
                        </div>
                    </li>
                @endforelse
            </ul>
        </div>

        <!-- Back to Plans Link -->
        <div class="mt-8">
            <a href="{{ route('agent.billing.plans') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-600 text-white font-medium rounded-lg hover:bg-gray-700 transition-colors">
                Back to Plans
            </a>
        </div>
    </div>
</x-agent-layout>