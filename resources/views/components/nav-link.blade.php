@props(['active'])

@php
$classes = ($active ?? false)
            ? 'nav-link disabled'
            : 'nav-link active';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
