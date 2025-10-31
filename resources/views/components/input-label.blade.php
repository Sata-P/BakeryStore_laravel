@props(['value'])

<label {{ $attributes->merge([
    'class' => '
        block font-medium text-sm 
        text-[#4B2E05]  {{-- น้ำตาลเข้มขึ้น --}}
        tracking-wide
    '
]) }}>
    {{ $value ?? $slot }}
</label>
