<x-slot:heading>Visitor Monitoring</x-slot:heading>
<x-slot:secHeading>Visitor Registration</x-slot:secHeading>
<x-admin.body>
    <div class="w-full flex items-center justify-between px-2 py-4">

        <div x-data="{ open: false, qrSrc: '' }" class="flex items-center gap-2">
            
            <!-- Clickable QR Code -->
            <img src="data:image/svg+xml;base64,{{ base64_encode(QrCode::size(100)->color(0, 0, 0)->backgroundColor(255, 255, 255)->generate(url('/email-validation'))) }}"
                class="qr-code cursor-pointer" alt="QR Code" width="25" height="25"
                @click="qrSrc = $event.target.src; open = true" />

            <!-- Modal -->
            <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-75 z-50" x-transition>
                <div class="bg-white p-6 rounded-lg shadow-lg relative w-96 max-w-full">
                    
                    <!-- Close Button -->
                    <button class="absolute top-2 right-2 text-gray-700 text-2xl" @click="open = false">
                        &times;
                    </button>

                    <!-- Large QR Code -->
                    <div class="flex flex-col items-center">
                        <img :src="qrSrc" class="w-64 h-64" alt="QR Code" />

                        <!-- Link to Email Validation -->
                        <a href="{{ url('/email-validation') }}" class="mt-4 text-blue-600 hover:underline text-lg font-semibold">
                            Register
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <x-form.search wire:model.live="search"  />

    </div>

    {{-- * ================================================== TABLE ======================================== --}}
    <x-form.table.table>
        <x-slot:head>
            <x-form.table.th>Visitor ID No.</x-form.table.th>
            <x-form.table.th>Visitor Name</x-form.table.th>
            <x-form.table.th>Email Address</x-form.table.th>
            <x-form.table.th>Client Type</x-form.table.th>
            <x-form.table.th>Date</x-form.table.th>
            <x-form.table.th>Action</x-form.table.th>
        </x-slot:head>

        @foreach ($visitorRecords as $visitorRecord)
            <x-form.table.tr>
                <x-form.table.td> {{ $visitorRecord->control_no }} </x-form.table.td>
                <x-form.table.td> {{ $visitorRecord->visitor->fname . ' ' . $visitorRecord->visitor->mname . ' ' . $visitorRecord->visitor->lname . ' ' . $visitorRecord->visitor->suffix }}
                </x-form.table.td>
                <x-form.table.td> {{ $visitorRecord->visitor->email }} </x-form.table.td>
                <x-form.table.td>{{ $visitorRecord->client_type }}</x-form.table.td>
                <x-form.table.td>{{ $visitorRecord->created_at->format('n-j-Y g:i A') }}</x-form.table.td>
                <x-form.table.td>
                    <div class="flex items-center gap-3">
                        <x-form.view-btn href="/visitor-view/{{ $visitorRecord->id }}"/>
                        @if(auth()->user()->is_admin || auth()->user()->is_tourist_assistance || auth()->user()->is_technical)
                        <button wire:click="approve({{ $visitorRecord->id }})"
                            class="text-sm bg-green-300 font-bold hover:bg-green-400 rounded px-4 py-1">Approve</button>
                        @endIf
                    </div>
                </x-form.table.td>
            </x-form.table.tr>
        @endforeach

    </x-form.table.table>

    {{-- =============================================================== QR CODE MODAL --}}
    <div x-data="{ qrcode: false }" x-show="qrcode" x-on:open-qrcode.window="qrcode = true"
        x-on:close-qrcode.window="qrcode = false" x-transition x-cloak
        class="absolute top-0 left-0 right-0 bottom-0 flex justify-center items-center">
        <div class="absolute top-0 left-0 right-0 bottom-0 bg-black opacity-50 z-10"></div>
        <div @click.outside="qrcode = false"
            class="flex flex-col justify-between min-w-96 min-h-54 bg-gray-100 rounded-lg z-50 border dark:border-gray-500">
            {{-- ============= HEAD ========================================== --}}
            <div class="flex gap-2 items-center justify-center bg-clr-midnight1 w-full rounded-t-lg px-4 py-2 ">
                <h1 class="text-2xl font-bold text-white">QR Code</h1>
                <a href="data:image/svg+xml;base64,{{ base64_encode(QrCode::size(300)->color(0, 0, 0)->backgroundColor(255, 255, 255)->generate($url)) }}"
                    download="registration-qr-code.svg">
                    <svg class="w-7 h-7 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M13 11.15V4a1 1 0 1 0-2 0v7.15L8.78 8.374a1 1 0 1 0-1.56 1.25l4 5a1 1 0 0 0 1.56 0l4-5a1 1 0 1 0-1.56-1.25L13 11.15Z"
                            clip-rule="evenodd" />
                        <path fill-rule="evenodd"
                            d="M9.657 15.874 7.358 13H5a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2h-2.358l-2.3 2.874a3 3 0 0 1-4.685 0ZM17 16a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H17Z"
                            clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
            {{-- ============= BODY =========================================== --}}
            <div class="flex text-black font-semibold justify-center items-start w-full h-full py-6 px-4">
                {!! QrCode::size(300)->color(0, 0, 0)->generate($url) !!}
            </div>
        </div>
    </div>

</x-admin.body>
