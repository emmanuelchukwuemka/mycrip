<x-agent-layout>
    <div class="max-w-2xl mx-auto py-12 animate-in zoom-in-95 duration-500">
        
        <div class="bg-white rounded-[3rem] shadow-2xl overflow-hidden border border-gray-100">
            <div class="p-12 text-center">
                <div class="w-24 h-24 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-8 animate-bounce transition-all duration-1000">
                    <svg class="w-12 h-12 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                </div>
                
                <h1 class="text-3xl font-black text-gray-900 tracking-tight mb-4">We're sorry to see you go</h1>
                <p class="text-gray-500 text-base leading-relaxed mb-10">Deleting your account is permanent. This will remove all your data, property listings, and subscription records from MyCrip Africa.</p>

                <form action="{{ route('account.delete') }}" method="POST" class="space-y-8">
                    @csrf
                    
                    <div class="text-left space-y-3">
                        <label class="text-sm font-bold text-gray-700 ml-5 uppercase tracking-widest">Confirm with your password</label>
                        <input type="password" name="password" required 
                            class="w-full px-8 py-5 rounded-3xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:border-red-500 focus:ring-4 focus:ring-red-500/10 transition-all duration-300 outline-none placeholder:text-gray-300"
                            placeholder="Enter your current password">
                        @error('password')
                            <p class="text-xs text-red-500 font-bold mt-2 ml-5">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-4">
                        <a href="{{ route('account.privacy') }}" class="w-full sm:w-auto px-10 py-4 text-gray-500 font-bold hover:text-gray-900 transition-colors uppercase tracking-widest text-xs">
                            Keep My Account
                        </a>
                        <button type="submit" 
                            class="w-full sm:w-auto px-12 py-4 bg-red-600 text-white rounded-[2rem] font-black text-sm uppercase tracking-widest hover:bg-red-700 transition-all duration-300 shadow-xl shadow-red-600/30 active:scale-[0.98]">
                            Confirm Deletion
                        </button>
                    </div>
                </form>
            </div>
            
            <div class="bg-gray-50/50 p-8 border-t border-gray-50 text-center">
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-[.2em]">Data retention policy: 30 days pending permanent deletion</p>
            </div>
        </div>
    </div>
</x-agent-layout>
