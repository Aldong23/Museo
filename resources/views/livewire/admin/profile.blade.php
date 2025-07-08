<x-slot:heading>Museo De Urdaneta</x-slot:heading>
<x-slot:secHeading>Profile</x-slot:secHeading>
<x-admin.body>
    <div class="w-full h-full grid grid-cols-6 gap-4 p-10">
        {{-- todo================================================ LEFT SIDE --}}
        <div class="w-full space-y-5 col-span-6 lg:col-span-2">
            <div class="relative flex items-center justify-center bg-gray-200 rounded-lg">
                @if ($profile)
                    {{-- Show preview when a new image is selected --}}
                    <img class="rounded-lg aspect-square object-cover object-center" src="{{ $profile->temporaryUrl() }}"
                        alt="Profile Preview">
                @elseif ($user->profile)
                    {{-- Show existing profile picture from the database --}}
                    <img class="rounded-lg aspect-square object-cover object-center"
                        src="{{ asset('storage/' . $user->profile) }}" alt="Profile Image">
                @else
                    {{-- Show default placeholder image --}}
                    <img class="aspect-square object-cover object-center" src="/images/icons/image-placeholder.png"
                        alt="Placeholder">
                @endif
                {{-- IMAGE EDIT BUTTON --}}
                <div class="absolute right-2 bottom-2">
                    <label for="imageUpload">
                        <svg class="w-8 h-8 text-clr-crimson hover:text-clr-crimson1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z"
                                clip-rule="evenodd" />
                            <path fill-rule="evenodd"
                                d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z"
                                clip-rule="evenodd" />
                        </svg>

                    </label>
                    <input id="imageUpload" class="hidden" type="file" accept="image/*" wire:model="profile">
                </div>
            </div>
            <div>
                <div class="w-full flex items-center gap-2">
                    <svg class="w-10 h-10 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M4 4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2H4Zm10 5a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-8-5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm1.942 4a3 3 0 0 0-2.847 2.051l-.044.133-.004.012c-.042.126-.055.167-.042.195.006.013.02.023.038.039.032.025.08.064.146.155A1 1 0 0 0 6 17h6a1 1 0 0 0 .811-.415.713.713 0 0 1 .146-.155c.019-.016.031-.026.038-.04.014-.027 0-.068-.042-.194l-.004-.012-.044-.133A3 3 0 0 0 10.059 14H7.942Z"
                            clip-rule="evenodd" />
                    </svg>

                    <x-form.input label="Employee Number" disabled wire:model="employee_number" />
                </div>
                <div class="w-full flex items-center gap-2 mt-3">
                    <svg class="w-10 h-10 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path d="M11 9a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z" />
                        <path fill-rule="evenodd"
                            d="M9.896 3.051a2.681 2.681 0 0 1 4.208 0c.147.186.38.282.615.255a2.681 2.681 0 0 1 2.976 2.975.681.681 0 0 0 .254.615 2.681 2.681 0 0 1 0 4.208.682.682 0 0 0-.254.615 2.681 2.681 0 0 1-2.976 2.976.681.681 0 0 0-.615.254 2.682 2.682 0 0 1-4.208 0 .681.681 0 0 0-.614-.255 2.681 2.681 0 0 1-2.976-2.975.681.681 0 0 0-.255-.615 2.681 2.681 0 0 1 0-4.208.681.681 0 0 0 .255-.615 2.681 2.681 0 0 1 2.976-2.975.681.681 0 0 0 .614-.255ZM12 6a3 3 0 1 0 0 6 3 3 0 0 0 0-6Z"
                            clip-rule="evenodd" />
                        <path
                            d="M5.395 15.055 4.07 19a1 1 0 0 0 1.264 1.267l1.95-.65 1.144 1.707A1 1 0 0 0 10.2 21.1l1.12-3.18a4.641 4.641 0 0 1-2.515-1.208 4.667 4.667 0 0 1-3.411-1.656Zm7.269 2.867 1.12 3.177a1 1 0 0 0 1.773.224l1.144-1.707 1.95.65A1 1 0 0 0 19.915 19l-1.32-3.93a4.667 4.667 0 0 1-3.4 1.642 4.643 4.643 0 0 1-2.53 1.21Z" />
                    </svg>


                    <x-form.input label="Position" disabled wire:model="position" />
                </div>
            </div>
        </div>

        {{-- todo================================================ RIGHT SIDE --}}
        <div class="relative w-full col-span-6 lg:col-span-4 rounded-lg border border-gray-500">
            <div class="bg-slate-100 shadow-lg rounded-lg px-5 py-2">
                <h1 class="font-bold text-xl">User Information</h1>
            </div>
            <div class="w-full lg:flex gap-2 pt-5 px-4">
                <div class="w-full">
                    <x-form.input label="First Name" wire:model="first_name" />
                    @error('first_name')
                        <x-form.error> {{ $message }} </x-form.error>
                    @enderror
                </div>
                <div class="w-full">
                    <x-form.input label="Middle Initial" wire:model="middle_initial" />
                    @error('middle_initial')
                        <x-form.error> {{ $message }} </x-form.error>
                    @enderror
                </div>
            </div>
            <div class="w-full lg:flex gap-2 px-4 pt-2">
                <div class="w-full">
                    <x-form.input label="Last Name" wire:model="last_name" />
                    @error('last_name')
                        <x-form.error> {{ $message }} </x-form.error>
                    @enderror
                </div>
                <div class="w-full">
                    <x-form.input label="Suffix" wire:model="suffix" />
                    @error('suffix')
                        <x-form.error> {{ $message }} </x-form.error>
                    @enderror
                </div>
            </div>
            <div class="w-full px-4 pt-2">
                <x-form.input label="Employee Email" wire:model="email" />
                @error('email')
                    <x-form.error> {{ $message }} </x-form.error>
                @enderror
            </div>


            <button x-on:click.prevent="$dispatch('confirm-open')"
                class="ml-6 my-4 bg-blue-200 hover:bg-blue-100 rounded-sm px-5 py-2 text-sm">Change Password</button>


            <div class="w-full flex justify-end p-4">
                <div class="flex items-center gap-4">
                    <x-form.return href="/">Back</x-form.return>
                    <x-form.button wire:click="update" wire:target="update" wire:loading.attr="disabled"
                        wire:loading.class="cursor-not-allowed opacity-50">
                        Update
                        <img wire:loading wire:target="update" src="/images/icons/loading.svg" alt="..." />
                    </x-form.button>
                </div>
            </div>
        </div>
    </div>


    {{-- todo ================================ CHANGE PASSWORD MODAL --}}
    <div x-data="{ changePass: false }" x-show="changePass" x-on:confirm-open.window="changePass = true"
        x-on:confirm-close.window="changePass = false" x-transition x-cloak
        class="absolute inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center">
        <div class="w-96 p-10 bg-white flex flex-col gap-4 justify-between rounded-lg border border-gray-500">
            {{-- header --}}
            <div class="w-full text-center py-2">
                <span class="text-black font-bold text-lg">Change Password</span>
                <br>
                <hr>
                <br>


                <x-form.input type="password" label="Current Password" wire:model.defer="current_password" />

                @error('current_password')
                    <x-form.error>{{ $message }}</x-form.error>
                @enderror

                <x-form.input type="password" label="New Password" wire:model.defer="new_password" />
                @error('new_password')
                    <x-form.error>{{ $message }}</x-form.error>
                @enderror
                <x-form.input type="password" label="Confirm Password" wire:model.defer="confirm_password" />
                @error('confirm_password')
                    <x-form.error>{{ $message }}</x-form.error>
                @enderror


            </div>


            <div class="w-full py-2 flex gap-2 justify-end items-center">
                <x-form.return x-on:click="$dispatch('confirm-close')">Cancel</x-form.return>
                <x-form.button wire:click.prevent="updatePass">Confirm</x-form.button>
            </div>
        </div>
    </div>
</x-admin.body>
