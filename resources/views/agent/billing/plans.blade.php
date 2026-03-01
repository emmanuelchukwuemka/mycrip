<x-agent-layout>
<div class="space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-black text-gray-900 tracking-tight">Subscription Plans</h1>
            <p class="text-sm text-gray-500 mt-0.5">Choose a plan that fits your business needs</p>
        </div>
        @php $currentSubscription = Auth::user()->subscriptions()->where('status','active')->orderByDesc('created_at')->first(); @endphp
        @if($currentSubscription && $currentSubscription->isActive())
            <div class="flex items-center gap-2.5 px-4 py-2 rounded-xl border"
                 style="background:rgba(52,211,153,0.08); border-color:rgba(52,211,153,0.25)">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span class="text-sm font-bold text-emerald-700">Active: {{ $currentSubscription->plan->name ?? 'Plan' }}</span>
                <span class="text-xs text-emerald-600">· Renews {{ $currentSubscription->end_date->format('M d, Y') }}</span>
            </div>
        @else
            <div class="flex items-center gap-2 px-4 py-2 rounded-xl bg-gray-100 border border-gray-200">
                <span class="text-sm font-semibold text-gray-500">Free Tier</span>
            </div>
        @endif
    </div>

    {{-- Session messages --}}
    @if(session('success'))
        <div class="flex items-center gap-3 px-5 py-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm font-semibold">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="flex items-center gap-3 px-5 py-3.5 rounded-xl bg-red-50 border border-red-200 text-red-700 text-sm font-semibold">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/></svg>
            {{ session('error') }}
        </div>
    @endif

    {{-- Plans grid --}}
    @if(!$plans || $plans->isEmpty())
        {{-- No plans seeded yet — show a placeholder --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach([
                ['name'=>'Starter','price'=>'₦9,900','interval'=>'monthly','color'=>'#001F3F','features'=>['Up to 5 listings','Basic analytics','Email support','Standard placement']],
                ['name'=>'Professional','price'=>'₦24,900','interval'=>'monthly','color'=>'#C6A664','features'=>['Up to 25 listings','Advanced analytics','Priority support','Featured placement','Document uploads'],'popular'=>true],
                ['name'=>'Enterprise','price'=>'₦59,900','interval'=>'monthly','color'=>'#001F3F','features'=>['Unlimited listings','Full analytics suite','Dedicated support','Top featured placement','All premium features']],
            ] as $plan)
                <div class="relative bg-white rounded-2xl border shadow-sm overflow-hidden transition-all duration-300 hover:shadow-lg hover:-translate-y-1
                            {{ isset($plan['popular']) ? 'ring-2' : '' }}"
                     style="{{ isset($plan['popular']) ? 'border-color:#C6A664; ring-color:#C6A664;' : 'border-color:#e5e7eb;' }}">
                    @if(isset($plan['popular']))
                        <div class="absolute top-0 inset-x-0 h-0.5" style="background:linear-gradient(90deg,#C6A664,#a8894e)"></div>
                        <div class="absolute top-3 right-3">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-widest text-white"
                                  style="background:linear-gradient(135deg,#C6A664,#a8894e)">Most Popular</span>
                        </div>
                    @endif

                    <div class="p-6">
                        <p class="text-[11px] font-black uppercase tracking-widest text-gray-400 mb-2">{{ $plan['name'] }}</p>
                        <div class="flex items-baseline gap-1 mb-1">
                            <span class="text-3xl font-black text-gray-900">{{ $plan['price'] }}</span>
                            <span class="text-sm text-gray-400 font-medium">/{{ $plan['interval'] }}</span>
                        </div>

                        <div class="mt-5 space-y-2.5">
                            @foreach($plan['features'] as $feature)
                                <div class="flex items-center gap-2.5">
                                    <div class="w-4 h-4 rounded-full flex items-center justify-center flex-shrink-0"
                                         style="background:{{ $plan['color'] }}20">
                                        <svg class="w-2.5 h-2.5" style="color:{{ $plan['color'] }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                                        </svg>
                                    </div>
                                    <span class="text-sm text-gray-600">{{ $feature }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6">
                            <div class="w-full py-2.5 px-4 rounded-xl text-sm font-bold text-center border-2 transition-all duration-200"
                                 style="{{ isset($plan['popular']) ? 'background:linear-gradient(135deg,#C6A664,#a8894e); color:#001F3F; border-color:transparent;' : 'background:transparent; color:#001F3F; border-color:#001F3F;' }}">
                                {{ isset($currentSubscription) && $currentSubscription ? 'Switch Plan' : 'Get Started' }}
                            </div>
                            <p class="text-center text-[11px] text-gray-400 mt-2">Plans coming soon — contact us to subscribe</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($plans as $plan)
                @php $isCurrentPlan = $currentSubscription && $currentSubscription->plan_id === $plan->id; @endphp
                <div class="relative bg-white rounded-2xl border shadow-sm overflow-hidden transition-all duration-300 hover:shadow-lg hover:-translate-y-1
                            {{ $plan->is_featured ? 'ring-2' : '' }}"
                     style="{{ $plan->is_featured ? 'border-color:#C6A664;' : 'border-color:#e5e7eb;' }}">
                    @if($plan->is_featured)
                        <div class="absolute top-0 inset-x-0 h-0.5" style="background:linear-gradient(90deg,#C6A664,#a8894e)"></div>
                        <div class="absolute top-3 right-3">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-widest text-white"
                                  style="background:linear-gradient(135deg,#C6A664,#a8894e)">Most Popular</span>
                        </div>
                    @endif

                    <div class="p-6">
                        <p class="text-[11px] font-black uppercase tracking-widest text-gray-400 mb-2">{{ $plan->name }}</p>
                        <div class="flex items-baseline gap-1 mb-1">
                            <span class="text-3xl font-black text-gray-900">
                                {{ $plan->currency ?? '₦' }}{{ number_format($plan->price) }}
                            </span>
                            <span class="text-sm text-gray-400 font-medium">/{{ $plan->interval }}</span>
                        </div>
                        @if($plan->description)
                            <p class="text-xs text-gray-500 mt-1">{{ $plan->description }}</p>
                        @endif

                        @if($plan->features)
                            <div class="mt-5 space-y-2.5">
                                @foreach(is_array($plan->features) ? $plan->features : json_decode($plan->features, true) ?? [] as $feature)
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-4 h-4 rounded-full flex items-center justify-center flex-shrink-0 bg-[#001F3F]/10">
                                            <svg class="w-2.5 h-2.5 text-[#001F3F]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                                            </svg>
                                        </div>
                                        <span class="text-sm text-gray-600">{{ $feature }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div class="mt-6">
                            @if($isCurrentPlan)
                                <div class="w-full py-2.5 px-4 rounded-xl text-sm font-bold text-center bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    ✓ Current Plan
                                </div>
                            @else
                                <form method="POST" action="{{ route('agent.subscription.subscribe', $plan->id) }}">
                                    @csrf
                                    <button type="submit"
                                            class="w-full py-2.5 px-4 rounded-xl text-sm font-bold transition-all duration-200 hover:shadow-md hover:-translate-y-0.5"
                                            style="{{ $plan->is_featured ? 'background:linear-gradient(135deg,#C6A664,#a8894e); color:#001F3F;' : 'background:#001F3F; color:white;' }}">
                                        {{ $currentSubscription ? 'Switch to ' . $plan->name : 'Get Started' }}
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- Active subscription management --}}
    @if($currentSubscription && $currentSubscription->isActive())
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <h2 class="text-sm font-bold text-gray-800 mb-4">Current Subscription</h2>
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background:rgba(52,211,153,0.1)">
                        <svg class="w-5 h-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-800">{{ $currentSubscription->plan->name ?? 'Active Plan' }}</p>
                        <p class="text-xs text-gray-500">
                            Started {{ $currentSubscription->start_date->format('M d, Y') }} ·
                            Renews {{ $currentSubscription->end_date->format('M d, Y') }}
                        </p>
                    </div>
                </div>
                <form method="POST" action="{{ route('agent.subscription.cancel', $currentSubscription->id) }}"
                      onsubmit="return confirm('Cancel your subscription? You will retain access until {{ $currentSubscription->end_date->format("M d") }}.')">
                    @csrf @method('DELETE')
                    <button type="submit"
                            class="px-4 py-2 rounded-xl text-xs font-bold text-red-600 border border-red-200 hover:bg-red-50 transition-colors">
                        Cancel Subscription
                    </button>
                </form>
            </div>
        </div>
    @endif

    {{-- FAQ note --}}
    <div class="text-center py-4">
        <p class="text-xs text-gray-400">
            Questions about plans?
            <a href="{{ url('/faq') }}" class="font-semibold hover:underline" style="color:#C6A664">Read our FAQ</a>
            or
            <a href="{{ url('/support/tickets/create') }}" class="font-semibold hover:underline" style="color:#C6A664">contact support</a>
        </p>
    </div>

</div>
</x-agent-layout>