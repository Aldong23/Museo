<x-slot:heading>Visitor Monitoring</x-slot:heading>
<x-slot:secHeading>View Visitor Feedback</x-slot:secHeading>
<x-admin.body>
<style>

    .inputs div {
        flex: 1 1 100%;
    }

    .inputs select,
    .inputs input {
        width: 100%;
        padding: 1em;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    .inputs input:disabled {
        background-color: #f0f0f0;
    }


    .ccc,
    .emotes {
        border: 1px solid gray;
        border-radius: 10px;
        overflow: hidden;
        margin: 20px 0 0 0;
    }

    .title {
        padding: 1em;
        background: #F1F1F1;
        border-bottom-left-radius: 5px;
        border-bottom-right-radius: 5px;
        border-bottom: 1px solid gray;
    }

    .ccc .choices {
        padding: 1em;
    }

    .ccc .choices ol {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .emotes .choices {
        font-size: 0.875rem;
        display: flex !important;
        justify-content: space-evenly !important;
        align-items: flex-end !important;
        gap: 20px !important;
        flex-wrap: wrap !important;
        text-align: center !important;
    }


    /* .emotes .choices label img {
        transition: all .5s ease;
        cursor: pointer;
    } */

    .emotes .choices input[type="radio"] {
        opacity: 0;
    }

    /* .emotes .choices label img:hover {
        transform: scale(1.3);
    } */

    .emotes .choices input[type="radio"]:checked+label img {
        transform: scale(1.3);
    }

    .emotes .choices input[type="radio"]:checked+label+div {
        color: red; /* Change text color when selected */
        font-weight: bold; /* Optional: Make the text bold */
        transform: scale(1.1); /* Slightly increase text size */
    }

    .emotes .choices input[type="radio"]:checked+label p {
        transform: scale(1.3);
        color: red;
    }


    .emotes-flex {
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center !important;
        width: auto !important;
    }
</style>

    {{-- INPUTS --}}
    <div>
        <div class="header">
            <h1>
                Help us improve our processes and services
            </h1>
            <br>
            <p>
                The Client Satisfaction Measurement (CSM) aims to monitor citizens' experiences when transacting
                with government offices. Your feedback on your recent transaction will help enhance and improve
                public service. Any personal information you provide will remain confidential. Participation in this
                survey is optional.
            </p>
        </div>

        <div class="inputs flex flex-col gap-2">
            <div class="flex gap-2">
                <div>
                    <label for="">Control No.</label>
                    <input type="text" value="{{ $feedback->control_no }}" disabled>
                </div>
                <div>
                    <label for="">Type of Client</label>
                    <input type="text" value="{{ $feedback->client }}" disabled>
                </div>
                <div>
                    <label for="">Date</label>
                    <input type="text" value="{{ \Carbon\Carbon::parse($feedback->current_date)->format('M d, Y') }}" disabled>
                </div>
            </div>

            <div class="flex gap-2">
                <div>
                    <label for="">Sex</label>
                    <input type="text" value="{{ $feedback->sex }}" disabled>
                </div>
                <div>
                    <label for="">Age</label>
                    <input type="text" value="{{ $feedback->age }}" disabled>
                </div>
                <div>
                    <label for="">Religion</label>
                    <input type="text" value="{{ $feedback->religion }}" disabled>
                </div>
                <div>
                    <label for="">Email Address</label>
                    <input type="text" value="{{ $feedback->email }}" disabled>
                </div>
            </div>

            <div class="flex gap-2 mt-5">
                <div>
                    <label for="">Type of Transaction or Service</label>
                    <input type="text" value="{{ $feedback->purpose }}" disabled>
                </div>
            </div>
        </div>
    </div>

    {{-- CHECKBOXES --}}
    <div>

        <br><br>
        <div>
            <h3>
                INSTRUCTION: Check (✔) your answer to the following questions about the Citizen’s Charter (CC). This
                official document outlines the services provided by a government agency/office, detailing the
                required documents, corresponding fees, and overall processing time.
            </h3>
        </div>

        <div class="ccc">
            <div class="title">
                <span style="font-weight:bold; margin-right: 20px;">CCC1</span> Which of the following best
                describes your knowledge of the Citizen’s Charter (CC)?
            </div>

            <div class="choices">
                <ol>
                    <div>
                        <input type="radio" name="q1"
                            value="I know about CC, and I saw it in the office I visited" disabled
                            {{ $feedback->q1 == "I know about CC, and I saw it in the office I visited" ? 'checked' : '' }}>
                        <label for="">1. I know about CC, and I saw it in the office I visited.</label>
                    </div>

                    <div>
                        <input type="radio" name="q1"
                            value="I know about CC, but I didn’t see it in the office I visited" disabled
                            {{ $feedback->q1 == "I know about CC, but I didn’t see it in the office I visited" ? 'checked' : '' }}>
                        <label for="">2. I know about CC, but I didn’t see it in the office I visited.</label>
                    </div>

                    <div>
                        <input type="radio" name="q1"
                            value="I learned about CC when I saw it in the office I visited" disabled
                            {{ $feedback->q1 == "I learned about CC when I saw it in the office I visited" ? 'checked' : '' }}>
                        <label for="">3. I learned about CC when I saw it in the office I visited.</label>
                    </div>

                    <div>
                        <input type="radio" name="q1"
                            value="I don’t know what CC is, and I didn’t see anything in the office I visited (Check ‘NA’)" disabled
                            {{ $feedback->q1 == "I don’t know what CC is, and I didn’t see anything in the office I visited (Check ‘NA’)" ? 'checked' : '' }}>
                        <label for="">4. I don’t know what CC is, and I didn’t see anything in the office I visited (Check ‘NA’).</label>
                    </div>
                </ol>
            </div>

        </div>

        <div class="ccc">
            <div class="title">
                <span style="font-weight:bold; margin-right: 20px;">CCC2</span> If you know about CC (checked
                options 1-3 in CC1), can you say that the CC in the office you visited is...
            </div>

            <div class="choices">
                <ol>
                    <div>
                        <input type="radio" name="q2" value="Easy to see" disabled {{ $feedback->q2 == "Easy to see" ? 'checked' : '' }}>
                        <label for="">1. Easy to see.</label>
                    </div>

                    <div>
                        <input type="radio" name="q2" value="Somewhat easy to see" disabled {{ $feedback->q2 == "Somewhat easy to see" ? 'checked' : '' }}>
                        <label for="">2. Somewhat easy to see.</label>
                    </div>

                    <div>
                        <input type="radio" name="q2" value="Difficult to see" disabled {{ $feedback->q2 == "Difficult to see" ? 'checked' : '' }}>
                        <label for="">3. Difficult to see.</label>
                    </div>

                    <div>
                        <input type="radio" name="q2" value="Cannot be seen" disabled {{ $feedback->q2 == "Cannot be seen" ? 'checked' : '' }}>
                        <label for="">4. Cannot be seen.</label>
                    </div>

                    <div>
                        <input type="radio" name="q2" value="N/A" disabled {{ $feedback->q2 == "N/A" ? 'checked' : '' }}>
                        <label for="">5. N/A.</label>
                    </div>
                </ol>
            </div>
        </div>

        <div class="ccc">
            <div class="title">
                <span style="font-weight:bold; margin-right: 20px;">CCC3</span> If you are familiar with the CC
                (checked options 1-3 in CC1), how helpful was the CC in your transaction?
            </div>

            <div class="choices">
                <ol>
                    <div>
                        <input type="radio" name="q3" value="Very helpful" disabled {{ $feedback->q3 == "Very helpful" ? 'checked' : '' }}>
                        <label for="">1. Very helpful.</label>
                    </div>

                    <div>
                        <input type="radio" name="q3" value="Somewhat helpful" disabled {{ $feedback->q3 == "Somewhat helpful" ? 'checked' : '' }}>
                        <label for="">2. Somewhat helpful.</label>
                    </div>

                    <div>
                        <input type="radio" name="q3" value="Not helpful" disabled {{ $feedback->q3 == "Not helpful" ? 'checked' : '' }}>
                        <label for="">3. Not helpful.</label>
                    </div>

                    <div>
                        <input type="radio" name="q3" value="N/A" disabled {{ $feedback->q3 == "N/A" ? 'checked' : '' }}>
                        <label for="">4. N/A.</label>
                    </div>
                </ol>
            </div>
        </div>
    </div>

    {{-- EMOJI --}}
    <div>
        <br>
        <br>
        <h3>
            INSTRUCTIONS: For SQD 0-8, choose the most appropriate answer.
        </h3>

        <!-- SQD0 -->
        <div class="emotes sqd0">
            <div class="title">
                <span style="font-weight: bold; margin-right: 20px;">SQD0</span> I was satisfied with the service I
                received at the office I visited.
            </div>
            <div class="choices">
                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd0-5" name="satisfaction_0" value="5" disabled {{ $feedback->satisfaction_0 == 5 ? 'checked' : '' }}>
                    <label for="sqd0-5">
                        <img src="{{ asset('images/icons/5.png') }}" alt="Very Satisfied"
                            style="width: 50px; height: 50px;">
                    </label>
                    <div style="margin-top: 10px;">Very Satisfied</div>
                </div>

                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd0-4" name="satisfaction_0" value="4" disabled {{ $feedback->satisfaction_0 == 4 ? 'checked' : '' }}>
                    <label for="sqd0-4">
                        <img src="{{ asset('images/icons/4.png') }}" alt="Satisfied"
                            style="width: 50px; height: 50px;">
                    </label>
                    <div style="margin-top: 10px;">Satisfied</div>
                </div>

                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd0-3" name="satisfaction_0" value="3" disabled {{ $feedback->satisfaction_0 == 3 ? 'checked' : '' }}>
                    <label for="sqd0-3">
                        <img src="{{ asset('images/icons/3.png') }}" alt="Neutral"
                            style="width: 50px; height: 50px;">
                    </label>
                    <div style="margin-top: 10px;">Neutral</div>
                </div>

                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd0-2" name="satisfaction_0" value="2" disabled {{ $feedback->satisfaction_0 == 2 ? 'checked' : '' }}>
                    <label for="sqd0-2">
                        <img src="{{ asset('images/icons/2.png') }}" alt="Dissatisfied"
                            style="width: 50px; height: 50px;">
                    </label>
                    <div style="margin-top: 10px;">Dissatisfied</div>
                </div>

                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd0-1" name="satisfaction_0" value="1" disabled {{ $feedback->satisfaction_0 == 1 ? 'checked' : '' }}>
                    <label for="sqd0-1">
                        <img src="{{ asset('images/icons/1.png') }}" alt="Very Dissatisfied"
                            style="width: 50px; height: 50px;">
                    </label>
                    <div style="margin-top: 10px;">Very Dissatisfied</div>
                </div>

                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd0-0" name="satisfaction_0" value="0" disabled {{ $feedback->satisfaction_0 == 0 ? 'checked' : '' }}>
                    <label for="sqd0-0">
                        <p> N/A </p>
                    </label>
                    <div style="margin-top: 10px;">Not Applicable</div>
                </div>
            </div>
        </div>

        <!-- SQD1 -->
        <div class="emotes sqd1">
            <div class="title">
                <span style="font-weight: bold; margin-right: 20px;">SQD1</span> The time I spent processing my
                transaction was reasonable.
            </div>
            <div class="choices">
                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd1-5" name="satisfaction_1" value="5" disabled {{ $feedback->satisfaction_1 == 5 ? 'checked' : '' }}>
                    <label for="sqd1-5">
                        <img src="{{ asset('images/icons/5.png') }}" alt="Very Satisfied"
                            style="width: 50px; height: 50px;">
                    </label>
                    <div style="margin-top: 10px;">Very Satisfied</div>
                </div>

                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd1-4" name="satisfaction_1" value="4" disabled {{ $feedback->satisfaction_1 == 4 ? 'checked' : '' }}>
                    <label for="sqd1-4">
                        <img src="{{ asset('images/icons/4.png') }}" alt="Satisfied"
                            style="width: 50px; height: 50px;">
                    </label>
                    <div style="margin-top: 10px;">Satisfied</div>
                </div>

                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd1-3" name="satisfaction_1" value="3" disabled {{ $feedback->satisfaction_1 == 3 ? 'checked' : '' }}>
                    <label for="sqd1-3">
                        <img src="{{ asset('images/icons/3.png') }}" alt="Neutral"
                            style="width: 50px; height: 50px;">
                    </label>
                    <div style="margin-top: 10px;">Neutral</div>
                </div>

                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd1-2" name="satisfaction_1" value="2" disabled {{ $feedback->satisfaction_1 == 2 ? 'checked' : '' }}>
                    <label for="sqd1-2">
                        <img src="{{ asset('images/icons/2.png') }}" alt="Dissatisfied"
                            style="width: 50px; height: 50px;">
                    </label>
                    <div style="margin-top: 10px;">Dissatisfied</div>
                </div>

                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd1-1" name="satisfaction_1" value="1" disabled {{ $feedback->satisfaction_1 == 1 ? 'checked' : '' }}>
                    <label for="sqd1-1">
                        <img src="{{ asset('images/icons/1.png') }}" alt="Very Dissatisfied"
                            style="width: 50px; height: 50px;">
                    </label>
                    <div style="margin-top: 10px;">Very Dissatisfied</div>
                </div>

                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd1-0" name="satisfaction_1" value="0" disabled {{ $feedback->satisfaction_1 == 0 ? 'checked' : '' }}>
                    <label for="sqd1-0">
                        <p>N/A</p>
                    </label>
                    <div style="margin-top: 10px;">Not Applicable</div>
                </div>

            </div>
        </div>

        <!-- SQD2 -->
        <div class="emotes sqd2">
            <div class="title">
                <span style="font-weight: bold; margin-right: 20px;">SQD2</span> The office adheres to the required
                documents and procedures based on the information provided.
            </div>
            <div class="choices">
                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd2-5" name="satisfaction_2" value="5" disabled {{ $feedback->satisfaction_2 == 5 ? 'checked' : '' }}>
                    <label for="sqd2-5">
                        <img src="{{ asset('images/icons/5.png') }}" alt="Very Satisfied"
                            style="width: 50px; height: 50px;">
                    </label>
                    <div style="margin-top: 10px;">Very Satisfied</div>
                </div>

                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd2-4" name="satisfaction_2" value="4" disabled {{ $feedback->satisfaction_2 == 4 ? 'checked' : '' }}>
                    <label for="sqd2-4">
                        <img src="{{ asset('images/icons/4.png') }}" alt="Satisfied"
                            style="width: 50px; height: 50px;">
                    </label>
                    <div style="margin-top: 10px;">Satisfied</div>
                </div>

                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd2-3" name="satisfaction_2" value="3" disabled {{ $feedback->satisfaction_2 == 3 ? 'checked' : '' }}>
                    <label for="sqd2-3">
                        <img src="{{ asset('images/icons/3.png') }}" alt="Neutral"
                            style="width: 50px; height: 50px;">
                    </label>
                    <div style="margin-top: 10px;">Neutral</div>
                </div>

                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd2-2" name="satisfaction_2" value="2" disabled {{ $feedback->satisfaction_2 == 2 ? 'checked' : '' }}>
                    <label for="sqd2-2">
                        <img src="{{ asset('images/icons/2.png') }}" alt="Dissatisfied"
                            style="width: 50px; height: 50px;">
                    </label>
                    <div style="margin-top: 10px;">Dissatisfied</div>
                </div>

                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd2-1" name="satisfaction_2" value="1" disabled {{ $feedback->satisfaction_2 == 1 ? 'checked' : '' }}>
                    <label for="sqd2-1">
                        <img src="{{ asset('images/icons/1.png') }}" alt="Very Dissatisfied"
                            style="width: 50px; height: 50px;">
                    </label>
                    <div style="margin-top: 10px;">Very Dissatisfied</div>
                </div>

                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd2-0" name="satisfaction_2" value="0" disabled {{ $feedback->satisfaction_2 == 0 ? 'checked' : '' }}>
                    <label for="sqd2-0">
                        <p>N/A</p>
                    </label>
                    <div style="margin-top: 10px;">Not Applicable</div>
                </div>

            </div>
        </div>

        <!-- SQD3 -->
        <div class="emotes sqd3">
            <div class="title">
                <span style="font-weight: bold; margin-right: 20px;">SQD3</span> The steps in processing, including
                payment, are easy and simple.
            </div>
            <div class="choices">
                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd3-5" name="satisfaction_3" value="5" disabled {{ $feedback->satisfaction_3 == 5 ? 'checked' : '' }}>
                    <label for="sqd3-5">
                        <img src="{{ asset('images/icons/5.png') }}" alt="Very Satisfied"
                            style="width: 50px; height: 50px;">
                    </label>
                    <div style="margin-top: 10px;">Very Satisfied</div>
                </div>

                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd3-4" name="satisfaction_3" value="4" disabled {{ $feedback->satisfaction_3 == 4 ? 'checked' : '' }}>
                    <label for="sqd3-4">
                        <img src="{{ asset('images/icons/4.png') }}" alt="Satisfied"
                            style="width: 50px; height: 50px;">
                    </label>
                    <div style="margin-top: 10px;">Satisfied</div>
                </div>

                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd3-3" name="satisfaction_3" value="3" disabled {{ $feedback->satisfaction_3 == 3 ? 'checked' : '' }}>
                    <label for="sqd3-3">
                        <img src="{{ asset('images/icons/3.png') }}" alt="Neutral"
                            style="width: 50px; height: 50px;">
                    </label>
                    <div style="margin-top: 10px;">Neutral</div>
                </div>

                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd3-2" name="satisfaction_3" value="2" disabled {{ $feedback->satisfaction_3 == 2 ? 'checked' : '' }}>
                    <label for="sqd3-2">
                        <img src="{{ asset('images/icons/2.png') }}" alt="Dissatisfied"
                            style="width: 50px; height: 50px;">
                    </label>
                    <div style="margin-top: 10px;">Dissatisfied</div>
                </div>

                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd3-1" name="satisfaction_3" value="1" disabled {{ $feedback->satisfaction_3 == 1 ? 'checked' : '' }}>
                    <label for="sqd3-1">
                        <img src="{{ asset('images/icons/1.png') }}" alt="Very Dissatisfied"
                            style="width: 50px; height: 50px;">
                    </label>
                    <div style="margin-top: 10px;">Very Dissatisfied</div>
                </div>

                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd3-0" name="satisfaction_3" value="0" disabled {{ $feedback->satisfaction_3 == 0 ? 'checked' : '' }}>
                    <label for="sqd3-0">
                        <p>N/A</p>
                    </label>
                    <div style="margin-top: 10px;">Not Applicable</div>
                </div>

            </div>
        </div>

        <!-- SQD4 -->
        <div class="emotes sqd4">
            <div class="title">
                <span style="font-weight: bold; margin-right: 20px;">SQD4</span> I quickly and easily found
                information about my transaction from the office or its website.
            </div>
            <div class="choices">
                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd4-5" name="satisfaction_4" value="5" disabled {{ $feedback->satisfaction_4 == 5 ? 'checked' : '' }}>
                    <label for="sqd4-5">
                        <img src="{{ asset('images/icons/5.png') }}" alt="Very Satisfied"
                            style="width: 50px; height: 50px;">
                    </label>
                    <div style="margin-top: 10px;">Very Satisfied</div>
                </div>

                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd4-4" name="satisfaction_4" value="4" disabled {{ $feedback->satisfaction_4 == 4 ? 'checked' : '' }}>
                    <label for="sqd4-4">
                        <img src="{{ asset('images/icons/4.png') }}" alt="Satisfied"
                            style="width: 50px; height: 50px;">
                    </label>
                    <div style="margin-top: 10px;">Satisfied</div>
                </div>

                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd4-3" name="satisfaction_4" value="3" disabled {{ $feedback->satisfaction_4 == 3 ? 'checked' : '' }}>
                    <label for="sqd4-3">
                        <img src="{{ asset('images/icons/3.png') }}" alt="Neutral"
                            style="width: 50px; height: 50px;">
                    </label>
                    <div style="margin-top: 10px;">Neutral</div>
                </div>

                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd4-2" name="satisfaction_4" value="2" disabled {{ $feedback->satisfaction_4 == 2 ? 'checked' : '' }}>
                    <label for="sqd4-2">
                        <img src="{{ asset('images/icons/2.png') }}" alt="Dissatisfied"
                            style="width: 50px; height: 50px;">
                    </label>
                    <div style="margin-top: 10px;">Dissatisfied</div>
                </div>

                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd4-1" name="satisfaction_4" value="1" disabled {{ $feedback->satisfaction_4 == 1 ? 'checked' : '' }}>
                    <label for="sqd4-1">
                        <img src="{{ asset('images/icons/1.png') }}" alt="Very Dissatisfied"
                            style="width: 50px; height: 50px;">
                    </label>
                    <div style="margin-top: 10px;">Very Dissatisfied</div>
                </div>

                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd4-0" name="satisfaction_4" value="0" disabled {{ $feedback->satisfaction_4 == 0 ? 'checked' : '' }}>
                    <label for="sqd4-0">
                        <p>N/A</p>
                    </label>
                    <div style="margin-top: 10px;">Not Applicable</div>
                </div>

            </div>
        </div>

        <!-- SQD5 -->
        <div class="emotes sqd5">
            <div class="title">
                <span style="font-weight: bold; margin-right: 20px;">SQD5</span> I paid a reasonable amount for my
                transaction. (If the service was provided for free, press N/A).
            </div>
            <div class="choices">
                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd5-5" name="satisfaction_5" value="5" disabled {{ $feedback->satisfaction_5 == 5 ? 'checked' : '' }}>
                    <label for="sqd5-5">
                        <img src="{{ asset('images/icons/5.png') }}" alt="Very Satisfied"
                            style="width: 50px; height: 50px;">
                    </label>
                    <div style="margin-top: 10px;">Very Satisfied</div>
                </div>

                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd5-4" name="satisfaction_5" value="4" disabled {{ $feedback->satisfaction_5 == 4 ? 'checked' : '' }}>
                    <label for="sqd5-4">
                        <img src="{{ asset('images/icons/4.png') }}" alt="Satisfied"
                            style="width: 50px; height: 50px;">
                    </label>
                    <div style="margin-top: 10px;">Satisfied</div>
                </div>

                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd5-3" name="satisfaction_5" value="3" disabled {{ $feedback->satisfaction_5 == 3 ? 'checked' : '' }}>
                    <label for="sqd5-3">
                        <img src="{{ asset('images/icons/3.png') }}" alt="Neutral"
                            style="width: 50px; height: 50px;">
                    </label>
                    <div style="margin-top: 10px;">Neutral</div>
                </div>

                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd5-2" name="satisfaction_5" value="2" disabled {{ $feedback->satisfaction_5 == 2 ? 'checked' : '' }}>
                    <label for="sqd5-2">
                        <img src="{{ asset('images/icons/2.png') }}" alt="Dissatisfied"
                            style="width: 50px; height: 50px;">
                    </label>
                    <div style="margin-top: 10px;">Dissatisfied</div>
                </div>

                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd5-1" name="satisfaction_5" value="1" disabled {{ $feedback->satisfaction_5 == 1 ? 'checked' : '' }}>
                    <label for="sqd5-1">
                        <img src="{{ asset('images/icons/1.png') }}" alt="Very Dissatisfied"
                            style="width: 50px; height: 50px;">
                    </label>
                    <div style="margin-top: 10px;">Very Dissatisfied</div>
                </div>

                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd5-0" name="satisfaction_5" value="0" disabled {{ $feedback->satisfaction_5 == 0 ? 'checked' : '' }}>
                    <label for="sqd5-0">
                        <p>N/A</p>
                    </label>
                    <div style="margin-top: 10px;">Not Applicable</div>
                </div>

            </div>
        </div>

        <!-- SQD6 -->
        <div class="emotes sqd6">
            <div class="title">
                <span style="font-weight: bold; margin-right: 20px;">SQD6</span> I feel that the office is fair to
                everyone, or "there is no favoritism," in my transaction.
            </div>
            <div class="choices">
                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd6-5" name="satisfaction_6" value="5" disabled {{ $feedback->satisfaction_6 == 5 ? 'checked' : '' }}>
                    <label for="sqd6-5">
                        <img src="{{ asset('images/icons/5.png') }}" alt="Very Satisfied"
                            style="width: 50px; height: 50px;">
                    </label>
                    <div style="margin-top: 10px;">Very Satisfied</div>
                </div>

                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd6-4" name="satisfaction_6" value="4" disabled {{ $feedback->satisfaction_6 == 4 ? 'checked' : '' }}>
                    <label for="sqd6-4">
                        <img src="{{ asset('images/icons/4.png') }}" alt="Satisfied"
                            style="width: 50px; height: 50px;">
                    </label>
                    <div style="margin-top: 10px;">Satisfied</div>
                </div>

                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd6-3" name="satisfaction_6" value="3" disabled {{ $feedback->satisfaction_6 == 3 ? 'checked' : '' }}>
                    <label for="sqd6-3">
                        <img src="{{ asset('images/icons/3.png') }}" alt="Neutral"
                            style="width: 50px; height: 50px;">
                    </label>
                    <div style="margin-top: 10px;">Neutral</div>
                </div>

                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd6-2" name="satisfaction_6" value="2" disabled {{ $feedback->satisfaction_6 == 2 ? 'checked' : '' }}>
                    <label for="sqd6-2">
                        <img src="{{ asset('images/icons/2.png') }}" alt="Dissatisfied"
                            style="width: 50px; height: 50px;">
                    </label>
                    <div style="margin-top: 10px;">Dissatisfied</div>
                </div>

                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd6-1" name="satisfaction_6" value="1" disabled {{ $feedback->satisfaction_6 == 1 ? 'checked' : '' }}>
                    <label for="sqd6-1">
                        <img src="{{ asset('images/icons/1.png') }}" alt="Very Dissatisfied"
                            style="width: 50px; height: 50px;">
                    </label>
                    <div style="margin-top: 10px;">Very Dissatisfied</div>
                </div>

                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd6-0" name="satisfaction_6" value="0" disabled {{ $feedback->satisfaction_6 == 0 ? 'checked' : '' }}>
                    <label for="sqd6-0">
                        <p>N/A</p>
                    </label>
                    <div style="margin-top: 10px;">Not Applicable</div>
                </div>

            </div>
        </div>

        <!-- SQD7 -->
        <div class="emotes sqd7">
            <div class="title">
                <span style="font-weight: bold; margin-right: 20px;">SQD7</span> I was treated politely by the
                staff, and (in case I asked for help) I know they are willing to assist me.
            </div>
            <div class="choices">
                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd7-5" name="satisfaction_7" value="5" disabled {{ $feedback->satisfaction_7 == 5 ? 'checked' : '' }}>
                    <label for="sqd7-5">
                        <img src="{{ asset('images/icons/5.png') }}" alt="Very Satisfied"
                            style="width: 50px; height: 50px;">
                    </label>
                    <div style="margin-top: 10px;">Very Satisfied</div>
                </div>

                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd7-4" name="satisfaction_7" value="4" disabled {{ $feedback->satisfaction_7 == 4 ? 'checked' : '' }}>
                    <label for="sqd7-4">
                        <img src="{{ asset('images/icons/4.png') }}" alt="Satisfied"
                            style="width: 50px; height: 50px;">
                    </label>
                    <div style="margin-top: 10px;">Satisfied</div>
                </div>

                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd7-3" name="satisfaction_7" value="3" disabled {{ $feedback->satisfaction_7 == 3 ? 'checked' : '' }}>
                    <label for="sqd7-3">
                        <img src="{{ asset('images/icons/3.png') }}" alt="Neutral"
                            style="width: 50px; height: 50px;">
                    </label>
                    <div style="margin-top: 10px;">Neutral</div>
                </div>

                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd7-2" name="satisfaction_7" value="2" disabled {{ $feedback->satisfaction_7 == 2 ? 'checked' : '' }}>
                    <label for="sqd7-2">
                        <img src="{{ asset('images/icons/2.png') }}" alt="Dissatisfied"
                            style="width: 50px; height: 50px;">
                    </label>
                    <div style="margin-top: 10px;">Dissatisfied</div>
                </div>

                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd7-1" name="satisfaction_7" value="1" disabled {{ $feedback->satisfaction_7 == 1 ? 'checked' : '' }}>
                    <label for="sqd7-1">
                        <img src="{{ asset('images/icons/1.png') }}" alt="Very Dissatisfied"
                            style="width: 50px; height: 50px;">
                    </label>
                    <div style="margin-top: 10px;">Very Dissatisfied</div>
                </div>

                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd7-0" name="satisfaction_7" value="0" disabled {{ $feedback->satisfaction_7 == 0 ? 'checked' : '' }}>
                    <label for="sqd7-0">
                        <p>N/A</p>
                    </label>
                    <div style="margin-top: 10px;">Not Applicable</div>
                </div>

            </div>
        </div>

        <!-- SQD8 -->
        <div class="emotes sqd8">
            <div class="title">
                <span style="font-weight: bold; margin-right: 20px;">SQD8</span> I received what I needed from the
                government office, and if it was denied, it was sufficiently explained to me.
            </div>
            <div class="choices">
                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd8-5" name="satisfaction_8" value="5" disabled {{ $feedback->satisfaction_8 == 5 ? 'checked' : '' }}>
                    <label for="sqd8-5">
                        <img src="{{ asset('images/icons/5.png') }}" alt="Very Satisfied"
                            style="width: 50px; height: 50px;">
                    </label>
                    <div style="margin-top: 10px;">Very Satisfied</div>
                </div>

                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd8-4" name="satisfaction_8" value="4" disabled {{ $feedback->satisfaction_8 == 4 ? 'checked' : '' }}>
                    <label for="sqd8-4">
                        <img src="{{ asset('images/icons/4.png') }}" alt="Satisfied"
                            style="width: 50px; height: 50px;">
                    </label>
                    <div style="margin-top: 10px;">Satisfied</div>
                </div>

                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd8-3" name="satisfaction_8" value="3" disabled {{ $feedback->satisfaction_8 == 3 ? 'checked' : '' }}>
                    <label for="sqd8-3">
                        <img src="{{ asset('images/icons/3.png') }}" alt="Neutral"
                            style="width: 50px; height: 50px;">
                    </label>
                    <div style="margin-top: 10px;">Neutral</div>
                </div>

                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd8-2" name="satisfaction_8" value="2" disabled {{ $feedback->satisfaction_8 == 2 ? 'checked' : '' }}>
                    <label for="sqd8-2">
                        <img src="{{ asset('images/icons/2.png') }}" alt="Dissatisfied"
                            style="width: 50px; height: 50px;">
                    </label>
                    <div style="margin-top: 10px;">Dissatisfied</div>
                </div>

                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd8-1" name="satisfaction_8" value="1" disabled {{ $feedback->satisfaction_8 == 1 ? 'checked' : '' }}>
                    <label for="sqd8-1">
                        <img src="{{ asset('images/icons/1.png') }}" alt="Very Dissatisfied"
                            style="width: 50px; height: 50px;">
                    </label>
                    <div style="margin-top: 10px;">Very Dissatisfied</div>
                </div>

                <div style="text-align: center;" class="emotes-flex">
                    <input type="radio" id="sqd8-0" name="satisfaction_8" value="0" disabled
                        {{ $feedback->satisfaction_8 == 0 ? 'checked' : '' }}>
                    <label for="sqd8-0">
                        <p>N/A</p>
                    </label>
                    <div style="margin-top: 10px;">Not Applicable</div>
                </div>

            </div>
        </div>
    </div>

    <br>
    <div style="margin-top: 10px;">
        <label for="optional">
            <h3>Suggestions on how we can further improve our services (optional):</h3>
        </label> <br>
        <textarea name="optional" id="optional" cols="30" rows="10"
            style="width: 100%; resize:none; padding: 1em;" disabled>{{ $feedback->optional }}</textarea>
    </div>

</x-admin.body>
