<div>
    @if (auth()->user()->unreadNotifications->isNotEmpty())
        <!-- SVG for unread notifications -->
        <div class="relative">
            <svg x-on:click="$dispatch('toggle-notif')" width="24" height="24" viewBox="0 0 32 32"
                class="stroke-current" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M18.3067 27.9998C18.0723 28.4039 17.7358 28.7394 17.331 28.9725C16.9261 29.2057 16.4672 29.3284 16 29.3284C15.5328 29.3284 15.0739 29.2057 14.669 28.9725C14.2642 28.7394 13.9277 28.4039 13.6933 27.9998M24 10.6665C24 8.54477 23.1571 6.50994 21.6569 5.00965C20.1566 3.50936 18.1217 2.6665 16 2.6665C13.8783 2.6665 11.8434 3.50936 10.3431 5.00965C8.84286 6.50994 8 8.54477 8 10.6665C8 19.9998 4 22.6665 4 22.6665H28C28 22.6665 24 19.9998 24 10.6665Z"
                    stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <div class="absolute top-0 right-0  bg-btn-red h-2 w-2 border border-bg-secondary rounded-full">
            </div>
        </div>
    @else
        <!-- SVG for no unread notifications -->
        <svg x-on:click="$dispatch('toggle-notif')" width="24" height="24" viewBox="0 0 32 32"
            class="stroke-current" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M18.3067 27.9998C18.0723 28.4039 17.7358 28.7394 17.331 28.9725C16.9261 29.2057 16.4672 29.3284 16 29.3284C15.5328 29.3284 15.0739 29.2057 14.669 28.9725C14.2642 28.7394 13.9277 28.4039 13.6933 27.9998M24 10.6665C24 8.54477 23.1571 6.50994 21.6569 5.00965C20.1566 3.50936 18.1217 2.6665 16 2.6665C13.8783 2.6665 11.8434 3.50936 10.3431 5.00965C8.84286 6.50994 8 8.54477 8 10.6665C8 19.9998 4 22.6665 4 22.6665H28C28 22.6665 24 19.9998 24 10.6665Z"
                stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    @endif

    {{-- NOTIFICATION DROPDOWN --}}
    <div x-data="{ notif: false }" x-show="notif" x-on:toggle-notif.window="notif = !notif" @click.outside="notif = false"
        x-transition x-cloak
        class="absolute z-[100] top-16 right-1 mt-3 w-96 h-[600px] overflow-y-auto p-2 bg-bg-secondary border border-brdr-primary rounded-lg space-y-1 scrollbar-thin scrollbar-track-bg-secondary scrollbar-thumb-txt-tertiary scrollbar-corner-slate-50">
        <div class="w-full text-txt-primary text-2xl font-bold select-none">
            Notifications
        </div>
        <div class="flex items-baseline gap-5 mt-3 mb-2 select-none">
            <button wire:click.prevent="markAllAsRead"
                class="text-txt-secondary hover:text-btn-blue hover:underline">Mark
                all
                as read</button>
            <button wire:click.prevent="removeAll" class="text-txt-secondary hover:text-btn-red hover:underline">Remove
                all</button>
        </div>
        <hr>
        <br class="select-none">
        {{-- notifs --}}
        @forelse ($notifications as $notif)
            <div
                class="flex items-start justify-between w-full text-txt-primary p-2 hover:bg-bg-tertiary rounded-md select-none">
                <div wire:click.prevent="notifLink('{{ $notif->id }}')" class="w-full cursor-pointer">
                    <h1 class="font-bold">{{ $notif->data['title'] ?? 'No Title' }}</h1>
                    <p class="text-gray-900 font-semibold">{{ $notif->data['content'] ?? 'No Content' }}</p>
                    <span class="text-green-500 text-xs mt-2">
                        {{ \Carbon\Carbon::parse($notif['created_at'])->diffForHumans() }}</span>
                    @if (!$notif->read_at)
                        <button wire:click.prevent="markAsRead('{{ $notif->id }}')"
                            class="text-btn-blue block text-sm">Mark
                            as
                            read</button>
                    @else
                    @endif

                </div>
                <button wire:click.prevent="deleteNotification('{{ $notif->id }}')" title="Remove">

                    <svg class="w-5 h-5 text-txt-tertiary hover:text-btn-red" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18 17.94 6M18 18 6.06 6" />
                    </svg>

                </button>

            </div>
        @empty
            <div class="w-full text-center text-txt-primary select-none">
                No notifications
            </div>
        @endforelse
        @if ($notifications)
            <div x-intersect="$wire.loadMore()"></div>

            <div class="w-full text-gray-700 text-center select-none">
                {{-- <img class="size-8" wire:loading src="/images/svg/loading.svg" alt="..." /> --}}
                <p wire:loading>Loading...</p>
            </div>
        @endif
        {{-- <div wire:loading class="w-full h-14 animate-pulse bg-bg-tertiary">
</div> --}}

    </div>
</div>
