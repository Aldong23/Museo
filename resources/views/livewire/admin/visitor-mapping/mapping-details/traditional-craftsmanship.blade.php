<x-layouts.visitor-layout>
    <div class="relative w-full p-10 flex flex-col gap-6">
        <x-visitor-view.row>
            @isset($tc->cultural_heritage_category)
                <x-visitor-view.text label="Cultural Heritage Category" content="{{ $tc->cultural_heritage_category }}" />
            @endisset

            @isset($tc->cultural_heritage_type)
                <x-visitor-view.text label="Types of Cultural Heritage" content="{{ $tc->cultural_heritage_type }}" />
            @endisset
        </x-visitor-view.row>

        @isset($tc->name)
            <x-visitor-view.text label="Name of the Elements" content="{{ $tc->name }}" />
        @endisset

        <x-visitor-view.section label="Featured Collections">
            @isset($tc->photo_details)
                @foreach ($tc->photo_details as $photo)
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
                @isset($tc->type)
                    <x-visitor-view.text label="Type" content="{{ $tc->type }}" />
                @endisset
            </x-visitor-view.row>


            @isset($tc->geographical_location)
                <x-visitor-view.text label="Geographical Location and Range of the Elements"
                    content="{{ $tc->geographical_location }}" />
            @endisset

            @isset($tc->related_domains)
                <x-visitor-view.text label="Related Domains of the Intangible Cultural Heritage"
                    content="{{ $tc->related_domains }}" />
            @endisset

        </x-visitor-view.section>

        <x-visitor-view.section label="Description of Intangible Cultural Heritage">
            @isset($tc->summary_of_elements)
                <x-visitor-view.text label="Summary of Elements" content="{{ $tc->summary_of_elements }}" />
            @endisset
        </x-visitor-view.section>

        @isset($tc->list_of_tangible_movable_heritage)
            <x-visitor-view.section
                label="List of Significant Tangible Movable Heritage Used / Associated with the Element">
                @foreach ($tc->list_of_tangible_movable_heritage as $list)
                    <div class="w-full p-4 space-y-4 border border-gray-300 rounded-lg">
                        <x-visitor-view.row>
                            @isset($list['name_1'])
                                <x-visitor-view.text label="Name of Object" content="{{ $list['name_1'] }}" />
                            @endisset

                            @isset($list['year_produced_1'])
                                <x-visitor-view.text label="Year produced or estimated age"
                                    content="{{ $list['year_produced_1'] }}" />
                            @endisset
                            @isset($list['use_1'])
                                <x-visitor-view.text label="Use of the object in the practice"
                                    content="{{ $list['use_1'] }}" />
                            @endisset
                        </x-visitor-view.row>

                        @if ($list['photo_1'])
                            <x-visitor-view.image label="Photo">

                                <img src="{{ asset('storage/' . $list['photo_1']) }}" alt="{{ $list['photo_1'] }}"
                                    class="photo-img clickable-img w-auto h-60">

                            </x-visitor-view.image>
                        @endif
                    </div>
                @endforeach
            </x-visitor-view.section>
        @endisset

        @isset($tc->list_of_flora_fauna)
            <x-visitor-view.section label="List of Significant Flora /  Fauna Used / Associated with the Element">
                @foreach ($tc->list_of_flora_fauna as $list)
                    <div class="w-full p-4 space-y-4 border border-gray-300 rounded-lg">
                        <x-visitor-view.row>
                            @isset($list['name_2'])
                                <x-visitor-view.text label="Name of Flora / Fauna" content="{{ $list['name_2'] }}" />
                            @endisset
                            @isset($list['use_2'])
                                <x-visitor-view.text label="Use of the flora / fauna in the practice"
                                    content="{{ $list['use_2'] }}" />
                            @endisset
                        </x-visitor-view.row>

                        @if ($list['photo_2'])
                            <x-visitor-view.image label="Photo">
                                <img src="{{ asset('storage/' . $list['photo_2']) }}" alt="{{ $list['photo_2'] }}"
                                    class="photo-img clickable-img w-auto h-60">
                            </x-visitor-view.image>
                        @endif
                    </div>
                @endforeach
            </x-visitor-view.section>
        @endisset


        @isset($tc->stories)
            <x-visitor-view.text label="Stories / Narratives Associated with the Element" content="{{ $tc->stories }}" />
        @endisset

        @isset($tc->significance)
            <x-visitor-view.text label="Significance" content="{{ $tc->significance }}" />
        @endisset

        <x-visitor-view.section label="Assessment of the Practice">
            @isset($tc->assessment_of_practice)
                <x-visitor-view.text label="" content="{{ $tc->assessment_of_practice }}" />
            @endisset

            @isset($tc->measures_and_description_dropdown)
                <x-visitor-view.text label="Measures and Description of Safeguard Measure Taken"
                    content="{{ $tc->measures_and_description_dropdown }}" />
            @endisset

            @isset($tc->measures_and_description_text)
                <x-visitor-view.text label="" content="{{ $tc->measures_and_description_text }}" />
            @endisset
        </x-visitor-view.section>

        <x-visitor-view.section label="References">
            @isset($tc->supporting_documentation)
                <x-visitor-view.text label="Supporting Documentation"
                    content="{{ implode(', ', $tc->supporting_documentation) }}" />
            @endisset

            @isset($tc->key_informat)
                <x-visitor-view.text label="Key Informat/s" content="{{ $tc->key_informat }}" />
            @endisset

            @isset($tc->name_of_mapper)
                <x-visitor-view.text label="Name of Mapper" content="{{ $tc->name_of_mapper }}" />
            @endisset

            @isset($tc->date_profiled)
                <x-visitor-view.text label="Date Profiled" content="{{ $tc->date_profiled->format('F j, Y') }}" />
            @endisset
        </x-visitor-view.section>

        <x-visitor-view.section label="Attachment">
            @isset($tc->attachment_text)
                <x-visitor-view.text label="Supporting Documentation" content="{{ $tc->attachment_text }}" />
            @endisset

            @isset($tc->attachment_image)
                <x-visitor-view.image label="">
                    <img src="{{ asset('storage/' . $tc->attachment_image) }}" alt="{{ $tc->attachment_image }}"
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
