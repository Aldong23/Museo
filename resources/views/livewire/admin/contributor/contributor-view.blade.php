<div class="w-full h-screen flex flex-col items-center font-montserrat">
    <x-visitor.header />

    <div class="w-full h-fit bg-gray-200 p-20">
        <div class="w-full h-fit flex flex-col bg-white rounded-lg shadow-lg p-4">
            <h1 class="font-bold text-4xl text-center mt-4 mb-5">Contributor Form</h1>
            <h1 class="text-lg md:text-2xl">Contributor Information</h1>
            <div class="w-full md:flex gap-2 mt-5">
                <div class="w-full">
                    <x-form.input label="Last Name" wire:model="last_name" disabled />
                    @error('last_name')
                        <x-form.error> {{ $message }} </x-form.error>
                    @enderror
                </div>
                <div class="w-full">
                    <x-form.input label="First Name" wire:model="first_name" disabled />
                    @error('first_name')
                        <x-form.error> {{ $message }} </x-form.error>
                    @enderror
                </div>
                <div class="w-full">
                    <x-form.input label="Middle Name" wire:model="middle_name" disabled />
                    @error('middle_name')
                        <x-form.error> {{ $message }} </x-form.error>
                    @enderror
                </div>
                <div class="w-full">
                    <x-form.input label="Suffix" wire:model="suffix" disabled />
                    @error('suffix')
                        <x-form.error> {{ $message }} </x-form.error>
                    @enderror
                </div>
            </div>

            <div class="w-full md:flex gap-2 mt-2">
                <x-form.input label="Sex" wire:model="sex" disabled />
                <x-form.input label="Contact No." wire:model="contact_no" disabled />
                <x-form.input label="Email" wire:model="email" disabled />
            </div>

            <div class="w-full md:flex gap-2 mt-2">
                <div class="w-full">
                    <x-form.input label="Province" wire:model="province" disabled />
                </div>
                <div class="w-full">
                    <x-form.input label="City" wire:model="municipality" disabled />
                </div>
                <div class="w-full">
                    <x-form.input label="Barangay" wire:model="barangay" disabled />
                </div>
            </div>

            <div class="w-full mt-2">
                <x-form.input label="Village, Building no., Street no. " wire:model="address" disabled />
            </div>

            {{-- ==================================================================== ARTIFACT INFORMATION --}}
            <br>

            <h1 class="text-lg md:text-2xl">Artifact Information</h1>

            <div class="w-96 mt-5">
                <x-form.input label="Atifact Name" wire:model="artifact_name" disabled />
            </div>

            <div class="w-full flex items-center gap-2 mt-2">
                <x-form.input label="Cultural Heritage Category" wire:model="selectedCategory" disabled />
                <x-form.input label="Types of Cultural Heritage" wire:model="selectedSubcategory" disabled />
            </div>

            <div class="w-full md:flex gap-2 mt-2">
                <x-form.date-input label="Date Photograph" wire:model="date_photograph" disabled />
                <x-form.input label="Owned By" wire:model="owned_by" disabled />
                <x-form.input label="Donated By" wire:model="donated_by" disabled />
            </div>
            
            <div class="w-full flex flex-col gap-1 p-2">
                <label class="text-sm font-medium text-gray-700">Description</label>
                <div class="border border-brdr-primary text-txt-primary rounded-lg p-2.5 whitespace-pre-wrap">{{ $description }}</div>
            </div>
            <div class="w-full flex flex-col gap-1 p-2">
                <label class="text-sm font-medium text-gray-700">Story of Artifact</label>
                <div class="border border-brdr-primary text-txt-primary rounded-lg p-2.5 whitespace-pre-wrap">{{ $story }}</div>
            </div>

            @if ($collections)
                <div x-data="{ modalOpen: false, modalImage: '' }">
                    <div class="w-full p-2">
                        <label class="text-sm font-medium text-gray-700">Images</label>
                        <div class="w-full flex flex-wrap gap-2 p-2 border border-gray-400 rounded-lg">
                            @foreach ($collections as $collection)
                                <button @click="modalOpen = true; modalImage = '{{ Storage::url($collection) }}'">
                                    <img class="rounded-md h-64 flex cursor-pointer" src="{{ Storage::url($collection) }}">
                                </button>
                            @endforeach
                        </div>
                    </div>

                    {{-- Modal --}}
                    <div wire:ignore x-show="modalOpen"
                        class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center p-4 z-50"
                        x-transition.opacity @click="modalOpen = false">
                        <div class="relative" @click.stop>
                            <button @click="modalOpen = false" class="absolute top-2 right-2 text-white text-3xl">&times;</button>
                            <img :src="modalImage" class="max-w-full max-h-screen rounded-lg shadow-lg">
                        </div>
                    </div>
                </div>
            @endif



            {{-- =============== REMARKS ======================= --}}
            <x-form.textarea label="Remarks" wire:model="remarks" />
            @error('remarks')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror

            <div class="w-full flex items-center gap-2 my-4">
                <div class="w-full">
                    <x-form.date-input label="Date Profiled" wire:model="date_profiled" />
                    @error('date_profiled')
                        <x-form.error> {{ $message }} </x-form.error>
                    @enderror
                </div>

                <x-form.select-input label="" wire:model="status">
                    <option value="">Status</option>
                    <option value="Approved">Approved</option>
                    <option value="Disapproved">Disapproved</option>
                </x-form.select-input>
            </div>

            <div class="w-full flex justify-end px-4 pt-4 pb-10">
                <div class="flex items-center gap-4">
                    <x-form.return href="/contributor">Cancel</x-form.return>
                    <x-form.button wire:click="save" wire:target="save" wire:loading.attr="disabled"
                        wire:loading.class="cursor-not-allowed opacity-50">
                        Submit
                        <img wire:loading wire:target="save" src="/images/icons/loading.svg" alt="..." />
                    </x-form.button>
                </div>
            </div>
        </div>
    </div>
</div>
