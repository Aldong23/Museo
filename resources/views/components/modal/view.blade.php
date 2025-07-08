<div x-data="{ view: false }" x-show="view" x-on:open-view.window="view = true" x-on:close-view.window="view = false"
    x-cloak x-transition class="absolute top-0 left-0 right-0 bottom-0 flex justify-center items-center">
    <div class="absolute top-0 left-0 right-0 bottom-0 bg-black/50 backdrop-blur-sm z-10"></div>
    <div class="w-[800px] h-[400px] p-12 z-50">
        <div class="flex flex-col justify-between w-full h-full bg-clr-midnight1 rounded-lg border dark:border-gray-500">
            {{-- ============= HEAD ========================================== --}}
            <div class="flex items-center justify-between bg-bg-quart w-full rounded-t-lg px-4 py-2">
                <h1 class="text-2xl font-bold text-gray-100 ">
                    {{ $header }}
                </h1>
                <button title="Close" x-on:click="$dispatch('close-view')">
                    <svg class="w-[38px] h-[38px] text-red-500 hover:text-red-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            {{-- ============= BODY =========================================== --}}
            <div class="relative w-full h-full">
                <div
                    class="absolute bg-gray-100 inset-0 overflow-y-auto p-5 scrollbar-thin scrollbar-track-bg-secondary scrollbar-thumb-bg-tertiary ">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>
