<x-admin-layout>
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-bold" style="color: #001F3F;">Announcements</h2>
            <p class="mt-1 text-gray-500">Manage sliding announcements displayed on the frontend.</p>
        </div>
        <a href="{{ route('admin.announcements.create') }}" class="inline-flex items-center px-4 py-2 bg-[#001F3F] text-white rounded-lg font-semibold hover:bg-[#00152B] transition-colors shadow-lg">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Add New Announcement
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-r-lg shadow-sm">
            <div class="flex items-center">
                <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="font-medium">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr style="background-color: #F8F9FC;">
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Preview</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Content</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">Status</th>
                        <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-gray-500">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($announcements as $announcement)
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="px-3 py-1 rounded text-xs font-medium inline-block" style="background-color: {{ $announcement->bg_color }}; color: {{ $announcement->text_color }};">
                                {{ Str::limit($announcement->content, 20) }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900 line-clamp-1">{{ $announcement->content }}</div>
                            @if($announcement->link)
                                <div class="text-xs text-blue-500 truncate max-w-xs">{{ $announcement->link }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form action="{{ route('admin.announcements.toggle', $announcement->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-lg transition-colors {{ $announcement->is_active ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}" 
                                        title="{{ $announcement->is_active ? 'Click to remove from live' : 'Click to put live' }}">
                                    {{ $announcement->is_active ? 'Live' : 'Inactive' }}
                                </button>
                            </form>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-right space-x-2">
                            <a href="{{ route('admin.announcements.edit', $announcement->id) }}" class="p-2 inline-flex rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 transition-colors" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5M16.5 3.5a2.121 2.121 0 113 3L11.707 14.707a1 1 0 01-.39.242l-3 1a1 1 0 01-1.266-1.265l1-3a1 1 0 01.242-.39L16.5 3.5z"/></svg>
                            </a>
                            <form action="{{ route('admin.announcements.destroy', $announcement->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this announcement?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 inline-flex rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition-colors" title="Delete">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-gray-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5M16.5 3.5a2.121 2.121 0 113 3L11.707 14.707a1 1 0 01-.39.242l-3 1a1 1 0 01-1.266-1.265l1-3a1 1 0 01.242-.39L16.5 3.5z"/></svg>
                                <p class="text-gray-400 font-medium">No announcements found.</p>
                                <a href="{{ route('admin.announcements.create') }}" class="mt-4 text-[#001F3F] font-bold hover:underline">Create your first announcement</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($announcements->hasPages())
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                {{ $announcements->links() }}
            </div>
        @endif
    </div>
</x-admin-layout>
