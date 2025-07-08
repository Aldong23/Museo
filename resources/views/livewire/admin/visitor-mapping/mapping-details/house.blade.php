<x-layouts.visitor-layout>
    <div class="relative w-full p-10 flex flex-col gap-6">
        <x-visitor-view.row>
            @isset($house->cultural_heritage_category)
                <x-visitor-view.text label="Cultural Heritage Category" content="{{ $house->cultural_heritage_category }}" />
            @endisset

            @isset($house->cultural_heritage_type)
                <x-visitor-view.text label="Types of Cultural Heritage" content="{{ $house->cultural_heritage_type }}" />
            @endisset
        </x-visitor-view.row>


        @isset($house->name)
            <x-visitor-view.text label="Name of Immovable Heritage" content="{{ $house->name }}" />
        @endisset

        <x-visitor-view.section label="Featured Collections">
            @isset($house->photo_details)
                @foreach ($house->photo_details as $photo)
                    <div class="w-full p-4 space-y-4 border border-gray-300 rounded-lg">
                        <x-visitor-view.row>
                            @isset($photo['photo_credit'])
                                <x-visitor-view.text label="Photo Credit" content="{{ $photo['photo_credit'] }}" />
                            @endisset

                            @isset($photo['photo_date'])
                                <x-visitor-view.text label="Photo Date Captured"
                                    content="{{ \Carbon\Carbon::parse($photo['photo_date'])->format('F j, Y') }}" />
                            @endisset
                        </x-visitor-view.row>

                        <x-visitor-view.image label="Photo">
                            @isset($photo['photos'])
                                @foreach ($photo['photos'] as $path)
                                    <img src="{{ asset('storage/' . $path) }}" alt="{{ $path }}"
                                        class="photo-img clickable-img w-auto h-60">
                                @endforeach
                            @endisset
                        </x-visitor-view.image>
                    </div>
                @endforeach
            @endisset
        </x-visitor-view.section>

        <!-- Modal for Image Display -->
        <div id="imageModal"
            class="fixed left-0 right-0 top-0 h-screen overflow-hidden bg-black/40 backdrop-blur-sm z-40 hidden p-5">
            <div class="relative w-full h-full flex flex-col items-center justify-center">
                <div class="absolute right-0 top-0">
                    <x-icons.close />
                </div>
                <img id="modalImage" class="w-auto h-full cursor-zoom-in" />
            </div>
        </div>

        <x-visitor-view.section label="Background Information">

            <x-visitor-view.row>
                @isset($house->type)
                    <x-visitor-view.text label="Period" content="{{ $house->type }}" />
                @endisset
                @isset($house->ownership)
                    <x-visitor-view.text label="Ownership" content="{{ $house->ownership }}" />
                @endisset

            </x-visitor-view.row>

            <x-visitor-view.row>
                @isset($house->location)
                    <x-visitor-view.text label="Location" content="{{ $house->location }}" />
                @endisset
                @isset($house->address)
                    <x-visitor-view.text label="Address" content="{{ $house->address }}" />
                @endisset
            </x-visitor-view.row>

            <x-visitor-view.row>
                @isset($house->latitude)
                    <x-visitor-view.text label="latitude" content="{{ $house->latitude }}" />
                @endisset
                @isset($house->longitude)
                    <x-visitor-view.text label="longitude" content="{{ $house->longitude }}" />
                @endisset
                @isset($house->year_constructed)
                    <x-visitor-view.text label="year_constructed" content="{{ $house->year_constructed }}" />
                @endisset
            </x-visitor-view.row>

            <x-visitor-view.row>
                @isset($house->area)
                    <x-visitor-view.text label="Area" content="{{ $house->area }}" />
                @endisset
                @isset($house->structure)
                    <x-visitor-view.text label="Structure" content="{{ $house->structure }}" />
                @endisset
            </x-visitor-view.row>

            @isset($house->ownership_jurisdiction)
                <x-visitor-view.text label="Ownership / Jurisdiction" content="{{ $house->ownership_jurisdiction }}" />
            @endisset
            @isset($house->declaration_legislation)
                <x-visitor-view.text label="Declaration Legislation" content="{{ $house->declaration_legislation }}" />
            @endisset


            @isset($house->description)
                <x-visitor-view.text label="Description" content="{{ $house->description }}" />
            @endisset

            @isset($house->stories)
                <x-visitor-view.text label="Stories Associated with the Structure" content="{{ $house->stories }}" />
            @endisset

            @isset($house->significance)
                <x-visitor-view.text label="Significance" content="{{ $house->significance }}" />
            @endisset

            @isset($house->condition_of_structure)
                <x-visitor-view.text label="Conservation" content="{{ $house->condition_of_structure }}" />
            @endisset

            <x-visitor-view.section label="List of Significant Tangible Movable Heritage">
                @isset($house->list_of_cultural_props)
                    @foreach ($house->list_of_cultural_props as $list)
                        <div class="w-full p-4 space-y-4 border border-gray-300 rounded-lg">
                            <x-visitor-view.row>
                                @isset($list['name_of_built_structure'])
                                    <x-visitor-view.text label="Name of Object"
                                        content="{{ $list['name_of_built_structure'] }}" />
                                @endisset

                                @isset($list['year_produced'])
                                    <x-visitor-view.text label="Year produced or estimated age"
                                        content="{{ $list['year_produced'] }}" />
                                @endisset
                            </x-visitor-view.row>

                            @isset($list['photo'])
                                <x-visitor-view.image label="Photo">
                                    <img src="{{ asset('storage/' . $list['photo']) }}" alt="{{ $list['photo'] }}"
                                        class="photo-img clickable-img w-auto h-60">
                                </x-visitor-view.image>
                            @endisset
                        </div>
                    @endforeach
                @endisset
            </x-visitor-view.section>

            @isset($house->references)
                <x-visitor-view.text label="References" content="{{ $house->references }}" />
            @endisset

            @isset($house->name_of_mapper)
                <x-visitor-view.text label="Name of Mapper" content="{{ $house->name_of_mapper }}" />
            @endisset

            @isset($house->date_profiled)
                <x-visitor-view.text label="Date Profiled" content="{{ $house->date_profiled->format('F j, Y') }}" />
            @endisset

        </x-visitor-view.section>


        <div class="px-5 py-10 flex justify-end">
            <x-form.cancel-link href="javascript:history.back()">
                Back
            </x-form.cancel-link>
        </div>


        <script src="{{ asset('js/zoom.js') }}"></script>
</x-layouts.visitor-layout>
