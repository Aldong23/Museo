<div wire:keydown.enter="adminLogin" class="auth-container min-h-screen flex items-center justify-center p-10">

    <div class="wrapper-page bg-white rounded-lg px-10 py-16 h-fit mx-auto">
        <div class="flex justify-center">
            <img src="{{ asset('images/icons/city-of-urdaneta.png') }}" class="w-24" alt="City of Urdaneta Logo">    
            <img src="{{ asset('images/icons/urdaneta-logo.png') }}" class="w-24" alt="Museo De Urdaneta Logo">
        </div>
        <h1 class="text-4xl font-bold text-center text-gray-900">Museo De Urdaneta</h1>
        <h2 class="text-2xl font-semibold text-center text-gray-600 my-5">Login</h2>

        @if (session()->has('error'))
            <div class="w-full text-center text-lg p-2 mb-3 bg-red-500 text-white rounded">
                {{ session('error') }}
            </div>
        @endif

        <x-form.input label="Email address:" wire:model="email" />
        @error('email')
            <x-form.error> {{ $message }}* </x-form.error>
        @enderror
        <x-form.password label="Password:" wire:model="password" />
        @error('password')
            <x-form.error> {{ $message }}* </x-form.error>
        @enderror

        <div class="mb-4 flex justify-between w-full text-sm">
            <div class="text-sm">
                <!-- <input id="remember" type="checkbox" name="remember" wire:model="remember">
                <label for="remember">Keep me logged in</label> -->
            </div>
            <a href="/forgot-password" class="font-semibold hover:underline text-red-700">
                Forgot password?
            </a>
        </div>

        <button wire:click="adminLogin" wire:target="adminLogin" wire:loading.attr="disabled"
            wire:loading.class="cursor-not-allowed opacity-50"
            class="my-5 w-full py-3 bg-blue-500 hover:bg-blue-700 text-white font-bold rounded transition duration-200">
            Login
            <img wire:loading wire:target="adminLogin" src="/images/icons/loading.svg" alt="Loading..." />
        </button>
        
    </div>

</div>
