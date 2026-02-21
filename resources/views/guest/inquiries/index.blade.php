<x-app-layout>
    <div class="bg-gray-50 min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 gap-4">
                <div>
                    <h1 class="text-3xl font-extrabold text-[#001F3F] tracking-tight text-center md:text-left">My Inquiries</h1>
                    <p class="mt-2 text-gray-500 font-medium text-center md:text-left">Track all your property inquiries and agent responses.</p>
                </div>
                <div class="flex justify-center">
                    <div class="bg-white p-2 rounded-xl border-2 border-[#C6A664]/20 shadow-sm inline-flex items-center">
                        <span class="px-4 py-1.5 bg-[#001F3F] text-white text-xs font-bold rounded-lg uppercase tracking-widest leading-none">
                            {{ $inquiries->total() }} Submitted
                        </span>
                    </div>
                </div>
            </div>

            @if($inquiries->isEmpty())
                <div class="bg-white rounded-3xl p-16 text-center shadow-xl border border-gray-100 max-w-2xl mx-auto">
                    <div class="w-24 h-24 bg-[#C6A664]/10 rounded-full flex items-center justify-center mx-auto mb-8">
                        <svg class="w-12 h-12 text-[#C6A664]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-[#001F3F] mb-4">No inquiries found</h2>
                    <p class="text-gray-500 mb-8 max-w-sm mx-auto font-medium">When you inquire about a property, it will show up here so you can keep track of the conversation.</p>
                    <a href="{{ route('properties.index') }}" 
                       class="inline-flex items-center justify-center px-8 py-4 bg-[#001F3F] text-white font-bold rounded-2xl hover:bg-[#00152B] transition-all duration-300 shadow-lg hover:shadow-[#001F3F]/20 transform hover:-translate-y-1">
                        Find a Property
                    </a>
                </div>
            @else
                <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-gray-50 border-b border-gray-100">
                                    <th class="px-8 py-5 text-xs font-bold text-gray-500 uppercase tracking-widest">Property</th>
                                    <th class="px-8 py-5 text-xs font-bold text-gray-500 uppercase tracking-widest">Agent</th>
                                    <th class="px-8 py-5 text-xs font-bold text-gray-500 uppercase tracking-widest">Last Message</th>
                                    <th class="px-8 py-5 text-xs font-bold text-gray-500 uppercase tracking-widest">Status</th>
                                    <th class="px-8 py-5 text-xs font-bold text-gray-500 uppercase tracking-widest text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @foreach($inquiries as $inquiry)
                                    <tr class="hover:bg-gray-50/50 transition-colors">
                                        <td class="px-8 py-6">
                                            <div class="flex items-center">
                                                <div class="w-16 h-12 rounded-xl overflow-hidden shadow-sm flex-shrink-0">
                                                    <img src="{{ $inquiry->property->images->first()->image_path ?? asset('images/placeholder-property.jpg') }}" 
                                                         alt="{{ $inquiry->property->title }}" 
                                                         class="w-full h-full object-cover">
                                                </div>
                                                <div class="ml-4">
                                                    <p class="text-sm font-bold text-[#001F3F] line-clamp-1 truncate max-w-[200px]">{{ $inquiry->property->title }}</p>
                                                    <p class="text-xs text-gray-500 font-medium">{{ $inquiry->property->city }}, {{ $inquiry->property->state }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-8 py-6">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 rounded-full bg-[#C6A664]/20 flex items-center justify-center text-[#C6A664] font-black text-[10px]">
                                                    {{ strtoupper(substr($inquiry->property->user->name, 0, 1)) }}
                                                </div>
                                                <span class="ml-3 text-sm font-bold text-gray-700">{{ $inquiry->property->user->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-8 py-6">
                                            <div>
                                                <p class="text-sm text-gray-600 font-medium line-clamp-1">{{ Str::limit($inquiry->message, 40) }}</p>
                                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mt-1">{{ $inquiry->created_at->format('M d, Y') }}</p>
                                            </div>
                                        </td>
                                        <td class="px-8 py-6">
                                            @php
                                                $statusColors = [
                                                    'new' => 'bg-blue-50 text-blue-600',
                                                    'responded' => 'bg-green-50 text-green-600',
                                                    'closed' => 'bg-gray-50 text-gray-600'
                                                ];
                                            @endphp
                                            <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest {{ $statusColors[$inquiry->status] ?? 'bg-gray-50 text-gray-600' }}">
                                                {{ $inquiry->status }}
                                            </span>
                                        </td>
                                        <td class="px-8 py-6 text-right">
                                            <a href="{{ route('inquiries.show', $inquiry->id) }}" 
                                               class="inline-flex items-center px-4 py-2 bg-[#001F3F] text-white text-xs font-bold rounded-xl hover:bg-[#00152B] transition-all shadow-md">
                                                Details
                                                <svg class="w-3 h-3 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/>
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-8">
                    {{ $inquiries->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
