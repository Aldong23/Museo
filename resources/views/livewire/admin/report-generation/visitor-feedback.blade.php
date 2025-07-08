<x-slot:heading>Museo De Urdaneta</x-slot:heading>
<x-slot:secHeading>Visitor Feedback</x-slot:secHeading>
<x-admin.body>
    <div class="w-full flex items-end justify-between px-2 py-4">

        <div class="flex items-end gap-5">
            <div class="flex items-center gap-2">
                <div
                    class="px-4 py-2 flex items-center justify-between gap-10 border border-gray-300 rounded-lg shadow-lg">
                    <x-icons.visitor-icon />

                    <div class="text-center">
                        <h1 class="text-2xl font-bold">{{ $feedbacks->total() }}</h1>
                        <h1 class="text-txt-secondary">Total Feedbacks</h1>
                    </div>
                </div>

                <a href="{{ url('/statistics-overall-view') }}"
                    class="px-4 py-4 flex items-center justify-between gap-10 border border-gray-300 rounded-lg shadow-lg no-underline">
                    <svg class="w-[40px] h-[40px] text-clr-crimson" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4.5V19a1 1 0 0 0 1 1h15M7 14l4-4 4 4 5-5m0 0h-3.207M20 9v3.207" />
                    </svg>

                    <div class="text-center">
                        <h1 class="text-txt-secondary font-bold">Statistics</h1>
                    </div>
                </a>
            </div>


            <x-form.search wire:model.live="search" />
        </div>

        <div class="flex items-center gap-5">
            <div x-data="{ showOptions: false }" class="relative">
                <x-form.filter-button @click="showOptions = !showOptions" />

                <div x-show="showOptions" @click.away="showOptions = false"
                    class="absolute right-0 mt-2 w-40 bg-white border shadow-lg rounded z-10">
                    <ul class="py-2">
                        <li>
                            <a href="#" @click="showOptions = false" wire:click="filter"
                                class="block px-4 py-2 hover:bg-gray-100 {{ ($day === null && $month === null && $year === null) ? 'bg-gray-200' : '' }}">
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
            <x-form.print-btn id="print-btn" />
        </div>
    </div>

    {{-- * ================================================== TABLE ======================================== --}}
    <x-form.table.table>
        <x-slot:head>
            <x-form.table.th>Visitor ID No.</x-form.table.th>
            <x-form.table.th>Visitor Name</x-form.table.th>
            <x-form.table.th>Email Address</x-form.table.th>
            <x-form.table.th>Date</x-form.table.th>
            <x-form.table.th>Time</x-form.table.th>
            <x-form.table.th>Actions</x-form.table.th>
        </x-slot:head>


        @foreach ($feedbacks as $feedback)
            <x-form.table.tr>
                <x-form.table.td>{{ $feedback->control_no }}</x-form.table.td>
                <x-form.table.td>{{ $feedback->name}}</x-form.table.td>
                <x-form.table.td> {{ $feedback->email }} </x-form.table.td>
                <x-form.table.td> {{ $feedback->created_at->format('M d, Y') }} </x-form.table.td>
                <x-form.table.td> {{ $feedback->created_at->format('h:i A') }} </x-form.table.td>
                <x-form.table.td>
                    <div class="flex items-center gap-1">
                        <x-form.view-btn href="{{ url('/visitor-report-feedback-view/' . $feedback->id) }}" />
                    </div>
                </x-form.table.td>
            </x-form.table.tr>
        @endforeach

    </x-form.table.table>

    @if (!empty($feedbacks))
        <x-form.table.pagination wire:model.change="page">
            {{ $feedbacks->links() }}
        </x-form.table.pagination>
    @endif


    <!-- Modal -->
    <x-modal.view id="viewVisitorModal" header="View Visitor Report">
        <div class="w-full h-full flex items-center justify-center">
            <div class="text-lg font-sans">
                <p> <span class="text-gray-500">Visitor ID No.: </span> <span id="visitor-id"></span></p>
                <p> <span class="text-gray-500">Visitor Name: </span> <span id="visitor-name"></span></p>
                <p> <span class="text-gray-500">Email Address: </span> <span id="visitor-email"></span></p>
                <p> <span class="text-gray-500">Date: </span> <span id="visitor-date"></span></p>
                <p> <span class="text-gray-500">Time: </span> <span id="visitor-time"></span></p>
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
            <h3 class="text-2xl font-semibold">Visitor Report</h3>
        </div>
        <!-- Header End -->
        <!-- Table Begin -->
        <div>
        <x-form.table.table>
            <x-slot:head>
                <x-form.table.th>Visitor ID No.</x-form.table.th>
                <x-form.table.th>Visitor Name</x-form.table.th>
                <x-form.table.th>Email Address</x-form.table.th>
                <x-form.table.th>Date</x-form.table.th>
                <x-form.table.th>Time</x-form.table.th>
            </x-slot:head>


            @foreach ($feedbacks as $feedback)
                <x-form.table.tr>
                    <x-form.table.td>{{ $feedback->control_no }}</x-form.table.td>
                    <x-form.table.td>{{ $feedback->name }}</x-form.table.td>
                    <x-form.table.td> {{ $feedback->email }} </x-form.table.td>
                    <x-form.table.td> {{ $feedback->created_at->format('M d, Y') }} </x-form.table.td>
                    <x-form.table.td> {{ $feedback->created_at->format('h:i A') }} </x-form.table.td>
                </x-form.table.tr>
            @endforeach

    </x-form.table.table>

            <div class="mt-4 text-right font-bold">Total Feedbacks: {{ $feedbacks->total() }}</div>
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
