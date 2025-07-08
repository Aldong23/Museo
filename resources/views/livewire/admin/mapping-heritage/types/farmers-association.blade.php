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

    {{-- =============================================================== Urdaneta  Farmers Association / COOP --}}
    {{-- * ================================================== TABLE ======================================== --}}
    <div class="w-full h-auto p-2 mt-4 mb-4">
        <h1 class="font-bold text-xl mb-1">Urdaneta Farmers Association / COOP</h1>
        <x-form.table.table>
            <x-slot:head>
                <x-form.table.th>No.</x-form.table.th>
                <x-form.table.th>Barangay</x-form.table.th>
                <x-form.table.th>Name of FA / COOP / IA</x-form.table.th>
                <x-form.table.th>President</x-form.table.th>
                <x-form.table.th>Contact No.</x-form.table.th>
                <x-form.table.th>Remarks</x-form.table.th>
                <x-form.table.th></x-form.table.th>
            </x-slot:head>

            @foreach ($lists as $index => $list)
                <x-form.table.tr>
                    <x-form.table.td>
                        <x-form.input type="hidden" label="" placeholder="Barangay"
                            wire:model="lists.{{ $index }}.no" />
                        {{ $index + 1 }}
                    </x-form.table.td>
                    <x-form.table.td>
                        <div class="w-full">
                            <x-form.input label="" placeholder="Barangay"
                                wire:model="lists.{{ $index }}.barangay" />
                            @error("lists.$index.barangay")
                                <x-form.error> {{ $message }} </x-form.error>
                            @enderror
                        </div>
                    </x-form.table.td>
                    <x-form.table.td>
                        <x-form.input label="" placeholder="Name of FA / COOP / IA"
                            wire:model="lists.{{ $index }}.coop" />
                        @error("lists.$index.coop")
                            <x-form.error> {{ $message }} </x-form.error>
                        @enderror
                    </x-form.table.td>
                    <x-form.table.td>
                        <div class="w-full flex items-center">
                            <!-- First Name -->
                            <x-form.input label="" placeholder="First Name"
                                wire:model="lists.{{ $index }}.president.fname" />
                            @error("lists.$index.president.fname")
                                <x-form.error> {{ $message }} </x-form.error>
                            @enderror

                            <!-- Middle Name -->
                            <x-form.input label="" placeholder="Middle Name"
                                wire:model="lists.{{ $index }}.president.mname" />
                            @error("lists.$index.president.mname")
                                <x-form.error> {{ $message }} </x-form.error>
                            @enderror

                            <!-- Last Name -->
                            <x-form.input label="" placeholder="Last Name"
                                wire:model="lists.{{ $index }}.president.lname" />
                            @error("lists.$index.president.lname")
                                <x-form.error> {{ $message }} </x-form.error>
                            @enderror
                        </div>
                    </x-form.table.td>

                    <x-form.table.td>
                        <div class="w-full">
                            <x-form.input label="" placeholder="Contact No."
                                wire:model="lists.{{ $index }}.contact_no" />
                            @error("lists.$index.contact_no")
                                <x-form.error> {{ $message }} </x-form.error>
                            @enderror
                        </div>
                    </x-form.table.td>
                    <x-form.table.td>
                        <div class="w-full">
                            <x-form.input label="" placeholder="Remarks"
                                wire:model="lists.{{ $index }}.remarks" />
                            @error("lists.$index.remarks")
                                <x-form.error> {{ $message }} </x-form.error>
                            @enderror
                        </div>
                    </x-form.table.td>
                    <x-form.table.td>
                        <button type="button" wire:click="removeList({{ $index }})"
                            class="flex items-center gap-1 w-fit px-4 py-2 mt-3 rounded bg-red-500 hover:bg-red-400 text-white">
                            <svg class="w-5 h-5 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>

                            Remove
                        </button>
                    </x-form.table.td>
                </x-form.table.tr>
            @endforeach

            <x-form.table.tr>
                <x-form.table.td colspan="6">
                    <div class="w-full flex items-center justify-center">
                        <button type="button" wire:click="addList"
                            class="w-fit flex items-center gap-2 px-8 py-2 rounded bg-blue-500 hover:bg-blue-400 text-white text-nowrap">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
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
