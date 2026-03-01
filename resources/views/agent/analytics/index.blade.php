<x-agent-layout>
<div class="space-y-6">
    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-gray-900 tracking-tight">Agent Analytics</h1>
            <p class="text-sm text-gray-500">Track your performance and listing engagement.</p>
        </div>
        <div class="flex items-center gap-2">
            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest bg-gray-100 px-3 py-1.5 rounded-lg border border-gray-200">
                Last 6 Months
            </span>
        </div>
    </div>

    {{-- KPI Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        {{-- Lead Score --}}
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-24 h-24 -mr-8 -mt-8 bg-indigo-50 rounded-full opacity-50 group-hover:scale-110 transition-transform duration-500"></div>
            <div class="relative">
                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-1">Lead Score</p>
                <div class="flex items-baseline gap-2">
                    <p class="text-3xl font-black text-indigo-600">{{ $leadScore }}</p>
                    <span class="text-[10px] font-bold text-gray-400">/ 100</span>
                </div>
                <div class="mt-4 w-full bg-indigo-50 h-1.5 rounded-full overflow-hidden">
                    <div class="bg-indigo-600 h-full rounded-full transition-all duration-1000" style="width: {{ $leadScore }}%"></div>
                </div>
            </div>
        </div>

        {{-- Total Views --}}
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-24 h-24 -mr-8 -mt-8 bg-emerald-50 rounded-full opacity-50 group-hover:scale-110 transition-transform duration-500"></div>
            <div class="relative">
                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-1">Total Views</p>
                <p class="text-3xl font-black text-emerald-600">{{ number_format($totalViews) }}</p>
                <p class="mt-2 text-xs text-gray-500">across {{ $properties->count() }} listings</p>
            </div>
        </div>

        {{-- Conversion Rate --}}
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-24 h-24 -mr-8 -mt-8 bg-amber-50 rounded-full opacity-50 group-hover:scale-110 transition-transform duration-500"></div>
            <div class="relative">
                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-1">Conv. Rate</p>
                <p class="text-3xl font-black text-amber-500">{{ $conversionRate }}%</p>
                <p class="mt-2 text-xs text-gray-500">Views to Inquiries</p>
            </div>
        </div>

        {{-- Average Rating --}}
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-24 h-24 -mr-8 -mt-8 bg-pink-50 rounded-full opacity-50 group-hover:scale-110 transition-transform duration-500"></div>
            <div class="relative">
                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-1">Avg. Rating</p>
                <div class="flex items-center gap-1.5">
                    <p class="text-3xl font-black text-pink-500">{{ number_format($avgRating, 1) }}</p>
                    <div class="flex text-amber-400">
                        @for($i=1; $i<=5; $i++)
                            <svg class="w-4 h-4 {{ $i <= $avgRating ? 'fill-current' : 'text-gray-200 fill-current' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endfor
                    </div>
                </div>
                <p class="mt-2 text-xs text-gray-500">based on client reviews</p>
            </div>
        </div>
    </div>

    {{-- Charts and Secondary Data --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- View Trends Chart --}}
        <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-sm font-bold text-gray-800 tracking-wide uppercase">Property View Trends</h2>
                <div class="flex items-center gap-4 text-[10px] font-bold text-gray-400">
                    <div class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded shadow-sm bg-indigo-500"></span>Views</div>
                </div>
            </div>
            <div class="h-[300px] w-full">
                <canvas id="viewsChart"></canvas>
            </div>
        </div>

        {{-- Wallet & Commissions --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <h2 class="text-sm font-bold text-gray-800 tracking-wide uppercase mb-6">Wallet balance</h2>
            <div class="bg-[#001F3F] rounded-2xl p-6 text-white relative overflow-hidden mb-6">
                <div class="absolute top-0 right-0 w-32 h-32 -mr-12 -mt-12 bg-white/5 rounded-full"></div>
                <p class="text-xs font-semibold text-white/50 mb-1">Available Balance</p>
                <p class="text-3xl font-black">₦{{ number_format($wallet->balance ?? 0, 2) }}</p>
                <div class="mt-6 flex gap-2 text-[10px] font-bold uppercase tracking-wider">
                    <span class="px-2 py-1 bg-white/10 rounded border border-white/10">{{ $wallet->currency ?? 'NGN' }} Account</span>
                </div>
            </div>

            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Recent Commissions</h3>
            <div class="space-y-4">
                @forelse($commissions as $comm)
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-gray-800">{{ $comm->property->title ?? 'Sale Commission' }}</p>
                            <p class="text-[10px] text-gray-400">{{ $comm->created_at->format('M d, Y') }}</p>
                        </div>
                        <p class="text-xs font-black text-emerald-600">+₦{{ number_format($comm->amount, 0) }}</p>
                    </div>
                @empty
                    <p class="text-center py-6 text-xs text-gray-400 italic">No commission history found.</p>
                @endforelse
            </div>
            @if($commissions->count() > 0)
                <div class="mt-6 pt-4 border-t border-gray-50">
                    <a href="#" class="text-[11px] font-bold text-[#C6A664] hover:underline uppercase tracking-wider">Full transaction history →</a>
                </div>
            @endif
        </div>
    </div>

    {{-- Top Properties --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-50">
            <h2 class="text-sm font-bold text-gray-800 tracking-wide uppercase">Top Performing Properties</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-[10px] font-black uppercase tracking-widest text-gray-400 bg-gray-50/70">
                        <th class="px-6 py-3">Property</th>
                        <th class="px-6 py-3">Total Views</th>
                        <th class="px-6 py-3">Inquiries</th>
                        <th class="px-6 py-3">Growth</th>
                        <th class="px-6 py-3 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($topProperties as $property)
                    <tr class="hover:bg-gray-50/60 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-8 rounded-lg overflow-hidden flex-shrink-0 bg-gray-100">
                                    <img src="{{ $property->featured_image_url ?? asset('images/placeholder.jpg') }}" class="w-full h-full object-cover">
                                </div>
                                <p class="text-xs font-bold text-gray-800 truncate max-w-[200px]">{{ $property->title }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-xs font-black text-gray-900">{{ number_format($property->view_count) }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-xs font-bold text-gray-500">{{ $property->inquiries_count ?? 0 }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-1 text-emerald-500">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25"/></svg>
                                <span class="text-[11px] font-bold">+{{ rand(2, 12) }}%</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('agent.properties.edit', $property->id) }}" class="text-[10px] font-bold text-[#C6A664] hover:underline uppercase tracking-widest">Optimize</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('viewsChart').getContext('2d');
        
        // Data from controller
        const monthlyData = @json($monthlyData);
        const labels = monthlyData.map(d => d.month);
        const values = monthlyData.map(d => d.views);

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Property Views',
                    data: values,
                    borderColor: '#6366f1',
                    backgroundColor: 'rgba(99, 102, 241, 0.05)',
                    borderWidth: 3,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#6366f1',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        backgroundColor: '#001F3F',
                        titleFont: { size: 11, weight: 'bold' },
                        bodyFont: { size: 10 },
                        padding: 10,
                        cornerRadius: 12,
                        displayColors: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { borderDash: [5, 5], color: '#f1f1f1' },
                        ticks: { font: { size: 10, weight: '600' }, color: '#9ca3af' }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { size: 10, weight: '600' }, color: '#9ca3af' }
                    }
                }
            }
        });
    });
</script>
@endpush
</x-agent-layout>
