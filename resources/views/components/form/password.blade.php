{{-- <div class="w-full flex flex-col gap-1 relative p-2" x-data="{ show: false }">

    <label class="text-gray-600">{{ $label }}</label>


    <input :type="show ? 'text' : 'password'" autocomplete="off"
        {{ $attributes->merge(['class' => 'bg-bg-tertiary border border-brdr-primary text-txt-primary text-sm rounded-lg focus:ring-btn-blue focus:border-btn-blue block w-full p-2.5']) }}
        placeholder=" " />



    <button @keydown.enter.prevent class="absolute right-5 top-11 text-white" @click.prevent="show = !show"
        :title="show ? 'Hide' : 'Show'">
       
        <svg :class="show ? 'hidden' : ''" class="w-6 h-6 text-txt-secondary rounded-sm hover:bg-gray-300"
            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
            viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                d="M3.933 13.909A4.357 4.357 0 0 1 3 12c0-1 4-6 9-6m7.6 3.8A5.068 5.068 0 0 1 21 12c0 1-3 6-9 6-.314 0-.62-.014-.918-.04M5 19 19 5m-4 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
        </svg>
    
        <svg :class="show ? '' : 'hidden'" class="w-6 h-6 text-txt-secondary rounded-sm hover:bg-gray-300"
            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
            viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-width="1"
                d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
            <path stroke="currentColor" stroke-width="1" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
        </svg>

    </button>
</div> --}}

<div class="w-full relative p-2" x-data="{ show: false }">
    <input :type="show ? 'text' : 'password'" id="floating_outlined" autocomplete="off"
        {{ $attributes->merge(['class' => 'block px-2.5 pb-2.5 pt-4 w-full text-sm text-txt-primary bg-transparent rounded-lg border-1 border-brdr-primary appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer']) }}
        placeholder=" " />

    <label for="floating_outlined"
        class="absolute text-sm text-txt-secondary bg-white rounded duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-3 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-4">{{ $label }}</label>
    <button @keydown.enter.prevent class="absolute right-5 top-5 text-white" @click.prevent="show = !show"
        :title="show ? 'Hide' : 'Show'">
        {{-- SHOW --}}
        <svg :class="show ? 'hidden' : ''" class="w-6 h-6 text-txt-secondary hover:p-1 rounded-sm hover:bg-bg-secondary"
            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
            viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                d="M3.933 13.909A4.357 4.357 0 0 1 3 12c0-1 4-6 9-6m7.6 3.8A5.068 5.068 0 0 1 21 12c0 1-3 6-9 6-.314 0-.62-.014-.918-.04M5 19 19 5m-4 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
        </svg>
        {{-- HIDE --}}
        <svg :class="show ? '' : 'hidden'" class="w-6 h-6 text-txt-secondary hover:p-1 rounded-sm hover:bg-bg-secondary"
            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
            viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-width="1"
                d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
            <path stroke="currentColor" stroke-width="1" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
        </svg>

    </button>
</div>
