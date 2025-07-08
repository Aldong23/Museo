<x-slot:heading>Museo De Urdaneta</x-slot:heading>
<x-slot:secHeading>Visitor Report Statistics</x-slot:secHeading>
<x-admin.body>
    <div class="w-full flex items-end justify-between px-2 py-4">
        <div class="flex space-x-2 border border-black p-1 rounded-md">
            <a href="{{ url('/statistics-overall-view') }}"
                class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md no-underline">
                Overall View
            </a>
            <a href="{{ url('/statistics-cc') }}"
                class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md no-underline bg-gray-200">
                Citizen's Charter
            </a>
            <a href="{{ url('/statistics-sqd') }}"
                class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md no-underline">
                Synthesis of Qualitative Data
            </a>
        </div>

        <div class="flex items-center gap-5">
            <x-form.print-btn id="print-btn" />

            <div x-data="{ showOptions: false }" class="relative">
                <button class="bg-clr-crimson p-1 hover:bg-clr-crimson1 rounded-sm" @click="showOptions = !showOptions">
                    <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                            d="M18.796 4H5.204a1 1 0 0 0-.753 1.659l5.302 6.058a1 1 0 0 1 .247.659v4.874a.5.5 0 0 0 .2.4l3 2.25a.5.5 0 0 0 .8-.4v-7.124a1 1 0 0 1 .247-.659l5.302-6.059c.566-.646.106-1.658-.753-1.658Z" />
                    </svg>
                </button>
                <!-- Dropdown Options -->
                <div x-show="showOptions" @click.away="showOptions = false"
                    class="absolute right-0 mt-2 w-60 bg-white border shadow-lg rounded z-10">
                    <ul class="py-2">
                        <li>
                            <a href="#" @click="showOptions = false" wire:click="filter"
                                class="block px-4 py-2 hover:bg-gray-100 {{ ($month === now()->month && $year === now()->year && $day === null) ? 'bg-gray-200' : '' }}">
                                Current
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
    </div>

    <div id="printable-area">
        <!-- Header Begin -->
        <div class="hidden print-show">
            <div class="flex items-center justify-center border-b-2 pb-2 mb-4">
                <img src="images/icons/city-of-urdaneta.png" alt="Logo 1" class="h-12 w-auto">
                <img src="images/icons/urdaneta-logo.png" alt="Logo 2" class="h-12 w-auto">
                <h2 class="text-xl font-bold uppercase">CITY TOURISM OFFICE</h2>
            </div>
            <div class="text-center mb-4">
                <h3 class="text-2xl font-semibold">Visitor Report</h3>
            </div>
        </div>
        <!-- Header End -->

        <div class="flex flex-col p-10 border border-black rounded-md">

            <div class="text-lg font-semibold mb-2">Total Responses: <span id="totalResponses">0</span></div>

            <div class="text-md font-medium mb-4">
                Which of the following best describes your knowledge of the Citizen’s Charter (CC)?
            </div>

            <div wire:ignore id="cc1Chart" class="w-full"></div>

            <div class="mt-4 text-sm text-center">
                Filter: 
                @if($year && $month && $day)
                    {{ date('F d, Y', strtotime("$year-$month-$day")) }}
                @elseif($year && $month)
                    {{ date('F, Y', strtotime("$year-$month-01")) }}
                @elseif($year)
                    {{ $year }}
                @else
                    All Time
                @endif
            </div>
        </div>

        <div class="flex flex-col p-10 border border-black rounded-md mt-5">
            <div class="text-lg font-semibold mb-2">Total Responses: <span id="totalResponsesCC2">0</span></div>
            <div class="text-md font-medium mb-4">If you know about CC (checked options 1-3 in CC1), can you say that the CC
                in the office you visited is...</div>
            <div wire:ignore id="cc2Chart" class="w-full"></div>

            <div class="mt-4 text-sm text-center">
                Filter: 
                @if($year && $month && $day)
                    {{ date('F d, Y', strtotime("$year-$month-$day")) }}
                @elseif($year && $month)
                    {{ date('F, Y', strtotime("$year-$month-01")) }}
                @elseif($year)
                    {{ $year }}
                @else
                    All Time
                @endif
            </div>
        </div>

        <div wire:ignore class="flex flex-col p-10 border border-black rounded-md mt-5">
            <div class="text-lg font-semibold mb-2">Total Responses: <span id="totalResponsesCC3">0</span></div>
            <div class="text-md font-medium mb-4">If you are familiar with the CC (Checked options 1-3 in CC1), how helpful
                was the CC in your transaction?</div>
            <div wire:ignore id="cc3Chart" class="w-full"></div>

            <div class="mt-4 text-sm text-center">
                Filter: 
                @if($year && $month && $day)
                    {{ date('F d, Y', strtotime("$year-$month-$day")) }}
                @elseif($year && $month)
                    {{ date('F, Y', strtotime("$year-$month-01")) }}
                @elseif($year)
                    {{ $year }}
                @else
                    All Time
                @endif
            </div>
        </div>

        <!-- Footer Begin -->
        <div class="mt-8 hidden print-show">
            <p class="font-semibold">Prepared by:</p>
            <br>
            <div">
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
            document.addEventListener('livewire:initialized', function() {

                function printSection(divId) {
                    var section = document.getElementById(divId);
                    if (!section) return;

                    var originalContent = document.body.innerHTML;
                    var printableContent = section.innerHTML;

                    document.body.innerHTML = printableContent;
                    window.print();
                    document.body.innerHTML = originalContent;
                    location.reload();
                }

                $('#print-btn').off('click').on('click', function() {
                    document.querySelectorAll('.print-show').forEach(el => {
                        el.classList.remove('hidden');
                    });
                    document.querySelectorAll('.no-print').forEach(el => {
                        el.classList.add('hidden');
                    });
                    printSection('printable-area');
                });


                // ============================== CC1
                let cc1Chart;

                function renderCC1Chart(data) {

                    if (!data || typeof data.opt1 === 'undefined' || typeof data.opt2 === 'undefined' ||
                        typeof data.opt3 === 'undefined' ||
                        typeof data.opt4 === 'undefined') {
                        console.error("Invalid data structure for CC1:", data);
                        return;
                    }

                    var totalResponses = Object.values(data).flat().reduce((a, b) => a + b, 0);

                    document.getElementById("totalResponses").innerText = totalResponses;

                    var options = {
                        series: [{
                                name: 'CC1-1: I know about CC, and I saw it in the office I visited.',
                                data: [data.opt1]
                            },
                            {
                                name: 'CC1-2: I know about CC, but I didn’t see it in the office I visited.',
                                data: [data.opt2]
                            },
                            {
                                name: 'CC1-3: I learned about CC when I saw it in the office I visited.',
                                data: [data.opt3]
                            },
                            {
                                name: 'CC1-4: I don’t know what CC is, and I didn’t see anything in the office I visited (Check ‘NA’).',
                                data: [data.opt4]
                            }
                        ],
                        chart: {
                            height: 350,
                            type: 'bar'
                        },
                        plotOptions: {
                            bar: {
                                horizontal: false
                            }
                        },
                        xaxis: {
                            categories: ['CC1'],
                            title: {
                                text: 'Citizen’s Charter 1'
                            },
                            labels: {
                                style: {
                                    fontSize: '14px',
                                    fontWeight: 'bold'
                                }
                            }
                        },
                        title: {
                            text: 'Citizen’s Charter 1 Responses',
                            align: 'left',
                            style: {
                                fontSize: "16px",
                                color: '#666'
                            }
                        },
                        fill: {
                            type: 'solid',
                            colors: ['#FF5733', '#33FF57', '#3357FF', '#F3C13A']
                        }
                    };

                    if (cc1Chart) cc1Chart.destroy();

                    cc1Chart = new ApexCharts(document.querySelector("#cc1Chart"), options);

                    cc1Chart.render();
                }

                let cc1data = @json($cc1_data);
                console.log("Initializing CC1 Chart with CC1:", cc1data);

                renderCC1Chart(cc1data);

                Livewire.on('updateCC1', (data) => {

                    if (Array.isArray(data) && data.length > 0) data = data[0];

                    if (typeof data === 'object' && data !== null) {
                        renderCC1Chart(data);
                    } else {
                        console.error("Invalid data for CC1:", data);
                    }
                });

                // ============================== CC2
                let cc2Chart;

                function renderCC2Chart(data) {

                    if (!data || typeof data.opt1 === 'undefined' || typeof data.opt2 === 'undefined' ||
                        typeof data.opt3 === 'undefined' ||
                        typeof data.opt4 === 'undefined' ||
                        typeof data.opt5 === 'undefined') {
                        console.error("Invalid data structure for CC2:", data);
                        return;
                    }

                    var totalResponses = Object.values(data).flat().reduce((a, b) => a + b, 0);
                    document.getElementById("totalResponsesCC2").innerText = totalResponses;

                    var options = {
                        series: [{
                                name: 'CC2-1: Easy to see',
                                data: [data.opt1]
                            },
                            {
                                name: 'CC2-2: Somewhat easy to see',
                                data: [data.opt2]
                            },
                            {
                                name: 'CC2-3: Difficult to see',
                                data: [data.opt3]
                            },
                            {
                                name: 'CC2-4: Cannot be seen',
                                data: [data.opt4]
                            },
                            {
                                name: 'CC2-5: N/A',
                                data: [data.opt5]
                            }
                        ],
                        chart: {
                            height: 350,
                            type: 'bar'
                        },
                        plotOptions: {
                            bar: {
                                horizontal: false
                            }
                        },
                        xaxis: {
                            categories: ['CC2'],
                            title: {
                                text: 'Citizen’s Charter 2'
                            },
                            labels: {
                                style: {
                                    fontSize: '14px',
                                    fontWeight: 'bold'
                                }
                            }
                        },
                        title: {
                            text: 'Citizen’s Charter 2 Responses',
                            align: 'left',
                            style: {
                                fontSize: "16px",
                                color: '#666'
                            }
                        },
                        fill: {
                            type: 'solid',
                            colors: ['#FF5733', '#33FF57', '#3357FF', '#F3C13A']
                        }
                    };

                    if (cc2Chart) cc2Chart.destroy();
                    cc2Chart = new ApexCharts(document.querySelector("#cc2Chart"), options);
                    cc2Chart.render();
                }

                let cc2data = @json($cc2_data);
                console.log("Initializing CC2 Chart with:", cc2data);

                renderCC2Chart(cc2data);

                Livewire.on('updateCC2', (data) => {
                    if (Array.isArray(data) && data.length > 0) data = data[0];

                    if (typeof data === 'object' && data !== null) {
                        renderCC2Chart(data);
                    } else {
                        console.error("Invalid data for CC2:", data);
                    }
                });

                // ============================== CC3
                let cc3Chart;

                function renderCC3Chart(data) {

                    if (!data || typeof data.opt1 === 'undefined' || typeof data.opt2 === 'undefined' ||
                        typeof data.opt3 === 'undefined' ||
                        typeof data.opt4 === 'undefined') {
                        console.error("Invalid data structure for CC3:", data);
                        return;
                    }

                    var totalResponses = Object.values(data).flat().reduce((a, b) => a + b, 0);
                    document.getElementById("totalResponsesCC3").innerText = totalResponses;

                    var options = {
                        series: [{
                                name: 'CC3-1: Very helpful',
                                data: [data.opt1]
                            },
                            {
                                name: 'CC3-2: Somewhat helpful',
                                data: [data.opt2]
                            },
                            {
                                name: 'CC3-3: Not helpful',
                                data: [data.opt3]
                            },
                            {
                                name: 'CC3-4: N/A',
                                data: [data.opt4]
                            }
                        ],
                        chart: {
                            height: 350,
                            type: 'bar'
                        },
                        plotOptions: {
                            bar: {
                                horizontal: false
                            }
                        },
                        xaxis: {
                            categories: ['CC3'],
                            title: {
                                text: 'Citizen’s Charter 3'
                            },
                            labels: {
                                style: {
                                    fontSize: '14px',
                                    fontWeight: 'bold'
                                }
                            }
                        },
                        title: {
                            text: 'Citizen’s Charter 3 Responses',
                            align: 'left',
                            style: {
                                fontSize: "16px",
                                color: '#666'
                            }
                        },
                        fill: {
                            type: 'solid',
                            colors: ['#FF5733', '#33FF57', '#3357FF', '#F3C13A']
                        }
                    };

                    if (cc3Chart) cc3Chart.destroy();
                    cc3Chart = new ApexCharts(document.querySelector("#cc3Chart"), options);
                    cc3Chart.render();
                }

                let cc3data = @json($cc3_data);
                console.log("Initializing CC3 Chart with:", cc3data);

                renderCC3Chart(cc3data);

                Livewire.on('updateCC3', (data) => {

                    if (Array.isArray(data) && data.length > 0) data = data[0];

                    if (typeof data === 'object' && data !== null) {
                        renderCC3Chart(data);
                    } else {
                        console.error("Invalid data for CC3:", data);
                    }
                });



            });
        </script>
    @endpush


<style>
    @media print {
        .no-print { display: none !important; }

        .print-show { display: block !important; }
    }
</style>

</x-admin.body>
