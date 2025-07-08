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

        <x-form.input label="Title of Records" wire:model="name" />
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

            {{-- SINGLE SELECT TYPE --}}
            <div class="w-full">
                <div wire:ignore class="w-full">
                    <x-form.select2 label="Type of Material" id="type" wire:model="type">
                        <option value="">Select</option>
                        <option value="Paper">Paper</option>
                        <option value="Parchment / Vellum">Parchment / Vellum</option>
                        <option value="Photographs">Photographs</option>
                        <option value="Magnet Media (Tapes, Cds, DVDs)">Magnet Media (Tapes, Cds, DVDs)</option>
                        <option value="Manuscripts">Manuscripts</option>
                        <option value="Books">Books</option>
                        <option value="Negatives / Positives">Negatives / Positives</option>
                    </x-form.select2>
                </div>
                @error('type')
                    <x-form.error> {{ $message }} </x-form.error>
                @enderror
            </div>

            <div class="w-full">
                <x-form.date-input label="Date of Record" wire:model="date_of_record" />
                @error('date_of_record')
                    <x-form.error> {{ $message }} </x-form.error>
                @enderror
            </div>
        </div>

        {{--  SIZE / VOLUME , ARRANGEMENT --}}
        <div class="w-full flex items-start gap-2">
            <div class="w-full">
                <x-form.input label="Volume / Size of Records" wire:model="length" placeholder="Length" />
                @error('length')
                    <x-form.error> {{ $message }} </x-form.error>
                @enderror
                <x-form.input label="" wire:model="width" placeholder="Width" />
                @error('width')
                    <x-form.error> {{ $message }} </x-form.error>
                @enderror
            </div>

            {{-- SINGLE SELECT ARRANGEMENT --}}
            <div class="w-full">
                <div wire:ignore class="w-full">
                    <x-form.select2 label="Arrangement" id="arrangement" wire:model="arrangement">
                        <option value="">Select</option>
                        <option value="Alphabetical">Alphabetical</option>
                        <option value="Numerical">Numerical</option>
                        <option value="Chronological">Chronological</option>
                    </x-form.select2>
                </div>
                @error('arrangement')
                    <x-form.error> {{ $message }} </x-form.error>
                @enderror
            </div>
        </div>

        {{-- OFFICE OF ORIGIN / CONTACT PERSON --}}
        <div class="w-full flex items-center gap-2">
            <div class="w-full">
                <x-form.input label="Office of Origin / Creator" wire:model="office_of_origin" />
                @error('office_of_origin')
                    <x-form.error> {{ $message }} </x-form.error>
                @enderror
            </div>

            <div class="w-full">
                <x-form.input label="Contact Person" wire:model="contact_person" />
                @error('contact_person')
                    <x-form.error> {{ $message }} </x-form.error>
                @enderror
            </div>
        </div>


        {{--  ===================================== DESCRIPTION --}}
        <h1 class="font-bold text-xl">Description</h1>

        {{-- MULTI SELECT DESCRIPTION OF MATERIAL --}}
        <div class="w-full">
            <div wire:ignore class="w-full">
                <x-form.select2 label="Description of Material" id="description_of_material" multiple="multiple"
                    wire:model="description_of_material">
                    <option value="">Select</option>
                    <option value="Mounted">Mounted</option>
                    <option value="Lining">Lining</option>
                    <option value="Seals">Seals</option>
                    <option value="Fasteners">Fasteners</option>
                    <option value="Ribbons">Ribbons</option>
                    <option value="Tapes">Tapes</option>
                </x-form.select2>
            </div>
            @error('description_of_material')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>

        <x-form.textarea rows="2" label="Remarks" wire:model="remarks_1" />
        @error('remarks_1')
            <x-form.error> {{ $message }} </x-form.error>
        @enderror

        <x-form.textarea label="Stories Associated with the Natural Geological" wire:model="stories" />
        @error('stories')
            <x-form.error> {{ $message }} </x-form.error>
        @enderror

        <x-form.textarea label="Significance" wire:model="significance" />
        @error('significance')
            <x-form.error> {{ $message }} </x-form.error>
        @enderror

        {{-- ================================= CONSERVATION --}}
        <h1 class="font-bold text-xl">Conservation</h1>
        {{-- MULTI SELECT DESCRIPTION OF MATERIAL --}}
        <div class="w-full">
            <div wire:ignore class="w-full">
                <x-form.select2 label="Physical Condition" id="physical_condition" multiple="multiple"
                    wire:model="physical_condition">
                    <option value="">Select</option>
                    <option value="Yellowing">Yellowing</option>
                    <option value="Fading">Fading</option>
                    <option value="Foxing (Brown Spot)">Foxing (Brown Spot)</option>
                    <option value="Accretions">Accretions</option>
                    <option value="Holes">Holes</option>
                    <option value="Fingerprints">Fingerprints</option>
                    <option value="Tears/Break">Tears/Break</option>
                    <option value="Losses">Losses</option>
                    <option value="Creases">Creases</option>
                    <option value="Brittle">Brittle</option>
                    <option value="Abrasion">Abrasion</option>
                    <option value="Folds">Folds</option>
                    <option value="Wrinkles">Wrinkles</option>
                    <option value="Molds">Molds</option>
                    <option value="Insect Infestation">Insect Infestation</option>
                </x-form.select2>
            </div>
            @error('physical_condition')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>

        <x-form.textarea rows="2" label="Remarks" wire:model="remarks_2" />
        @error('remarks_2')
            <x-form.error> {{ $message }} </x-form.error>
        @enderror

        <x-form.textarea rows="3" label="" wire:model="narration" placeholder="Narration" />
        @error('narration')
            <x-form.error> {{ $message }} </x-form.error>
        @enderror

        {{-- ============================================================ REFERENCES --}}
        <x-form.textarea label="References" wire:model="references" />
        @error('references')
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

                    // ============================ TYPE
                    $('#type').select2({
                        tags: true
                    });

                    $('#type').on('change', function() {
                        let data = $(this).val();
                        $wire.set('type', data, false);
                    });

                    // ============================ ARRANGEMENT
                    $('#arrangement').select2({
                        tags: true
                    });

                    $('#arrangement').on('change', function() {
                        let data = $(this).val();
                        $wire.set('arrangement', data, false);
                    });

                    // MULTIPLE SELECT ================================== DESCRIPTION OF MATERIAL
                    $('#description_of_material').select2({
                        placeholder: 'Select',
                        closeOnSelect: true,
                        tags: true
                    });

                    $('#description_of_material').on('change', function() {
                        let data = $(this).val();
                        $wire.set('description_of_material', data, false);
                    });

                    // MULTIPLE SELECT ================================== PHYSICAL CONDITION
                    $('#physical_condition').select2({
                        placeholder: 'Select',
                        closeOnSelect: true,
                        tags: true
                    });

                    $('#physical_condition').on('change', function() {
                        let data = $(this).val();
                        $wire.set('physical_condition', data, false);
                    });

                });
            </script>
        @endscript
    </div>

</x-admin.body>
