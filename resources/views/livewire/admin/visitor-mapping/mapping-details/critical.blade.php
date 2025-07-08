<x-layouts.visitor-layout>
    <div class="relative w-full p-10 flex flex-col gap-6">
        <x-visitor-view.row>
            @isset($critical->cultural_heritage_category)
                <x-visitor-view.text label="Cultural Heritage Category"
                    content="{{ $critical->cultural_heritage_category }}" />
            @endisset

            @isset($critical->cultural_heritage_type)
                <x-visitor-view.text label="Types of Cultural Heritage" content="{{ $critical->cultural_heritage_type }}" />
            @endisset
        </x-visitor-view.row>


        @isset($critical->name)
            <x-visitor-view.text label="Name of Area" content="{{ $critical->name }}" />
        @endisset


        <x-visitor-view.row>
            @isset($critical->location)
                <x-visitor-view.text label="Location" content="{{ $critical->location }}" />
            @endisset

            @isset($critical->address)
                <x-visitor-view.text label="Address" content="{{ $critical->address }}" />
            @endisset
        </x-visitor-view.row>

        @isset($critical->existing_hazard_type)
            <x-visitor-view.text label="Existing Hazard Type" content="{{ $critical->existing_hazard_type }}" />
        @endisset

        <x-visitor-view.section label="Featured Collections">
            @isset($critical->photo_details)
                @foreach ($critical->photo_details as $photo)
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

            @isset($critical->summary)
                <x-visitor-view.text label="Summary" content="{{ $critical->summary }}" />
            @endisset


            @isset($critical->remarks)
                <x-visitor-view.text label="Remarks" content="{{ $critical->remarks }}" />
            @endisset

            @isset($critical->description)
                <x-visitor-view.text label="Description" content="{{ $critical->description }}" />
            @endisset




            @isset($critical->stories)
                <x-visitor-view.text label="Stories Associated with the Natural Geological"
                    content="{{ $critical->stories }}" />
            @endisset

            @isset($critical->significance)
                <x-visitor-view.text label="Significance" content="{{ $critical->significance }}" />
            @endisset

            @isset($critical->conservation)
                <x-visitor-view.text label="Conservation" content="{{ $critical->conservation }}" />
            @endisset

            @isset($critical->references)
                <x-visitor-view.text label="References" content="{{ $critical->references }}" />
            @endisset

            @isset($critical->name_of_mapper)
                <x-visitor-view.text label="Name of Mapper" content="{{ $critical->name_of_mapper }}" />
            @endisset

            @isset($critical->date_profiled)
                <x-visitor-view.text label="Date Profiled" content="{{ $critical->date_profiled->format('F j, Y') }}" />
            @endisset


            @isset($critical->attachment)
                <x-visitor-view.image label="">
                    <img src="{{ asset('storage/' . $critical->attachment) }}" alt="{{ $path }}"
                        class="photo-img clickable-img w-auto h-60">
                </x-visitor-view.image>
            @endisset

        </x-visitor-view.section>


        <div class="px-5 py-10 flex justify-end">
            <x-form.cancel-link href="javascript:history.back()">
                Back
            </x-form.cancel-link>
        </div>


        <script src="{{ asset('js/zoom.js') }}"></script>
</x-layouts.visitor-layout>
