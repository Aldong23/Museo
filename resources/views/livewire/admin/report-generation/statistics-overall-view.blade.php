<x-slot:heading>Museo De Urdaneta</x-slot:heading>
<x-slot:secHeading>Visitor Report Statistics</x-slot:secHeading>
<x-admin.body>
    <div class="w-full flex items-end justify-between px-2 py-4">
        <div class="flex space-x-2 border border-black p-1 rounded-md">
            <a href="{{ url('/statistics-overall-view') }}"
                class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md no-underline bg-gray-200">
                Overall View
            </a>
            <a href="{{ url('/statistics-cc') }}"
                class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md no-underline">
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

        <!-- Content Begin -->
    
        <div class="flex flex-col p-10 border border-black rounded-md">
            <div wire:ignore id="visitorSexChart" class="w-full"></div>
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
        

        <div class="flex flex-col p-10 border border-black rounded-md mt-6">
            <div wire:ignore id="clientTypeChart" class="w-full"></div>
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

        <div class="flex flex-col p-10 border border-black rounded-md mt-6">
            <div wire:ignore id="visitorAgeChart" class="w-full"></div>
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
    
        <!-- Content End -->
        
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

            let visitorSexChart, clientTypeChart, visitorAgeChart; 

            function renderVisitorSexChart(data) {

                console.log("Rendering Chart with Data:", data);

                if (!data || typeof data.male === 'undefined' || typeof data.female === 'undefined') {
                    console.error("Invalid data structure for chart:", data);
                    return;
                }

                if (visitorSexChart) visitorSexChart.destroy();

                visitorSexChart = new ApexCharts(document.querySelector("#visitorSexChart"), {
                    series: [{
                            name: 'Male',
                            data: [data.male]
                        },
                        {
                            name: 'Female',
                            data: [data.female]
                        }
                    ],
                    chart: {
                        height: 350,
                        type: 'bar'
                    },
                    plotOptions: {
                        bar: {
                            horizontal: true
                        }
                    },
                    xaxis: {
                        categories: ['Sex'],
                        title: {
                            text: 'Visitor Count'
                        }
                    },
                    title: {
                        text: 'Sex',
                        align: 'left',
                        style: {
                            fontSize: "16px",
                            color: '#666'
                        }
                    },
                    fill: {
                        type: 'solid',
                        colors: ['#1E90FF', '#FF69B4']
                    }
                });

                visitorSexChart.render();
            }

            function renderClientTypeChart(data) {

                console.log("Rendering Client with Data:", data);

                if (!data || typeof data.citizen === 'undefined' || typeof data.business === 'undefined' ||
                    typeof data.employee === 'undefined') {
                    console.error("Invalid data structure for client type chart:", data);
                    return;
                }

                if (clientTypeChart) clientTypeChart.destroy();

                clientTypeChart = new ApexCharts(document.querySelector("#clientTypeChart"), {
                    series: [{
                            name: 'Citizen',
                            data: [data.citizen]
                        },
                        {
                            name: 'Business',
                            data: [data.business]
                        },
                        {
                            name: 'Employee',
                            data: [data.employee]
                        }
                    ],
                    chart: {
                        height: 350,
                        type: 'bar'
                    },
                    plotOptions: {
                        bar: {
                            horizontal: true
                        }
                    },
                    xaxis: {
                        categories: ['Client Type'],
                        title: {
                            text: 'Client Count'
                        }
                    },
                    title: {
                        text: 'Client Type',
                        align: 'left',
                        style: {
                            fontSize: "16px",
                            color: '#666'
                        }
                    },
                    fill: {
                        type: 'solid',
                        colors: ['#8DC63F', '#FFCC00', '#0073E6']
                    }
                });

                clientTypeChart.render();
            }

            function renderVisitorAgeChart(data) {

                // Ensure data is properly formatted
                if (Array.isArray(data) && data.length > 0) {
                    data = data[0]; // Extract object if wrapped in an array
                }

                if (!data || typeof data !== 'object') {
                    console.error("Invalid data structure for age chart:", data);
                    return;
                }

                let chartElement = document.querySelector("#visitorAgeChart");
                if (!chartElement) {
                    console.error("Chart container not found");
                    return;
                }

                if (typeof visitorAgeChart !== 'undefined' && visitorAgeChart) {
                    visitorAgeChart.destroy();
                }

                visitorAgeChart = new ApexCharts(chartElement, {
                    series: [
                        { name: '0-17', data: [data['0-17']] },
                        { name: '18-24', data: [data['18-24']] },
                        { name: '25-34', data: [data['25-34']] },
                        { name: '35-44', data: [data['35-44']] },
                        { name: '45-54', data: [data['45-54']] },
                        { name: '55+', data: [data['55+']] }
                    ],
                    chart: {
                        height: 350,
                        type: 'bar'
                    },
                    plotOptions: {
                        bar: {
                            horizontal: true,
                        }
                    },
                    xaxis: {
                        categories: ['Visitors'],
                        title: { text: 'Number of Visitors' }
                    },
                    title: {
                        text: 'Visitor Data by Age',
                        align: 'left',
                        style: { fontSize: "16px", color: '#666' }
                    },
                    
                    fill: {
                        type: 'solid',
                        colors: ['#FF5733', '#33FF57', '#337BFF', '#FFC300', '#C70039', '#900C3F'] // Unique colors per age group
                    }
                });

                visitorAgeChart.render();
            }


            // Fetch Initial Data and Render Chart
            let initialVisitorData = @json($visitorData);
            let initialClientData = @json($clientData);
            let initialVisitorAgeData = @json($visitorAgeData);

            console.log("Initializing Visitor Chart with:", initialVisitorData);
            console.log("Initializing Client Type Chart with:", initialClientData);
            console.log("Initializing Age Chart with:", initialVisitorAgeData);

            renderVisitorSexChart(initialVisitorData);
            renderClientTypeChart(initialClientData);
            renderVisitorAgeChart(initialVisitorAgeData);

            // Listen for Livewire Updates
            Livewire.on('updateVisitorChart', (data) => {
                if (Array.isArray(data) && data.length > 0) data = data[0];
                if (typeof data === 'object' && data !== null) {
                    renderVisitorSexChart(data);
                } else {
                    console.error("Invalid data for Visitor Sex Chart:", data);
                }
            });

            Livewire.on('updateClientChart', (data) => {
                if (Array.isArray(data) && data.length > 0) data = data[0];
                if (typeof data === 'object' && data !== null) {
                    renderClientTypeChart(data);
                } else {
                    console.error("Invalid data for Client Type Chart:", data);
                }
            });

            Livewire.on('updateVisitorAgeChart', (data) => {
                if (typeof data === 'object' && data !== null) {
                    renderVisitorAgeChart(data);
                } else {
                    console.error("Invalid data for Visitor Age Chart:", data);
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