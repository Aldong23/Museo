<x-slot:heading>Museo De Urdaneta</x-slot:heading>
<x-slot:secHeading>Mapping Heritage</x-slot:secHeading>
<x-admin.body>
    <link rel='stylesheet' href='https://unpkg.com/leaflet@1.8.0/dist/leaflet.css' crossorigin='' />

    {{-- MAP --}}
    <div id="map-container" wire:ignore>
        <div id="map" class="w-full bg-gray-300 rounded-lg z-0 relative" style="min-height: 200px; height: 200px;"></div>
    </div>


    {{-- MAP --}}

    <br>
    <h1 class="font-bold text-lg">Cultural Heritage List</h1>
    <br>
    <div class="w-full flex justify-between items-center mb-4">
        <div class="flex items-center gap-4">
            <div x-data="{ open: false, qrSrc: '' }" class="flex items-center gap-2">

                <img src="data:image/svg+xml;base64,{{ base64_encode(QrCode::size(100)->color(0, 0, 0)->backgroundColor(255, 255, 255)->generate(url('/home'))) }}"
                    class="qr-code cursor-pointer" alt="QR Code" width="25" height="25"
                    @click="qrSrc = $event.target.src; open = true" />

                <div x-show="open"
                    class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-75 z-50" x-transition>
                    <div class="bg-white p-6 rounded-lg shadow-lg relative w-96 max-w-full">

                        <button class="absolute top-2 right-2 text-gray-700 text-2xl" @click="open = false">
                            &times;
                        </button>
                        <div class="flex flex-col items-center">
                            <img :src="qrSrc" class="w-64 h-64" alt="QR Code" />

                            <a href="{{ url('/home') }}"
                                class="mt-4 text-blue-600 hover:underline text-lg font-semibold">
                                View Mapping Heritages
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <x-form.search wire:model.live="search" />
        </div>

        <a href="/mapping-heritage-create"
            class="w-fit h-fit flex items-center gap-2 bg-clr-crimson hover:bg-clr-crimson1 text-white px-4 py-1 rounded-sm">
            <span class="font-semibold">Add</span>
        </a>
    </div>

    <div class="w-full p-2 flex gap-1 rounded-md">
        <x-form.mapping-button
            class="{{ $category === 'all' ? 'shadow-md bg-gray-100 font-semibold border-gray-500' : '' }}"
            wire:click="allButton">All</x-form.mapping-button>
        <x-form.mapping-button
            class="{{ $category === 'snr' ? 'shadow-md bg-gray-100 font-semibold border-gray-500' : '' }}"
            title="Significant Natural Resources" wire:click="snrButton">SNR</x-form.mapping-button>
        <x-form.mapping-button
            class="{{ $category === 'ti' ? 'shadow-md bg-gray-100 font-semibold border-gray-500' : '' }}"
            wire:click="tiButton">Tangible-Immovalble</x-form.mapping-button>
        <x-form.mapping-button
            class="{{ $category === 'tm' ? 'shadow-md bg-gray-100 font-semibold border-gray-500' : '' }}"
            wire:click="tmButton">Tangible-Movable</x-form.mapping-button>
        <x-form.mapping-button
            class="{{ $category === 'i' ? 'shadow-md bg-gray-100 font-semibold border-gray-500' : '' }}"
            wire:click="iButton">Intangible</x-form.mapping-button>
        <x-form.mapping-button
            class="{{ $category === 'sp' ? 'shadow-md bg-gray-100 font-semibold border-gray-500' : '' }}"
            wire:click="spButton">Significant Personalities</x-form.mapping-button>
        <x-form.mapping-button
            class="{{ $category === 'ci' ? 'shadow-md bg-gray-100 font-semibold border-gray-500' : '' }}"
            wire:click="ciButton">Cultural Institutions</x-form.mapping-button>
    </div>

    <x-form.table.table>
        <x-slot:head>
            <x-form.table.th>No.</x-form.table.th>
            <x-form.table.th>Name Cultural Heritage</x-form.table.th>
            <x-form.table.th>Cultural Heritage Category</x-form.table.th>
            <x-form.table.th>Type of Cultural Heritage</x-form.table.th>
            <x-form.table.th>Count</x-form.table.th>
            <x-form.table.th>Action</x-form.table.th>
        </x-slot:head>


        @if ($category === 'snr')

            @foreach ($heritages as $heritage)
                <x-form.table.tr>
                    <x-form.table.td> {{ $heritage->id }} </x-form.table.td>
                    <x-form.table.td> {{ $heritage->name }} </x-form.table.td>
                    <x-form.table.td> {{ $heritage->cultural_heritage_category }} </x-form.table.td>
                    <x-form.table.td> {{ $heritage->cultural_heritage_type }} </x-form.table.td>
                    <x-form.table.td> {{ $heritage->views }} </x-form.table.td>
                    <x-form.table.td>
                        <div class="flex items-center gap-1">
                            {{-- VIEW BUTTON --}}
                            @if ($heritage->cultural_heritage_type === 'Bodies of Water')
                                <x-form.view-btn href="{{ route('bow.details', $heritage->id) }}" />
                            @elseif($heritage->cultural_heritage_type === 'Animals (Fauna)')
                                <x-form.view-btn href="{{ route('animals.details', $heritage->id) }}" />
                            @elseif($heritage->cultural_heritage_type === 'Plants (Flora)')
                                <x-form.view-btn href="{{ route('plants.details', $heritage->id) }}" />
                            @elseif($heritage->cultural_heritage_type === 'Critical Area')
                                <x-form.view-btn href="{{ route('critical.details', $heritage->id) }}" />
                            @elseif($heritage->cultural_heritage_type === 'Protected Area')
                                <x-form.view-btn href="{{ route('protected.details', $heritage->id) }}" />
                            @endif
                            {{-- EDIT BUTTON --}}
                            @if ($heritage->cultural_heritage_type === 'Bodies of Water')
                                <x-form.edit-btn href="/edit/bodies-of-water/{{ $heritage->id }}" />
                            @elseif($heritage->cultural_heritage_type === 'Animals (Fauna)')
                                <x-form.edit-btn href="/edit/animals/{{ $heritage->id }}" />
                            @elseif($heritage->cultural_heritage_type === 'Plants (Flora)')
                                <x-form.edit-btn href="/edit/plants/{{ $heritage->id }}" />
                            @elseif($heritage->cultural_heritage_type === 'Critical Area')
                                <x-form.edit-btn href="/edit/critical-area/{{ $heritage->id }}" />
                            @elseif($heritage->cultural_heritage_type === 'Protected Area')
                                <x-form.edit-btn href="/edit/protected-area/{{ $heritage->id }}" />
                            @endif

                            {{-- <x-form.archive-btn /> --}}
                        </div>
                    </x-form.table.td>
                </x-form.table.tr>
            @endforeach
        @elseif($category === 'ti')
            @foreach ($tangible_immovable as $ti)
                <x-form.table.tr>
                    <x-form.table.td> {{ $ti->id }} </x-form.table.td>
                    <x-form.table.td> {{ $ti->name }} </x-form.table.td>
                    <x-form.table.td> {{ $ti->cultural_heritage_category }} </x-form.table.td>
                    <x-form.table.td> {{ $ti->cultural_heritage_type }} </x-form.table.td>
                    <x-form.table.td> {{ $ti->views }} </x-form.table.td>
                    <x-form.table.td>
                        <div class="flex items-center gap-1">
                            {{-- VIEW BUTTON --}}
                            @if ($ti->cultural_heritage_type === 'Government/Private')
                                <x-form.view-btn href="{{ route('government.details', $ti->id) }}" />
                            @elseif($ti->cultural_heritage_type === 'Sites')
                                <x-form.view-btn href="{{ route('sites.details', $ti->id) }}" />
                            @elseif($ti->cultural_heritage_type === 'House')
                                <x-form.view-btn href="{{ route('house.details', $ti->id) }}" />
                            @endif
                            {{-- EDIT BUTTON --}}
                            @if ($ti->cultural_heritage_type === 'Government/Private')
                                <x-form.edit-btn href="/edit/government/{{ $ti->id }}" />
                            @elseif($ti->cultural_heritage_type === 'Sites')
                                <x-form.edit-btn href="/edit/sites/{{ $ti->id }}" />
                            @elseif($ti->cultural_heritage_type === 'House')
                                <x-form.edit-btn href="/edit/houses/{{ $ti->id }}" />
                            @endif
                            {{-- <x-form.archive-btn /> --}}
                        </div>
                    </x-form.table.td>
                </x-form.table.tr>
            @endforeach
        @elseif($category === 'tm')
            @foreach ($tangible_movable as $tm)
                <x-form.table.tr>
                    <x-form.table.td> {{ $tm->id }} </x-form.table.td>
                    <x-form.table.td> {{ $tm->name }} </x-form.table.td>
                    <x-form.table.td> {{ $tm->cultural_heritage_category }} </x-form.table.td>
                    <x-form.table.td> {{ $tm->cultural_heritage_type }} </x-form.table.td>
                    <x-form.table.td> {{ $tm->views }} </x-form.table.td>
                    <x-form.table.td>
                        <div class="flex items-center gap-1">
                            {{-- VIEW BUTTON --}}
                            @if ($tm->cultural_heritage_type === 'Ethnographic Object')
                                <x-form.view-btn href="{{ route('ethno.details', $tm->id) }}" />
                            @elseif($tm->cultural_heritage_type === 'Archival Holdings')
                                <x-form.view-btn href="{{ route('archival.details', $tm->id) }}" />
                            @endif
                            {{-- EDIT BUTTON --}}
                            @if ($tm->cultural_heritage_type === 'Ethnographic Object')
                                <x-form.edit-btn href="/edit/ethnographic-object/{{ $tm->id }}" />
                            @elseif($tm->cultural_heritage_type === 'Archival Holdings')
                                <x-form.edit-btn href="/edit/archival-holdings/{{ $tm->id }}" />
                            @endif
                            {{-- <x-form.archive-btn /> --}}
                        </div>
                    </x-form.table.td>
                </x-form.table.tr>
            @endforeach
        @elseif($category === 'i')
            @foreach ($intangible as $in)
                <x-form.table.tr>
                    <x-form.table.td> {{ $in->id }} </x-form.table.td>
                    <x-form.table.td> {{ $in->name }} </x-form.table.td>
                    <x-form.table.td> {{ $in->cultural_heritage_category }} </x-form.table.td>
                    <x-form.table.td> {{ $in->cultural_heritage_type }} </x-form.table.td>
                    <x-form.table.td> {{ $in->views }} </x-form.table.td>
                    <x-form.table.td>
                        <div class="flex items-center gap-1">
                            @if ($in->cultural_heritage_type === 'Social Practices')
                                <x-form.view-btn href="{{ route('social.practices.details', $in->id) }}" />
                            @elseif($in->cultural_heritage_type === 'Knowledge and Practices')
                                <x-form.view-btn href="{{ route('knowledge.details', $in->id) }}" />
                            @elseif($in->cultural_heritage_type === 'Traditional Craftsmanship')
                                <x-form.view-btn href="{{ route('traditional.craftsmanship.details', $in->id) }}" />
                            @elseif($in->cultural_heritage_type === 'Oral Tradition')
                                <x-form.view-btn href="{{ route('oral.tradition.details', $in->id) }}" />
                            @endif
                            {{-- EDIT BUTTON --}}
                            @if ($in->cultural_heritage_type === 'Social Practices')
                                <x-form.edit-btn href="/edit/social-practices/{{ $in->id }}" />
                            @elseif($in->cultural_heritage_type === 'Knowledge and Practices')
                                <x-form.edit-btn href="/edit/knp/{{ $in->id }}" />
                            @elseif($in->cultural_heritage_type === 'Traditional Craftsmanship')
                                <x-form.edit-btn href="/edit/traditional-craftsmanship/{{ $in->id }}" />
                            @elseif($in->cultural_heritage_type === 'Oral Tradition')
                                <x-form.edit-btn href="/edit/oral-tradition/{{ $in->id }}" />
                            @endif
                            {{-- <x-form.archive-btn /> --}}
                        </div>
                    </x-form.table.td>
                </x-form.table.tr>
            @endforeach
        @elseif($category === 'sp')
            @foreach ($significant_personalities as $sp)
                <x-form.table.tr>
                    <x-form.table.td> {{ $sp->id }} </x-form.table.td>
                    <x-form.table.td> {{ $sp->name }} </x-form.table.td>
                    <x-form.table.td> {{ $sp->cultural_heritage_category }} </x-form.table.td>
                    <x-form.table.td> {{ $sp->cultural_heritage_type }} </x-form.table.td>
                    <x-form.table.td> {{ $sp->views }} </x-form.table.td>
                    <x-form.table.td>
                        <div class="flex items-center gap-1">
                            <x-form.view-btn href="{{ route('personalities.details', $sp->id) }}" />
                            <x-form.edit-btn href="/edit/significant-personalities/{{ $sp->id }}" />
                            {{-- <x-form.archive-btn /> --}}
                        </div>
                    </x-form.table.td>
                </x-form.table.tr>
            @endforeach
        @elseif($category === 'ci')
            @foreach ($cultural_institutions as $ci)
                <x-form.table.tr>
                    <x-form.table.td> {{ $ci->id }} </x-form.table.td>
                    <x-form.table.td> {{ $ci->name }} </x-form.table.td>
                    <x-form.table.td> {{ $ci->cultural_heritage_category }} </x-form.table.td>
                    <x-form.table.td> {{ $ci->cultural_heritage_type }} </x-form.table.td>
                    <x-form.table.td> {{ $ci->views }} </x-form.table.td>
                    <x-form.table.td>
                        <div class="flex items-center gap-1">
                            <x-form.view-btn href="{{ route('cul.ins.details', $ci->id) }}" />
                            @if (
                                $ci->type_of_cultural_institutions === 'Both Non-Formal & Formal Education' ||
                                    $ci->type_of_cultural_institutions === 'Kalipunan ng Liping Pilipina Natl. Inc. Urdaneta City (KALIPI)')
                                <x-form.edit-btn href="/edit/school-institutions/{{ $ci->id }}" />
                            @elseif ($ci->type_of_cultural_institutions === 'Formal Education')
                                <x-form.edit-btn href="/edit/school-institutions-library/{{ $ci->id }}" />
                            @elseif ($ci->type_of_cultural_institutions === 'Farmer’s Association')
                                <x-form.edit-btn href="/edit/farmers-association/{{ $ci->id }}" />
                            @elseif (
                                $ci->type_of_cultural_institutions === 'LGBTQI+' ||
                                    $ci->type_of_cultural_institutions === 'Rural Improvements Club of Urdaneta City' ||
                                    $ci->type_of_cultural_institutions === '(RCU) Rotary Club of Urdaneta' ||
                                    $ci->type_of_cultural_institutions === 'Federation of Senior Citizen' ||
                                    $ci->type_of_cultural_institutions === 'Federation' ||
                                    $ci->type_of_cultural_institutions === 'Urdaneta Masonic Lodge, #302 Free & Accepted Mission' ||
                                    $ci->type_of_cultural_institutions === 'Library')
                                <x-form.edit-btn href="/edit/associations/{{ $ci->id }}" />
                            @elseif ($ci->type_of_cultural_institutions === 'Political Clan')
                                <x-form.edit-btn href="/edit/political-clan/{{ $ci->id }}" />
                            @endif

                            {{-- <x-form.archive-btn /> --}}
                        </div>
                    </x-form.table.td>
                </x-form.table.tr>
            @endforeach
        @elseif($category === 'all')
            @foreach ($heritages as $heritage)
                <x-form.table.tr>
                    <x-form.table.td> {{ $heritage->id }} </x-form.table.td>
                    <x-form.table.td> {{ $heritage->name }} </x-form.table.td>
                    <x-form.table.td> {{ $heritage->cultural_heritage_category }} </x-form.table.td>
                    <x-form.table.td> {{ $heritage->cultural_heritage_type }} </x-form.table.td>
                    <x-form.table.td> {{ $heritage->views }} </x-form.table.td>
                    <x-form.table.td>
                        <div class="flex items-center gap-1">
                            {{-- VIEW BUTTON --}}
                            @if ($heritage->cultural_heritage_type === 'Bodies of Water')
                                <x-form.view-btn href="{{ route('bow.details', $heritage->id) }}" />
                            @elseif($heritage->cultural_heritage_type === 'Animals (Fauna)')
                                <x-form.view-btn href="{{ route('animals.details', $heritage->id) }}" />
                            @elseif($heritage->cultural_heritage_type === 'Plants (Flora)')
                                <x-form.view-btn href="{{ route('plants.details', $heritage->id) }}" />
                            @elseif($heritage->cultural_heritage_type === 'Critical Area')
                                <x-form.view-btn href="{{ route('critical.details', $heritage->id) }}" />
                            @elseif($heritage->cultural_heritage_type === 'Protected Area')
                                <x-form.view-btn href="{{ route('protected.details', $heritage->id) }}" />
                            @endif
                            {{-- EDIT BUTTON --}}
                            @if ($heritage->cultural_heritage_type === 'Bodies of Water')
                                <x-form.edit-btn href="/edit/bodies-of-water/{{ $heritage->id }}" />
                            @elseif($heritage->cultural_heritage_type === 'Animals (Fauna)')
                                <x-form.edit-btn href="/edit/animals/{{ $heritage->id }}" />
                            @elseif($heritage->cultural_heritage_type === 'Plants (Flora)')
                                <x-form.edit-btn href="/edit/plants/{{ $heritage->id }}" />
                            @elseif($heritage->cultural_heritage_type === 'Critical Area')
                                <x-form.edit-btn href="/edit/critical-area/{{ $heritage->id }}" />
                            @elseif($heritage->cultural_heritage_type === 'Protected Area')
                                <x-form.edit-btn href="/edit/protected-area/{{ $heritage->id }}" />
                            @endif

                            {{-- <x-form.archive-btn /> --}}
                        </div>
                    </x-form.table.td>
                </x-form.table.tr>
            @endforeach
            @foreach ($tangible_immovable as $ti)
                <x-form.table.tr>
                    <x-form.table.td> {{ $ti->id }} </x-form.table.td>
                    <x-form.table.td> {{ $ti->name }} </x-form.table.td>
                    <x-form.table.td> {{ $ti->cultural_heritage_category }} </x-form.table.td>
                    <x-form.table.td> {{ $ti->cultural_heritage_type }} </x-form.table.td>
                    <x-form.table.td> {{ $ti->views }} </x-form.table.td>
                    <x-form.table.td>
                        <div class="flex items-center gap-1">
                            {{-- VIEW BUTTON --}}
                            @if ($ti->cultural_heritage_type === 'Government/Private')
                                <x-form.view-btn href="{{ route('government.details', $ti->id) }}" />
                            @elseif($ti->cultural_heritage_type === 'Sites')
                                <x-form.view-btn href="{{ route('sites.details', $ti->id) }}" />
                            @elseif($ti->cultural_heritage_type === 'House')
                                <x-form.view-btn href="{{ route('house.details', $ti->id) }}" />
                            @endif
                            {{-- EDIT BUTTON --}}
                            @if ($ti->cultural_heritage_type === 'Government/Private')
                                <x-form.edit-btn href="/edit/government/{{ $ti->id }}" />
                            @elseif($ti->cultural_heritage_type === 'Sites')
                                <x-form.edit-btn href="/edit/sites/{{ $ti->id }}" />
                            @elseif($ti->cultural_heritage_type === 'House')
                                <x-form.edit-btn href="/edit/houses/{{ $ti->id }}" />
                            @endif
                            {{-- <x-form.archive-btn /> --}}
                        </div>
                    </x-form.table.td>
                </x-form.table.tr>
            @endforeach
            @foreach ($tangible_movable as $tm)
                <x-form.table.tr>
                    <x-form.table.td> {{ $tm->id }} </x-form.table.td>
                    <x-form.table.td> {{ $tm->name }} </x-form.table.td>
                    <x-form.table.td> {{ $tm->cultural_heritage_category }} </x-form.table.td>
                    <x-form.table.td> {{ $tm->cultural_heritage_type }} </x-form.table.td>
                    <x-form.table.td> {{ $tm->views }} </x-form.table.td>
                    <x-form.table.td>
                        <div class="flex items-center gap-1">
                            {{-- VIEW BUTTON --}}
                            @if ($tm->cultural_heritage_type === 'Ethnographic Object')
                                <x-form.view-btn href="{{ route('ethno.details', $tm->id) }}" />
                            @elseif($tm->cultural_heritage_type === 'Archival Holdings')
                                <x-form.view-btn href="{{ route('archival.details', $tm->id) }}" />
                            @endif
                            {{-- EDIT BUTTON --}}
                            @if ($tm->cultural_heritage_type === 'Ethnographic Object')
                                <x-form.edit-btn href="/edit/ethnographic-object/{{ $tm->id }}" />
                            @elseif($tm->cultural_heritage_type === 'Archival Holdings')
                                <x-form.edit-btn href="/edit/archival-holdings/{{ $tm->id }}" />
                            @endif
                            {{-- <x-form.archive-btn /> --}}
                        </div>
                    </x-form.table.td>
                </x-form.table.tr>
            @endforeach
            @foreach ($intangible as $in)
                <x-form.table.tr>
                    <x-form.table.td> {{ $in->id }} </x-form.table.td>
                    <x-form.table.td> {{ $in->name }} </x-form.table.td>
                    <x-form.table.td> {{ $in->cultural_heritage_category }} </x-form.table.td>
                    <x-form.table.td> {{ $in->cultural_heritage_type }} </x-form.table.td>
                    <x-form.table.td> {{ $in->views }} </x-form.table.td>
                    <x-form.table.td>
                        <div class="flex items-center gap-1">
                            @if ($in->cultural_heritage_type === 'Social Practices')
                                <x-form.view-btn href="{{ route('social.practices.details', $in->id) }}" />
                            @elseif($in->cultural_heritage_type === 'Knowledge and Practices')
                                <x-form.view-btn href="{{ route('knowledge.details', $in->id) }}" />
                            @elseif($in->cultural_heritage_type === 'Traditional Craftsmanship')
                                <x-form.view-btn href="{{ route('traditional.craftsmanship.details', $in->id) }}" />
                            @elseif($in->cultural_heritage_type === 'Oral Tradition')
                                <x-form.view-btn href="{{ route('oral.tradition.details', $in->id) }}" />
                            @endif
                            {{-- EDIT BUTTON --}}
                            @if ($in->cultural_heritage_type === 'Social Practices')
                                <x-form.edit-btn href="/edit/social-practices/{{ $in->id }}" />
                            @elseif($in->cultural_heritage_type === 'Knowledge and Practices')
                                <x-form.edit-btn href="/edit/knp/{{ $in->id }}" />
                            @elseif($in->cultural_heritage_type === 'Traditional Craftsmanship')
                                <x-form.edit-btn href="/edit/traditional-craftsmanship/{{ $in->id }}" />
                            @elseif($in->cultural_heritage_type === 'Oral Tradition')
                                <x-form.edit-btn href="/edit/oral-tradition/{{ $in->id }}" />
                            @endif
                            {{-- <x-form.archive-btn /> --}}
                        </div>
                    </x-form.table.td>
                </x-form.table.tr>
            @endforeach
            @foreach ($significant_personalities as $sp)
                <x-form.table.tr>
                    <x-form.table.td> {{ $sp->id }} </x-form.table.td>
                    <x-form.table.td> {{ $sp->name }} </x-form.table.td>
                    <x-form.table.td> {{ $sp->cultural_heritage_category }} </x-form.table.td>
                    <x-form.table.td> {{ $sp->cultural_heritage_type }} </x-form.table.td>
                    <x-form.table.td> {{ $sp->views }} </x-form.table.td>
                    <x-form.table.td>
                        <div class="flex items-center gap-1">
                            <x-form.view-btn href="{{ route('personalities.details', $sp->id) }}" />
                            <x-form.edit-btn href="/edit/significant-personalities/{{ $sp->id }}" />
                            {{-- <x-form.archive-btn /> --}}
                        </div>
                    </x-form.table.td>
                </x-form.table.tr>
            @endforeach
            @foreach ($cultural_institutions as $ci)
                <x-form.table.tr>
                    <x-form.table.td> {{ $ci->id }} </x-form.table.td>
                    <x-form.table.td> {{ $ci->name }} </x-form.table.td>
                    <x-form.table.td> {{ $ci->cultural_heritage_category }} </x-form.table.td>
                    <x-form.table.td> {{ $ci->cultural_heritage_type }} </x-form.table.td>
                    <x-form.table.td> {{ $ci->views }} </x-form.table.td>
                    <x-form.table.td>
                        <div class="flex items-center gap-1">
                            <x-form.view-btn href="{{ route('cul.ins.details', $ci->id) }}" />
                            @if (
                                $ci->type_of_cultural_institutions === 'Both Non-Formal & Formal Education' ||
                                    $ci->type_of_cultural_institutions === 'Kalipunan ng Liping Pilipina Natl. Inc. Urdaneta City (KALIPI)')
                                <x-form.edit-btn href="/edit/school-institutions/{{ $ci->id }}" />
                            @elseif ($ci->type_of_cultural_institutions === 'Formal Education')
                                <x-form.edit-btn href="/edit/school-institutions-library/{{ $ci->id }}" />
                            @elseif ($ci->type_of_cultural_institutions === 'Farmer’s Association')
                                <x-form.edit-btn href="/edit/farmers-association/{{ $ci->id }}" />
                            @elseif (
                                $ci->type_of_cultural_institutions === 'LGBTQI+' ||
                                    $ci->type_of_cultural_institutions === 'Rural Improvements Club of Urdaneta City' ||
                                    $ci->type_of_cultural_institutions === '(RCU) Rotary Club of Urdaneta' ||
                                    $ci->type_of_cultural_institutions === 'Federation of Senior Citizen' ||
                                    $ci->type_of_cultural_institutions === 'Federation' ||
                                    $ci->type_of_cultural_institutions === 'Urdaneta Masonic Lodge, #302 Free & Accepted Mission' ||
                                    $ci->type_of_cultural_institutions === 'Library')
                                <x-form.edit-btn href="/edit/associations/{{ $ci->id }}" />
                            @elseif ($ci->type_of_cultural_institutions === 'Political Clan')
                                <x-form.edit-btn href="/edit/political-clan/{{ $ci->id }}" />
                            @endif

                            {{-- <x-form.archive-btn /> --}}
                        </div>
                    </x-form.table.td>
                </x-form.table.tr>
            @endforeach
        @endif
    </x-form.table.table>

    @if ($category === 'snr')
        @if ($heritages->count())
            <x-form.table.pagination wire:model.change="page">
                {{ $heritages->links() }}
            </x-form.table.pagination>
        @endif
    @elseif($category === 'ti')
        @if ($tangible_immovable->count())
            <x-form.table.pagination wire:model.change="page">
                {{ $tangible_immovable->links() }}
            </x-form.table.pagination>
        @endif
    @elseif($category === 'tm')
        @if ($tangible_movable->count())
            <x-form.table.pagination wire:model.change="page">
                {{ $tangible_movable->links() }}
            </x-form.table.pagination>
        @endif
    @elseif($category === 'i')
        @if ($intangible->count())
            <x-form.table.pagination wire:model.change="page">
                {{ $intangible->links() }}
            </x-form.table.pagination>
        @endif
    @elseif($category === 'sp')
        @if ($significant_personalities->count())
            <x-form.table.pagination wire:model.change="page">
                {{ $significant_personalities->links() }}
            </x-form.table.pagination>
        @endif
    @elseif($category === 'ci')
        @if ($cultural_institutions->count())
            <x-form.table.pagination wire:model.change="page">
                {{ $cultural_institutions->links() }}
            </x-form.table.pagination>
        @endif
    @endif

    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" crossorigin=""></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const mapContainer = document.getElementById('map');
        if (!mapContainer) {
            console.error("Map container not found!");
            return;
        }
        mapContainer.style.minHeight = "300px";

        const map = L.map('map', {
            center: [15.9765, 120.5709],
            zoom: 15
        });

        const bounds = L.latLngBounds(
            [15.9600, 120.5400], // Southwest corner
            [15.9900, 120.6000]  // Northeast corner
        );
        map.setMaxBounds(bounds);
        map.setMinZoom(10);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        setTimeout(() => map.invalidateSize(), 500);
        window.addEventListener("resize", () => setTimeout(() => map.invalidateSize(), 300));

        if (typeof Livewire !== "undefined") {
            Livewire.hook('message.processed', () => setTimeout(() => map.invalidateSize(), 500));
        }

        const markers = [
            ...@json($pin_heritages),
            ...@json($pin_tangible_immovable),
            ...@json($pin_significant_personalities),
            ...@json($pin_tangible_movable),
            ...@json($pin_intangible),
            ...@json($pin_cultural_institutions)
        ];

        markers.forEach(marker => {
            if (marker.lat && marker.lng) {
                addMarker(marker.lat, marker.lng, marker);
            } else if (marker.location) {
                geocodeAddress(marker.location, (lat, lng) => {
                    if (lat && lng) addMarker(lat, lng, marker);
                });
            } else if (marker.address) {
                geocodeAddress(marker.address, (lat, lng) => {
                    if (lat && lng) addMarker(lat, lng, marker);
                });
            }
        });

        function addMarker(lat, lng, marker) {
            const markerColor = getMarkerColor(marker.cultural_heritage_category);
            const customIcon = L.icon({
                iconUrl: `https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-${markerColor}.png`,
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34]
            });

            const offset = Math.random() * 0.0005 - 0.00025; // Small offset to prevent overlap
            const adjustedLat = lat + offset;
            const adjustedLng = lng + offset;

            L.marker([adjustedLat, adjustedLng], { icon: customIcon })
                .addTo(map)
                .bindPopup(`<b>${marker.name}</b><br>${marker.location || marker.address}`);
        }

        function geocodeAddress(address, callback) {
            const fullAddress = address + ' Urdaneta';
            fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(fullAddress)}&limit=1`)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        callback(parseFloat(data[0].lat), parseFloat(data[0].lon));
                    } else {
                        callback(null, null);
                    }
                })
                .catch(() => callback(null, null));
        }

        function getMarkerColor(category) {
            switch (category) {
                case 'Significant Natural Resources': return 'blue';
                case 'Tangible-Immovable Cultural Heritage': return 'green';
                case 'Tangible Movable Culture': return 'red';
                case 'Intangible Culture Heritage': return 'violet';
                case 'Significant Personalities': return 'yellow';
                case 'Cultural Institutions': return 'orange';
                default: return 'gray';
            }
        }
    });
    </script>


</x-admin.body>
