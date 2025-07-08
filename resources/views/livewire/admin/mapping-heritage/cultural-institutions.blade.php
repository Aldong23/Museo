<div class="w-full h-full flex flex-col pb-8">


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
                            <svg class="w-5 h-5 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
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
    <div class="w-full">
        <div wire:ignore class="w-full">
            <x-form.select2 label="Type of Cultural Institution" id="type" wire:model.change="type">
                <option value="">Select</option>
                @foreach ($types as $typ)
                    <option value="{{ $typ }}">{{ $typ }}</option>
                @endforeach
            </x-form.select2>
        </div>
        @error('type')
            <x-form.error> {{ $message }} </x-form.error>
        @enderror
    </div>

    @if (
        $typeValue === 'Both Non-Formal & Formal Education' ||
            $typeValue === 'Kalipunan ng Liping Pilipina Natl. Inc. Urdaneta City (KALIPI)')
        <livewire:admin.mapping-heritage.types.school-institutions :name="$name" :city="$city" :province="$province"
            :location="$location" :type="$type" :fields="$fields" />
    @elseif ($typeValue === 'Formal Education')
        <livewire:admin.mapping-heritage.types.school-institutions-library :name="$name" :city="$city"
            :province="$province" :location="$location" :type="$type" :fields="$fields" />
    @elseif ($typeValue === 'Farmer’s Association')
        <livewire:admin.mapping-heritage.types.farmers-association :name="$name" :city="$city"
            :province="$province" :location="$location" :type="$type" :fields="$fields" />
    @elseif (
        $typeValue === 'LGBTQI+' ||
            $typeValue === 'Rural Improvements Club of Urdaneta City' ||
            $typeValue === '(RCU) Rotary Club of Urdaneta' ||
            $typeValue === 'Federation of Senior Citizen' ||
            $typeValue === 'Federation' ||
            $typeValue === 'Urdaneta Masonic Lodge, #302 Free & Accepted Mission' ||
            $typeValue === 'Library')
        <livewire:admin.mapping-heritage.types.associations :name="$name" :city="$city" :province="$province"
            :location="$location" :type="$type" :fields="$fields" />
    @elseif ($typeValue === 'Political Clan')
        <livewire:admin.mapping-heritage.types.political-clan :name="$name" :city="$city" :province="$province"
            :location="$location" :type="$type" :fields="$fields" />
    @endif

</div>
@script()
    <script>
        $(document).ready(function() {

            // ================================== TYPE
            $('#type').select2({
                //tags: true
            });

            $('#type').on('change', function() {
                console.log('type Selected');

                let data = $(this).val();
                $wire.set('type', data, false);
                $wire.dispatch('updateType');
            });

            Livewire.on('type-update', function() {

                console.log('types Updated');

                $('#type').html('');
                @this.types.forEach(function(typ) {
                    $('#type').append(new Option(typ, typ)); // Append new options
                });
                // $('#type').trigger('change'); // Refresh Select2
            });

            // MULTIPLE SELECT ================================== SUPPORTING DOCUMENTATION
            // $('#supporting_documentation').select2({
            //     placeholder: 'Select',
            //     closeOnSelect: true,
            //     tags: true
            // });

            // $('#supporting_documentation').on('change', function() {
            //     let data = $(this).val();
            //     $wire.set('supporting_documentation', data, false);
            // });

        });
    </script>
@endscript
