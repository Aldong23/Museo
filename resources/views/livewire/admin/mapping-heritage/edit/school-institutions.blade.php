<x-slot:heading>Museo De Urdaneta</x-slot:heading>
<x-slot:secHeading>EDIT</x-slot:secHeading>
<x-admin.body>
    <div class="w-full h-full flex flex-col pb-8">

        <div class="w-full flex items-center gap-2 mb-4">
            <x-form.input disabled label="Cultural Heritage Category" wire:model="selectedCategory" />
            @if ($selectedCategory !== 'Significant Personalities')
                <x-form.input disabled label="Types of Cultural Heritage" wire:model="selectedType" />
            @endif
        </div>

        <x-form.input label="Name of Institution" wire:model="name" />
        @error('name')
            <x-form.error> {{ $message }} </x-form.error>
        @enderror

        {{-- ===================================================== Featured Collections  --}}
        <h1 class="font-bold my-2">Featured Collections</h1>

        <div class="space-y-2">
            @foreach ($fields as $index => $field)
                <div class="p-2 w-full flex flex-col gap-2 border border-gray-400 rounded-lg">
                    <div class="w-full flex items-center gap-2 mb-2">
                        <div class="w-full">
                            <x-form.file-input label="Photos" wire:model="fields.{{ $index }}.photos"
                                multiple="multiple" accept="image/*" />
                            @error("fields.$index.photos")
                                <x-form.error> {{ $message }} </x-form.error>
                            @enderror
                        </div>
                        <div class="w-full">
                            <x-form.input label="Photo Credit" wire:model="fields.{{ $index }}.photo_credit" />
                            @error("fields.$index.photo_credit")
                                <x-form.error> {{ $message }} </x-form.error>
                            @enderror
                        </div>
                        <div class="w-full">
                            <x-form.date-input label="Photo Date Captured"
                                wire:model="fields.{{ $index }}.photo_date" />
                            @error("fields.$index.photo_date")
                                <x-form.error> {{ $message }} </x-form.error>
                            @enderror
                        </div>
                        @if ($index !== 0)
                            <button type="button" wire:click="removeField({{ $index }})"
                                class="flex items-center gap-2 w-fit px-4 py-2 rounded bg-red-500 hover:bg-red-400 text-white">
                                <svg class="w-5 h-5 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>

                                Remove
                            </button>
                        @endif
                    </div>
                    <div>

                        @if (!empty($field['photos']))
                            <div class="flex flex-wrap gap-2 p-2 rounded-lg">
                                @foreach ($field['photos'] as $photoIndex => $photo)
                                    <div class="relative">
                                        <button wire:click="removePhoto({{ $index }}, {{ $photoIndex }})"
                                            class="absolute top-0 right-0 bg-red-500 text-white p-2 rounded text-xs">Remove</button>

                                        @if ($photo instanceof \Illuminate\Http\UploadedFile)
                                            <img class="rounded-md h-64 flex" src="{{ $photo->temporaryUrl() }}">
                                        @else
                                            <img class="rounded-md h-64 flex" src="{{ Storage::url($photo) }}">
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                </div>
            @endforeach
            <div class="w-full flex justify-end">
                <button type="button" wire:click="addField"
                    class="w-fit flex items-center gap-2  px-4 py-2 rounded bg-blue-500 hover:bg-blue-400 text-white text-nowrap">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    Add Text Field
                </button>
            </div>
        </div>

        {{-- ===================================================== Background Information  --}}
        <h1 class="font-bold text-xl my-2">Background Information</h1>
        <div class="w-full flex items-center gap-2">
            <div class="w-full">
                <x-form.input label="Municipality / City" wire:model="city" />
                @error('city')
                    <x-form.error> {{ $message }} </x-form.error>
                @enderror
            </div>
            <div class="w-full">
                <x-form.input label="Province" wire:model="province" />
                @error('province')
                    <x-form.error> {{ $message }} </x-form.error>
                @enderror
            </div>
        </div>

        <x-form.input label="Location / Address" wire:model="location" />
        @error('location')
            <x-form.error> {{ $message }} </x-form.error>
        @enderror

        {{-- SINGLE SELECT TYPE OF CULTURAL INSTITUTION --}}
        <div class="w-full mt-3">
            <x-form.input disabled label="Type of Cultural Institution" wire:model="type" />
            @error('type')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>

        {{-- ===================================================== Remarks  --}}
        <div class="w-full p-2">
            <h1 class="text-gray-900 my-2">Remarks</h1>

            @if ($remarks_image)
                @if ($remarks_image instanceof \Illuminate\Http\UploadedFile)
                    <div class="w-fit flex flex-col items-end gap-2 p-2 border border-gray-400 rounded-lg ">
                        <img class="rounded-md h-64 flex" src="{{ $remarks_image->temporaryUrl() }}">
                        <button class="w-fit text-white text-xs bg-red-500 rounded py-1 px-2"
                            wire:click="change2">Remove</button>
                    </div>
                @else
                    <div class="w-fit flex flex-col items-end gap-2 p-2 border border-gray-400 rounded-lg ">
                        <img class="rounded-md h-64 flex" src="{{ Storage::url($remarks_image) }}">
                        <button class="w-fit text-white text-xs bg-red-500 rounded py-1 px-2"
                            wire:click="change2">Remove</button>
                    </div>
                @endif
            @else
                <div class="w-full p-2">
                    <x-form.file wire:model="remarks_image" accept="image/*" />
                </div>
            @endif
        </div>

        <x-form.textarea label="" wire:model="remarks_text" />
        @error('remarks_text')
            <x-form.error> {{ $message }} </x-form.error>
        @enderror

        <x-form.textarea label="Narrative Description" wire:model="narrative_description" />
        @error('narrative_description')
            <x-form.error> {{ $message }} </x-form.error>
        @enderror

        <x-form.textarea label="Stories and Narrative" wire:model="stories" />
        @error('stories')
            <x-form.error> {{ $message }} </x-form.error>
        @enderror

        <x-form.textarea label="Significance" wire:model="significance" />
        @error('significance')
            <x-form.error> {{ $message }} </x-form.error>
        @enderror

        {{-- ================================= SUPPORTING DOCUMENTATION --}}
        <h1 class="font-bold text-xl mb-1">References</h1>
        {{-- MULTI SELECT SUPPORTING DOCUMENTATION --}}
        <div class="w-full">
            <div wire:ignore class="w-full">
                <x-form.select2 label="Supporting Documentation" id="supporting_documentation" multiple="multiple"
                    wire:model="supporting_documentation">
                    <option value="">Select</option>
                    <option value="Print, write-ups">Print, write-ups</option>
                    <option value="Audio/video recording">Audio/video recording</option>
                    <option value="Photographs and sketches">Photographs and sketches</option>
                </x-form.select2>
            </div>
            @error('supporting_documentation')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>

        <x-form.textarea label="Key Informat/s" wire:model="key_informats" />
        @error('key_informats')
            <x-form.error> {{ $message }} </x-form.error>
        @enderror

        <x-form.textarea label="Name of Mapper/s" wire:model="mappers" />
        @error('mappers')
            <x-form.error> {{ $message }} </x-form.error>
        @enderror

        <div class="w-96">
            <x-form.date-input label="Date Profiled" wire:model="date_profiled" />
            @error('date_profiled')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>


        <div class="w-full flex justify-end px-4 pt-4 pb-20">
            <div class="flex items-center gap-4">
                <x-form.return href="/mapping-heritage">Cancel</x-form.return>
                <x-form.button wire:click="save" wire:target="save" wire:loading.attr="disabled"
                    wire:loading.class="cursor-not-allowed opacity-50">
                    Save
                    <img wire:loading wire:target="save" src="/images/icons/loading.svg" alt="..." />
                </x-form.button>
            </div>
        </div>

        @script()
            <script>
                $(document).ready(function() {

                    // ================================== TYPE
                    $('#type').select2({
                        tags: true
                    });

                    $('#type').on('change', function() {
                        let data = $(this).val();
                        $wire.set('type', data, false);
                    });

                    // MULTIPLE SELECT ================================== SUPPORTING DOCUMENTATION
                    $('#supporting_documentation').select2({
                        placeholder: 'Select',
                        closeOnSelect: true,
                        tags: true
                    });

                    $('#supporting_documentation').on('change', function() {
                        let data = $(this).val();
                        $wire.set('supporting_documentation', data, false);
                    });

                });
            </script>
        @endscript
    </div>

</x-admin.body>
