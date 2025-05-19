@props(['active'])

@php
// TODO: Change line 7 and 9 to bootstrap classes.
$classes = ($active ?? false)
            ? 'd-block pl-3 pr-4 py-2 border-left
            focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700 transition duration-150 ease-in-out'
            : 'd-block pl-3 pr-4 py-2 border-left
            hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out';
$styles = ($active ?? false)
            ? 'border-color: rgba(129, 140, 248, 1); font-size: 1rem; line-height: 1.5rem; font-weight: 500; color: rgba(67, 56, 202, 1); background-color: rgba(238, 242, 255, 1);'
            : 'border-color: transparent; font-size: 1rem; line-height: 1.5rem; font-weight: 500; color: rgba(75, 85, 99, 1);';
@endphp

<a style="{{$styles}}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
