<x-slot:heading>Museo De Urdaneta</x-slot:heading>
<x-slot:secHeading>Artifacts Exhibit Event Form</x-slot:secHeading>
<x-admin.body>
    {{-- PROGRAM NAME --}}
    <x-form.input label="Program Name" wire:model="program_name" />
    @error('program_name')
        <x-form.error> {{ $message }} </x-form.error>
    @enderror

    {{-- SUBJECT ACTIVITY --}}
    <x-form.input label="Subject Activity" wire:model="subject_activity" />
    @error('subject_activity')
        <x-form.error> {{ $message }} </x-form.error>
    @enderror

    {{-- LOCATIONS --}}
    <div class="w-full md:flex items-center gap-2">
        <div class="w-full">
            <x-form.select-input label="" wire:model.change="province" wire:change="updateProvince">
                <option value="">Province</option>
                @foreach ($provinces as $prov)
                    <option value="{{ $prov->name }}"> {{ $prov->name }} </option>
                @endforeach
            </x-form.select-input>
            @error('province')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>
        <div class="w-full">
            <x-form.select-input label="" wire:model="municipality" wire:change="updateCity">
                <option value="">Municipality</option>
                @foreach ($cities as $city)
                    <option value="{{ $city->name }}"> {{ $city->name }} </option>
                @endforeach
            </x-form.select-input>
            @error('municipality')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>

        <div class="w-full">
            <x-form.select-input label="" wire:model="barangay">
                <option value="">Barangay</option>
                @foreach ($barangays as $brngy)
                    <option value="{{ $brngy->name }}"> {{ $brngy->name }} </option>
                @endforeach
            </x-form.select-input>
            @error('barangay')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>
    </div>

    {{-- SUBJECT ACTIVITY --}}
    <x-form.input label="House/Block/Lot No." wire:model="address" />
    @error('address')
        <x-form.error> {{ $message }} </x-form.error>
    @enderror

    {{-- DURATION OF ACTIVTY --}}
    <h1 class="ms-2 mt-3 mb-2 text-gray-900">Duration of Activity</h1>
    <div class="w-full md:flex items-center gap-2">
        <div class="w-full">
            <x-form.date-input label="Start" wire:model="start_date" />
            @error('start_date')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>

        <div class="w-full">
            <x-form.date-input label="End" wire:model="end_date" />
            @error('end_date')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>
    </div>


    {{-- DESCRIPTION OF ACTIVTY --}}
    <x-form.textarea label="Description of Activity" wire:model="description" />
    @error('description')
        <x-form.error> {{ $message }} </x-form.error>
    @enderror

    {{-- ========================== LIST OF ARTIFACTS =========================== --}}
    <h1 class="ms-2 mt-3 mb-2 font-bold text-gray-900">List of Artifacts</h1>

    {{-- MULTI SELECT SUPPORTING DOCUMENTATION --}}
    <div class="w-full">
        <div wire:ignore class="w-full">
            <x-form.select2 label="Artifacts Name" id="artifacts_id" multiple="multiple" wire:model="artifacts_id">
                <option value="">Select</option>
                @foreach ($artifacts as $art)
                    <option value="{{ $art->id }}">{{ $art->name }}</option>
                @endforeach
            </x-form.select2>
        </div>
        @error('artifacts_id')
            <x-form.error> {{ $message }} </x-form.error>
        @enderror
    </div>


    {{-- REMARKS --}}
    <x-form.textarea label="Remarks" wire:model="remarks" />
    @error('remarks')
        <x-form.error> {{ $message }} </x-form.error>
    @enderror


    <div class="w-full flex justify-end px-4 pt-10 pb-20">
        <div class="flex items-center gap-4">
            <x-form.return href="/artifacts-exhibit-monitoring">Cancel</x-form.return>
            <x-form.button wire:click="save" wire:target="save" wire:loading.attr="disabled"
                wire:loading.class="cursor-not-allowed opacity-50">
                Save
                <img wire:loading wire:target="save" src="/images/icons/loading.svg" alt="..." />
            </x-form.button>
        </div>
    </div>

</x-admin.body>


@script()
    <script>
        $(document).ready(function() {

            // SINGLE SELECT  ================================== TYPE
            // $('#type').select2({
            //     tags: true
            // });

            // $('#type').on('change', function() {
            //     let data = $(this).val();
            //     $wire.set('type', data, false);
            // });

            // MULTIPLE SELECT ================================== SUPPORTING DOCUMENTATION
            $('#artifacts_id').select2({
                placeholder: 'Select',
                closeOnSelect: true,
                //tags: true
            });

            $('#artifacts_id').on('change', function() {
                let data = $(this).val();
                $wire.set('artifacts_id', data, false);
            });

        });
    </script>
@endscript
