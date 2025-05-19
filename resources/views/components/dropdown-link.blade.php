<a style="font-size: 0.875rem; line-height: 1.25rem; color: rgba(55, 65, 81, 1)" {{ $attributes->merge(['class' => 'd-block px-3 py-2
    hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out'
]) }}>{{ $slot }}</a>
{{-- TODO: Change line 2 to bootstrap classes --}}
