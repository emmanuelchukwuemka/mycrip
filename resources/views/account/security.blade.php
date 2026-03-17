<x-agent-layout>
    <div class="max-w-5xl mx-auto space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-700">
        
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <nav class="flex mb-3" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3 text-xs font-semibold uppercase tracking-wider text-gray-400">
                        <li class="inline-flex items-center">
                            <a href="{{ route('agent.dashboard') }}" class="hover:text-amber-500 transition-colors">Dashboard</a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-3 h-3 mx-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                <span class="text-gray-600">Account Security</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-3xl font-black text-gray-900 tracking-tight">Security & Sessions</h1>
                <p class="mt-2 text-gray-500 font-medium">Manage your password, active sessions, and account protection settings.</p>
            </div>
            
            <div class="flex items-center gap-2 text-xs font-bold px-3 py-1.5 bg-amber-50 text-amber-700 rounded-full border border-amber-100 uppercase tracking-widest">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                </span>
                Account Protected
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Column: Password & Protection -->
            <div class="lg:col-span-2 space-y-8">
                
                <!-- Password Change Card -->
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow duration-300">
                    <div class="px-8 py-6 border-b border-gray-50 flex items-center justify-between bg-gradient-to-r from-gray-50/50 to-transparent">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 00-2 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            </div>
                            <h2 class="text-lg font-bold text-gray-900">Change Password</h2>
                        </div>
                    </div>
                    
                    <div class="p-8">
                        @if (session('status'))
                            <div class="mb-6 p-4 bg-emerald-50 text-emerald-700 rounded-2xl border border-emerald-100 text-sm font-medium flex items-center gap-3">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('user-password.update') }}" method="POST" class="space-y-6">
                            @csrf
                            @method('PUT')
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2 md:col-span-2">
                                    <label class="text-sm font-bold text-gray-700 ml-1">Current Password</label>
                                    <input type="password" name="current_password" required 
                                        class="w-full px-5 py-3 rounded-2xl border border-gray-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 transition-all duration-200 outline-none placeholder:text-gray-300"
                                        placeholder="••••••••">
                                    @error('current_password', 'updatePassword')
                                        <p class="text-xs text-red-500 font-bold mt-1 ml-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="space-y-2">
                                    <label class="text-sm font-bold text-gray-700 ml-1">New Password</label>
                                    <input type="password" name="password" required 
                                        class="w-full px-5 py-3 rounded-2xl border border-gray-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 transition-all duration-200 outline-none placeholder:text-gray-300"
                                        placeholder="Min. 8 characters">
                                    @error('password', 'updatePassword')
                                        <p class="text-xs text-red-500 font-bold mt-1 ml-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="space-y-2">
                                    <label class="text-sm font-bold text-gray-700 ml-1">Confirm New Password</label>
                                    <input type="password" name="password_confirmation" required 
                                        class="w-full px-5 py-3 rounded-2xl border border-gray-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 transition-all duration-200 outline-none placeholder:text-gray-300"
                                        placeholder="Repeat new password">
                                </div>
                            </div>
                            
                            <div class="pt-2">
                                <button type="submit" 
                                    class="px-8 py-3.5 bg-[#001F3F] text-white rounded-2xl font-bold hover:bg-[#002d5c] hover:shadow-lg hover:shadow-[#001F3F]/20 transition-all duration-300 active:scale-[0.98]">
                                    Update Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Two-Factor Authentication Placeholder -->
                <div class="bg-gradient-to-br from-[#001F3F] to-[#00152B] rounded-3xl shadow-xl overflow-hidden text-white relative group">
                    <div class="absolute top-0 right-0 p-8 opacity-10 group-hover:scale-110 transition-transform duration-700">
                        <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    </div>
                    <div class="p-8 relative z-10">
                        <h3 class="text-xl font-bold mb-2">Two-Factor Authentication</h3>
                        <p class="text-white/60 text-sm max-w-md mb-6 leading-relaxed">Add an extra layer of security to your account by requiring more than just a password to log in.</p>
                        <button class="px-6 py-2.5 bg-amber-500 text-[#001F3F] rounded-xl font-black text-xs uppercase tracking-widest hover:bg-amber-400 transition-colors shadow-lg shadow-amber-500/20">
                            Enable 2FA
                        </button>
                    </div>
                </div>
            </div>

            <!-- Right Column: Recent Activity -->
            <div class="space-y-8">
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden flex flex-col h-full">
                    <div class="px-6 py-5 border-b border-gray-50 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-500 flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <h2 class="text-sm font-bold text-gray-900 tracking-tight text-center">Recent Logins</h2>
                        </div>
                        <a href="{{ route('account.activity') }}" class="text-[10px] font-black uppercase tracking-widest text-amber-600 hover:text-amber-700">View All</a>
                    </div>
                    
                    <div class="flex-1 p-6 space-y-6">
                        @forelse($recentLogins as $login)
                            <div class="flex items-start gap-4 group">
                                <div class="mt-1 w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center flex-shrink-0 group-hover:bg-amber-50 transition-colors">
                                    <svg class="w-4 h-4 text-gray-400 group-hover:text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-xs font-bold text-gray-800 truncate">Login from {{ $login->ip_address ?? 'Unknown IP' }}</p>
                                    <p class="text-[10px] text-gray-400 mt-0.5 font-medium">{{ $login->created_at->diffForHumans() }}</p>
                                    @if($loop->first)
                                        <span class="inline-block mt-1 px-2 py-0.5 bg-emerald-50 text-emerald-600 text-[9px] font-black uppercase rounded-md tracking-tighter">Current Session</span>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="py-12 text-center">
                                <div class="w-12 h-12 bg-gray-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <p class="text-xs font-bold text-gray-400">No recent activity found</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="px-6 py-4 bg-gray-50/50 border-t border-gray-50">
                        <p class="text-[10px] text-gray-400 font-medium leading-relaxed">
                            <span class="text-gray-500 font-bold">Pro Tip:</span> If you see any suspicious activity, change your password immediately and sign out of all other devices.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-agent-layout>
