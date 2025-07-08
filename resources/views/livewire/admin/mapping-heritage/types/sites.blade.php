<div class="w-full h-full flex flex-col pb-8">


    <x-form.input label="Name of Immovable Heritage" wire:model="name" />
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
    <div class="w-full flex items-center gap-2">

        {{-- SINGLE SELECT TYPE --}}
        <div class="w-full">
            <div wire:ignore class="w-full">
                <x-form.select2 label="Type" id="type" wire:model="type">
                    <option value="">Select</option>
                    <option value="Plaza">Plaza</option>
                    <option value="Archaeological Site">Archaeological Site</option>
                    <option value="Cemetery">Cemetery</option>
                    <option value="Sport Complex">Sport Complex</option>
                    <option value="Park">Park</option>
                    <option value="Heritage Landscape">Heritage Landscape</option>
                    <option value="Burial Site">Burial Site</option>
                    <option value="Pilgrimage Site">Pilgrimage Site</option>
                    <option value="Street">Street</option>
                    <option value="CHeritage Waterscape">CHeritage Waterscape</option>
                    <option value="Railways System">Railways System</option>
                </x-form.select2>

            </div>
            @error('type')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>

        <x-form.select-input label="Ownership" wire:model="ownership">
            <option value="">Select</option>
            <option value="Public">Public</option>
            <option value="Private">Private</option>
        </x-form.select-input>
        @error('ownership')
            <x-form.error> {{ $message }} </x-form.error>
        @enderror

    </div>


    {{-- ======================= LOCATION --}}
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


    {{-- ======================= COORDINATES --}}
    <div class="w-full flex items-center gap-2">
        <div class="w-full">
            <x-form.input label="Coordinates (Optional)" placeholder="Latitude" wire:model="latitude" />
            @error('latitude')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>
        <div class="w-full">
            <x-form.input label="" placeholder="Longitude" class="mt-6" wire:model="longitude" />
            @error('longitude')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>

        <div class="w-full">
            <x-form.input label="Year Constructed" wire:model="year_constructed" placeholder="e.g., 1990 / 2000" />
            @error('year_constructed')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>
    </div>


    {{-- ======================= AREA --}}
    <div class="w-full flex items-center gap-2">
        <div class="w-full">
            <x-form.input label="Area" wire:model="area" placeholder="Total Land Area" />
            @error('area')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>

        <div class="w-full">
            <x-form.input label="Structure" wire:model="structure" placeholder="Structure" />
            @error('structure')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>

        <div class="w-full">
            <x-form.input label="Estimated Age" wire:model="estimated_age" />
            @error('estimated_age')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>
    </div>

    <x-form.input label="Ownership / Jurisdiction" wire:model="ownership_jurisdiction" />
    @error('ownership_jurisdiction')
        <x-form.error> {{ $message }} </x-form.error>
    @enderror

    <x-form.input label="Declaration / Legislation" wire:model="declaration_legislation" />
    @error('declaration_legislation')
        <x-form.error> {{ $message }} </x-form.error>
    @enderror

    <x-form.textarea label="Description" wire:model="description" />
    @error('description')
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
    <div class="w-96">
        <x-form.input label="Condition of Structure" wire:model="condition_of_structure" />
        @error('condition_of_structure')
            <x-form.error> {{ $message }} </x-form.error>
        @enderror
    </div>

    <x-form.textarea rows="2" label="Remarks" wire:model="remarks_1" />
    @error('remarks_1')
        <x-form.error> {{ $message }} </x-form.error>
    @enderror

    <div class="w-96">
        <x-form.input label="Integrity of the Structure" wire:model="integrity_of_structure" />
        @error('integrity_of_structure')
            <x-form.error> {{ $message }} </x-form.error>
        @enderror
    </div>

    <x-form.textarea rows="2" label="Remarks" wire:model="remarks_2" />
    @error('remarks_2')
        <x-form.error> {{ $message }} </x-form.error>
    @enderror

    {{-- =============================================================== List of Cultural Properties within the Site --}}
    {{-- * ================================================== TABLE ======================================== --}}
    <div class="w-full h-auto p-2 mt-4 mb-4">
        <h1 class="font-bold text-xl mb-1">List of Significant Tangible Movable Heritage</h1>
        <x-form.table.table>
            <x-slot:head>
                <x-form.table.th>Name of Object</x-form.table.th>
                <x-form.table.th>Photo</x-form.table.th>
                <x-form.table.th>Year produced or estimated age</x-form.table.th>
                {{-- <x-form.table.th>Dimensions</x-form.table.th> --}}
                <x-form.table.th></x-form.table.th>
            </x-slot:head>

            @foreach ($lists as $index => $list)
                <x-form.table.tr>
                    <x-form.table.td>
                        <div class="w-full">
                            <x-form.input label="Name of Object"
                                wire:model="lists.{{ $index }}.name_of_built_structure" />
                            @error("lists.$index.name_of_built_structure")
                                <x-form.error> {{ $message }} </x-form.error>
                            @enderror
                        </div>
                    </x-form.table.td>
                    <x-form.table.td class="align-middle">
                        <div class="w-full flex gap-1 items-center">
                            <x-form.file-input label="Photo" wire:model="lists.{{ $index }}.photo"
                                accept="image/*" />
                            @error("lists.$index.photo")
                                <x-form.error> {{ $message }} </x-form.error>
                            @enderror

                            @if (!empty($list['photo']))
                                <div class=" w-fit">
                                    <img class="rounded-sm h-11 flex" src="{{ $list['photo']->temporaryUrl() }}">
                                </div>
                            @endif
                        </div>
                    </x-form.table.td>
                    <x-form.table.td>
                        <div class="w-full">
                            <x-form.input label="Year produced or estimated age"
                                wire:model="lists.{{ $index }}.year_produced" />
                            @error("lists.$index.year_produced")
                                <x-form.error> {{ $message }} </x-form.error>
                            @enderror
                        </div>
                    </x-form.table.td>
                    {{-- <x-form.table.td>
                        <div class="w-full">
                            <x-form.input label="" placeholder="Dimensions"
                                wire:model="lists.{{ $index }}.dimension" />
                            @error("lists.$index.dimension")
                                <x-form.error> {{ $message }} </x-form.error>
                            @enderror
                        </div>
                    </x-form.table.td> --}}
                    <x-form.table.td>
                        <button type="button" wire:click="removeList({{ $index }})"
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
                        <button type="button" wire:click="addList"
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

                $('#type').select2({
                    tags: true
                });

                $('#type').on('change', function() {
                    let data = $(this).val();
                    $wire.set('type', data, false);
                });

            });
        </script>
    @endscript
</div>
