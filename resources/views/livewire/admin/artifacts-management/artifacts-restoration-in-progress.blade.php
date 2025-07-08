<x-slot:heading>Museo De Urdaneta</x-slot:heading>
<x-slot:secHeading>Adding of Restoration</x-slot:secHeading>
<x-admin.body>
    {{-- SINGLE SELECT NAME --}}
    <div class="w-full">
        <div wire:ignore class="w-full">
            <x-form.select2 label="Artifact Name" id="artifact_id" wire:model.change="artifact_id"
                wire:change="updateArtifact">
                <option value="">Select</option>
                @foreach ($artifact_names as $art)
                    <option value="{{ $art->id }}"> {{ $art->name }} </option>
                @endforeach
            </x-form.select2>

        </div>
        @error('artifact_id')
            <x-form.error> {{ $message }} </x-form.error>
        @enderror
    </div>

    {{-- CATEGORY AND TYPES --}}
    <div class="w-full md:flex items-center gap-2">
        <div class="w-full">
            <x-form.select-input label="Artifacts Category" wire:model="selectedCategory"
                wire:change="updateSubcategories">
                <option value="">Select Category</option>
                @foreach ($categories as $key => $value)
                    <option value="{{ $key }}" {{ $selectedCategory == $key ? 'selected' : '' }}>
                        {{ $value }}
                    </option>
                @endforeach
            </x-form.select-input>
            @error('selectedCategory')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>

        <div class="w-full">
            <x-form.select-input label="Types of Artifacts" wire:model="selectedType">
                <option value="">Select Type</option>
                @foreach ($types as $type)
                    <option value="{{ $type }}" {{ $selectedType == $type ? 'selected' : '' }}>
                        {{ $type }}
                    </option>
                @endforeach
            </x-form.select-input>
            @error('selectedType')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>
    </div>

    {{-- ========================================= CONSERVATOR INFORMATION --}}
    <br>
    <h1 class="font-bold">Conservator Information</h1>

    <x-form.select-input label="Valid ID*" wire:model="valid_id">
        <option value="">Select</option>
        <option value="NCCA Employee ID">NCCA Employee ID</option>
        <option value="UMID">UMID</option>
        <option value="Passport">Passport</option>
        <option value="Driver’s License">Driver’s License</option>
        <option value="Professional Regulation">Professional Regulation</option>
        <option value="Commission (PRC) ID">Commission (PRC) ID</option>
        <option value="Philippine Postal ID">Philippine Postal ID</option>
    </x-form.select-input>
    @error('valid_id')
        <x-form.error> {{ $message }} </x-form.error>
    @enderror

    {{-- FULL NAME --}}
    <div class="w-full md:flex items-center pt-2">
        <div class="w-full">
            <x-form.input label="Last Name*" wire:model="last_name" />
            @error('last_name')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>

        <div class="w-full">
            <x-form.input label="First Name*" wire:model="first_name" />
            @error('first_name')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>

        <div class="w-full">
            <x-form.input label="Middle Name" wire:model="middle_name" />
        </div>

        <div class="w-full">
            <x-form.input label="Suffix" wire:model="suffix" />
        </div>
    </div>
    {{-- EMAIL / CONTACT NO --}}
    <div class="w-full md:flex items-center pt-2">
        <div class="w-full">
            <x-form.input label="Contact No*" wire:model="contact_no" />
            @error('contact_no')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>

        <div class="w-full">
            <x-form.input label="Email Address*" wire:model="email" />
            @error('email')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>
    </div>

    {{-- ========================================= ARTIFACT INFORMATION --}}
    <br>
    <h1 class="font-bold">Artifact Information</h1>

    <div class="w-full flex items-start gap-2">

        <div class="w-full lg:w-96 mt-5">
            <x-form.date-input label="Date Released" wire:model="date_released" />
            @error('date_released')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>
        {{-- MULTIPLE SELECT  --}}
        <div class="w-full">
            <div wire:ignore class="w-full">
                <x-form.select2 label="Conservation Status" id="conservation_status_before" multiple="multiple"
                    wire:model="conservation_status_before">
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
            @error('conservation_status_before')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>
    </div>

    {{-- ===================================================== ARTIFACTS BEFORE  --}}
    <h1 class="mb-2 mt-4 ms-2">Artifacts Before</h1>

    @if ($artifacts_before)
        <div class="w-fit flex flex-col items-end gap-1">
            <div class="flex flex-wrap gap-2 p-2 border border-gray-400 rounded-lg ">
                @foreach ($artifacts_before as $collection)
                    <img class="rounded-md h-64 flex" src="{{ $collection->temporaryUrl() }}">
                @endforeach
            </div>
            <button class="w-fit text-white text-xs bg-red-500 rounded py-1 px-2" wire:click="change1">Remove</button>
        </div>
    @else
        <x-form.file multiple accept="image/*" wire:model="artifacts_before" />
    @endif
    @error('artifacts_before')
        <x-form.error> {{ $message }} </x-form.error>
    @enderror

    <x-form.textarea label="Remarks" wire:model="remarks_before" />

    @error('remarks_before')
        <x-form.error> {{ $message }} </x-form.error>
    @enderror


    <div class="flex items-center justify-end px-4 py-6">
        <div class="flex items-center gap-4">
            <x-form.cancel-link href="/artifacts-restoration">Cancel</x-form.cancel-link>
            <x-form.button wire:click="save"> Save </x-form.button>
        </div>
    </div>


</x-admin.body>
@script()
    <script>
        $(document).ready(function() {

            // SINGLE SELECT ================================== TYPE
            $('#artifact_id').select2({
                //tags: true
            });

            $('#artifact_id').on('change', function() {
                let data = $(this).val();
                $wire.set('artifact_id', data, false);
                $wire.dispatch('updateArt');
            });

            // MULTIPLE SELECT ================================== CONSERVATION BEFORE
            $('#conservation_status_before').select2({
                placeholder: 'Physical Condition',
                closeOnSelect: true,
                tags: true
            });

            $('#conservation_status_before').on('change', function() {
                let data = $(this).val();
                $wire.set('conservation_status_before', data, false);
            });

        });
    </script>
@endscript
