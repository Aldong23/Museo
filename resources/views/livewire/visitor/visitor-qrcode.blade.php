<div class="w-full h-screen flex flex-col items-center">
    <x-visitor.header />

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
        <a href="{{ $qr }}" class="text-blue-600">Visitor ID no. {{ $control_no }} </a>

    </div>
    
    {{-- <a class="bg-clr-crimson hover:bg-clr-crimson1 text-white font-bold px-5 py-2 rounded mb-4 mt-2"
        href="/visitorqr">Download</a> --}}
        
     <a class="bg-clr-crimson hover:bg-clr-crimson1 text-white font-bold px-5 py-2 rounded mb-4 mt-2"
         href="data:image/svg+xml;base64,{{ base64_encode(QrCode::size(300)->color(0, 0, 0)->backgroundColor(255, 255, 255)->generate($qr)) }}" download="registration-qr-code.svg">Download</a>

    <div class="w-full flex justify-end p-2">
        <a href="/feedback-fil" class="flex items-center gap-1" id="feedbackLink">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M21 15C21 15.5304 20.7893 16.0391 20.4142 16.4142C20.0391 16.7893 19.5304 17 19 17H7L3 21V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H19C19.5304 3 20.0391 3.21071 20.4142 3.58579C20.7893 3.96086 21 4.46957 21 5V15Z"
                    stroke="#885858" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            MDUFeedback.com
        </a>
    </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.getElementById('feedbackLink').addEventListener('click', function(e) {
        e.preventDefault();

        // Store the control_no in localStorage before redirecting
        const controlNo = '{{ $control_no }}'; // Get the control_no from Blade

        // Store the control number in localStorage
        localStorage.setItem('control_no', controlNo);

        Swal.fire({
            title: 'Language Choice',
            text: 'Visitor Feedback',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Filipino',
            cancelButtonText: 'English',
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to the Filipino feedback page
                window.location.href = '/feedback-fil';
            } else if (result.isDismissed) {
                // Redirect to the English feedback page
                window.location.href = '/feedback-en';
            }
        });
    });
</script>
