<button {{ $attributes->merge([
    'type' => 'submit',
    'class' =>
        'inline-flex items-center px-4 py-2 bg-[#CEAB93] hover:bg-[#AD8B73] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-200 shadow-sm'
]) }}>
    {{ $slot }}
</button>
