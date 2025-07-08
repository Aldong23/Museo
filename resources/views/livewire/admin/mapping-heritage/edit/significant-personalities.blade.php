<x-slot:heading>Museo De Urdaneta</x-slot:heading>
<x-slot:secHeading>EDIT</x-slot:secHeading>
<x-admin.body>
    <div class="w-full h-full flex flex-col pb-8">

        <div class="w-full flex items-center gap-2 mb-4">
            <x-form.input disabled label="Cultural Heritage Category" wire:model="selectedCategory" />
        </div>

        <x-form.input label="Name" wire:model="name" />
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
            <div class="w-96">
                <x-form.date-input label="Date of Birth" wire:model="date_of_birth" />
                @error('date_of_birth')
                    <x-form.error> {{ $message }} </x-form.error>
                @enderror
            </div>

            <div class="w-96">
                <x-form.date-input label="Date of Death" wire:model="date_of_death" />
                @error('date_of_death')
                    <x-form.error> {{ $message }} </x-form.error>
                @enderror
            </div>

            <x-form.input label="Age" wire:model="age" />
            @error('age')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror

        </div>


        {{-- ======================= COORDINATES --}}
        {{-- ======================= AREA --}}
        <div class="w-full flex items-center gap-2">

            <div class="w-full">
                <div wire:ignore class="w-full">
                    <x-form.select2 label="" id="type" wire:model="type">
                        <option value="">Prominence</option>
                        <option value="Politics">Politics</option>
                        <option value="Actress">Actress</option>
                        <option value="Music">Music</option>
                        <option value="Military Officer">Military Officer</option>
                        <option value="Media and Journalism">Media and Journalism</option>
                        <option value="Teacher">Teacher</option>
                        <option value="Education">Education</option>
                        <option value="Arts">Arts</option>
                        <option value="Sports">Sports</option>
                    </x-form.select2>
                </div>
                @error('type')
                    <x-form.error> {{ $message }} </x-form.error>
                @enderror
            </div>

            <x-form.input label="Birthplace" wire:model="birthplace" />
            @error('birthplace')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror

        </div>

        <x-form.input label="Present Address" wire:model="present_address" />
        @error('present_address')
            <x-form.error> {{ $message }} </x-form.error>
        @enderror

        <x-form.textarea label="Biography" wire:model="biography" />
        @error('biography')
            <x-form.error> {{ $message }} </x-form.error>
        @enderror

        <x-form.textarea label="Significance" wire:model="significance" />
        @error('significance')
            <x-form.error> {{ $message }} </x-form.error>
        @enderror

        <x-form.textarea label="References (Key Informat/s)" wire:model="references" />
        @error('references')
            <x-form.error> {{ $message }} </x-form.error>
        @enderror

        <x-form.textarea label="Name of Mapper/s" wire:model="mapper" />
        @error('mapper')
            <x-form.error> {{ $message }} </x-form.error>
        @enderror



        {{-- ================================= CONSERVATION --}}


        {{-- =============================================================== List of Cultural Properties within the Site --}}
        {{-- * ================================================== TABLE ======================================== --}}
        <div class="w-96">
            <x-form.date-input label="Date Profiled" wire:model="date_profiled" />
            @error('date_profiled')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>

        <x-form.textarea label="Attachment" wire:model="attachment" />
        @error('attachment')
            <x-form.error> {{ $message }} </x-form.error>
        @enderror

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

</x-admin.body>
