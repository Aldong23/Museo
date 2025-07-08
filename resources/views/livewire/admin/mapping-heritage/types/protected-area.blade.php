<div class="w-full h-full flex flex-col pb-8">


    <x-form.input label="Name of Protected Area" wire:model="name" />
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

        {{-- SINGLE SELECT SUB CATEGORY --}}
        <div class="w-full">
            <div wire:ignore class="w-full">
                <x-form.select2 label="Category" id="category" wire:model="category">
                    <option value="">Select</option>
                    <option value="NIPAS (National Integrated Protected Areas System, RA7586)">NIPAS (National
                        Integrated Protected Areas System, RA7586)</option>
                    <option value="NON-NIPAS">NON-NIPAS</option>
                    <option value="ASEAN Natural Heritage">ASEAN Natural Heritage</option>
                    <option value="World Heritage Site">World Heritage Site</option>
                </x-form.select2>

            </div>
            @error('category')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>


        <div class="w-full">
            <x-form.select2 label="Classification" id="classification" wire:model="classification">
                <option value="">Select</option>
                <option value="National Park">National Park</option>
                <option value="Game Refuge">Game Refuge</option>
                <option value="Strict Nature Reserve">Strict Nature Reserve</option>
                <option value="Fish Sanctuary">Fish Sanctuary</option>
                <option value="Protected and Managed Landscape / Seascape">Protected and Managed Landscape / Seascape
                </option>
                <option value="Bird and Wildlife Sanctuary">Bird and Wildlife Sanctuary</option>
                <option value="Wilderness Area">Wilderness Area</option>
                <option value="Water /  Mangrove Reserve">Water / Mangrove Reserve</option>
                <option value="Natural Historical Landmark">Natural Historical Landmark</option>
                <option value="Virgin Fores">Virgin Forest</option>
            </x-form.select2>

            @error('classification')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror

        </div>

    </div>

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

    <x-form.input label="Area" wire:model="area" />
    @error('area')
        <x-form.error> {{ $message }} </x-form.error>
    @enderror

    <x-form.input label="Legislation and Date of Legislation" wire:model="legislation" />
    @error('ownership')
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

                $('#sub_category').select2({
                    tags: true
                });

                $('#sub_category').on('change', function() {
                    let data = $(this).val();
                    $wire.set('sub_category', data, false);
                });

            });
        </script>
    @endscript
</div>
