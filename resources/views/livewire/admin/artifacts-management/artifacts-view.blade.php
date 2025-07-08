<x-slot:heading>Museo De Urdaneta</x-slot:heading>
<x-slot:secHeading>View Artifacts</x-slot:secHeading>
<x-admin.body>
<div class="w-full flex items-center gap-2 mb-2">
    {{-- ARTIFACTS CATEGORY --}}
    <div class="w-full">
        <x-form.input label="Artifacts Category" value="{{ $artifact->category }}" disabled />
    </div>

    <div class="w-full">
        <x-form.input label="Types of Artifacts" value="{{ $artifact->type }}" disabled />
    </div>
</div>

<x-form.input label="Artifact Name" value="{{ $artifact->name }}" disabled />

<div class="flex items-center py-3">
    <div class="w-full">
        <x-form.input label="Date Photograph" value="{{ \Carbon\Carbon::parse($artifact->date_photograph)->format('m/d/Y') }}" disabled />
    </div>
    <div class="w-full">
        <x-form.input label="Owned by" value="{{ $artifact->owned_by }}" disabled />
    </div>
    <div class="w-full">
        <x-form.input label="Donated by" value="{{ $artifact->donated_by }}" disabled />
    </div>
</div>

<div class="w-full flex flex-col gap-1 p-2">
    <label class="text-txt-secondary">Description</label>
    <div class="border border-brdr-primary text-txt-primary rounded-lg p-2.5 whitespace-pre-wrap">{{ $artifact->description }}</div>
</div>
<div class="w-full flex flex-col gap-1 p-2">
    <label class="text-txt-secondary">Story of Artifacts</label>
    <div class="border border-brdr-primary text-txt-primary rounded-lg p-2.5 whitespace-pre-wrap">{{ $artifact->story }}</div>
</div>

{{-- ===================================================== Featured Collections --}}
<h1 class="mb-2 mt-4 ms-2">Featured Collections</h1>

@if ($artifact->collections)
    <div x-data="{ modalOpen: false, modalImage: '' }">
        <div class="w-fit flex flex-col items-end gap-1">
            <div class="flex flex-wrap gap-2 p-2 border border-gray-400 rounded-lg">
                @foreach ($artifact->collections as $collection)
                    <button @click="modalOpen = true; modalImage = '{{ asset('storage/' . str_replace('\/', '/', $collection)) }}'">
                        <img class="rounded-md h-64 flex cursor-pointer" 
                            src="{{ asset('storage/' . str_replace('\/', '/', $collection)) }}">
                    </button>
                @endforeach
            </div>
        </div>

        {{-- Modal --}}
        <div wire:ignore x-show="modalOpen" 
            class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center p-4 z-50"
            x-transition.opacity @click="modalOpen = false">
            <div class="relative" @click.stop>
                <button @click="modalOpen = false" class="absolute top-2 right-2 text-white text-3xl">&times;</button>
                <img :src="modalImage" class="max-w-full max-h-screen rounded-lg shadow-lg">
            </div>
        </div>
    </div>
@endif



</x-admin.body>