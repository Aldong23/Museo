<style>
    @media print {
        .heading {
            display: none;
        }
    }
</style>

<a class=" heading
    {{ $active ? 'bg-clr-midnight1 shadow-md font-semibold text-white' : 'text-gray-500' }}
    relative flex items-center px-6 py-4 bg-clr-midnight1 hover:text-white w-full transition-all duration-200 ease-out group"
    aria-current="{{ $active ? 'page' : 'false' }} "
    :class="isOpen ?
        'hidden md:flex' : 'hidden md:justify-center md:flex'" {{ $attributes }}>
    <div class="absolute left-0 top-0 bottom-0 w-1 bg-clr-crimson h-full hidden md:flex">

    </div>

    {{ $slot }}

    <div class="absolute right-3 w-2 h-2 rounded-full bg-clr-crimson {{ $active ? 'hidden md:flex' : 'hidden' }}">

    </div>
</a>
