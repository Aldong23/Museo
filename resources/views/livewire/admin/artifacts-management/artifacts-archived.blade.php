<x-slot:heading>Museo De Urdaneta</x-slot:heading>
<x-slot:secHeading>Archived Artifacts</x-slot:secHeading>
<x-admin.body>
    
    <div class="w-full flex items-center justify-between px-2 py-4">
        {{-- todo =================================================== ARTIFACTS --}}
        <div
            class="w-fit px-4 py-2 flex items-center justify-between gap-10 border border-gray-300 rounded-lg shadow-lg">
            <x-icons.artifacts-icon />
            <div class="text-center">
                <h1 class="text-2xl font-bold"> {{ $artifacts_count }} </h1>
                <h1 class="text-txt-secondary">Artifacts</h1>
            </div>
        </div>

        <x-form.search wire:model.live="search" />

        <div class="flex items-center gap-5">
            <div x-data="{ showOptions: false }" class="relative">
                <x-form.filter-button @click="showOptions = !showOptions" />

                <!-- Dropdown Options -->
                <div x-show="showOptions" @click.away="showOptions = false"
                    class="absolute right-0 mt-2 w-60 bg-white border shadow-lg rounded z-10">
                    <ul class="py-2">
                        <li>
                            <x-form.select-input label="" wire:model.change="selectedCategory"
                                wire:change="updateTypes">
                                <option value="">Select Category</option>
                                @foreach ($categories as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </x-form.select-input>
                        </li>
                        <li>
                            <x-form.select-input label="" wire:model.change="selectedType">
                                <option value="">Select Type</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type }}">{{ $type }}</option>
                                @endforeach
                            </x-form.select-input>
                        </li>
                    </ul>
                </div>
            </div>

            <x-form.add-btn href="/artifacts-create" />
        </div>
    </div>
    <div class="w-full flex items-end justify-between px-2 py-4">
        <div class="flex space-x-2 border border-black p-1 rounded-md">
            <a href="{{ url('/artifacts-managements') }}" class="px-4 py-2 text-gray-600 rounded-md">
                Artifacts
            </a>
            <a href="{{ url('/artifacts-archived') }}" class="px-4 py-2 text-gray-600 rounded-md bg-gray-200">
                Archived Artifacts
            </a>
        </div>

        <div class="flex items-center gap-5">
            <x-form.print-btn id="print-btn" />
        </div>
    </div>

    {{-- * ================================================== TABLE ======================================== --}}
    <x-form.table.table>
        <x-slot:head>
            <x-form.table.th>Artfact No.</x-form.table.th>
            <x-form.table.th>Artifacts Name</x-form.table.th>
            <x-form.table.th>Artifacts Category</x-form.table.th>
            <x-form.table.th>Artifact Type</x-form.table.th>
            <x-form.table.th>Visit Count</x-form.table.th>
            <x-form.table.th>Actions</x-form.table.th>
        </x-slot:head>

        @foreach ($artifacts as $artifact)
            <x-form.table.tr>
                <x-form.table.td>
                    <div class="flex items-center gap-2">
                        <a title="Download"
                            href="data:image/svg+xml;base64,{{ base64_encode(QrCode::size(300)->color(0, 0, 0)->backgroundColor(255, 255, 255)->generate('https://urdanetacitymuseum.com/visitor-view/artifact=' . $artifact->artifact_no)) }}"
                            download="registration-qr-code.svg">
                            <img src="data:image/svg+xml;base64,{{ base64_encode(QrCode::size(100)->color(0, 0, 0)->backgroundColor(255, 255, 255)->generate('https://urdanetacitymuseum.com/visitor-view/artifact=' . $artifact->artifact_no)) }}"
                                class="qr-code" alt="QR Code" width="25" height="25" />
                        </a>
                        <p>{{ $artifact->artifact_no }}</p>
                    </div>
                </x-form.table.td>
                <x-form.table.td> {{ $artifact->name }} </x-form.table.td>
                <x-form.table.td> {{ $artifact->category }} </x-form.table.td>
                <x-form.table.td> {{ $artifact->type }} </x-form.table.td>
                <x-form.table.td> {{ $artifact->views }} </x-form.table.td>
                <x-form.table.td>
                    <div class="flex items-center gap-1">
                        <x-form.restore-btn  wire:click="openArchive({{ $artifact->id }})"/>
                    </div>
                </x-form.table.td>
            </x-form.table.tr>
        @endforeach
    </x-form.table.table>

    @if (!empty($artifacts))
        <x-form.table.pagination wire:model.change="page">
            {{ $artifacts->links() }}
        </x-form.table.pagination>
    @endif

    {{-- --------------------------------------------- ARCHIVE MODAL ------------------------------------- --}}
    <x-modal.archive>
        <p>Restore this Artifact?</p>

        <x-slot:button>
            @if ($artifactsInfo)
                <x-form.button wire:click="restoreArtifact({{ $artifactsInfo->id }})">Restore</x-form.button>
            @endif
        </x-slot:button>
    </x-modal.archive>

</x-admin.body>
