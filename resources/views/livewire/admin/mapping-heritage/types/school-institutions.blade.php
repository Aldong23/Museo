<div class="w-full h-full flex flex-col pb-8">

    {{-- ===================================================== Remarks  --}}
    <div class="w-full p-2">
        <h1 class="text-gray-900 my-2">Remarks</h1>

        @if (!$remarks_image)
            <x-form.file wire:model="remarks_image" accept="image/*" />
            @error('remarks_image')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        @else
            <div class="flex flex-wrap gap-2 p-2 border border-gray-400 rounded-lg ">

                <img class="rounded-md h-64 flex" src="{{ $remarks_image->temporaryUrl() }}">
            </div>
        @endif
    </div>

    <x-form.textarea rows="3" label="" wire:model="remarks_text" />
    @error('remarks_text')
        <x-form.error> {{ $message }} </x-form.error>
    @enderror



    <x-form.textarea label="Narrative Description" wire:model="narrative_description" />
    @error('narrative_description')
        <x-form.error> {{ $message }} </x-form.error>
    @enderror

    <x-form.textarea label="Stories and Narrative" wire:model="stories" />
    @error('stories')
        <x-form.error> {{ $message }} </x-form.error>
    @enderror

    <x-form.textarea label="Significance" wire:model="significance" />
    @error('significance')
        <x-form.error> {{ $message }} </x-form.error>
    @enderror

    {{-- ================================= SUPPORTING DOCUMENTATION --}}
    <h1 class="font-bold text-xl mb-1">References</h1>
    {{-- MULTI SELECT SUPPORTING DOCUMENTATION --}}
    <div class="w-full">
        <div wire:ignore class="w-full">
            <x-form.select2 label="Supporting Documentation" id="supporting_documentation" multiple="multiple"
                wire:model="supporting_documentation">
                <option value="">Select</option>
                <option value="Print, write-ups">Print, write-ups</option>
                <option value="Audio/video recording">Audio/video recording</option>
                <option value="Photographs and sketches">Photographs and sketches</option>
            </x-form.select2>
        </div>
        @error('supporting_documentation')
            <x-form.error> {{ $message }} </x-form.error>
        @enderror
    </div>

    <x-form.textarea rows="3" label="Key Informat/s" wire:model="key_informats" />
    @error('key_informats')
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

                // ================================== TYPE
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
