<div class="w-full h-screen flex flex-col items-center font-montserrat">
    <x-visitor.header />

    <div class="w-full h-fit bg-gray-200 lg:p-20">
        <div class="w-full h-fit flex flex-col bg-white rounded-lg shadow-lg p-4">
            <h1 class="font-bold text-4xl text-center mt-4 mb-5">Contributor Form</h1>
            <h1 class="text-lg md:text-2xl">Contributor Information</h1>
            <div class="w-full md:flex gap-2">
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
                    @error('middle_name')
                        <x-form.error> {{ $message }} </x-form.error>
                    @enderror
                </div>
                <div class="w-full">
                    <x-form.input label="Suffix" wire:model="suffix" />
                    @error('suffix')
                        <x-form.error> {{ $message }} </x-form.error>
                    @enderror
                </div>
            </div>
            <div class="w-full md:flex gap-2">
                <div class="w-full">
                    <x-form.select-input label="" wire:model="sex">
                        <option value="">Sex</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </x-form.select-input>
                    @error('sex')
                        <x-form.error> {{ $message }} </x-form.error>
                    @enderror
                </div>
                <div class="w-full">
                    <x-form.input label="Contact No.*" wire:model="contact_no" />
                    @error('contact_no')
                        <x-form.error> {{ $message }} </x-form.error>
                    @enderror
                </div>
                <div class="w-full">
                    <x-form.input label="Email*" wire:model="email" />
                    @error('email')
                        <x-form.error> {{ $message }} </x-form.error>
                    @enderror
                </div>
            </div>
            <div class="w-full md:flex gap-2">
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

            <div class="w-full">
                <x-form.input label="Village, Building no., Street no. *" wire:model="address" />
                @error('address')
                    <x-form.error> {{ $message }} </x-form.error>
                @enderror
            </div>
            {{-- ==================================================================== ARTIFACT INFORMATION --}}
            <br>
            <h1 class="text-lg md:text-2xl">Artifact Information</h1>

            <div class="w-96">
                <x-form.input label="Atifact Name" wire:model="artifact_name" />
                @error('artifact_name')
                    <x-form.error> {{ $message }} </x-form.error>
                @enderror
            </div>

            <div class="w-full flex items-center gap-2">
                <x-form.select-input label="Cultural Heritage Category" wire:model.change="selectedCategory"
                    wire:change="updateSubcategories">
                    <option value="">Select Category</option>
                    @foreach ($categories as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </x-form.select-input>

                <x-form.select-input label="Types of Cultural Heritage" wire:model.change="selectedSubcategory">
                    <option value="">Select Subcategory</option>
                    @foreach ($subcategories as $subcategory)
                        <option value="{{ $subcategory }}">{{ $subcategory }}</option>
                    @endforeach
                </x-form.select-input>
            </div>

            <div class="w-full md:flex gap-2 mt-2">
                <div class="w-full">
                    <x-form.date-input label="Date Photograph" wire:model="date_photograph" />
                    @error('date_photograph')
                        <x-form.error> {{ $message }} </x-form.error>
                    @enderror
                </div>
                <div class="w-full">
                    <x-form.input label="Owned By" wire:model="owned_by" />
                    @error('owned_by')
                        <x-form.error> {{ $message }} </x-form.error>
                    @enderror
                </div>
                <div class="w-full">
                    <x-form.input label="Donated By" wire:model="donated_by" />
                    @error('donated_by')
                        <x-form.error> {{ $message }} </x-form.error>
                    @enderror
                </div>
            </div>
            <div class="w-full">
                <x-form.textarea label="Description" wire:model="description" />
                @error('description')
                    <x-form.error> {{ $message }} </x-form.error>
                @enderror
            </div>
            <div class="w-full">
                <x-form.textarea label="Story of Artifact" wire:model="story" />
                @error('story')
                    <x-form.error> {{ $message }} </x-form.error>
                @enderror
            </div>

            @if ($collections)
                <div class="w-full flex items-end gap-2 p-2 border border-gray-400 rounded-lg ">
                    @foreach ($collections as $collection)
                        <img class="rounded-md h-64 flex" src="{{ $collection->temporaryUrl() }}">
                    @endforeach
                    <button class="w-fit text-white text-xs bg-red-500 rounded py-1 px-2"
                        wire:click="change1">Remove</button>
                </div>
            @else
                <div class="w-full p-2">
                    <x-form.file wire:model="collections" multiple accept="image/*" />
                    @error('collections')
                        <x-form.error> {{ $message }} </x-form.error>
                    @enderror
                </div>
            @endif

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
