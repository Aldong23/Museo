{{-- <div class="w-full flex flex-col gap-1 p-2">
    <label for="" class="text-txt-secondary">
        {{ $label }}
    </label>

    <input
        class="bg-bg-tertiary border border-gray-500 bg-transparent py-1 text-txt-primary rounded focus:ring-btn-blue focus:border-btn-blue block w-full"
        type="file" {{ $attributes }}>

</div> --}}
@props(['id' => 'file-upload-' . uniqid(), 'label' => 'Upload File'])

<div class="w-full">
    <label for="{{ $id }}"
        class="flex items-center justify-between gap-1 text-black px-4 py-3 rounded-md cursor-pointer border border-gray-400">
        {{ $label }}
        <svg class="w-6 h-6 text-black" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
            fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd"
                d="M12 3a1 1 0 0 1 .78.375l4 5a1 1 0 1 1-1.56 1.25L13 6.85V14a1 1 0 1 1-2 0V6.85L8.78 9.626a1 1 0 1 1-1.56-1.25l4-5A1 1 0 0 1 12 3ZM9 14v-1H5a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2h-4v1a3 3 0 1 1-6 0Zm8 2a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H17Z"
                clip-rule="evenodd" />
        </svg>
        <input id="{{ $id }}" type="file" class="hidden" {{ $attributes }} />
    </label>
</div>
