<style>
    @media print {
        .heading {
            display: none;
        }
    }
</style>

<a class=" heading
    {{ $active ? 'bg-clr-midnight1 shadow-md font-semibold text-white' : 'text-gray-500' }}
    relative flex items-center px-0 py-0 md:px-6 md:py-4 hover:bg-clr-midnight1 hover:text-white w-full transition-all duration-200 ease-out group"
    aria-current="{{ $active ? 'page' : 'false' }} " :class="isOpen ?
        '' : 'hidden md:justify-center md:flex'"
    {{ $attributes }}>
    <div class="absolute left-0 top-0 bottom-0 w-0 md:w-2 bg-clr-crimson h-full {{ $active ? 'flex' : 'hidden' }}">

    </div>

    {{ $slot }}
</a>
