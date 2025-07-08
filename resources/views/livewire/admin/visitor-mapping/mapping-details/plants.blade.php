<x-layouts.visitor-layout>
    <div class="relative w-full p-10 flex flex-col gap-6">
        <x-visitor-view.row>
            @isset($plants->cultural_heritage_category)
                <x-visitor-view.text label="Cultural Heritage Category" content="{{ $plants->cultural_heritage_category }}" />
            @endisset

            @isset($plants->cultural_heritage_type)
                <x-visitor-view.text label="Types of Cultural Heritage" content="{{ $plants->cultural_heritage_type }}" />
            @endisset
        </x-visitor-view.row>


        @isset($plants->name)
            <x-visitor-view.text label="Local / Indigenous Name" content="{{ $plants->name }}" />
        @endisset

        <x-visitor-view.section label="Featured Collections">
            @isset($plants->photo_details)
                @foreach ($plants->photo_details as $photo)
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
                @isset($plants->other_common_name)
                    <x-visitor-view.text label="Other Common Name" content="{{ $plants->other_common_name }}" />
                @endisset
                @isset($plants->scientific_name)
                    <x-visitor-view.text label="Scientific Name" content="{{ $plants->scientific_name }}" />
                @endisset

            </x-visitor-view.row>

            <x-visitor-view.row>
                @isset($plants->classification_growth_habit)
                    <x-visitor-view.text label="Classification According to Growth Habit"
                        content="{{ $plants->classification_growth_habit }}" />
                @endisset
                @isset($plants->classification_origin)
                    <x-visitor-view.text label="Classification According to Origin"
                        content="{{ $plants->classification_origin }}" />
                @endisset

            </x-visitor-view.row>

            @isset($plants->habitat)
                <x-visitor-view.text label="Habitat" content="{{ $plants->habitat }}" />
            @endisset

            <x-visitor-view.row>
                @isset($plants->location)
                    <x-visitor-view.text label="Locaiton" content="{{ $plants->location }}" />
                @endisset
                @isset($plants->address)
                    <x-visitor-view.text label="Address" content="{{ $plants->address }}" />
                @endisset

            </x-visitor-view.row>

            <x-visitor-view.row>
                @isset($plants->indicate_visibility)
                    <x-visitor-view.text label="Indicate Visibility" content="{{ $plants->indicate_visibility }}" />
                @endisset
                @isset($plants->indicate_seasonability)
                    <x-visitor-view.text label="Indicate Seasonability" content="{{ $plants->indicate_seasonability }}" />
                @endisset

            </x-visitor-view.row>

            @isset($plants->area)
                <x-visitor-view.text label="area" content="{{ $plants->area }}" />
            @endisset

            @isset($plants->ownership)
                <x-visitor-view.text label="Ownership / Jurisdiction" content="{{ $plants->ownership }}" />
            @endisset

            @isset($plants->description)
                <x-visitor-view.text label="Description" content="{{ $plants->description }}" />
            @endisset

            @isset($plants->common_uses)
                <x-visitor-view.text label="Common Uses and Scope of Use"
                    content="{{ implode(' ,', $plants->common_uses) }}" />
            @endisset

            @isset($plants->remarks)
                <x-visitor-view.text label="Remarks" content="{{ $plants->remarks }}" />
            @endisset

            @isset($plants->stories)
                <x-visitor-view.text label="Stories Associated with the Natural Geological"
                    content="{{ $plants->stories }}" />
            @endisset

            @isset($plants->significance)
                <x-visitor-view.text label="Significance" content="{{ $plants->significance }}" />
            @endisset

            @isset($plants->conservation)
                <x-visitor-view.text label="Conservation" content="{{ $plants->conservation }}" />
            @endisset

            @isset($plants->references)
                <x-visitor-view.text label="References" content="{{ $plants->references }}" />
            @endisset

            @isset($plants->name_of_mapper)
                <x-visitor-view.text label="Name of Mapper" content="{{ $plants->name_of_mapper }}" />
            @endisset

            @isset($plants->date_profiled)
                <x-visitor-view.text label="Date Profiled" content="{{ $plants->date_profiled->format('F j, Y') }}" />
            @endisset

        </x-visitor-view.section>


        <div class="px-5 py-10 flex justify-end">
            <x-form.cancel-link href="javascript:history.back()">
                Back
            </x-form.cancel-link>
        </div>


        <script src="{{ asset('js/zoom.js') }}"></script>
</x-layouts.visitor-layout>
