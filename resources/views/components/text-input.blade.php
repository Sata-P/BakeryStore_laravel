@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'border-cocoa-300 text-cocoa-900 focus:border-cocoa-500 focus:ring-cocoa-500 rounded-md shadow-sm'
]) !!}>