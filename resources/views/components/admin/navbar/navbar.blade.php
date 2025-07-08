<style>
    @media print {
        .heading {
            display: none;
        }
    }
</style>

<nav class="heading sticky z-10 top-0 flex flex-col w-full h-32 bg-white transition-all duration-200 shadow-md">
    {{-- ----------------------------------------------SIDEBAR BUTTON -------------------------------------------- --}}
    {{-- for desktop toggle sidebar --}}
    {{-- todo =================================================================================== NAVBAR TOP --}}
    <div class="heading  w-full h-16 flex items-center justify-between bg-clr-crimson px-10 py-2">
        <div class="flex items-center gap-4">
            <button @click.prevent="isOpen = !isOpen"
                class="hidden md:inline-block text-white hover:bg-clr-crimson1 p-2 rounded-md transition-all duration-200 ">
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h10" />
                </svg>
            </button>

            <h1 class="text-lg font-sans font-bold text-white">{{ $heading }}</h1>
        </div>

        <div class="h-full flex items-center gap-4 text-white">

            <livewire:admin.partials.notification>

                {{-- todo ============================================================ PROFILE BUTTON --}}
                <button x-on:click="$dispatch('toggle-profile')" class="rounded-full bg-white flex p-1 w-fit items-center gap-2">
                    <div class="w-8 h-8">
                        <img src="{{ Auth::user()->profile ? Storage::url(Auth::user()->profile) : asset('images/icons/image-placeholder.png') }}" alt="User Profile" class="w-full h-full object-cover rounded-full">
                    </div>
                    <div class="leading-none">
                        <h1 class="text-black text-xs">
                            {{ Auth::user()->fname . ' ' . Auth::user()->mname . ' ' . Auth::user()->lname . '' . Auth::user()->suffix }}
                        </h1>
                        <p class="text-gray-500 text-xs"> {{ Auth::user()->position }} </p>
                    </div>
                    <svg class="w-4 h-4 text-clr-midnight" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M18.425 10.271C19.499 8.967 18.57 7 16.88 7H7.12c-1.69 0-2.618 1.967-1.544 3.271l4.881 5.927a2 2 0 0 0 3.088 0l4.88-5.927Z"
                            clip-rule="evenodd" />
                    </svg>

                </button>

                {{-- todo ============================================================ PROFILE BUTTON DROPDOWN --}}
                <div x-data="{ profile: false }" x-show="profile" x-on:toggle-profile.window="profile = !profile"
                    @click.outside="profile = false" x-transition x-cloak
                    class="flex flex-col gap-1 z-10 absolute top-16 right-1 bg-clr-crimson border border-gray-300  p-2 w-52 rounded-lg">
                    <a href="/profile"
                        class="w-full rounded-md hover:bg-bg-tertiary text-gray-100 hover:text-txt-primary p-2 text-center">
                        <h1>Profile</h1>
                    </a>

                    <a href="/audit-logs"
                        class="w-full rounded-md hover:bg-bg-tertiary text-gray-100 hover:text-txt-primary p-2 text-center">
                        <h1>Activity Logs</h1>
                    </a>

                    <a href="{{ route('logout') }}"
                        class="w-full rounded-md hover:bg-bg-tertiary text-gray-100 hover:text-txt-primary p-2 text-center">
                        Logout
                    </a>
                </div>

        </div>
    </div>
    {{-- todo =================================================================================== NAVBAR BOTTOM --}}
    <div class="heading flex items-center px-10 py-2">
        <div class="flex items-center w-fit ms-2">
            {{-- <svg class="w-4 h-4 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m9 5 7 7-7 7" />
            </svg> --}}
            <h1 class="text-lg font-bold text-clr-midnight">{{ $secHeading }}</h1>
        </div>
    </div>
</nav>
