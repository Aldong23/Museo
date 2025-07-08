<div class="w-full h-full flex flex-col justify-center items-center space-y-4">
    <div class="p-4 bg-gray-200 text-black text-2xl font-bold">
        {{ $message }}
    </div>

    <button wire:click="goBack"
        class="px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white text-lg rounded-md">
        Go Back to QR Code
    </button>

    @if ($isExpired)
        <button wire:click="logout"
            class="px-6 py-2 bg-red-500 hover:bg-red-600 text-white text-lg rounded-md">
            Logout
        </button>
    @endif
</div>
