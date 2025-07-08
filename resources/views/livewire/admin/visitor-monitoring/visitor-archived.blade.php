<x-slot:heading>Museo De Urdaneta</x-slot:heading>
<x-slot:secHeading>Archived Visitors</x-slot:secHeading>
<x-admin.body>
    
    <div class="w-full flex items-center justify-between px-2 py-4">

        <x-form.search wire:model.live="search"  />

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
                        <x-form.select-input label="" wire:model.change="month">
                            <option value="">Select Month</option>
                            @foreach (range(1, 12) as $m)
                                <option value="{{ sprintf('%02d', $m) }}">{{ date('F', mktime(0, 0, 0, $m, 1)) }}</option>
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
                </ul>
            </div>

        </div>
    </div>
    <div class="w-full flex items-end justify-between px-2 py-4">
        <div class="flex space-x-2 border border-black p-1 rounded-md">
            <a href="{{ url('visitor-profiling') }}" class="px-4 py-2 text-gray-600 rounded-md">
                Visitor
            </a>
            <a href="{{ url('visitor-archived') }}" class="px-4 py-2 text-gray-600 rounded-md bg-gray-200">
                Archived Visitor
            </a>
        </div>
    </div>

    {{-- * ================================================== TABLE ======================================== --}}
    <x-form.table.table>
        <x-slot:head>
            <x-form.table.th>Visitor No.</x-form.table.th>
            <x-form.table.th>Visitor Name</x-form.table.th>
            <x-form.table.th>Address</x-form.table.th>
            <x-form.table.th>Date</x-form.table.th>
            <x-form.table.th>Visit Count</x-form.table.th>
            <x-form.table.th>Action</x-form.table.th>
        </x-slot:head>

        @foreach ($visitors as $visitor)
            <x-form.table.tr>
                <x-form.table.td> {{ $loop->iteration }} </x-form.table.td>
                <x-form.table.td> 
                    {{ $visitor->fname . ' ' . $visitor->mname . ' ' . $visitor->lname . ' ' . $visitor->suffix }}
                </x-form.table.td>
                <x-form.table.td> 
                    {{ $visitor->barangay . ', ' . $visitor->city . ', ' . $visitor->province }} 
                </x-form.table.td>
                <x-form.table.td>{{ $visitor->created_at->format('F j, Y') }}</x-form.table.td>
                <x-form.table.td>{{ $visitor->approved_visits_count }}</x-form.table.td>
                <x-form.table.td>
                    <div class="flex items-center gap-1">
                        <x-form.restore-btn  wire:click="openArchive({{ $visitor->id }})"/>
                    </div>
                </x-form.table.td>
            </x-form.table.tr>
        @endforeach
    </x-form.table.table>

    @if (!empty($visitors))
        <x-form.table.pagination wire:model.change="page">
            {{ $visitors->links() }}
        </x-form.table.pagination>
    @endif

    {{-- --------------------------------------------- ARCHIVE MODAL ------------------------------------- --}}
    <x-modal.archive>
        <p>Restore this Visitor?</p>

        <x-slot:button>
            @if ($visitorInfo)
                <x-form.button wire:click="restoreVisitor({{ $visitorInfo->id }})">Restore</x-form.button>
            @endif
        </x-slot:button>
    </x-modal.archive>

</x-admin.body>
