  <x-layouts.visitor-layout>
    <div class="relative w-full p-10 flex flex-col gap-6">
        <x-visitor-view.row>
            @isset($animal->cultural_heritage_category)
                <x-visitor-view.text label="Cultural Heritage Category" content="{{ $animal->cultural_heritage_category }}" />
            @endisset

            @isset($animal->cultural_heritage_type)
                <x-visitor-view.text label="Types of Cultural Heritage" content="{{ $animal->cultural_heritage_type }}" />
            @endisset
        </x-visitor-view.row>


        @isset($animal->name)
            <x-visitor-view.text label="Local / Indigenous Name" content="{{ $animal->name }}" />
        @endisset

        <x-visitor-view.section label="Featured Collections">
            @isset($animal->photo_details)
                @foreach ($animal->photo_details as $photo)
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
                @isset($animal->other_common_name)
                    <x-visitor-view.text label="Other Common Name" content="{{ $animal->other_common_name }}" />
                @endisset
                @isset($animal->scientific_name)
                    <x-visitor-view.text label="Scientific Name" content="{{ $animal->scientific_name }}" />
                @endisset

            </x-visitor-view.row>

            <x-visitor-view.row>
                @isset($animal->classification)
                    <x-visitor-view.text label="Classification" content="{{ $animal->classification }}" />
                @endisset
                @isset($animal->classification_origin)
                    <x-visitor-view.text label="Classification According to Origin"
                        content="{{ $animal->classification_origin }}" />
                @endisset

            </x-visitor-view.row>

            @isset($animal->habitat)
                <x-visitor-view.text label="Habitat" content="{{ $animal->habitat }}" />
            @endisset

            <x-visitor-view.row>
                @isset($animal->location)
                    <x-visitor-view.text label="Location" content="{{ $animal->location }}" />
                @endisset
                @isset($animal->address)
                    <x-visitor-view.text label="Address" content="{{ $animal->address }}" />
                @endisset

            </x-visitor-view.row>

            <x-visitor-view.row>
                @isset($animal->special_notes)
                    <x-visitor-view.text label="Special Notes" content="{{ $animal->special_notes }}" />
                @endisset

                @isset($animal->indicate_visibility)
                    <x-visitor-view.text label="Indicate Visibility" content="{{ $animal->indicate_visibility }}" />
                @endisset
            </x-visitor-view.row>

            @isset($animal->time_of_year_most_seen)
                <x-visitor-view.text label="Time of Year Most Seen" content="{{ $animal->time_of_year_most_seen }}" />
            @endisset

            @isset($animal->area)
                <x-visitor-view.text label="area" content="{{ $animal->area }}" />
            @endisset

            @isset($animal->ownership)
                <x-visitor-view.text label="Ownership / Jurisdiction" content="{{ $animal->ownership }}" />
            @endisset

            @isset($animal->description)
                <x-visitor-view.text label="Description" content="{{ $animal->description }}" />
            @endisset

            @isset($animal->common_uses)
                <x-visitor-view.text label="Common Uses and Scope of Use"
                    content="{{ implode(' ,', $animal->common_uses) }}" />
            @endisset

            @isset($animal->remarks)
                <x-visitor-view.text label="Remarks" content="{{ $animal->remarks }}" />
            @endisset

            @isset($animal->stories)
                <x-visitor-view.text label="Stories Associated with the Natural Geological"
                    content="{{ $animal->stories }}" />
            @endisset

            @isset($animal->significance)
                <x-visitor-view.text label="Significance" content="{{ $animal->significance }}" />
            @endisset

            @isset($animal->conservation)
                <x-visitor-view.text label="Conservation" content="{{ $animal->conservation }}" />
            @endisset

            @isset($animal->references)
                <x-visitor-view.text label="References" content="{{ $animal->references }}" />
            @endisset

            @isset($animal->name_of_mapper)
                <x-visitor-view.text label="Name of Mapper" content="{{ $animal->name_of_mapper }}" />
            @endisset

            @isset($animal->date_profiled)
                <x-visitor-view.text label="Date Profiled" content="{{ $animal->date_profiled->format('F j, Y') }}" />
            @endisset

        </x-visitor-view.section>


        <div class="px-5 py-10 flex justify-end">
            <x-form.cancel-link href="javascript:history.back()">
                Back
            </x-form.cancel-link>
        </div>


        <script src="{{ asset('js/zoom.js') }}"></script>
</x-layouts.visitor-layout>
