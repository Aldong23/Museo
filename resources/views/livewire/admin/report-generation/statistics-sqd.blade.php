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
                class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md no-underline">
                Citizen's Charter
            </a>
            <a href="{{ url('/statistics-sqd') }}"
                class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md no-underline bg-gray-200">
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

    <!-- Prevents JavaScript from running before Livewire loads -->
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

        @foreach ($sqd_data as $sqdId => $data)
            <div class="chart-container border p-4 rounded-lg shadow-md mb-6 bg-white">
                <h3 class="text-lg font-semibold mb-2">{{ $questions[$loop->index] }}</h3>

                <div wire:ignore id="sqdChart{{ $sqdId }}" style="height: 350px;"></div>
                <p class="mt-2">Total Responses: <span id="totalResponses{{ $sqdId }}">0</span></p>

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
        @endforeach

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


                let sqdCharts = {};

                function renderSQDChart(data, sqdId, questions) {
                    // console.log("Rendering Chart for:", sqdId, "Data:", data);
                    // console.log('questions', sqdId);

                    if (sqdId === undefined || sqdId === null) {
                        console.error("Invalid SQD ID:", sqdId);
                        return;
                    }

                    if (!data || typeof data !== 'object') {
                        console.error(`Invalid data structure for SQD${sqdId}:`, data);
                        return;
                    }

                    let dataValues = [
                        data.Strongly_Agree ?? 0,
                        data.Agree ?? 0,
                        data.Neutral ?? 0,
                        data.Disagree ?? 0,
                        data.Strongly_Disagree ?? 0,
                        data.Not_Applicable ?? 0
                    ];

                    // console.log(`Processed Data for SQD${sqdId}:`, dataValues);

                    let seriesData = [{
                        name: "Responses",
                        data: dataValues
                    }];

                    let chartContainer = document.querySelector(`#sqdChart${sqdId}`);
                    // console.log(`🔍 Checking chart container for SQD${sqdId}:`, chartContainer);
                    if (!chartContainer) {
                        console.warn(`⚠️ Chart container #sqdChart${sqdId} not found.`);
                        return;
                    }

                    var totalResponses = Object.values(data).flat().reduce((a, b) => a + b, 0);
                    document.getElementById(`totalResponses${sqdId}`).innerText = totalResponses;

                    let options = {
                        series: seriesData,
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
                            categories: ["Strongly Agree", "Agree", "Neutral", "Disagree", "Strongly Disagree",
                                "Not Applicable"
                            ],
                            title: {
                                text: questions
                            }
                        },
                        title: {
                            text: questions,
                            align: 'left',
                            style: {
                                fontSize: "16px",
                                color: '#666'
                            }
                        },
                        fill: {
                            type: 'solid',
                            colors: ['#4CAF50', '#2196F3', '#FFC107', '#FF5722', '#9C27B0', '#795548']
                        }
                    };

                    if (sqdCharts[sqdId]) {
                        sqdCharts[sqdId].destroy();
                    }

                    sqdCharts[sqdId] = new ApexCharts(chartContainer, options);
                    sqdCharts[sqdId].render();
                }


                Livewire.on('updateSqd', (response) => {
                    console.log("Received response:", response);

                    if (!response || response.length === 0 || !response[0].data) {
                        console.warn("No valid data received from Livewire.");
                        return;
                    }

                    const data = response[0].data; // Extract the data array
                    const questions = response[0].questions; // Extract the questions array

                    data.forEach((questionData, sqdId) => {
                        console.log('🔍 Processing SQD ID:', sqdId, questionData);

                        // Convert index to string to avoid JavaScript treating 0 as falsy
                        renderSQDChart(questionData, String(sqdId), questions[sqdId]);
                    });
                });


                setTimeout(() => {
                    @foreach ($sqd_data as $sqdId => $data)

                        renderSQDChart(@json($data), {!! json_encode($sqdId) !!});
                    @endforeach
                }, 500);
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
