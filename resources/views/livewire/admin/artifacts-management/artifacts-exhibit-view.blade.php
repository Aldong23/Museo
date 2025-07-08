<x-slot:heading>Museo De Urdaneta</x-slot:heading>
<x-slot:secHeading>View Artifacts Exhibit</x-slot:secHeading>
<x-admin.body>

    <div id="printable-area">
        <div class="flex items-center justify-center border-b-2 pb-2 mb-4 hidden print-show">
            <img src="{{ asset('images/icons/city-of-urdaneta.png') }}" alt="Logo 1" class="h-12 w-auto">
            <img src="{{ asset('images/icons/urdaneta-logo.png') }}" alt="Logo 2" class="h-12 w-auto">
            <h2 class="text-xl font-bold uppercase">CITY TOURISM OFFICE</h2>
        </div>

    
        {{-- PROGRAM NAME --}}
        <x-form.input label="Program Name" value="{{ $exhibit->program_name }}" disabled/>

        {{-- SUBJECT ACTIVITY --}}
        <x-form.input label="Subject Activity" value="{{ $exhibit->subject_activity }}" disabled/>

        {{-- LOCATIONS --}}
        <div class="w-full flex items-center gap-2">
            <div class="w-full">
                <x-form.input label="Province" value="{{ $exhibit->province ?? 'N/A' }}" disabled/>
            </div>
            <div class="w-full">
                <x-form.input label="Municipality" value="{{ $exhibit->municipality ?? 'N/A' }}" disabled/>
            </div>

            <div class="w-full">
                <x-form.input label="Barangay" value="{{ $exhibit->barangay ?? 'N/A' }}" disabled/>
            </div>
        </div>

        {{-- SUBJECT ACTIVITY --}}
        <x-form.input label="House/Block/Lot No." value="{{ $exhibit->address ?? 'N/A' }}" disabled/>

        {{-- DURATION OF ACTIVTY --}}
        <h1 class="ms-2 mt-3 mb-2 text-gray-900">Duration of Activity</h1>
        <div class="w-full md:flex items-center gap-2">
            <div class="w-full">
                <x-form.input label="Start" value="{{ $exhibit->start_date->format('m/d/Y') }}" disabled/>
            </div>

            <div class="w-full">
                <x-form.input label="End" value="{{ $exhibit->end_date->format('m/d/Y') }}" disabled/>
            </div>
        </div>


        {{-- DESCRIPTION OF ACTIVTY --}}
        <div class="w-full flex flex-col gap-1 p-2">
            <label class="text-txt-secondary">Description of Activity</label>
            <div class="border border-brdr-primary text-txt-primary rounded-lg p-2.5 whitespace-pre-wrap">{{ $exhibit->description }}</div>
        </div>

        {{-- ========================== LIST OF ARTIFACTS =========================== --}}
        <h1 class="ms-2 mt-3 mb-2 font-bold text-gray-900">List of Artifacts</h1>

        {{-- MULTI SELECT SUPPORTING DOCUMENTATION --}}
        <div class="ms-3 w-full">
            <x-form.table.table>
                <x-slot:head>
                    <x-form.table.th>Artifacts Name</x-form.table.th>
                    <x-form.table.th>Category</x-form.table.th>
                    <x-form.table.th>Type</x-form.table.th>
                </x-slot:head>


                @foreach ($artifacts as $art)
                    <x-form.table.tr>
                        <x-form.table.td> {{ $art->name }} </x-form.table.td>
                        <x-form.table.td> {{ $art->category }} </x-form.table.td>
                        <x-form.table.td> {{ $art->type }} </x-form.table.td>
                    </x-form.table.tr>
                @endforeach

            </x-form.table.table>
        </div>


        <div class="w-96 mt-5">
            <x-form.input label="Status" value="{{ $exhibit->status }}" disabled/>
        </div>

        {{-- REMARKS --}}
        <div class="w-full flex flex-col gap-1 p-2">
            <label class="text-txt-secondary">Remarks</label>
            <div class="border border-brdr-primary text-txt-primary rounded-lg p-2.5 whitespace-pre-wrap">{{ $exhibit->remarks }}</div>
        </div>

    

        <br>
        <div class="hidden print-show">
            <div class="mt-8">
                <p class="font-semibold">Prepared by:</p>
                <br>
                <div>
                    <span class="block w-48 border-b border-black"></span>
                    <p class="mt-1 font-bold">{{ Auth::user()->fname }} {{ Auth::user()->mname }} {{ Auth::user()->lname }}
                    </p>
                    <p>{{ Auth::user()->position }}</p>
                </div>
            </div>

            <br>
            <div class="mt-8">
                <p class="font-semibold">Approved by:</p>
                <br>
                <div>
                    <span class="block w-48 border-b border-black"></span>
                    <p class="mt-1 font-bold">{{ $adminUser->fname }} {{ $adminUser->mname }} {{ $adminUser->lname }}
                    </p>
                    <p>{{ $adminUser->position }}</p>
                </div>
            </div>

            <div class="mt-8 border-t-2 pt-2 text-center text-[10px]">
                <p>
                    1/F Cultural and Sports, Amadeo R. Perez Jr. Avenue, Brgy. Poblacion, Urdaneta City, Pangasinan 2428  
                    <br>
                    Website: www.urdaneta-city.gov.ph Email: urdanetacitytourism@gmail.com  
                    Facebook: Urdaneta Tourism Contact No.: 075-600-5321 / 0917-836-5748
                </p>
            </div>
        </div>
    
    </div>
    
    
    @if ($exhibit->status === 'Approved' || $exhibit->status === 'Declined')
    <div class="fixed bottom-4 right-4 flex flex-col space-y-2 no-print">
        <button id="print-btn" class="bg-[crimson] text-white px-4 py-2 rounded shadow-lg hover:bg-red-700 transition">
            Print
        </button>
    </div>
    @endif

    @push('scripts')
    <script>
        $(document).ready(function() {
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
                    el.classList.remove('hidden'); // Remove Tailwind's hidden class
                });
                printSection('printable-area');
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