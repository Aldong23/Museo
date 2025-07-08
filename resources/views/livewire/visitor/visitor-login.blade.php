<div class="auth-container min-h-screen flex items-center justify-center p-10">

    {{-- ==================================== RIGHT --}}
    <div class="wrapper-page bg-white rounded-lg px-10 py-16 h-fit mx-auto">
        <div class="flex justify-center">
            <img src="{{ asset('images/icons/city-of-urdaneta.png') }}" class="w-24" alt="City of Urdaneta Logo">    
            <img src="{{ asset('images/icons/urdaneta-logo.png') }}" class="w-24" alt="Museo De Urdaneta Logo">
        </div>
        <h1 class="text-4xl font-bold text-center text-gray-900">Museo De Urdaneta</h1>
        <h2 class="text-2xl font-semibold text-center text-gray-600 my-5">Visitor Login</h2>

        <x-form.input  label="Enter your controll number" placeholder="" wire:model="controll_number" />
        @error('controll_number')
            <x-form.error> {{ $message }} </x-form.error>
        @enderror
        
        <div class="flex justify-center items-center my-5">
            <button wire:click="validateControllNumber" wire:target="validateControllNumber" wire:loading.attr="disabled"
                wire:loading.class="cursor-not-allowed opacity-50"
                class="flex items-center gap-1 bg-gray-800 hover:bg-gray-700 py-2 px-20 rounded-sm text-white">
                SUBMIT
                <img wire:loading wire:target="validateControllNumber" src="/images/icons/loading.svg" alt="..." />
            </button>
        </div>
        <div class="mb-4 flex justify-center w-full text-sm">
            <a href="/email-validation" class="font-semibold hover:underline text-blue-700">
                Visitor Registration
            </a>
        </div>
    </div>
</div>
