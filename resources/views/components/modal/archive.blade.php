<div x-data="{ archive: false }" x-show="archive" x-on:open-archive.window="archive = true"
    x-on:close-archive.window="archive = false" x-transition x-cloak
    class="absolute top-0 left-0 right-0 bottom-0 flex justify-center items-center" {{ $attributes }}>
    <div class="absolute top-0 left-0 right-0 bottom-0 bg-black opacity-50 z-10"></div>
    <div class="flex flex-col justify-between min-w-96 min-h-54 bg-gray-100 rounded-lg z-50 border dark:border-gray-500">
        {{-- ============= HEAD ========================================== --}}
        <div class="flex gap-2 items-center bg-clr-midnight1 w-full rounded-t-lg px-4 py-2 ">
            <svg class="w-[48px] h-[48px] text-red-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 13V8m0 8h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <span class="text-2xl font-bold text-white">Archive</span>
        </div>
        {{-- ============= BODY =========================================== --}}
        <div class="flex text-black font-semibold justify-center items-start w-full h-full py-6 px-4">
            {{ $slot }}
        </div>
        {{-- ============= FOOTER =========================================== --}}
        <div class="flex justify-center w-full p-4">
            <div class="flex gap-2 ">
                <x-form.cancel-btn x-on:click="$dispatch('close-archive')">Cancel</x-form.cancel-btn>
                {{ $button }}
            </div>
        </div>
    </div>
</div>
