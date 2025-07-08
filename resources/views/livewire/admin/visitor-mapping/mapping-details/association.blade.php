<x-layouts.visitor-layout>
    <div class="relative w-full p-10 flex flex-col gap-6">
        <x-visitor-view.row>
            @isset($assoc->cultural_heritage_category)
                <x-visitor-view.text label="Cultural Heritage Category" content="{{ $assoc->cultural_heritage_category }}" />
            @endisset

            @isset($assoc->cultural_heritage_type)
                <x-visitor-view.text label="Types of Cultural Heritage" content="{{ $assoc->cultural_heritage_type }}" />
            @endisset
        </x-visitor-view.row>

        @isset($assoc->name)
            <x-visitor-view.text label="Name of Institution" content="{{ $assoc->name }}" />
        @endisset

        <x-visitor-view.section label="Featured Collections">
            @isset($assoc->photo_details)
                @foreach ($assoc->photo_details as $photo)
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
                        @isset($photo['photos'])
                            <x-visitor-view.image label="Photo">
                                @foreach ($photo['photos'] as $path)
                                    <img src="{{ asset('storage/' . $path) }}" alt="{{ $path }}"
                                        class="photo-img clickable-img w-auto h-60">
                                @endforeach
                            </x-visitor-view.image>
                        @endisset
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
                @isset($assoc->city)
                    <x-visitor-view.text label="Municipality" content="{{ $assoc->city }}" />
                @endisset
                @isset($assoc->province)
                    <x-visitor-view.text label="Province" content="{{ $assoc->province }}" />
                @endisset
            </x-visitor-view.row>

            @isset($assoc->location)
                <x-visitor-view.text label="Location / Address" content="{{ $assoc->location }}" />
            @endisset

            @isset($assoc->location)
                <x-visitor-view.text label="Type of Cultural Institution" content="{{ $assoc->location }}" />
            @endisset




        </x-visitor-view.section>



        <x-visitor-view.section label="Remarks">

            @isset($assoc->remarks_image)
                <x-visitor-view.image label="">

                    <img src="{{ asset('storage/' . $assoc->remarks_image) }}" alt="{{ $assoc->remarks_image }}"
                        class="photo-img clickable-img w-auto h-60">
                </x-visitor-view.image>
            @endisset
            @isset($assoc->remarks_text)
                <x-visitor-view.text label="" content="{{ $assoc->remarks_text }}" />
            @endisset
        </x-visitor-view.section>


        @isset($assoc->narrative_description)
            <x-visitor-view.text label="Narrative Description" content="{{ $assoc->narrative_description }}" />
        @endisset

        @isset($assoc->stories)
            <x-visitor-view.text label="Stories / Narratives Associated with the Element"
                content="{{ $assoc->stories }}" />
        @endisset

        @isset($assoc->significance)
            <x-visitor-view.text label="Significance" content="{{ $assoc->significance }}" />
        @endisset

        <x-visitor-view.section label="References">
            @isset($assoc->supporting_documentation)
                <x-visitor-view.text label="Supporting Documentation"
                    content="{{ implode(', ', $assoc->supporting_documentation) }}" />
            @endisset

            @isset($assoc->key_informat)
                <x-visitor-view.text label="Key Informat/s" content="{{ $assoc->key_informat }}" />
            @endisset

            @isset($assoc->name_of_mapper)
                <x-visitor-view.text label="Name of Mapper" content="{{ $assoc->name_of_mapper }}" />
            @endisset

            @isset($assoc->date_profiled)
                <x-visitor-view.text label="Date Profiled" content="{{ $assoc->date_profiled->format('F j, Y') }}" />
            @endisset
        </x-visitor-view.section>


        @isset($assoc->farmers_association)
            <x-visitor-view.section label="Urdaneta  Farmers Association / COOP">
                @foreach ($assoc->farmers_association as $list)
                    <div class="w-full p-4 space-y-4 border border-gray-300 rounded-lg">
                        <x-visitor-view.row>
                            @isset($list['no'])
                                <x-visitor-view.text label="No." content="{{ $list['no'] }}" />
                            @endisset
                            @isset($list['barangay'])
                                <x-visitor-view.text label="Barangay" content="{{ $list['barangay'] }}" />
                            @endisset
                            @isset($list['coop'])
                                <x-visitor-view.text label="Name of FA / COOP / IA" content="{{ $list['coop'] }}" />
                            @endisset
                            @isset($list['president'])
                                <x-visitor-view.text label="President" content="{{ implode(' ', $list['president']) }}" />
                            @endisset
                            @isset($list['contact_no'])
                                <x-visitor-view.text label="Contact No" content="{{ $list['contact_no'] }}" />
                            @endisset
                        </x-visitor-view.row>
                        @isset($list['remarks'])
                            <x-visitor-view.text label="Remarks" content="{{ $list['remarks'] }}" />
                        @endisset
                    </div>
                @endforeach
            </x-visitor-view.section>
        @endisset






        <div class="px-5 py-10 flex justify-end">
            <x-form.cancel-link href="javascript:history.back()">
                Back
            </x-form.cancel-link>
        </div>


        <script src="{{ asset('js/zoom.js') }}"></script>
</x-layouts.visitor-layout>
