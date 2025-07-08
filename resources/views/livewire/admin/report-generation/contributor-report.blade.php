<x-slot:heading>Museo De Urdaneta</x-slot:heading>
<x-slot:secHeading>Contributor Report</x-slot:secHeading>
<x-admin.body>
    <div class="w-full flex items-center justify-between px-2 py-4">

        <x-form.search wire:model.live="search" />

        <div class="flex items-center gap-5">
            <!-- Dropdown Options -->
            <div x-data="{ showOptions: false }" class="relative">
                <x-form.filter-button @click="showOptions = !showOptions" />

                <div x-show="showOptions" @click.away="showOptions = false"
                    class="absolute right-0 mt-2 w-40 bg-white border shadow-lg rounded z-10">
                    <ul class="py-2">
                        <li>
                            <a href="#" @click="showOptions = false" wire:click="filter"
                                class="block px-4 py-2 hover:bg-gray-100 {{ ($province === null && $municipality === null && $barangay === null && $month === null && $year === null) ? 'bg-gray-200' : '' }}">
                                All
                            </a>
                        </li>
                        <li>
                            <x-form.select-input label="" wire:model.change="province" wire:change="updateProvince">
                                <option value="">Province</option>
                                @foreach ($provinces as $prov)
                                    <option value="{{ $prov->name }}"> {{ $prov->name }} </option>
                                @endforeach
                            </x-form.select-input>
                        </li>
                        <li>
                            <x-form.select-input label="" wire:model.change="municipality" wire:change="updateCity">
                                <option value="">Municipality</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->name }}"> {{ $city->name }} </option>
                                @endforeach
                            </x-form.select-input>
                        </li>
                        <li>
                            <x-form.select-input label="" wire:model.change="barangay">
                                <option value="">Barangay</option>
                                @foreach ($barangays as $brngy)
                                    <option value="{{ $brngy->name }}"> {{ $brngy->name }} </option>
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
            <a href="{{ url('contributor-letter-edit') }}" class="rounded-md bg-black text-white px-3 py-1">Letter Form</a>
            @endIf
            <x-form.print-btn id="print-btn" />
        </div>
    </div>

    {{-- * ================================================== TABLE ======================================== --}}
    <x-form.table.table>
        <x-slot:head>
            <x-form.table.th>No.</x-form.table.th>
            <x-form.table.th>Name</x-form.table.th>
            <x-form.table.th>Contact No.</x-form.table.th>
            <x-form.table.th>Email Address</x-form.table.th>
            <x-form.table.th>Province</x-form.table.th>
            <x-form.table.th>Municipality</x-form.table.th>
            <x-form.table.th>Artifact Name</x-form.table.th>

            <x-form.table.th>Action</x-form.table.th>
        </x-slot:head>

        @foreach ($contributors as $contributor)
            <x-form.table.tr>
                <x-form.table.td> {{ $contributor->id }} </x-form.table.td>
                <x-form.table.td class="contributor-name">
                    {{ $contributor->fname . ' ' . $contributor->mname . ' ' . $contributor->lname . ' ' . $contributor->suffix }}
                </x-form.table.td>
                <x-form.table.td> {{ $contributor->contact_no }} </x-form.table.td>
                <x-form.table.td> {{ $contributor->email }} </x-form.table.td>
                <x-form.table.td> {{ $contributor->province }} </x-form.table.td>
                <x-form.table.td> {{ $contributor->municipality }} </x-form.table.td>
                <x-form.table.td class="artifact-name"> {{ $contributor->artifact->name }} </x-form.table.td>

                <x-form.table.td>
                    <div class="flex items-center gap-1">
                        <x-form.view-btn href="{{ url('contributor-view/' . $contributor->id) }}" />
                        <x-form.print-btn href="{{ url('contributor-letter/' . $contributor->id) }}" />
                    </div>
                </x-form.table.td>
            </x-form.table.tr>
        @endforeach

    </x-form.table.table>

    @if (!empty($contributors))
        <x-form.table.pagination wire:model.change="page">
            {{ $contributors->links() }}
        </x-form.table.pagination>
    @endif


    <!-- Modal -->
    <x-modal.view id="viewContributorModal" header="View Contributor Details">
        <div class="w-full h-full flex items-center justify-center">
            <div class="text-lg font-sans">
                <p> <span class="text-gray-500">No.: </span> <span id="modal-no"></span></p>
                <p> <span class="text-gray-500">Name: </span> <span id="modal-name"></span></p>
                <p> <span class="text-gray-500">Contact No.: </span> <span id="modal-contact"></span></p>
                <p> <span class="text-gray-500">Email Address: </span> <span id="modal-email"></span></p>
                <p> <span class="text-gray-500">Province: </span> <span id="modal-province"></span></p>
                <p> <span class="text-gray-500">Municipality: </span> <span id="modal-municipality"></span></p>
                <p> <span class="text-gray-500">Artifact Name: </span> <span id="modal-artifact"></span></p>
                <p> <span class="text-gray-500">Status: </span> <span id="modal-status"></span></p>
            </div>
        </div>
    </x-modal.view>

    <!-- Generate Report Tags -->
    <div id="printable-area" class="hidden">
        <!-- Header Begin -->
        <div class="flex items-center justify-center border-b-2 pb-2 mb-4">
            <img src="images/icons/city-of-urdaneta.png" alt="Logo 1" class="h-12 w-auto">
            <img src="images/icons/urdaneta-logo.png" alt="Logo 2" class="h-12 w-auto">
            <h2 class="text-xl font-bold uppercase">CITY TOURISM OFFICE</h2>
        </div>
        <div class="text-center mb-4">
            <h3 class="text-2xl font-semibold">Contributor Report</h3>
        </div>
        <!-- Header End -->
        <!-- Table Begin -->
        <div>
            <x-form.table.table>
                <x-slot:head>
                    <x-form.table.th>No.</x-form.table.th>
                    <x-form.table.th>Name</x-form.table.th>
                    <x-form.table.th>Contact No.</x-form.table.th>
                    <x-form.table.th>Email Address</x-form.table.th>
                    <x-form.table.th>Province</x-form.table.th>
                    <x-form.table.th>Municipality</x-form.table.th>
                    <x-form.table.th>Artifact Name</x-form.table.th>
                </x-slot:head>

                @foreach ($contributors as $contributor)
                    <x-form.table.tr>
                        <x-form.table.td> {{ $contributor->id }} </x-form.table.td>
                        <x-form.table.td class="contributor-name">
                            {{ $contributor->fname . ' ' . $contributor->mname . ' ' . $contributor->lname . ' ' . $contributor->suffix }}
                        </x-form.table.td>
                        <x-form.table.td> {{ $contributor->contact_no }} </x-form.table.td>
                        <x-form.table.td> {{ $contributor->email }} </x-form.table.td>
                        <x-form.table.td> {{ $contributor->province }} </x-form.table.td>
                        <x-form.table.td> {{ $contributor->municipality }} </x-form.table.td>
                        <x-form.table.td class="artifact-name"> {{ $contributor->artifact->name }} </x-form.table.td>
                    </x-form.table.tr>
                @endforeach

            </x-form.table.table>
        </div>
        <!-- Table End -->
        <!-- Footer Begin -->
        <div class="mt-8">
            <p class="font-semibold">Prepared by:</p>
            <div class="mt-4">
                <span class="block w-48 border-b border-black"></span>
                <p class="mt-1 font-bold">{{ Auth::user()->fname }} {{ Auth::user()->mname }} {{ Auth::user()->lname }}
                </p>
                <p>{{ Auth::user()->position }}</p>
            </div>
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
