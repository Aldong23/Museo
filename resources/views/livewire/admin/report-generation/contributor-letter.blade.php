<x-slot:heading>Museo De Urdaneta</x-slot:heading>
<x-slot:secHeading>Contributor Letter</x-slot:secHeading>
<x-admin.body>
    <!-- Printable Content -->
    <div id="printable-area" class="p-4">
        <!-- Header Begin -->
        <div class="flex items-center justify-center border-b-2 pb-2 mb-4">
            <img src="{{ asset('images/icons/city-of-urdaneta.png') }}" alt="Logo 1" class="h-12 w-auto">
            <img src="{{ asset('images/icons/urdaneta-logo.png') }}" alt="Logo 2" class="h-12 w-auto">
            <h2 class="text-xl font-bold uppercase">CITY TOURISM OFFICE</h2>
        </div>
        <div class="text-center mb-4">
            <h3 class="text-xl font-semibold">ACKNOWLEDGEMENT RECEPIENT</h3>
        </div>
        <!-- Header End -->

        <!-- Letter Content Begin -->
        <div class="text-justify print-section">
            {!! $content !!}
        </div>
        <!-- Letter Content End -->

        <!-- Footer Begin -->
        <br>
        <br>
        <div class="mt-8 border-t-2 pt-2 text-center text-[10px]">
            <p>
                1/F Cultural and Sports, Amadeo R. Perez Jr. Avenue, Brgy. Poblacion, Urdaneta City, Pangasinan 2428  
                <br>
                Website: www.urdaneta-city.gov.ph Email: urdanetacitytourism@gmail.com  
                Facebook: Urdaneta Tourism Contact No.: 075-600-5321 / 0917-836-5748
            </p>
        </div>
        <!-- Footer End -->
    </div>

    <!-- Print Buttons -->
    <div class="fixed bottom-4 right-4 flex flex-col space-y-2 no-print">
        <button id="print-btn" class="bg-[crimson] text-white px-4 py-2 rounded shadow-lg hover:bg-red-700 transition">
            Print Letter
        </button>
    </div>

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
                console.log("Print button clicked!");
                printSection('printable-area');
            });
        });
    </script>
    @endpush

    <style>
        @media print {
            .no-print { display: none !important; }
        }
    </style>
</x-admin.body>
