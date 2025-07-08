<div class="w-full relative font-mono">
    <input type="email" id="floating_outlined" autocomplete="off"
        {{ $attributes->merge(['class' => 'block px-2.5 pb-2.5 pt-4 w-full text-sm text-txt-primary bg-transparent rounded-lg border-1 border-brdr-primary appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer']) }}
        placeholder=" " />

    <label for="floating_outlined"
        class="absolute text-sm text-txt-secondary duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-bg-tertiary  px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">{{ $label }}
    </label>
</div>
