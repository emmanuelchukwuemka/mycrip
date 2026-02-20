<x-admin-layout>
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-bold" style="color: #001F3F;">Property Management</h2>
            <p class="mt-1 text-gray-500">Oversee and verify all property listings on the platform.</p>
        </div>
    </div>

    <!-- Properties Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr style="background-color: #F8F9FC;">
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Property</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Agent</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Category</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Price</th>
                        <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-gray-500">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse($properties as $property)
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-12 w-16 rounded-lg overflow-hidden flex-shrink-0 border bg-gray-50 shadow-sm">
                                    @if($property->featured_image_url)
                                        <img class="h-full w-full object-cover" src="{{ $property->featured_image_url }}" alt="{{ $property->title }}">
                                    @else
                                        <div class="h-full w-full flex items-center justify-center text-gray-300">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-semibold text-[#001F3F]">{{ $property->title }}</div>
                                    <div class="text-xs text-gray-500">{{ $property->city }}, {{ $property->state }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $property->user->name }}</div>
                            <div class="text-xs text-gray-500">{{ $property->user->email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-xs font-medium text-gray-600 px-2.5 py-1 rounded bg-gray-100 uppercase tracking-wider">
                                {{ str_replace('_', ' ', $property->category) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($property->status === 'approved')
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-lg bg-emerald-100 text-emerald-700">Live</span>
                            @elseif($property->status === 'rejected')
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-lg bg-red-100 text-red-700">Rejected</span>
                            @else
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-lg bg-amber-100 text-amber-700">Pending</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-[#001F3F]">
                            {{ $property->formatted_price }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                            <a href="{{ route('admin.properties.show', $property->id) }}" class="text-indigo-600 hover:text-indigo-900">Details</a>
                            
                            @if($property->status === 'pending')
                                <div class="inline-flex space-x-1 ml-4 border-l pl-4 border-gray-100">
                                    <form action="{{ route('admin.properties.verify', $property->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-emerald-600 hover:text-emerald-900">Approve</button>
                                    </form>
                                    <span class="text-gray-300">|</span>
                                    <form action="{{ route('admin.properties.reject', $property->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-red-600 hover:text-red-900">Reject</button>
                                    </form>
                                </div>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-gray-400">
                            No properties found on the platform.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($properties->hasPages())
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
            {{ $properties->links() }}
        </div>
        @endif
    </div>
</x-admin-layout>
