<x-slot:heading>Museo De Urdaneta</x-slot:heading>
<x-slot:secHeading>Edit Artifact</x-slot:secHeading>
<x-admin.body>


    <div class="w-full flex items-center gap-2">
        {{-- ARTIFACTS CATEGORY --}}
        <div class="w-full">
            <x-form.select-input label="Artifacts Category" wire:model.change="selectedCategory"
                wire:change="updateSubcategories">
                <option value="">Select Category</option>
                @foreach ($categories as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </x-form.select-input>
            @error('selectedCategory')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>

        <div class="w-full">
            <x-form.select-input label="Types of Artifacts" wire:model.change="selectedType">
                <option value="">Select Subcategory</option>
                @foreach ($types as $type)
                    <option value="{{ $type }}">{{ $type }}</option>
                @endforeach
            </x-form.select-input>
            @error('selectedType')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>


    </div>

    <x-form.input label="Artifact Name" wire:model="name" />
    @error('name')
        <x-form.error> {{ $message }} </x-form.error>
    @enderror

    <div class="flex items-center py-3">
        <div class="w-full">
            <x-form.date-input label="Date Photograph" wire:model="date_photograph" />
            @error('date_photograph')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>
        <div class="w-full">
            <x-form.input label="Owned by" wire:model="owned_by" />
            @error('owned_by')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>
        <div class="w-full">
            <x-form.input label="Donated by" wire:model="donated_by" />
            @error('donated_by')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>

    </div>

    <x-form.textarea label="Description" wire:model="description" />
    @error('description')
        <x-form.error> {{ $message }} </x-form.error>
    @enderror

    <x-form.textarea label="Story of Artifacts" wire:model="story" />
    @error('story')
        <x-form.error> {{ $message }} </x-form.error>
    @enderror


    {{-- ===================================================== Featured Collections  --}}
    <h1 class="mb-2 mt-4 ms-2">Featured Collections</h1>
    {{-- ----------- EXISTING IMAGES ------------- --}}
    @if ($existingImages)
        <div class="mt-4 p-2">
            <h4 class="text-gray-700">Existing Collections:</h4>
            <div class="flex flex-wrap gap-1">
                @foreach ($existingImages as $index => $image)
                    <div class="relative">
                        <img class="rounded h-96 flex" src="{{ Storage::url($image) }}">
                        <button type="button" wire:click="removeExistingImage({{ $index }})"
                            class="absolute top-2 right-2 bg-red-600 hover:bg-red-500 text-white rounded-full px-2 "
                            title="Remove">x</button>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    @if ($collections)
        <div class="w-fit flex flex-col items-end gap-1">
            <div class="flex flex-wrap gap-2 p-2 border border-gray-400 rounded-lg ">
                @foreach ($collections as $collection)
                    <img class="rounded-md h-64 flex" src="{{ $collection->temporaryUrl() }}">
                @endforeach
            </div>
            <button class="w-fit text-white text-xs bg-red-500 rounded py-1 px-2" wire:click="change1">Remove</button>
        </div>
    @else
        <x-form.file multiple accept="image/*" wire:model="collections" />
    @endif
    @error('collections')
        <x-form.error> {{ $message }} </x-form.error>
    @enderror

    <div class="flex items-center justify-end px-4 py-6">
        <div class="flex items-center gap-4">
            <x-form.cancel-link href="/artifacts-managements">Cancel</x-form.cancel-link>
            <x-form.button wire:click="update">Save</x-form.button>
        </div>
    </div>
</x-admin.body>
