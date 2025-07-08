<x-layouts.visitor-layout>
    <div class="relative w-full p-10 flex flex-col gap-6">
        <x-visitor-view.row>
            @isset($protected->cultural_heritage_category)
                <x-visitor-view.text label="Cultural Heritage Category"
                    content="{{ $protected->cultural_heritage_category }}" />
            @endisset

            @isset($protected->cultural_heritage_type)
                <x-visitor-view.text label="Types of Cultural Heritage" content="{{ $protected->cultural_heritage_type }}" />
            @endisset
        </x-visitor-view.row>


        @isset($protected->name)
            <x-visitor-view.text label="Local / Indigenous Name" content="{{ $protected->name }}" />
        @endisset

        <x-visitor-view.section label="Featured Collections">
            @isset($protected->photo_details)
                @foreach ($protected->photo_details as $photo)
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
                @isset($protected->category)
                    <x-visitor-view.text label="Category" content="{{ $protected->category }}" />
                @endisset
                @isset($protected->classification)
                    <x-visitor-view.text label="Classification" content="{{ $protected->classification }}" />
                @endisset

            </x-visitor-view.row>

            <x-visitor-view.row>
                @isset($protected->location)
                    <x-visitor-view.text label="Location" content="{{ $protected->location }}" />
                @endisset
                @isset($protected->address)
                    <x-visitor-view.text label="Address" content="{{ $protected->address }}" />
                @endisset

            </x-visitor-view.row>

            @isset($protected->area)
                <x-visitor-view.text label="Area" content="{{ $protected->area }}" />
            @endisset

            @isset($protected->legislation_date)
                <x-visitor-view.text label="Legislation and Date of Legislation"
                    content="{{ $protected->legislation_date }}" />
            @endisset

            @isset($protected->description)
                <x-visitor-view.text label="Description" content="{{ $protected->description }}" />
            @endisset

            @isset($protected->common_uses)
                <x-visitor-view.text label="Common Uses and Scope of Use"
                    content="{{ implode(' ,', $protected->common_uses) }}" />
            @endisset

            @isset($protected->remarks)
                <x-visitor-view.text label="Remarks" content="{{ $protected->remarks }}" />
            @endisset

            @isset($protected->stories)
                <x-visitor-view.text label="Stories Associated with the Natural Geological"
                    content="{{ $protected->stories }}" />
            @endisset

            @isset($protected->significance)
                <x-visitor-view.text label="Significance" content="{{ $protected->significance }}" />
            @endisset

            @isset($protected->conservation)
                <x-visitor-view.text label="Conservation" content="{{ $protected->conservation }}" />
            @endisset

            @isset($protected->references)
                <x-visitor-view.text label="References" content="{{ $protected->references }}" />
            @endisset

            @isset($protected->name_of_mapper)
                <x-visitor-view.text label="Name of Mapper" content="{{ $protected->name_of_mapper }}" />
            @endisset

            @isset($protected->date_profiled)
                <x-visitor-view.text label="Date Profiled" content="{{ $protected->date_profiled->format('F j, Y') }}" />
            @endisset

        </x-visitor-view.section>


        <div class="px-5 py-10 flex justify-end">
            <x-form.cancel-link href="javascript:history.back()">
                Back
            </x-form.cancel-link>
        </div>


        <script src="{{ asset('js/zoom.js') }}"></script>
</x-layouts.visitor-layout>
