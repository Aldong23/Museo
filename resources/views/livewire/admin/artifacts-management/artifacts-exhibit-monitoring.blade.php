<x-slot:heading>Museo De Urdaneta</x-slot:heading>
<x-slot:secHeading>Artifacts Management</x-slot:secHeading>
<x-admin.body>
    <div class="w-full flex items-center justify-between px-2 py-4">
        {{-- todo =================================================== ARTIFACTS --}}
        <h1 class="text-lg font-bold">Events</h1>


        <x-form.search wire:model.live="search" />

        <div class="flex items-center gap-5">
            <div x-data="{ showOptions: false }" class="relative">
                <x-form.filter-button @click="showOptions = !showOptions" />

                <!-- Dropdown Options -->
                <div x-show="showOptions" @click.away="showOptions = false"
                    class="absolute mt-2 w-40 bg-white border shadow-lg rounded z-10">
                    <ul class="py-2">
                        <li>
                            <a href="#" @click="showOptions = false" wire:click="filter(null)"
                                class="block px-4 py-2 hover:bg-gray-100 {{ $status_filter === null ? 'bg-gray-200' : '' }}">
                                All
                            </a>
                        </li>
                        <li>
                            <a href="#" @click="showOptions = false" wire:click="filter('Pending')"
                                class="block px-4 py-2 hover:bg-gray-100 {{ $status_filter === 'Pending' ? 'bg-gray-200' : '' }}">
                                Pending
                            </a>
                        </li>
                        <li>
                            <a href="#" @click="showOptions = false" wire:click="filter('Approved')"
                                class="block px-4 py-2 hover:bg-gray-100 {{ $status_filter === 'Approved' ? 'bg-gray-200' : '' }}">
                                Approved
                            </a>
                        </li>
                        <li>
                            <a href="#" @click="showOptions = false" wire:click="filter('Declined')"
                                class="block px-4 py-2 hover:bg-gray-100 {{ $status_filter === 'Declined' ? 'bg-gray-200' : '' }}">
                                Declined
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <x-form.add-btn href="/artifacts-exhibit-monitoring-create" />
        </div>
    </div>

    {{-- * ================================================== TABLE ======================================== --}}
    <x-form.table.table>
        <x-slot:head>
            <x-form.table.th>No.</x-form.table.th>
            <x-form.table.th>Program Name</x-form.table.th>
            <x-form.table.th>Subject Activity</x-form.table.th>
            <x-form.table.th>Location</x-form.table.th>
            <x-form.table.th>Duration</x-form.table.th>
            <x-form.table.th>Prepared by</x-form.table.th>
            <x-form.table.th>Status</x-form.table.th>
            <x-form.table.th>Action</x-form.table.th>
        </x-slot:head>


        @foreach ($exhibits as $ex)
            <x-form.table.tr>
                <x-form.table.td> {{ $ex->id }} </x-form.table.td>
                <x-form.table.td> {{ $ex->program_name }} </x-form.table.td>
                <x-form.table.td> {{ $ex->subject_activity }} </x-form.table.td>
                <x-form.table.td> {{ $ex->address }} </x-form.table.td>
                <x-form.table.td> {{ $ex->start_date->format('M d') . ' - ' . $ex->end_date->format('d, Y') }}
                </x-form.table.td>
                <x-form.table.td>
                    <div>
                        <h1>
                            {{ $ex->user->fname . ' ' . $ex->user->mname . ' ' . $ex->user->lname }}
                        </h1>
                        <p class="text-sm text-gray-700"> {{ $ex->user->position }} </p>
                    </div>
                </x-form.table.td>
                <x-form.table.td>
                    <p
                        class="{{ $ex->status === 'Declined' ? 'text-red-500 font-bold' : ($ex->status === 'Approved' ? 'text-green-400 font-bold' : '') }} ">
                        {{ $ex->status }}
                    </p>
                </x-form.table.td>
                <x-form.table.td>
                    <div class="flex items-center gap-1">
                        <x-form.view-btn href='/artifacts-exhibit-view/{{ $ex->id }}' />
                        <x-form.edit-btn href='/artifacts-exhibit-approval/{{ $ex->id }}' />
                    </div>
                </x-form.table.td>
            </x-form.table.tr>
        @endforeach

    </x-form.table.table>

    @if (!empty($exhibits))
        <x-form.table.pagination wire:model.change="page">
            {{ $exhibits->links() }}
        </x-form.table.pagination>
    @endif

</x-admin.body>
