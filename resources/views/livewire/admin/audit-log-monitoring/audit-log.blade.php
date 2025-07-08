<x-slot:heading>Museo De Urdaneta</x-slot:heading>
<x-slot:secHeading>Contributor</x-slot:secHeading>
<x-admin.body>
    <div class="w-full flex items-center justify-between px-2 py-4">
        {{-- todo =================================================== ARTIFACTS --}}


        <div class="flex items-center gap-5">
    
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
                            class="block px-4 py-2 hover:bg-gray-100 {{ ($month === null && $year === null) ? 'bg-gray-200' : '' }}">
                            All
                        </a>
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
    </div>

    {{-- * ================================================== TABLE ======================================== --}}
    <x-form.table.table>
        <x-slot:head>
            <x-form.table.th>Date</x-form.table.th>
            <x-form.table.th>Events</x-form.table.th>
            <x-form.table.th>Content</x-form.table.th>
            <x-form.table.th>Name</x-form.table.th>
            <x-form.table.th>Position</x-form.table.th>
        </x-slot:head>


        @foreach ($auditLogs as $auditLog)
            <x-form.table.tr>
                <x-form.table.td> {{ $auditLog->created_at->format('M d, Y g:i A') }} </x-form.table.td>
                <x-form.table.td> {{ $auditLog->event }} </x-form.table.td>
                <x-form.table.td> {{ $auditLog->content }} </x-form.table.td>
                <x-form.table.td> {{ $auditLog->user->fname . ' ' . $auditLog->user->mname . ' ' . $auditLog->user->lname . ' ' . $auditLog->user->suffix }}</x-form.table.td>
                <x-form.table.td> {{ $auditLog->user->position }} </x-form.table.td>
            </x-form.table.tr>
        @endforeach

    </x-form.table.table>

    @if (!empty($auditLogs))
        <x-form.table.pagination wire:model.change="page">
            {{ $auditLogs->links() }}
        </x-form.table.pagination>
    @endif
</x-admin.body>
