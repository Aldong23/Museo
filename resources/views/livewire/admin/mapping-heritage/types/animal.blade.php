<div class="w-full h-full flex flex-col pb-8">


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
        {{-- SINGLE SELECT CLASSIFICATIONS --}}
        <div class="w-full">
            <div wire:ignore class="w-full">
                <x-form.select2 label="Classification" id="classification" wire:model="classification">
                    <option value="">Select</option>
                    <option value="Mammal">Mammal</option>
                    <option value="Bird">Bird</option>
                    <option value="Reptile">Reptile</option>
                    <option value="Amphibian">Amphibian</option>
                    <option value="Fish">Fish</option>
                    <option value="Worm, Myriapod">Worm, Myriapod</option>
                    <option value="Insect , Aranchnid">Insect , Aranchnid</option>
                    <option value="Marine / Freshwater Organisms (Molluscs, Crutaceans, Echinoderms, Coelenterates)">
                        Marine / Freshwater Organisms (Molluscs, Crutaceans, Echinoderms, Coelenterates)</option>
                </x-form.select2>
            </div>
            @error('classification')
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
    @error('habitat')
        <x-form.error> {{ $message }} </x-form.error>
    @enderror


    <div class="w-full flex items-center">


        <div class="w-full">
            <x-form.input label="Special Notes" wire:model="special_notes" />
            @error('special_notes')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>


        {{-- SINGLE SELECT INDICATE VISIBILITY --}}
        <div class="w-full">
            <div wire:ignore class="w-full">
                <x-form.select2 label="Indicate Visibility" id="visibility" wire:model="visibility">
                    <option value="">Select</option>
                    <option value="Visible in all barangays">Visible in all barangays</option>
                    <option value="Visible in some barangays">Visible in some barangays</option>
                    <option value="Not visible in the municipality but can be found in other areas">Not visible in the
                        municipality but can be found in other areas</option>
                </x-form.select2>
            </div>
            @error('visibility')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>
    </div>


    {{-- TIME OF THE YEAR MOST SEEN --}}
    <x-form.input label="Time of the year most seen" wire:model="most_seen" />
    @error('most_seen')
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

                // ============================================ CLASSIFICATION
                $('#classification').select2({
                    tags: true
                });

                $('#classification').on('change', function() {
                    let data = $(this).val();
                    $wire.set('classification', data, false);
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
