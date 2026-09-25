@props([
    'target',
    'label' => 'Copy',
    'done' => 'Copied',
    'failed' => 'Copy failed',
])

@php
    // Callers that pass their own class get exactly that class. Merge would
    // append both and leave conflicting Tailwind utilities to fight over CSS
    // source order.
    $classes = $attributes->get('class', 'px-2 py-1 text-[10px] font-bold rounded bg-indigo-500/10 text-indigo-300 hover:bg-indigo-500/20 whitespace-nowrap transition');
@endphp

{{--
    The selector travels in a data attribute rather than inside the x-data
    expression: Blade escapes it correctly here, whereas raw JSON in an
    attribute value would terminate the attribute at its first double quote.
--}}
<button type="button" x-data="copyButton" data-copy-target="{{ $target }}" @click="copy($el)"
    {{ $attributes->except('class')->merge(['class' => $classes]) }}>
    <span x-show="state === 'idle'">{{ $label }}</span>
    <span x-show="state === 'done'" x-cloak>{{ $done }}</span>
    <span x-show="state === 'failed'" x-cloak class="text-amber-300">{{ $failed }}</span>
</button>
