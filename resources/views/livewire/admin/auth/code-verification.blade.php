<div class="w-full h-full flex items-center justify-center p-10">
    {{-- CARD --}}
    <div class="w-fit h-fit flex flex-col items-center justify-center bg-white rounded-lg p-10">
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-black">New Password</h1>
        {{-- <p class="my-4">Enter your email address</p> --}}
        <br>
        <div class="w-full px-2">
            <p class="w-full py-2 text-black bg-green-100 text-center px-2 rounded">We’ve send a password reset OTP to
                your email - {{ $user->email }}</p>
        </div>
        <br>
        @if (session()->has('error'))
            <div class="w-full text-center p-1 mb-3 bg-btn-red text-white rounded">
                {{ session('error') }}
            </div>
        @endif


        <x-form.input label="Verification code" wire:model="code" />
        @error('code')
            <x-form.error> {{ $message }} </x-form.error>
        @enderror

        <x-form.password label="Create new password" wire:model="new_password" />
        @error('new_password')
            <x-form.error> {{ $message }} </x-form.error>
        @enderror

        <x-form.password label="Confirm password" wire:model="confirm_password" />
        @error('confirm_password')
            <x-form.error> {{ $message }} </x-form.error>
        @enderror
        <br>
        <button wire:click="send" wire:target="send" wire:loading.attr="disabled"
            wire:loading.class="cursor-not-allowed opacity-50"
            class="py-2 mt-4 w-full bg-gray-900 hover:bg-gray-800 text-white font-bold px-4 rounded-lg">
            Submit
            <img wire:loading wire:target="send" src="/images/icons/loading.svg" alt="..." />
        </button>
    </div>
</div>
