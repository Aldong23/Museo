<x-slot:heading>Museo De Urdaneta</x-slot:heading>
<x-slot:secHeading>Edit User</x-slot:secHeading>
<x-admin.body>
    <div class="flex w-full gap-2 mb-4">
        <div class="w-full">
            <x-form.input label="Employee No. *" wire:model="employeeNo" />
            @error('employeeNo')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>
        <div class="w-full">
            <x-form.select-input label="Position *" wire:model="position">
                <option value="">Select Position</option>
                <option value="Technical Staff">Technical Staff</option>
                <option value="Clerical, Inspection and Communication Section">Clerical, Inspection and Communication
                    Section
                </option>
                <option value="Tourist Info and Assistance Section">Tourist Info and Assistance Section</option>
            </x-form.select-input>
            @error('position')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>
    </div>
    <h1 class="font-bold">Employee Name</h1>
    <div class="flex w-full gap-2">
        <div class="w-full">
            <x-form.input label="First Name *" wire:model="firstname" />
            @error('firstname')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>
        <x-form.input label="Middle Initial" wire:model="middleInitial" />
        <div class="w-full">
            <x-form.input label="Last Name *" wire:model="lastname" />
            @error('lastname')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>
        <x-form.input label="Suffix" wire:model="suffix" />
    </div>
    <div>
        <x-form.input type="email" label="Employee Email *" placeholder="@gmail.com" wire:model="email" />
        @error('email')
            <x-form.error> {{ $message }} </x-form.error>
        @enderror
    </div>

    <div class="w-full px-2 mt-10 flex justify-end">
        <div class="flex gap-2">
            <x-form.return href="/account-management">Cancel</x-form.return>
            <x-form.button wire:click="submit" wire:target="submit" wire:loading.attr="disabled"
                wire:loading.class="cursor-not-allowed opacity-50">
                Update
                <img wire:loading wire:target="submit" src="/images/icons/loading.svg" alt="..." />
            </x-form.button>
        </div>
    </div>
</x-admin.body>
