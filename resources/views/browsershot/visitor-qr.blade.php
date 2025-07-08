<x-layouts.visitor-layout>
    <div class="w-full h-screen flex flex-col items-center">
        {{-- <x-visitor.header /> --}}

        {{-- <a href="data:image/svg+xml;base64,{{ base64_encode(QrCode::size(300)->color(0, 0, 0)->backgroundColor(255, 255, 255)->generate($qr)) }}"
            download="registration-qr-code.svg">
            <svg class="w-7 h-7 text-black" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd"
                    d="M13 11.15V4a1 1 0 1 0-2 0v7.15L8.78 8.374a1 1 0 1 0-1.56 1.25l4 5a1 1 0 0 0 1.56 0l4-5a1 1 0 1 0-1.56-1.25L13 11.15Z"
                    clip-rule="evenodd" />
                <path fill-rule="evenodd"
                    d="M9.657 15.874 7.358 13H5a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2h-2.358l-2.3 2.874a3 3 0 0 1-4.685 0ZM17 16a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H17Z"
                    clip-rule="evenodd" />
            </svg>
        </a> --}}

        <div class="flex flex-col text-black font-semibold justify-center items-center w-full h-full py-6 px-4">
            <a href="data:image/svg+xml;base64,{{ base64_encode(QrCode::size(300)->color(0, 0, 0)->backgroundColor(255, 255, 255)->generate($qr)) }}"
                download="registration-qr-code.svg" class="text-2xl font-bold">VISITOR ID</a>
            <br>
            {!! QrCode::size(300)->color(0, 0, 0)->generate($qr) !!}
            <br>
            <a href="{{ $qr }}" class="text-gray-700">Visitor ID no. {{ $control_no }} </a>
        </div>
    </div>
</x-layouts.visitor-layout>
