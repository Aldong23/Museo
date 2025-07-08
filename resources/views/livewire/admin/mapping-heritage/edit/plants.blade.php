<x-slot:heading>Museo De Urdaneta</x-slot:heading>
<x-slot:secHeading>EDIT</x-slot:secHeading>
<x-admin.body>
    <div class="w-full h-full flex flex-col pb-8">

        <div class="w-full flex items-center gap-2 mb-4">
            <x-form.select-input disabled label="Cultural Heritage Category" wire:model.change="selectedCategory"
                wire:change="updateTypes">
                <option value="">Select Category</option>
                @foreach ($categories as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </x-form.select-input>
            @if ($selectedCategory !== 'Significant Personalities')
                <x-form.select-input disabled label="Types of Cultural Heritage" wire:model.change="selectedType">
                    <option value="">Select Subcategory</option>
                    @foreach ($types as $typ)
                        <option value="{{ $typ }}">{{ $typ }}</option>
                    @endforeach
                </x-form.select-input>
            @endif
        </div>

        <x-form.input label="Local / Indigenous Name" wire:model="name" />
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
                <x-form.input label="Other Common Name" wire:model="other_common_name" />
                @error('other_common_name')
                    <x-form.error> {{ $message }} </x-form.error>
                @enderror
            </div>

            <div class="w-full">
                <x-form.input label="Scientific Name" wire:model="scientific_name" />
                @error('scientific_name')
                    <x-form.error> {{ $message }} </x-form.error>
                @enderror
            </div>
        </div>

        <div class="w-full flex items-center">
            {{-- SINGLE SELECT CLASSIFICATIONS ACCORDING TO GROWTH HABIT --}}
            <div class="w-full">
                <div wire:ignore class="w-full">
                    <x-form.select2 label="Classification According to Growth Habit" id="classification_to_growth"
                        wire:model="classification_to_growth">
                        <option value="">Select Classification</option>
                        <option value="Succulent Plant (Herb)">Succulent Plant (Herb)</option>
                        <option value="Shrub">Shrub</option>
                        <option value="Vine">Vine</option>
                        <option value="Tree">Tree</option>
                        <option value="Tree">Tree</option>
                        <option value="Dam">Dam</option>
                        <option value="Canal">Canal</option>
                        <option value="Estuary">Estuary</option>
                        <option value="Wetland">Wetland</option>
                        <option value="Creek">Creek</option>
                    </x-form.select2>
                </div>
                @error('classification_to_growth')
                    <x-form.error> {{ $message }} </x-form.error>
                @enderror
            </div>

            <div class="w-full">
                <x-form.select-input label="Classification According to Origin" wire:model="classification_to_origin">
                    <option value="">Select Classification</option>
                    <option value="Endemic">Endemic</option>
                    <option value="Native">Native</option>
                    <option value="Exotic">Exotic</option>
                </x-form.select-input>

                @error('classification_to_origin')
                    <x-form.error> {{ $message }} </x-form.error>
                @enderror
            </div>
        </div>

        <x-form.textarea rows="1" label="Habitat" wire:model="habitat" />

        {{-- LOCALTION / ADDRESS --}}
        <div class="w-full flex items-center gap-2">
            <div class="w-full">
                <x-form.select-input label="Location" wire:model="location">
                    <option value="">Barangay</option>
                    <option value="Anonas">Anonas</option>
                    <option value="Bactad East">Bactad East</option>
                    <option value="Bayaoas">Bayaoas</option>
                    <option value="Bolaoen">Bolaoen</option>
                    <option value="Cabaruan">Cabaruan</option>
                    <option value="Cabuloan">Cabuloan</option>
                    <option value="Camanang">Camanang</option>
                    <option value="Camantiles">Camantiles</option>
                    <option value="Casantaan">Casantaan</option>
                    <option value="Catablan">Catablan</option>
                    <option value="Cayambanan">Cayambanan</option>
                    <option value="Consolacion">Consolacion</option>
                    <option value="Dilan-Paurido">Dilan-Paurido</option>
                    <option value="Labit Proper">Labit Proper</option>
                    <option value="Labit West">Labit West</option>
                    <option value="Mabanogbog">Mabanogbog</option>
                    <option value="Macalong">Macalong</option>
                    <option value="Nancalobasaan">Nancalobasaan</option>
                    <option value="Nancamaliran East">Nancamaliran East</option>
                    <option value="Nancamaliran West">Nancamaliran West</option>
                    <option value="Nancayasan">Nancayasan</option>
                    <option value="Oltama">Oltama</option>
                    <option value="Palina East">Palina East</option>
                    <option value="Palina West">Palina West</option>
                    <option value="Pedro T. Orata (Bactad Proper)">Pedro T. Orata (Bactad Proper)</option>
                    <option value="Pinmaludpod">Pinmaludpod</option>
                    <option value="Poblacion">Poblacion</option>
                    <option value="San Jose">San Jose</option>
                    <option value="San Vicente">San Vicente</option>
                    <option value="Santa Lucia">Santa Lucia</option>
                    <option value="Santo Domingo">Santo Domingo</option>
                    <option value="Sugcong">Sugcong</option>
                    <option value="Tipuso">Tipuso</option>
                    <option value="Tulong">Tulong</option>
                </x-form.select-input>
                @error('location')
                    <x-form.error> {{ $message }} </x-form.error>
                @enderror
            </div>

            <div class="w-full">
                <x-form.input label="" placeholder="Address (Optional)" class="mt-6" wire:model="address" />
                @error('address')
                    <x-form.error> {{ $message }} </x-form.error>
                @enderror
            </div>

        </div>

        <div class="w-full flex items-center">
            {{-- SINGLE SELECT INDICATE VISIBILITY --}}
            <div class="w-full">
                <div wire:ignore class="w-full">
                    <x-form.select2 label="Indicate Visibility" id="visibility" wire:model="visibility">
                        <option value="">Select</option>
                        <option value="Visible in all barangays">Visible in all barangays</option>
                        <option value="Visible in some barangays">Visible in some barangays</option>
                        <option value="Not visible in the municipality but can be found in other areas">Not visible in
                            the
                            municipality but can be found in other areas</option>
                    </x-form.select2>
                </div>
                @error('visibility')
                    <x-form.error> {{ $message }} </x-form.error>
                @enderror
            </div>

            <div class="w-full">
                <x-form.select-input label="Indicate Seasonability" wire:model="seasonability">
                    <option value="">Select</option>
                    <option value="Annual">Annual</option>
                    <option value="Biennial">Biennial</option>
                    <option value="Perennial">Perennial</option>
                </x-form.select-input>

                @error('seasonability')
                    <x-form.error> {{ $message }} </x-form.error>
                @enderror
            </div>
        </div>

        <x-form.textarea label="Description" wire:model="description" />
        @error('description')
            <x-form.error> {{ $message }} </x-form.error>
        @enderror


        {{-- MULTI SELECT ROLE Common Uses and Scope of Use --}}
        <div wire:ignore class="w-96 p-2">
            <label for="">Common Uses and Scope of Use</label>
            <select id="scope_of_use" wire:model="scope_of_use" multiple="multiple">
                <option value="Edibles">Edibles</option>
                <option value="Ornamental">Ornamental</option>
                <option value="Medical">Medical</option>
                <option value="Industrial Crops">Industrial Crops</option>
                <option value="Other Uses">Other Uses</option>
            </select>
            @error('scope_of_use')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>

        <x-form.textarea label="Remarks" wire:model="remarks" />
        @error('remarks')
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

        <x-form.textarea label="Conservation" wire:model="conservation" />
        @error('conservation')
            <x-form.error> {{ $message }} </x-form.error>
        @enderror

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

                    // ============================================ CLASSIFICATIONS ACCORDING TO GROWTH HABIT
                    $('#classification_to_growth').select2({
                        tags: true
                    });

                    $('#classification_to_growth').on('change', function() {
                        let data = $(this).val();
                        $wire.set('classification_to_growth', data, false);
                    });

                    // ============================================ INCDICATE VISIBILITY
                    $('#visibility').select2({
                        tags: true
                    });

                    $('#visibility').on('change', function() {
                        let data = $(this).val();
                        $wire.set('visibility', data, false);
                    });


                    // MULTIPLE SELECT ================================== Common Uses and Scope of Use
                    $('#scope_of_use').select2({
                        placeholder: 'Select',
                        closeOnSelect: true,
                    });

                    $('#scope_of_use').on('change', function() {
                        let data = $(this).val();
                        $wire.set('scope_of_use', data, false);
                    });

                });
            </script>
        @endscript
    </div>

</x-admin.body>
