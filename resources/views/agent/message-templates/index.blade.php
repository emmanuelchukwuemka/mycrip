<x-agent-layout>
    <div class="max-w-6xl mx-auto space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-700 pb-20">
        
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <nav class="flex mb-3" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3 text-xs font-semibold uppercase tracking-wider text-gray-400">
                        <li class="inline-flex items-center">
                            <a href="{{ route('agent.dashboard') }}" class="hover:text-amber-500 transition-colors">Dashboard</a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-3 h-3 mx-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                <span class="text-gray-600">Message Templates</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-4xl font-black text-gray-900 tracking-tight">Smart Templates</h1>
                <p class="mt-2 text-gray-500 font-medium">Save time with pre-written responses for common inquiries and property details.</p>
            </div>
            
            <button @click="$dispatch('open-modal', 'create-template')" class="inline-flex items-center gap-2 px-8 py-4 bg-[#A85C2E] text-white rounded-2xl font-bold hover:bg-[#002d5c] hover:shadow-xl hover:shadow-[#A85C2E]/20 transition-all duration-300 active:scale-[0.98]">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                New Template
            </button>
        </div>

        @if(session('success'))
            <div class="p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl flex items-center gap-3 animate-in fade-in zoom-in duration-300">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                <span class="text-sm font-bold">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Templates Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($templates as $template)
                <div class="group bg-white rounded-[2.5rem] p-8 border border-gray-100 shadow-sm hover:shadow-2xl hover:-translate-y-1 transition-all duration-500 flex flex-col">
                    <div class="flex items-start justify-between mb-8">
                        <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-500 flex items-center justify-center group-hover:scale-110 transition-transform duration-500 shadow-inner">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/></svg>
                        </div>
                        <div class="flex items-center gap-2">
                            <button @click="$dispatch('open-modal', 'edit-template-{{ $template->id }}')" class="p-2 text-gray-300 hover:text-amber-500 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                            </button>
                            <form action="{{ route('agent.message-templates.destroy', $template) }}" method="POST" onsubmit="return confirm('Delete this template?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 text-gray-300 hover:text-red-500 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </div>

                    <h3 class="text-xl font-black text-gray-900 mb-4 tracking-tight group-hover:text-amber-600 transition-colors">{{ $template->title }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-8 flex-1 line-clamp-4">{{ $template->body }}</p>
                    
                    <div class="pt-6 border-t border-gray-50 flex items-center justify-between">
                        <span class="text-[10px] font-black uppercase text-gray-400 tracking-widest">{{ strlen($template->body) }} Characters</span>
                        <div class="flex -space-x-2">
                            <!-- Visual decorations -->
                            <div class="w-6 h-6 rounded-full border-2 border-white bg-gray-100"></div>
                            <div class="w-6 h-6 rounded-full border-2 border-white bg-amber-100"></div>
                        </div>
                    </div>
                </div>

                <!-- Edit Modal -->
                <x-modal name="edit-template-{{ $template->id }}" focusable>
                    <div class="p-10">
                        <h2 class="text-2xl font-black text-gray-900 mb-8 tracking-tight">Edit Template</h2>
                        <form action="{{ route('agent.message-templates.update', $template) }}" method="POST" class="space-y-6">
                            @csrf @method('PUT')
                            <div class="space-y-2">
                                <label class="text-xs font-black uppercase tracking-[0.2em] text-gray-400 ml-1">Template Title</label>
                                <input type="text" name="title" required value="{{ $template->title }}"
                                    class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 transition-all duration-300 outline-none">
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-black uppercase tracking-[0.2em] text-gray-400 ml-1">Message Content</label>
                                <textarea name="body" required rows="8"
                                    class="w-full px-6 py-5 rounded-3xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 transition-all duration-300 outline-none resize-none">{{ $template->body }}</textarea>
                            </div>
                            <div class="flex justify-end gap-4 pt-4">
                                <button type="button" @click="$dispatch('close')" class="px-8 py-4 text-gray-400 font-bold hover:text-gray-900 transition-colors">Cancel</button>
                                <button type="submit" class="px-10 py-4 bg-[#A85C2E] text-white rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-[#002d5c] transition-all duration-300">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </x-modal>
            @empty
                <div class="col-span-1 md:col-span-3 py-32 text-center bg-white rounded-[4rem] border-2 border-dashed border-gray-100">
                    <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-8 animate-pulse text-gray-200">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0l-8 4-8-4"/></svg>
                    </div>
                    <h3 class="text-2xl font-black text-gray-900 tracking-tight">The list is empty</h3>
                    <p class="text-gray-400 text-base max-w-sm mx-auto mt-3 leading-relaxed">Boost your productivity by creating templates for messages you send often.</p>
                </div>
            @endforelse
        </div>

        <!-- Create Modal -->
        <x-modal name="create-template" focusable>
            <div class="p-10">
                <h2 class="text-2xl font-black text-gray-900 mb-8 tracking-tight">New Template</h2>
                <form action="{{ route('agent.message-templates.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="space-y-2">
                        <label class="text-xs font-black uppercase tracking-[0.2em] text-gray-400 ml-1">Template Title</label>
                        <input type="text" name="title" required value="{{ old('title') }}" placeholder="E.g. Property Viewing Confirmation"
                            class="w-full px-6 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 transition-all duration-300 outline-none">
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-black uppercase tracking-[0.2em] text-gray-400 ml-1">Message Content</label>
                        <textarea name="body" required rows="8" placeholder="Enter the template text here..."
                            class="w-full px-6 py-5 rounded-3xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 transition-all duration-300 outline-none resize-none">{{ old('body') }}</textarea>
                    </div>
                    <div class="flex justify-end gap-4 pt-4">
                        <button type="button" @click="$dispatch('close')" class="px-8 py-4 text-gray-400 font-bold hover:text-gray-900 transition-colors">Cancel</button>
                        <button type="submit" class="px-10 py-4 bg-[#A85C2E] text-white rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-[#002d5c] transition-all duration-300 shadow-xl shadow-[#A85C2E]/20">Create Template</button>
                    </div>
                </form>
            </div>
        </x-modal>
    </div>
</x-agent-layout>
