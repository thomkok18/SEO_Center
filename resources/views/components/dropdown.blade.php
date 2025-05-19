@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'py-1 bg-white'])

@php
switch ($align) {
    case 'left':
        $alignmentClasses = 'transform-origin: top left; left: 0;';
        break;
    case 'top':
        $alignmentClasses = 'transform-origin: top;';
        break;
    case 'right':
    default:
        $alignmentClasses = 'transform-origin: top right; right: 0;';
        break;
}

switch ($width) {
    case '48':
        $width = 'width: 12rem;';
        break;
}
@endphp

<div class="relative" x-data="{ open: false }" @click.away="open = false" @close.stop="open = false">
    <div @click="open = ! open">
        {{ $trigger }}
    </div>

    <div x-show="open"
            {{-- TODO: Change to bootstrap classes --}}
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="transform opacity-0 scale-95"
            x-transition:enter-end="transform opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-95"
            class="position-absolute mt-2 shadow-sm"
            style="
                display: none; z-index: 50; {{ $width }} border-radius: 0.375rem; {{ $alignmentClasses }}
                "
            @click="open = false">
        <div style="border-radius: 0.375rem; box-shadow: 0 0 0 1px black; opacity: 0.05;" class="{{ $contentClasses }}">
            {{ $content }}
        </div>
    </div>
</div>
