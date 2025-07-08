<x-slot:heading>Museo De Urdaneta</x-slot:heading>
<x-slot:secHeading>Archived Accounts</x-slot:secHeading>
<x-admin.body>
    
    <div class="w-full p-2 flex justify-between items-center">
        <x-form.search wire:model.live.debounce.250ms="search" />
        <a href="/account-management-create"
            class="w-fit h-fit flex items-center gap-2 bg-clr-crimson hover:bg-clr-crimson1 text-white px-4 py-1 rounded">
            <svg width="24" height="23" viewBox="0 0 29 28" fill="none" class="stroke-current"
                xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_127_838)">
                    <path
                        d="M19.3335 24.5V22.1667C19.3335 20.929 18.8243 19.742 17.9178 18.8668C17.0114 17.9917 15.782 17.5 14.5002 17.5H6.04183C4.75995 17.5 3.53057 17.9917 2.62415 18.8668C1.71772 19.742 1.2085 20.929 1.2085 22.1667V24.5M24.1668 9.33333V16.3333M27.7918 12.8333H20.5418M15.1043 8.16667C15.1043 10.744 12.9404 12.8333 10.271 12.8333C7.60162 12.8333 5.43766 10.744 5.43766 8.16667C5.43766 5.58934 7.60162 3.5 10.271 3.5C12.9404 3.5 15.1043 5.58934 15.1043 8.16667Z"
                        stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                </g>
            </svg>
            <span class="font-semibold">Add</span>
        </a>
    </div>
    <div class="w-full flex items-end justify-between px-2 py-4">
        <div class="flex space-x-2 border border-black p-1 rounded-md">
            <a href="{{ url('/account-management') }}" class="px-4 py-2 text-gray-600 rounded-md">
                Users
            </a>
            <a href="{{ url('/account-archived') }}" class="px-4 py-2 text-gray-600 rounded-md bg-gray-200">
                Archived Users
            </a>
        </div>
    </div>

    {{-- * ================================================== TABLE ======================================== --}}
    <x-form.table.table>
        <x-slot:head>
            <x-form.table.th>Name</x-form.table.th>
            <x-form.table.th>Employee No.</x-form.table.th>
            <x-form.table.th>Position</x-form.table.th>
            <x-form.table.th>Email</x-form.table.th>
            <x-form.table.th>Status</x-form.table.th>
            <x-form.table.th>Action</x-form.table.th>
        </x-slot:head>

        @foreach ($users as $user)
            <x-form.table.tr>
                <x-form.table.td> {{ $user->fname . ' ' . $user->mname . ' ' . $user->lname . ' ' . $user->suffix }}
                </x-form.table.td>
                <x-form.table.td> {{ $user->employee_no }} </x-form.table.td>
                <x-form.table.td> {{ $user->position }} </x-form.table.td>
                <x-form.table.td> {{ $user->email }} </x-form.table.td>
                <x-form.table.td>
                    @if ($user->last_seen && $user->last_seen->diffInMinutes(now()) < 5)
                        <span class="text-black px-4 py-1 bg-green-300 rounded-md font-semibold">Online</span>
                    @else
                        <span class="text-black px-4 py-1 bg-gray-300 rounded-md font-semibold">Offline</span>
                    @endif
                </x-form.table.td>
                <x-form.table.td>
                    <x-form.restore-btn  wire:click="openArchive({{ $user->id }})"/>
                </x-form.table.td>
            </x-form.table.tr>
        @endforeach
    </x-form.table.table>

    @if (!empty($users))
        <x-form.table.pagination wire:model.change="page">
            {{ $users->links() }}
        </x-form.table.pagination>
    @endif

    {{-- --------------------------------------------- ARCHIVE MODAL ------------------------------------- --}}
    <x-modal.archive>
        <p>Restore this User?</p>

        <x-slot:button>
            @if ($userInfo)
                <x-form.button wire:click="restoreUser({{ $userInfo->id }})">Restore</x-form.button>
            @endif
        </x-slot:button>
    </x-modal.archive>

</x-admin.body>
