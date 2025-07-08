<button type="submit"
    {{ $attributes->merge(['class' => 'flex items-center gap-2 bg-clr-crimson w-fit h-fit hover:bg-clr-crimson1 text-lg text-white font-bold py-2 px-6 lg:px-10 rounded-md']) }}>
    {{ $slot }}
</button>
