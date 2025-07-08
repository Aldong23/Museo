<div class="w-full h-full p-10">
    <div class="w-full md:flex justify-between items-center px-5 space-y-6 md:space-x-0">
        <h1 class="text-2xl lg:text-4xl font-bold text-center md:text-start">Significant Personalities</h1>
        <x-form.search wire:model.live="search" />
    </div>
    <br><br>


    @if ($categories->count())
        <x-form.table.table class="border-none">
            <x-slot:head>
                <x-form.table.th>Significant Personalities</x-form.table.th>
            </x-slot:head>
            @foreach ($categories as $cat)
                <x-form.table.tr>
                    <x-form.table.td>
                        <a class="block" href="{{ route('personalities.details', $cat->id) }}">{{ $cat->name }}</a>
                    </x-form.table.td>
                </x-form.table.tr>
            @endforeach
        </x-form.table.table>
    @endif


    {{-- Single Pagination --}}
    @if ($categories->count())
        <x-form.pagination wire:model.change="pages">
            {{ $categories->links() }}
        </x-form.pagination>
    @endif

    <div class="px-5 py-10 flex justify-end">
        <x-form.cancel-link href="javascript:history.back()">Back</x-form.cancel-link>
    </div>
</div>
