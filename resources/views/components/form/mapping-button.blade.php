<button {{ $attributes->merge(['class' => 'p-2 rounded-sm hover:bg-gray-100 border border-gray-200']) }}>
    {{ $slot }}
</button>
