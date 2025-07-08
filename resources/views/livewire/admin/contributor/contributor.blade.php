<x-slot:heading>Museo De Urdaneta</x-slot:heading>
<x-slot:secHeading>Contributor</x-slot:secHeading>
<x-admin.body>
    <div class="w-full flex items-center justify-between px-2 py-4">
        {{-- todo =================================================== ARTIFACTS --}}


        <div class="flex items-center gap-5">
    
            <div x-data="{ open: false, qrSrc: '' }" class="relative">
                
                <img src="data:image/svg+xml;base64,{{ base64_encode(QrCode::size(100)->color(0, 0, 0)->backgroundColor(255, 255, 255)->generate(url('/contributor-create'))) }}"
                    class="qr-code cursor-pointer" alt="QR Code" width="25" height="25"
                    @click="qrSrc = $event.target.src; open = true" />

                <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-75 z-50" x-transition>
                    <div class="bg-white p-6 rounded-lg shadow-lg relative w-96 max-w-full">
                        
                        <button class="absolute top-2 right-2 text-gray-700 text-2xl" @click="open = false">
                            &times;
                        </button>

                        <div class="flex flex-col items-center">
                            <img :src="qrSrc" class="w-64 h-64" alt="QR Code" />

                            <a href="{{ url('/contributor-create') }}" class="mt-4 text-blue-600 hover:underline text-lg font-semibold">
                                Create Contributor
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search Bar Below (Outside of Modal) -->
            <x-form.search class="relative z-10" wire:model.live="search" />

        </div>


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
                        <x-form.select-input label="" wire:model.change="status">
                            <option value="">All Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Disapproved">Disapproved</option>
                        </x-form.select-input>
                    </li>
                </ul>
            </div>

        </div>
    </div>

    {{-- * ================================================== TABLE ======================================== --}}
    <x-form.table.table>
        <x-slot:head>
            {{-- <x-form.table.th>No.</x-form.table.th> --}}
            <x-form.table.th>Name</x-form.table.th>
            <x-form.table.th>Contact No.</x-form.table.th>
            <x-form.table.th>Email Address</x-form.table.th>
            <x-form.table.th>Province</x-form.table.th>
            <x-form.table.th>Municipality</x-form.table.th>
            <x-form.table.th>Artifact Name</x-form.table.th>
            <x-form.table.th>Status</x-form.table.th>
            <x-form.table.th>Action</x-form.table.th>
        </x-slot:head>


        @foreach ($contributors as $cont)
            <x-form.table.tr>
                {{-- <x-form.table.td> </x-form.table.td> --}}
                <x-form.table.td> {{ $cont->fname . ' ' . $cont->mname . ' ' . $cont->lname . ' ' . $cont->suffix }}
                </x-form.table.td>
                <x-form.table.td> {{ $cont->contact_no }} </x-form.table.td>
                <x-form.table.td> {{ $cont->email }} </x-form.table.td>
                <x-form.table.td> {{ $cont->province }} </x-form.table.td>
                <x-form.table.td> {{ $cont->municipality }} </x-form.table.td>
                <x-form.table.td> {{ $cont->artifact->name }} </x-form.table.td>
                <x-form.table.td> {{ $cont->artifact->status }} </x-form.table.td>
                <x-form.table.td>
                    <div class="flex items-center gap-1">
                        <x-form.view-btn href="/contributor-view={{ $cont->id }}" />
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
</x-admin.body>
