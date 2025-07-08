<x-slot:heading>Museo De Urdaneta</x-slot:heading>
<x-slot:secHeading>Artifacts Management</x-slot:secHeading>
<x-admin.body>
    
    <div class="w-full flex items-center justify-between px-2 py-4">
        {{-- todo =================================================== ARTIFACTS --}}
        <div class="flex items-center gap-2">
            <div class="w-fit px-4 py-2 flex items-center justify-between gap-10 border border-gray-300 rounded-lg shadow-lg">
                <x-icons.artifacts-icon />
                <div class="text-center">
                    <h1 class="text-2xl font-bold"> {{ $artifacts_count }} </h1>
                    <h1 class="text-txt-secondary">Artifacts</h1>
                </div>
            </div>

            @if(auth()->user()->is_admin || auth()->user()->is_clerical)
            <div class="flex space-x-2 border border-black p-1 rounded-md">
                <a href="{{ url('/artifacts-managements') }}" class="px-4 py-2 text-gray-600 rounded-md bg-gray-200">
                    Artifacts
                </a>
                <a href="{{ url('/artifacts-archived') }}" class="px-4 py-2 text-gray-600 rounded-md">
                    Archived Artifacts
                </a>
            </div>
            @endIf
        </div>
    
        <x-form.search wire:model.live="search" />

        <div class="flex items-center gap-5">
            @if(auth()->user()->is_admin || auth()->user()->is_clerical)
                <x-form.print-btn id="print-btn" />
            @endIf

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
                        <li>
                            <x-form.select-input label="" wire:model.change="year">
                                <option value="">Select Year</option>
                                @foreach (range(now()->year, now()->year - 10) as $y)
                                    <option value="{{ $y }}">{{ $y }}</option>
                                @endforeach
                            </x-form.select-input>
                        </li>
                        <li>
                            <x-form.select-input label="" wire:model.change="month">
                                <option value="">Select Month</option>
                                @foreach (range(1, 12) as $m)
                                    <option value="{{ sprintf('%02d', $m) }}">{{ date('F', mktime(0, 0, 0, $m, 1)) }}</option>
                                @endforeach
                            </x-form.select-input>
                        </li>
                        <li>
                            <x-form.select-input label="" wire:model.change="day">
                                <option value="">Select Day</option>
                                @foreach ($days as $d)
                                    <option value="{{ $d }}">{{ $d }}</option>
                                @endforeach
                            </x-form.select-input>
                        </li>
                    </ul>
                </div>
            </div>

            @if(auth()->user()->is_admin || auth()->user()->is_clerical)
                <x-form.add-btn href="/artifacts-create" />
            @endIf
        </div>
    </div>
    {{-- * ================================================== TABLE ======================================== --}}
    <x-form.table.table>
        <x-slot:head>
            <x-form.table.th>QR</x-form.table.th>
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
                    <div x-data="{ open: false, qrSrc: '' }" class="flex items-center gap-2">

                        <img src="data:image/svg+xml;base64,{{ base64_encode(QrCode::size(100)->color(0, 0, 0)->backgroundColor(255, 255, 255)->generate(url('/view-artifact/' . $artifact->artifact_no))) }}"
                            class="qr-code cursor-pointer" alt="QR Code" width="25" height="25"
                            @click="qrSrc = $event.target.src; open = true" />

                        <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-75"
                            x-transition>
                            <div class="bg-white p-6 rounded-lg shadow-lg relative w-96 max-w-full">
                                <button class="absolute top-2 right-2 text-gray-700 text-2xl" @click="open = false">
                                    &times;
                                </button>
                                <div class="flex flex-col items-center">
                                    <img :src="qrSrc" class="w-64 h-64" alt="QR Code" />

                                    <p class="mt-4 text-sm text-center font-semibold text-gray-800">{{ $artifact->name }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </x-form.table.td>
                <x-form.table.td>
                    <p>{{ $artifact->artifact_no }}</p>
                </x-form.table.td>
                <x-form.table.td> {{ $artifact->name }} </x-form.table.td>
                <x-form.table.td> {{ $artifact->category }} </x-form.table.td>
                <x-form.table.td> {{ $artifact->type }} </x-form.table.td>
                <x-form.table.td> {{ $artifact->views }} </x-form.table.td>
                <x-form.table.td>
                    <div class="flex items-center gap-1">
                        <x-form.view-btn href="/artifacts-view/{{ $artifact->id }}"  />
                        @if(auth()->user()->is_admin || auth()->user()->is_clerical)
                        <x-form.edit-btn href="/artifacts-edit/{{ $artifact->id }}" />
                        <x-form.archive-btn  wire:click="openArchive({{ $artifact->id }})"/>
                        @endIf
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
        <p>Archive this Artifact?</p>

        <x-slot:button>
            @if ($artifactsInfo)
                <x-form.button wire:click="archiveArtifact({{ $artifactsInfo->id }})">Archive</x-form.button>
            @endif
        </x-slot:button>
    </x-modal.archive>


    <div id="printable-area" class="hidden">
        <!-- Header Begin -->
        <div class="flex items-center justify-center border-b-2 pb-2 mb-4">
            <img src="images/icons/city-of-urdaneta.png" alt="Logo 1" class="h-12 w-auto">
            <img src="images/icons/urdaneta-logo.png" alt="Logo 2" class="h-12 w-auto">
            <h2 class="text-xl font-bold uppercase">CITY TOURISM OFFICE</h2>
        </div>
        <div class="text-center mb-4">
            <h3 class="text-2xl font-semibold">List of Artifacts</h3>
        </div>
        <!-- Header End -->
        <!-- Table Begin -->
        <div>
        <x-form.table.table>
            <x-slot:head>
                <x-form.table.th>Artfact No.</x-form.table.th>
                <x-form.table.th>Artifacts Name</x-form.table.th>
                <x-form.table.th>Artifacts Category</x-form.table.th>
                <x-form.table.th>Artifact Type</x-form.table.th>
                <x-form.table.th>Owned by</x-form.table.th>
                <x-form.table.th>Dontaed by</x-form.table.th>
            </x-slot:head>

            @foreach ($artifacts as $artifact)
                <x-form.table.tr>
                    <x-form.table.td>{{ $artifact->artifact_no }}</x-form.table.td>
                    <x-form.table.td> {{ $artifact->name }} </x-form.table.td>
                    <x-form.table.td> {{ $artifact->category }} </x-form.table.td>
                    <x-form.table.td> {{ $artifact->type }} </x-form.table.td>
                    <x-form.table.td> {{ $artifact->owned_by ?? ' ' }} </x-form.table.td>
                    <x-form.table.td> {{ $artifact->donated_by ?? ' ' }} </x-form.table.td>
                </x-form.table.tr>
            @endforeach
        </x-form.table.table>
        </div>
        <!-- Table End -->
        <!-- Footer Begin -->
        <div class="mt-8 border-t-2 pt-2 text-center text-[10px]">
            <p>
                1/F Cultural and Sports, Amadeo R. Perez Jr. Avenue, Brgy. Poblacion, Urdaneta City, Pangasinan 2428  
                <br>
                Website: www.urdaneta-city.gov.ph Email: urdanetacitytourism@gmail.com  
                Facebook: Urdaneta Tourism Contact No.: 075-600-5321 / 0917-836-5748
            </p>
        </div>
        <!-- Footer End -->
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                function printSection(divId) {
                    var section = document.getElementById(divId);
                    if (!section) return;

                    var printWindow = document.body.innerHTML;
                    var printableContent = section.innerHTML;

                    document.body.innerHTML = printableContent;
                    window.print();
                    document.body.innerHTML = printWindow;
                    location.reload();
                }

                $('#print-btn').off('click').on('click', function() {
                    console.log("Print button clicked!");
                    printSection('printable-area');
                });
            });
        </script>
    @endpush

</x-admin.body>
