<x-admin-layout>
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center">
                <a href="{{ route('admin.users.index') }}" class="mr-4 text-gray-500 hover:text-gray-700 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <h3 class="text-gray-700 text-3xl font-medium">User Details</h3>
            </div>
            
            <div class="flex space-x-3">
                @if($user->role === 'agent' && $user->agent_verification_status !== 'approved')
                    <form action="{{ route('admin.users.verify', $user->id) }}" method="POST" onsubmit="return confirm('Verify this agent?')">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-medium text-sm">
                            Verify Agent
                        </button>
                    </form>
                @endif
                
                @if($user->role === 'agent' && $user->agent_verification_status !== 'rejected')
                    <form action="{{ route('admin.users.reject', $user->id) }}" method="POST" onsubmit="return confirm('Reject this agent?')">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium text-sm">
                            Reject Verification
                        </button>
                    </form>
                @endif
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow overflow-hidden sm:rounded-lg border border-gray-100 mb-8">
            <div class="px-6 py-5 border-b border-gray-200 bg-gray-50/50">
                <h3 class="text-lg leading-6 font-bold text-[#A85C2E] flex items-center">
                    <svg class="w-5 h-5 mr-2 text-[#2B1810]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Basic Information
                </h3>
            </div>
            <div class="px-6 py-5">
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-6">
                    <div>
                        <dt class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Full Name</dt>
                        <dd class="text-sm font-semibold text-gray-900">{{ $user->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Email Address</dt>
                        <dd class="text-sm font-semibold text-gray-900">{{ $user->email }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Role</dt>
                        <dd>
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-bold uppercase tracking-wide
                                {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : ($user->role === 'agent' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                                {{ $user->role }}
                            </span>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Joined Date</dt>
                        <dd class="text-sm font-semibold text-gray-900">{{ $user->created_at->format('M d, Y') }}</dd>
                    </div>
                </dl>
            </div>
        </div>

        @if($user->role === 'agent')
            <div class="bg-white shadow overflow-hidden sm:rounded-lg border border-gray-100">
                <div class="px-6 py-5 border-b border-gray-200 bg-gray-50/50">
                    <h3 class="text-lg leading-6 font-bold text-[#A85C2E] flex items-center">
                        <svg class="w-5 h-5 mr-2 text-[#2B1810]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        Agent Verification Data
                    </h3>
                </div>
                <div class="px-6 py-5">
                    <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-6">
                        <div>
                            <dt class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Phone Number</dt>
                            <dd class="text-sm font-semibold text-gray-900">{{ $user->agent_phone ?: 'N/A' }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Verification Status</dt>
                            <dd>
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold uppercase tracking-wide
                                    {{ $user->agent_verification_status === 'approved' ? 'bg-green-100 text-green-800' : ($user->agent_verification_status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                    {{ $user->agent_verification_status ?: 'Pending' }}
                                </span>
                            </dd>
                        </div>
                        <div>
                            <dt class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">ID Document Number</dt>
                            <dd class="text-sm font-semibold text-gray-900">{{ $user->agent_id_number ?: 'N/A' }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Address</dt>
                            <dd class="text-sm font-semibold text-gray-900">{{ $user->agent_address ?: 'N/A' }}</dd>
                        </div>
                        <div class="md:col-span-2">
                            <dt class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Identity Document</dt>
                            <dd>
                                @if($user->agent_id_document)
                                    <a href="{{ asset('storage/' . $user->agent_id_document) }}" target="_blank" class="inline-flex items-center px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl hover:bg-gray-100 transition group">
                                        <svg class="w-6 h-6 mr-3 text-gray-400 group-hover:text-[#2B1810]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <div class="text-left">
                                            <p class="text-sm font-bold text-gray-900 leading-none">View Document</p>
                                            <p class="text-[10px] text-gray-400 uppercase mt-1 font-black">Click to open in new tab</p>
                                        </div>
                                    </a>
                                @else
                                    <span class="text-sm text-gray-400 italic">No document uploaded</span>
                                @endif
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        @endif
    </div>
</x-admin-layout>
