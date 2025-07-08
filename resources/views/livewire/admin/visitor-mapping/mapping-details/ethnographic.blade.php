<x-layouts.visitor-layout>
    <div class="relative w-full p-10 flex flex-col gap-6">
        <x-visitor-view.row>
            @isset($ethno->cultural_heritage_category)
                <x-visitor-view.text label="Cultural Heritage Category" content="{{ $ethno->cultural_heritage_category }}" />
            @endisset

            @isset($ethno->cultural_heritage_type)
                <x-visitor-view.text label="Types of Cultural Heritage" content="{{ $ethno->cultural_heritage_type }}" />
            @endisset
        </x-visitor-view.row>


        @isset($ethno->name)
            <x-visitor-view.text label="Name of Object" content="{{ $ethno->name }}" />
        @endisset

        <x-visitor-view.section label="Featured Collections">
            @isset($ethno->photo_details)
                @foreach ($ethno->photo_details as $photo)
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
                @isset($ethno->type)
                    <x-visitor-view.text label="Type" content="{{ $ethno->type }}" />
                @endisset
                @isset($ethno->date_produced)
                    <x-visitor-view.text label="Year/Date Produced"
                        content="{{ $ethno->date_produced->format('F j, Y') }}" />
                @endisset
                @isset($ethno->estimated_age)
                    <x-visitor-view.text label="Estimated Age" content="{{ $ethno->estimated_age }}" />
                @endisset
            </x-visitor-view.row>

            <x-visitor-view.row>
                @isset($ethno->name_of_owner)
                    <x-visitor-view.text label="Name of Owner" content="{{ $ethno->name_of_owner }}" />
                @endisset
                @isset($ethno->type_of_acquisition)
                    <x-visitor-view.text label="Type of Acquisition" content="{{ $ethno->type_of_acquisition }}" />
                @endisset
            </x-visitor-view.row>

            @isset($ethno->description)
                <x-visitor-view.text label="Description" content="{{ $ethno->description }}" />
            @endisset

            @isset($ethno->stories)
                <x-visitor-view.text label="Stories Associated with the Structure" content="{{ $ethno->stories }}" />
            @endisset

            @isset($ethno->significance)
                <x-visitor-view.text label="Significance" content="{{ $ethno->significance }}" />
            @endisset

        </x-visitor-view.section>

        <x-visitor-view.section label="Conservation Status">

            @isset($ethno->physical_condition)
                <x-visitor-view.text label="Physical Condition"
                    content="{{ implode(' ,', $ethno->physical_condition) }}" />
            @endisset

            @isset($ethno->remarks_2)
                <x-visitor-view.text label="Remarks" content="{{ $ethno->remarks_2 }}" />
            @endisset

            @isset($ethno->narration)
                <x-visitor-view.text label="Narration" content="{{ $ethno->narration }}" />
            @endisset

            @isset($ethno->references)
                <x-visitor-view.text label="References" content="{{ $ethno->references }}" />
            @endisset

            @isset($ethno->mappers)
                <x-visitor-view.text label="Name of Mapper" content="{{ $ethno->mappers }}" />
            @endisset

            @isset($ethno->date_profiled)
                <x-visitor-view.text label="Date Profiled" content="{{ $ethno->date_profiled->format('F j, Y') }}" />
            @endisset
        </x-visitor-view.section>


        <div class="px-5 py-10 flex justify-end">
            <x-form.cancel-link href="javascript:history.back()">
                Back
            </x-form.cancel-link>
        </div>


        <script src="{{ asset('js/zoom.js') }}"></script>
</x-layouts.visitor-layout>
