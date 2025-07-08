<x-slot:heading>Museo De Urdaneta</x-slot:heading>
<x-slot:secHeading>View Contributor</x-slot:secHeading>
<x-admin.body>

    <div class="w-full h-fit bg-gray-200 p-20">
        <div class="w-full h-fit flex flex-col bg-white rounded-lg shadow-lg p-4">
            <h1 class="text-lg md:text-2xl">Contributor Information</h1>
            <div class="w-full md:flex gap-2 mt-5">
                <div class="w-full">
                    <x-form.input label="Last Name" value="{{ $contributors->lname }}" disabled />
                </div>
                <div class="w-full">
                    <x-form.input label="First Name" value="{{ $contributors->fname }}" disabled />
                </div>
                <div class="w-full">
                    <x-form.input label="Middle Name" value="{{ $contributors->mname ?? ' ' }}" disabled />
                </div>
                <div class="w-full">
                    <x-form.input label="Suffix" value="{{ $contributors->suffix ?? ' ' }}" disabled />
                </div>
            </div>

            <div class="w-full md:flex gap-2 mt-2">
                <x-form.input label="Sex" value="{{ $contributors->sex }}" disabled />
                <x-form.input label="Contact No." value="{{ $contributors->contact_no }}" disabled />
                <x-form.input label="Email" value="{{ $contributors->email }}" disabled />
            </div>

            <div class="w-full md:flex gap-2 mt-2">
                <div class="w-full">
                    <x-form.input label="Province" value="{{ $contributors->province }}" disabled />
                </div>
                <div class="w-full">
                    <x-form.input label="Municipality" value="{{ $contributors->municipality }}" disabled />
                </div>
                <div class="w-full">
                    <x-form.input label="Barangay" value="{{ $contributors->barangay }}" disabled />
                </div>
            </div>

            <div class="w-full mt-2">
                <x-form.input label="Village, Building no., Street no. " value="{{ $contributors->address ?? ' ' }}" disabled />
            </div>

            {{-- ==================================================================== ARTIFACT INFORMATION --}}
            <br>

            <h1 class="text-lg md:text-2xl">Artifact Information</h1>

            <div class="w-96 mt-5">
                <x-form.input label="Atifact Name" value="{{ $contributors->artifact->name }}" disabled />
            </div>

            <div class="w-full flex items-center gap-2 mt-2">
                <x-form.input label="Cultural Heritage Category" value="{{ $contributors->artifact->category }}" disabled />
                <x-form.input label="Types of Cultural Heritage" value="{{ $contributors->artifact->type }}" disabled />
            </div>

            <div class="w-full md:flex gap-2 mt-2">
                <x-form.date-input label="Date Photograph" value="{{ $contributors->artifact->date_photograph }}" disabled />
                <x-form.input label="Owned By" value="{{ $contributors->artifact->owned_by }}" disabled />
                <x-form.input label="Donated By" value="{{ $contributors->artifact->dontated_by }}" disabled />
            </div>
            
            <div class="w-full flex flex-col gap-1 p-2">
                <label class="text-sm font-medium text-gray-700">Description</label>
                <div class="border border-brdr-primary text-txt-primary rounded-lg p-2.5 whitespace-pre-wrap">{{ $contributors->artifact->description }}</div>
            </div>
            <div class="w-full flex flex-col gap-1 p-2">
                <label class="text-sm font-medium text-gray-700">Story of Artifact</label>
                <div class="border border-brdr-primary text-txt-primary rounded-lg p-2.5 whitespace-pre-wrap">{{ $contributors->artifact->story }}</div>
            </div>

            @if (!empty($contributors->artifact->collections))
                <div x-data="{ modalOpen: false, modalImage: '' }">
                    <div class="w-full p-2">
                        <label class="text-sm font-medium text-gray-700">Images</label>
                        <div class="w-full flex flex-wrap gap-2 p-2 border border-gray-400 rounded-lg">
                            @foreach ($contributors->artifact->collections as $collection)
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
            <div class="w-full flex flex-col gap-1 p-2">
                <label class="text-sm font-medium text-gray-700">Remarks</label>
                <div class="border border-brdr-primary text-txt-primary rounded-lg p-2.5 whitespace-pre-wrap">{{ $contributors->artifact->remarks }}</div>
            </div>

            <div class="w-full flex items-center gap-2 my-4">
                <div class="w-full">
                    <x-form.input label="Date Profiled" value="{{ \Carbon\Carbon::parse($contributors->artifact->date_profiled)->format('F j, Y') }}" disabled />
                </div>
            </div>

            <div class="w-full flex justify-end px-4 pt-4 pb-10">
                <div class="flex items-center gap-4">
                    <x-form.return href="/contributor-report">Go Back</x-form.return>
                </div>
            </div>
        </div>
    </div>
</div>
</x-admin.body>