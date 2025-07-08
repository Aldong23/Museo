<div class="w-full relative p-2">
    <div class="relative">
        <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3 pointer-events-none">
            <svg class="w-5 h-5 text-txt-primary" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd"
                    d="M6 5V4a1 1 0 1 1 2 0v1h3V4a1 1 0 1 1 2 0v1h3V4a1 1 0 1 1 2 0v1h1a2 2 0 0 1 2 2v2H3V7a2 2 0 0 1 2-2h1ZM3 19v-8h18v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm5-6a1 1 0 1 0 0 2h8a1 1 0 1 0 0-2H8Z"
                    clip-rule="evenodd" />
            </svg>
        </div>
        <input id="floating_outlined" autocomplete="off"
            {{ $attributes->merge(['class' => 'block px-2.5 pb-2.5 pt-4 w-full text-base text-txt-primary bg-transparent rounded-lg border-1 border-gray-400 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer', 'type' => 'date']) }}
            placeholder=" " />
    </div>

    <label for="floating_outlined"
        class="absolute text-sm text-txt-secondary duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white  px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-5 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-4">{{ $label }}
    </label>
</div>
