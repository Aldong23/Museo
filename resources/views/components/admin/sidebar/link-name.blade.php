<style>
    @media print {
        .heading {
            display: none;
        }
    }
</style>

<span x-show="isOpen" x-cloak class="heading ms-2 text-sm text-nowrap hidden md:flex">{{ $slot }}
</span>
