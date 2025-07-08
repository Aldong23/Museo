<div class="w-full h-full flex items-center justify-center">
    {{-- CARD --}}
    <div class="w-fit h-fit flex flex-col items-center justify-center bg-white rounded-lg p-10">
        <h1 class="text-5xl font-bold text-black">Forgot Password</h1>
        <p class="my-4">Enter your email address</p>


        @if (session()->has('error'))
            <div class="w-full text-center p-1 mb-3 bg-btn-red text-white rounded">
                {{ session('error') }}
            </div>
        @endif


        <x-form.input type="email" label="Email" wire:model="email" />
        @error('email')
            <x-form.error> {{ $message }} </x-form.error>
        @enderror
        <button wire:click="send" wire:target="send" wire:loading.attr="disabled"
            wire:loading.class="cursor-not-allowed opacity-50"
            class="py-2 mt-4 w-full bg-gray-900 hover:bg-gray-800 text-white font-bold px-4 rounded-lg">
            Continue
            <img wire:loading wire:target="send" src="/images/icons/loading.svg" alt="..." />
        </button>
    </div>
</div>
