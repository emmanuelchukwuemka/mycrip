<x-agent-layout>
    <div class="max-w-4xl mx-auto space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-700 pb-12">
        
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
                                <a href="{{ route('support.tickets') }}" class="hover:text-amber-500 transition-colors">Support</a>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-4xl font-black text-gray-900 tracking-tight">Create New Ticket</h1>
                <p class="mt-2 text-gray-500 font-medium">Please provide detailed information so we can assist you better.</p>
            </div>
            
            <a href="{{ route('support.tickets') }}" class="text-sm font-bold text-gray-500 hover:text-gray-900 transition-colors flex items-center gap-2 bg-white px-4 py-2 rounded-xl border border-gray-100 shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Back to List
            </a>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-10 border-b border-gray-50 bg-gray-50/20">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-900">Inquiry Details</h2>
                        <p class="text-xs text-gray-400 font-medium">Your request will be assigned to a specialist.</p>
                    </div>
                </div>
            </div>

            <div class="p-10">
                <form action="{{ route('support.tickets.store') }}" method="POST" class="space-y-8">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-3 md:col-span-2">
                            <label class="text-sm font-bold text-gray-700 ml-1 uppercase tracking-widest text-[10px]">Subject</label>
                            <input type="text" name="subject" required value="{{ old('subject') }}"
                                class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 transition-all duration-300 outline-none placeholder:text-gray-300"
                                placeholder="E.g. Issue with my property listing visibility">
                            @error('subject')
                                <p class="text-xs text-red-500 font-bold mt-2 ml-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-3">
                            <label class="text-sm font-bold text-gray-700 ml-1 uppercase tracking-widest text-[10px]">Case Priority</label>
                            <div class="relative">
                                <select name="priority" class="appearance-none w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 transition-all duration-300 outline-none cursor-pointer text-gray-700">
                                    <option value="low">Low - General Question</option>
                                    <option value="medium" selected>Medium - Minor Issue</option>
                                    <option value="high">High - Critical Problem</option>
                                    <option value="urgent">Urgent - Financial/Security</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-6 pointer-events-none text-gray-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <label class="text-sm font-bold text-gray-700 ml-1 uppercase tracking-widest text-[10px]">Topic Category</label>
                            <select class="appearance-none w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 transition-all duration-300 outline-none cursor-pointer text-gray-700">
                                <option>Billing & Payments</option>
                                <option>Technical Support</option>
                                <option>Property Listings</option>
                                <option>Account Management</option>
                            </select>
                        </div>

                        <div class="space-y-3 md:col-span-2">
                            <label class="text-sm font-bold text-gray-700 ml-1 uppercase tracking-widest text-[10px]">Message</label>
                            <textarea name="body" required minlength="50" rows="8"
                                class="w-full px-6 py-5 rounded-3xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 transition-all duration-300 outline-none placeholder:text-gray-300 resize-none"
                                placeholder="Please describe your issue in detail. The more information, the faster we can help! (Min. 50 characters)">{{ old('body') }}</textarea>
                            <div class="flex justify-between items-center mt-2 px-1">
                                @error('body')
                                    <p class="text-xs text-red-500 font-bold">{{ $message }}</p>
                                @else
                                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Character Count: 0 / 5000</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-gray-50 flex items-center justify-between gap-6">
                        <div class="hidden sm:flex items-center gap-3 text-emerald-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            <span class="text-xs font-bold uppercase tracking-wider">Secure Transfer</span>
                        </div>
                        
                        <button type="submit" 
                            class="w-full sm:w-auto px-12 py-4 bg-[#001F3F] text-white rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-[#002d5c] hover:shadow-2xl hover:shadow-[#001F3F]/30 transition-all duration-500 active:scale-[0.98]">
                            Submit Case
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-agent-layout>
