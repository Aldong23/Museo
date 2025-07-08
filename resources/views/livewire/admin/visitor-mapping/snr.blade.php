<div class="w-full h-full p-10">
    <div class="w-full md:flex justify-between items-center px-5 space-y-6 md:space-x-0">
        <h1 class="text-2xl lg:text-4xl font-bold text-center md:text-start">Significant Natural Resources</h1>
        <x-form.search wire:model.live="search" />
    </div>
    <br><br>

    @foreach ($categories as $type => $items)
        @if ($items->count())
            @if ($type === 'Bodies of Water')
                <x-form.table.table class="border-none">
                    <x-slot:head>
                        <x-form.table.th>{{ $type }}</x-form.table.th>
                    </x-slot:head>
                    @foreach ($items as $item)
                        <x-form.table.tr>
                            <x-form.table.td>
                                <a class="block" href="{{ route('bow.details', $item->id) }}">{{ $item->name }}</a>
                            </x-form.table.td>
                        </x-form.table.tr>
                    @endforeach
                </x-form.table.table>
            @endif
            @if ($type === 'Plants (Flora)')
                <x-form.table.table class="border-none">
                    <x-slot:head>
                        <x-form.table.th>{{ $type }}</x-form.table.th>
                    </x-slot:head>
                    @foreach ($items as $item)
                        <x-form.table.tr>
                            <x-form.table.td>
                                <a class="block" href="{{ route('plants.details', $item->id) }}">{{ $item->name }}</a>
                            </x-form.table.td>
                        </x-form.table.tr>
                    @endforeach
                </x-form.table.table>
            @endif
            @if ($type === 'Animals (Fauna)')
                <x-form.table.table class="border-none">
                    <x-slot:head>
                        <x-form.table.th>{{ $type }}</x-form.table.th>
                    </x-slot:head>
                    @foreach ($items as $item)
                        <x-form.table.tr>
                            <x-form.table.td>
                                <a class="block"
                                    href="{{ route('animals.details', $item->id) }}">{{ $item->name }}</a>
                            </x-form.table.td>
                        </x-form.table.tr>
                    @endforeach
                </x-form.table.table>
            @endif
            @if ($type === 'Critical Area')
                <x-form.table.table class="border-none">
                    <x-slot:head>
                        <x-form.table.th>{{ $type }}</x-form.table.th>
                    </x-slot:head>
                    @foreach ($items as $item)
                        <x-form.table.tr>
                            <x-form.table.td>
                                <a class="block"
                                    href="{{ route('critical.details', $item->id) }}">{{ $item->name }}</a>
                            </x-form.table.td>
                        </x-form.table.tr>
                    @endforeach
                </x-form.table.table>
            @endif
            @if ($type === 'Protected Area')
                <x-form.table.table class="border-none">
                    <x-slot:head>
                        <x-form.table.th>{{ $type }}</x-form.table.th>
                    </x-slot:head>
                    @foreach ($items as $item)
                        <x-form.table.tr>
                            <x-form.table.td>
                                <a class="block"
                                    href="{{ route('protected.details', $item->id) }}">{{ $item->name }}</a>
                            </x-form.table.td>
                        </x-form.table.tr>
                    @endforeach
                </x-form.table.table>
            @endif
        @endif
    @endforeach

    {{-- Single Pagination --}}
    @if ($categories->count())
        <x-form.pagination wire:model.change="pages">
            {{ $pagination->links() }}
        </x-form.pagination>
    @endif


    <div class="px-5 py-10 flex justify-end">
        <x-form.cancel-link href="javascript:history.back()">Back</x-form.cancel-link>
    </div>
</div>
