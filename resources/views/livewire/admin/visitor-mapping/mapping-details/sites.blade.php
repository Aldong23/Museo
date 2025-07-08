<x-layouts.visitor-layout>
    <div class="relative w-full p-10 flex flex-col gap-6">
        <x-visitor-view.row>
            @isset($sites->cultural_heritage_category)
                <x-visitor-view.text label="Cultural Heritage Category" content="{{ $sites->cultural_heritage_category }}" />
            @endisset

            @isset($sites->cultural_heritage_type)
                <x-visitor-view.text label="Types of Cultural Heritage" content="{{ $sites->cultural_heritage_type }}" />
            @endisset
        </x-visitor-view.row>


        @isset($sites->name)
            <x-visitor-view.text label="Name of Immovable Heritage" content="{{ $sites->name }}" />
        @endisset

        <x-visitor-view.section label="Featured Collections">
            @isset($sites->photo_details)
                @foreach ($sites->photo_details as $photo)
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
                @isset($sites->type)
                    <x-visitor-view.text label="Type" content="{{ $sites->type }}" />
                @endisset
                @isset($sites->ownership)
                    <x-visitor-view.text label="Ownership" content="{{ $sites->ownership }}" />
                @endisset

            </x-visitor-view.row>

            <x-visitor-view.row>
                @isset($sites->location)
                    <x-visitor-view.text label="Location" content="{{ $sites->location }}" />
                @endisset
                @isset($sites->address)
                    <x-visitor-view.text label="Address" content="{{ $sites->address }}" />
                @endisset
            </x-visitor-view.row>

            <x-visitor-view.row>
                @isset($sites->latitude)
                    <x-visitor-view.text label="latitude" content="{{ $sites->latitude }}" />
                @endisset
                @isset($sites->longitude)
                    <x-visitor-view.text label="longitude" content="{{ $sites->longitude }}" />
                @endisset
                @isset($sites->year_constructed)
                    <x-visitor-view.text label="year_constructed" content="{{ $sites->year_constructed }}" />
                @endisset
            </x-visitor-view.row>

            <x-visitor-view.row>
                @isset($sites->area)
                    <x-visitor-view.text label="Area" content="{{ $sites->area }}" />
                @endisset
                @isset($sites->structure)
                    <x-visitor-view.text label="Structure" content="{{ $sites->structure }}" />
                @endisset
                @isset($sites->estimated_age)
                    <x-visitor-view.text label="Estimated Age" content="{{ $sites->estimated_age }}" />
                @endisset
            </x-visitor-view.row>

            @isset($sites->ownership_jurisdiction)
                <x-visitor-view.text label="Ownership / Jurisdiction" content="{{ $sites->ownership_jurisdiction }}" />
            @endisset
            @isset($sites->declaration_legislation)
                <x-visitor-view.text label="Declaration Legislation" content="{{ $sites->declaration_legislation }}" />
            @endisset


            @isset($sites->description)
                <x-visitor-view.text label="Description" content="{{ $sites->description }}" />
            @endisset

            @isset($sites->stories)
                <x-visitor-view.text label="Stories Associated with the Structure" content="{{ $sites->stories }}" />
            @endisset

            @isset($sites->significance)
                <x-visitor-view.text label="Significance" content="{{ $sites->significance }}" />
            @endisset

            @isset($sites->condition_of_structure)
                <x-visitor-view.text label="Condition of Structure" content="{{ $sites->condition_of_structure }}" />
            @endisset

            @isset($sites->remarks_1)
                <x-visitor-view.text label="Remarks" content="{{ $sites->remarks_1 }}" />
            @endisset

            @isset($sites->integrity_of_structure)
                <x-visitor-view.text label="Integrity of Structure" content="{{ $sites->integrity_of_structure }}" />
            @endisset

            @isset($sites->remarks_2)
                <x-visitor-view.text label="Remarks" content="{{ $sites->remarks_2 }}" />
            @endisset

            <x-visitor-view.section label="List of Significant Tangible Movable Heritage">
                @isset($sites->list_of_cultural_props)
                    @foreach ($sites->list_of_cultural_props as $list)
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

            @isset($sites->references)
                <x-visitor-view.text label="References" content="{{ $sites->references }}" />
            @endisset

            @isset($sites->name_of_mapper)
                <x-visitor-view.text label="Name of Mapper" content="{{ $sites->name_of_mapper }}" />
            @endisset

            @isset($sites->date_profiled)
                <x-visitor-view.text label="Date Profiled" content="{{ $sites->date_profiled->format('F j, Y') }}" />
            @endisset

        </x-visitor-view.section>


        <div class="px-5 py-10 flex justify-end">
            <x-form.cancel-link href="javascript:history.back()">
                Back
            </x-form.cancel-link>
        </div>


        <script src="{{ asset('js/zoom.js') }}"></script>
</x-layouts.visitor-layout>
