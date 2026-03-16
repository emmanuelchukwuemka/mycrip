@php
    $announcements = \App\Models\Announcement::where('is_active', true)->get();
@endphp

@if($announcements->count() > 0)
    <div class="relative overflow-hidden py-2" style="background-color: {{ $announcements->first()->bg_color }}; color: {{ $announcements->first()->text_color }};">
        <div class="flex whitespace-nowrap animate-marquee">
            @foreach($announcements as $announcement)
                <div class="inline-flex items-center px-8">
                    @if($announcement->link)
                        <a href="{{ $announcement->link }}" class="hover:underline flex items-center">
                            <span class="mr-2">📢</span>
                            <span>{{ $announcement->content }}</span>
                        </a>
                    @else
                        <span class="mr-2">📢</span>
                        <span>{{ $announcement->content }}</span>
                    @endif
                </div>
            @endforeach
            
            {{-- Repeat for seamless loop --}}
            @foreach($announcements as $announcement)
                <div class="inline-flex items-center px-8">
                    @if($announcement->link)
                        <a href="{{ $announcement->link }}" class="hover:underline flex items-center">
                            <span class="mr-2">📢</span>
                            <span>{{ $announcement->content }}</span>
                        </a>
                    @else
                        <span class="mr-2">📢</span>
                        <span>{{ $announcement->content }}</span>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    <style>
        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .animate-marquee {
            display: inline-flex;
            animation: marquee 30s linear infinite;
        }
        .animate-marquee:hover {
            animation-play-state: paused;
        }
    </style>
@endif
