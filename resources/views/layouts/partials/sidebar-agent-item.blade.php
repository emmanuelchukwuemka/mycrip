{{--
  sidebar-agent-item.blade.php
  Variables: $href, $label, $active, $icon (SVG path markup), $accent (bool, optional)
  Brand colors: #001F3F navy, #C6A664 gold
--}}
@php
    $accent  = $accent ?? false;
    $baseBtn = 'group relative flex items-center px-3 py-2.5 rounded-xl transition-all duration-200 cursor-pointer w-full';
    $iconBox = 'flex items-center justify-center w-8 h-8 flex-shrink-0 rounded-xl transition-all duration-200';
    if ($active) {
        $btnClass  = $baseBtn . ' bg-white/10 shadow-inner';
        $iconClass = $iconBox . ' bg-[#C6A664] text-white shadow-lg shadow-[#C6A664]/20';
        $textClass = 'text-white font-bold';
    } elseif ($accent) {
        $btnClass  = $baseBtn . ' text-white hover:bg-white/[0.08]';
        $iconClass = $iconBox . ' bg-[#C6A664]/20 text-[#C6A664] group-hover:bg-[#C6A664] group-hover:text-white';
        $textClass = 'font-bold text-[#C6A664] group-hover:text-white transition-colors duration-150';
    } else {
        $btnClass  = $baseBtn . ' text-white/90 hover:text-white hover:bg-white/[0.07]';
        $iconClass = $iconBox . ' bg-white/10 text-white group-hover:bg-white/20 group-hover:text-white';
        $textClass = 'font-semibold text-white/90 group-hover:text-white transition-colors duration-150';
    }
@endphp

<a href="{{ $href }}" class="{{ $btnClass }}" data-sidebar-tooltip="{{ $label }}">
    {{-- Icon --}}
    <div class="{{ $iconClass }}">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            {!! $icon !!}
        </svg>
    </div>

    {{-- Label (hidden when collapsed) --}}
    <span class="ml-3 text-sm {{ $textClass }} whitespace-nowrap transition-all duration-300 overflow-hidden"
          :class="sidebarCollapsed ? 'w-0 opacity-0 ml-0' : 'w-auto opacity-100'">
        {{ $label }}
    </span>

    {{-- Active indicator dot --}}
    @if($active)
        <span class="ml-auto w-1.5 h-1.5 flex-shrink-0 rounded-full transition-all duration-300"
              style="background:#C6A664; box-shadow:0 0 8px #C6A664;"
              :class="sidebarCollapsed ? 'hidden' : 'block'"></span>
    @endif

    {{-- Left accent border for active --}}
    @if($active)
        <span class="absolute left-0 top-1/2 -translate-y-1/2 w-0.5 h-5 rounded-r-full" style="background:#C6A664;"></span>
    @endif
</a>
