<div class="w-full h-full flex flex-col pb-8">


    <x-form.input label="Name of the Elements" wire:model="name" />
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
                            <svg class="w-5 h-5 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>

                            Remove
                        </button>
                    @endif
                </div>
                {{-- <div wire:loading
                    class="w-full text-center bg-gray-400 animate-pulse rounded-sm p-2">
                    Uploading...
                </div> --}}
                <div>
                    @if (!empty($field['photos']))
                        <div class="flex flex-wrap gap-2 p-2 rounded-lg">
                            @foreach ($field['photos'] as $photoIndex => $photo)
                                @if ($photo)
                                    <div>
                                        <img class="rounded-md h-64 flex" src="{{ $photo->temporaryUrl() }}">
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>
        @endforeach
        <div class="w-full flex justify-end">
            <button type="button" wire:click="addField"
                class="w-fit flex items-center gap-2  px-4 py-2 rounded bg-blue-500 hover:bg-blue-400 text-white text-nowrap">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                Add Text Field
            </button>
        </div>
    </div>


    {{-- ===================================================== Background Information  --}}
    <h1 class="font-bold text-xl my-2">Background Information</h1>
    {{-- SINGLE SELECT TYPE --}}
    <div class="w-full">
        <div wire:ignore class="w-full">
            <x-form.select2 label="Type" id="type" wire:model="type">
                <option value="">Select</option>
                <option value="Proverbs">Proverbs</option>
                <option value="Riddles">Riddles</option>
                <option value="Tales">Tales</option>
                <option value="Nursery rhymes">Nursery rhymes</option>
                <option value="Dramatic performance">Dramatic performance</option>
                <option value="Legends">Legends</option>
                <option value="Myths">Myths</option>
                <option value="Epic">Epic</option>
                <option value="Song">Song</option>
                <option value="Poems">Poems</option>
                <option value="Charm">Charm</option>
                <option value="Prayer">Prayer</option>
                <option value="Chant">Chant</option>
            </x-form.select2>

        </div>
        @error('type')
            <x-form.error> {{ $message }} </x-form.error>
        @enderror
    </div>

    <x-form.textarea label="Geographical Location and Range of the Elements" wire:model="geographical_location" />
    @error('geographical_location')
        <x-form.error> {{ $message }} </x-form.error>
    @enderror

    <x-form.select-input label="Related Domains of the Intangible Cultural Heritage" wire:model="related_domains">
        <option value="">Select</option>
        <option value="Performing arts">Performing arts</option>
        <option value="Oral traditions and expressions">Oral traditions and expressions</option>
        <option value="Knowledge and practices concerning nature and the universe">Knowledge and practices concerning
            nature and the universe</option>
        <option value="Traditional craftsmanship">Traditional craftsmanship</option>
    </x-form.select-input>
    @error('related_domains')
        <x-form.error> {{ $message }} </x-form.error>
    @enderror
    <br>
    {{-- ================================= Description of Intangible Cultural Heritage --}}
    <h1 class="font-bold text-xl">Description of Intangible Cultural Heritage</h1>
    <x-form.textarea label="Summary of the Elemets" wire:model="summary_of_elements" />
    @error('summary_of_elements')
        <x-form.error> {{ $message }} </x-form.error>
    @enderror



    {{-- * ================================================== TABLE (List of Significant Tangible Movable Heritage) ======================================== --}}
    <div class="w-full h-auto p-2 mt-4 mb-4">
        <h1 class="text-gray-800 mb-1">List of Significant Tangible Movable Heritage Used / Associated with the Element
        </h1>
        <x-form.table.table>
            <x-slot:head>
                <x-form.table.th>Name of Object</x-form.table.th>
                <x-form.table.th>Photo</x-form.table.th>
                <x-form.table.th>Year produced or estimated age</x-form.table.th>
                <x-form.table.th>Use of the object in the practice</x-form.table.th>
                <x-form.table.th></x-form.table.th>
            </x-slot:head>

            @foreach ($lists_1 as $index => $list)
                <x-form.table.tr>
                    <x-form.table.td>
                        <div class="w-full">
                            <x-form.input label=""
                                placeholder="Name of Built Structure or Significant Flora / Fauna"
                                wire:model="lists_1.{{ $index }}.name_1" />
                            @error("lists_1.$index.name_1")
                                <x-form.error> {{ $message }} </x-form.error>
                            @enderror
                        </div>
                    </x-form.table.td>
                    <x-form.table.td class="align-middle">

                        <div class="w-full flex gap-1 items-center">
                            <x-form.file-input label="Photo" wire:model="lists_1.{{ $index }}.photo_1"
                                accept="image/*" />
                            @error("lists_1.$index.photo_1")
                                <x-form.error> {{ $message }} </x-form.error>
                            @enderror

                            @if (!empty($list['photo_1']))
                                <div class=" w-fit">
                                    <img class="rounded-sm h-11 flex" src="{{ $list['photo_1']->temporaryUrl() }}">
                                </div>
                            @endif
                        </div>

                    </x-form.table.td>
                    <x-form.table.td>
                        <div class="w-full">
                            <x-form.input label="" placeholder="Year produced or estimated age"
                                wire:model="lists_1.{{ $index }}.year_produced_1" />
                            @error("lists_1.$index.year_produced_1")
                                <x-form.error> {{ $message }} </x-form.error>
                            @enderror
                        </div>
                    </x-form.table.td>
                    <x-form.table.td>
                        <div class="w-full">
                            <x-form.textarea rows="1" label=""
                                wire:model="lists_1.{{ $index }}.use_1" />
                            @error("lists_1.$index.use_1")
                                <x-form.error> {{ $message }} </x-form.error>
                            @enderror
                        </div>
                    </x-form.table.td>
                    <x-form.table.td>
                        <button type="button" wire:click="removeList1({{ $index }})"
                            class="flex items-center gap-1 w-fit px-4 py-2 mt-3 rounded bg-red-500 hover:bg-red-400 text-white">
                            <svg class="w-5 h-5 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>

                            Remove
                        </button>
                    </x-form.table.td>
                </x-form.table.tr>
            @endforeach

            <x-form.table.tr>
                <x-form.table.td colspan="5">
                    <div class="w-full flex items-center justify-center">
                        <button type="button" wire:click="addList1"
                            class="w-fit flex items-center gap-2 px-8 py-2 rounded bg-blue-500 hover:bg-blue-400 text-white text-nowrap">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            Add
                        </button>
                    </div>
                </x-form.table.td>
            </x-form.table.tr>
        </x-form.table.table>
    </div>


    {{-- * ================================================== TABLE (List of Significant Flora /  Fauna Used) ======================================== --}}
    <div class="w-full h-auto p-2 mt-4 mb-4">
        <h1 class="text-gray-800 mb-1">List of Significant Flora / Fauna Used / Associated with the Element
        </h1>
        <x-form.table.table>
            <x-slot:head>
                <x-form.table.th>Name of Flora / Fauna</x-form.table.th>
                <x-form.table.th>Photo</x-form.table.th>
                <x-form.table.th>Use of the flora / fauna in the practice</x-form.table.th>
                <x-form.table.th></x-form.table.th>
            </x-slot:head>

            @foreach ($lists_2 as $index => $list)
                <x-form.table.tr>
                    <x-form.table.td>
                        <div class="w-full">
                            <x-form.input label=""
                                placeholder="Name of Built Structure or Significant Flora / Fauna"
                                wire:model="lists_2.{{ $index }}.name_2" />
                            @error("lists_2.$index.name_2")
                                <x-form.error> {{ $message }} </x-form.error>
                            @enderror
                        </div>
                    </x-form.table.td>
                    <x-form.table.td class="align-middle">
                        <div class="w-full flex gap-1 items-center">
                            <x-form.file-input label="Photo" wire:model="lists_2.{{ $index }}.photo_2"
                                accept="image/*" />
                            @error("lists_2.$index.photo_2")
                                <x-form.error> {{ $message }} </x-form.error>
                            @enderror

                            @if (!empty($list['photo_2']))
                                <div class=" w-fit">
                                    <img class="rounded-sm h-11 flex" src="{{ $list['photo_2']->temporaryUrl() }}">
                                </div>
                            @endif
                        </div>
                    </x-form.table.td>
                    <x-form.table.td>
                        <div class="w-full">
                            <x-form.textarea rows="1" label=""
                                wire:model="lists_2.{{ $index }}.use_2" />
                            @error("lists_2.$index.use_2")
                                <x-form.error> {{ $message }} </x-form.error>
                            @enderror
                        </div>
                    </x-form.table.td>
                    <x-form.table.td>
                        <button type="button" wire:click="removeList2({{ $index }})"
                            class="flex items-center gap-1 w-fit px-4 py-2 mt-3 rounded bg-red-500 hover:bg-red-400 text-white">
                            <svg class="w-5 h-5 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>

                            Remove
                        </button>
                    </x-form.table.td>
                </x-form.table.tr>
            @endforeach

            <x-form.table.tr>
                <x-form.table.td colspan="5">
                    <div class="w-full flex items-center justify-center">
                        <button type="button" wire:click="addList2"
                            class="w-fit flex items-center gap-2 px-8 py-2 rounded bg-blue-500 hover:bg-blue-400 text-white text-nowrap">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            Add
                        </button>
                    </div>
                </x-form.table.td>
            </x-form.table.tr>
        </x-form.table.table>
    </div>



    <x-form.textarea label="Stories / Narratives Associated with the Element" wire:model="stories" />
    @error('stories')
        <x-form.error> {{ $message }} </x-form.error>
    @enderror

    <x-form.textarea label="Significance" wire:model="significance" />
    @error('significance')
        <x-form.error> {{ $message }} </x-form.error>
    @enderror


    <x-form.textarea rows="3" label="Assessment of the Practice" wire:model="assessment_of_practice" />
    @error('assessment_of_practice')
        <x-form.error> {{ $message }} </x-form.error>
    @enderror

    <x-form.select-input label="Measures and Description of Safeguard Measure Taken"
        wire:model="measures_and_description_dropdown">
        <option value="">Select</option>
        <option value="Transmission, particularly through formal education">Transmission, particularly through formal
            education</option>
        <option value="Transmission, particularly through non-formal education">Transmission, particularly through
            non-formal education</option>
        <option value="Dentification, documentation, research">Dentification, documentation, research</option>
        <option value="Preservation, protection">Preservation, protection</option>
        <option value="Promotion, enhancement">Promotion, enhancement</option>
        <option value="Revitalization">Revitalization</option>
    </x-form.select-input>
    @error('measures_and_description_dropdown')
        <x-form.error> {{ $message }} </x-form.error>
    @enderror

    <x-form.textarea rows="3" label="" wire:model="measures_and_description_text" />
    @error('measures_and_description_text')
        <x-form.error> {{ $message }} </x-form.error>
    @enderror

    {{-- ================================= REFERENCES --}}
    <h1 class="font-bold text-xl">References</h1>

    {{-- MULTI SELECT SUPPORTING DOCUMENTATION --}}
    <div class="w-full">
        <div wire:ignore class="w-full">
            <x-form.select2 label="Supporting Documentation" id="supporting_documentation" multiple="multiple"
                wire:model="supporting_documentation">
                <option value="">Select</option>
                <option value="Audio/video recording">Audio/video recording</option>
                <option value="Photographs and sketches">Photographs and sketches</option>
            </x-form.select2>
        </div>
        @error('supporting_documentation')
            <x-form.error> {{ $message }} </x-form.error>
        @enderror
    </div>


    <x-form.textarea rows="2" label="Key Informat/s" wire:model="key_informat" />
    @error('key_informat')
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

    {{-- ================================= ATTACHMENTS --}}
    <h1 class="font-bold text-xl">Attachment</h1>
    <x-form.textarea rows="2" label="" wire:model="attachment_text" />
    @error('attachment_text')
        <x-form.error> {{ $message }} </x-form.error>
    @enderror


    @if ($attachment_image)
        <div class="w-fit flex flex-col items-end gap-2 p-2 border border-gray-400 rounded-lg ">
            <img class="rounded-md h-64 flex" src="{{ $attachment_image->temporaryUrl() }}">
            <button class="w-fit text-white text-xs bg-red-500 rounded py-1 px-2" wire:click="change2">Remove</button>
        </div>
    @else
        <div class="w-96 p-2">
            <x-form.file wire:model="attachment_image" accept="image/*" />
        </div>
    @endif



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

                //  ================================== TYPE
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
