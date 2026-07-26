<x-agent-layout>
    <div class="max-w-4xl mx-auto space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-700">
        
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
                                <span class="text-gray-600">Privacy & Data</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-3xl font-black text-gray-900 tracking-tight">Privacy & Data</h1>
                <p class="mt-2 text-gray-500 font-medium">Take control of your personal information and how it's used on Villa Africa.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-8">
            
            <!-- Data Export Card -->
            <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-500">
                <div class="p-10 flex flex-col md:flex-row items-start md:items-center gap-8">
                    <div class="w-20 h-20 rounded-3xl bg-indigo-50 text-indigo-600 flex items-center justify-center flex-shrink-0 shadow-inner border border-indigo-100">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0l-4-4m4 4V4"/></svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Request Data Export</h3>
                        <p class="text-gray-500 text-sm leading-relaxed max-w-xl">We believe you should own your data. Download a complete JSON archive of your profile, listings, messages, and activity history for your own records.</p>
                        
                        <div class="mt-6 flex flex-wrap gap-3">
                            <span class="px-3 py-1 bg-gray-50 text-gray-400 text-[10px] font-bold uppercase rounded-lg border border-gray-100">Profile Data</span>
                            <span class="px-3 py-1 bg-gray-50 text-gray-400 text-[10px] font-bold uppercase rounded-lg border border-gray-100">Real Estate Listings</span>
                            <span class="px-3 py-1 bg-gray-50 text-gray-400 text-[10px] font-bold uppercase rounded-lg border border-gray-100">Activity Logs</span>
                        </div>
                    </div>
                    <div>
                        <a href="{{ route('account.export') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-[#A85C2E] text-white rounded-2xl font-bold hover:bg-[#002d5c] hover:shadow-lg hover:shadow-[#A85C2E]/20 transition-all duration-300 active:scale-[0.98]">
                            Download Archive
                        </a>
                    </div>
                </div>
            </div>

            <!-- Ad Personalization -->
            <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden p-10">
                <div class="flex items-center justify-between mb-8 pb-6 border-b border-gray-50">
                    <h3 class="text-lg font-bold text-gray-900">Privacy Preferences</h3>
                    <span class="text-[10px] font-black uppercase text-amber-500 tracking-widest">Global Settings</span>
                </div>
                
                <div class="space-y-8">
                    <div class="flex items-start justify-between gap-6">
                        <div class="flex-1">
                            <h4 class="text-sm font-bold text-gray-900">Profile Visibility</h4>
                            <p class="text-xs text-gray-400 mt-1">Allow search engines to index your agent profile page.</p>
                        </div>
                        <div class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer" checked>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-500"></div>
                        </div>
                    </div>

                    <div class="flex items-start justify-between gap-6">
                        <div class="flex-1">
                            <h4 class="text-sm font-bold text-gray-900">Personalized Analytics</h4>
                            <p class="text-xs text-gray-400 mt-1">Allow us to collect data on your usage to improve your agent tools.</p>
                        </div>
                        <div class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-500"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Danger Zone -->
            <div class="bg-red-50/50 rounded-[2.5rem] border border-red-100 p-10 flex flex-col md:flex-row items-center justify-between gap-8">
                <div class="text-center md:text-left">
                    <h3 class="text-lg font-bold text-red-900">Permanently Delete Account</h3>
                    <p class="text-red-700/60 text-xs mt-1">This action is permanent and cannot be undone. All your listings will be removed.</p>
                </div>
                <a href="{{ route('account.delete.show') }}" class="px-8 py-3 bg-red-600 text-white rounded-2xl font-bold hover:bg-red-700 transition-all duration-300 shadow-md shadow-red-600/20">
                    Delete My Account
                </a>
            </div>
        </div>
    </div>
</x-agent-layout>
