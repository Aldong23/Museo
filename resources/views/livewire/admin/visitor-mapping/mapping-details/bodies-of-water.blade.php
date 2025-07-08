<x-layouts.visitor-layout>
    <div class="relative w-full p-10 flex flex-col gap-6">
        <x-visitor-view.row>
            @isset($bow->cultural_heritage_category)
                <x-visitor-view.text label="Cultural Heritage Category" content="{{ $bow->cultural_heritage_category }}" />
            @endisset

            @isset($bow->cultural_heritage_type)
                <x-visitor-view.text label="Types of Cultural Heritage" content="{{ $bow->cultural_heritage_type }}" />
            @endisset
        </x-visitor-view.row>


        @isset($bow->name)
            <x-visitor-view.text label="Local / Indigenous Name" content="{{ $bow->name }}" />
        @endisset

        <x-visitor-view.section label="Featured Collections">
            @isset($bow->photo_details)
                @foreach ($bow->photo_details as $photo)
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
                @isset($bow->sub_category)
                    <x-visitor-view.text label="Sub-Category" content="{{ $bow->sub_category }}" />
                @endisset
                @isset($bow->location)
                    <x-visitor-view.text label="Location" content="{{ $bow->location }}" />
                @endisset

                @isset($bow->address)
                    <x-visitor-view.text label="Address" content="{{ $bow->address }}" />
                @endisset

            </x-visitor-view.row>

            @isset($bow->area)
                <x-visitor-view.text label="area" content="{{ $bow->area }}" />
            @endisset

            @isset($bow->ownership)
                <x-visitor-view.text label="Ownership / Jurisdiction" content="{{ $bow->ownership }}" />
            @endisset

            @isset($bow->description)
                <x-visitor-view.text label="Description" content="{{ $bow->description }}" />
            @endisset

            @isset($bow->stories)
                <x-visitor-view.text label="Stories Associated with the Natural Geological"
                    content="{{ $bow->stories }}" />
            @endisset

            @isset($bow->significance)
                <x-visitor-view.text label="Significance" content="{{ $bow->significance }}" />
            @endisset

            @isset($bow->conservation)
                <x-visitor-view.text label="Conservation" content="{{ $bow->conservation }}" />
            @endisset

            @isset($bow->references)
                <x-visitor-view.text label="References" content="{{ $bow->references }}" />
            @endisset

            @isset($bow->name_of_mapper)
                <x-visitor-view.text label="Name of Mapper" content="{{ $bow->name_of_mapper }}" />
            @endisset

            @isset($bow->date_profiled)
                <x-visitor-view.text label="Date Profiled" content="{{ $bow->date_profiled->format('F j, Y') }}" />
            @endisset

        </x-visitor-view.section>


        <div class="px-5 py-10 flex justify-end">
            <x-form.cancel-link href="javascript:history.back()">
                Back
            </x-form.cancel-link>
        </div>


        <script src="{{ asset('js/zoom.js') }}"></script>
</x-layouts.visitor-layout>
