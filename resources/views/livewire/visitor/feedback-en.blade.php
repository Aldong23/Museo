<style>
    .header {
        text-align: center;
        margin-bottom: 2em;
    }

    .flex {
        display: flex;
        flex-wrap: wrap;
        gap: 1em;
    }

    .flex-col {
        display: flex;
        flex-direction: column;
        gap: 1em;
    }

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

    /* Responsive design */
    @media screen and (min-width: 768px) {
        .flex>div {
            flex: 1;
            /* Distribute space equally */
        }
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
        display: flex;
        /* align-items: center; */
        justify-content: space-evenly;
        padding: 2em 0;

        flex-wrap: wrap;
        align-items: flex-start;
    }

    .emotes .choices label img {
        transition: all .5s ease;
        cursor: pointer;
    }

    .emotes .choices input[type="radio"] {
        opacity: 0;
    }

    .emotes .choices label img:hover {
        transform: scale(1.3);
    }

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
        display: flex;
        justify-content: center;
        flex-direction: column;
        flex: 1;
    }
</style>

<x-admin.navbar.visitor-header heading="Visitor Feedback" :isHidden="false">
    <form action="{{ route('feedback') }}" method="POST" id="feedbackForm">
        @csrf

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

            <div class="inputs flex-col">
                <div class="flex">
                    <div>
                        <label for="">Type of Client</label><br>
                        <select name="client" id="">
                            <option value="Citizen"
                                {{ $visitorRecord->client_type == 'Citizen' ? 'selected' : '' }}>Citizen</option>
                            <option value="Business"
                                {{ $visitorRecord->client_type == 'Business' ? 'selected' : '' }}>Business
                            </option>
                            <option value="Government (Employee or Agency)"
                                {{ $visitorRecord->client_type == 'Government (Employee or Agency)' ? 'selected' : '' }}>
                                Government (Employee or Agency)</option>
                        </select>
                    </div>
                    <div>
                        <label for="">Date</label><br>
                        <input type="date" id="dateInput" name="current_date" value="{{ $currentDate }}" disabled>
                    </div>
                </div>

                <div class="flex">
                    <div>
                        <label for="">Sex</label><br>
                        <select name="sex" id="">
                            <option value="Male" {{ $visitorRecord->visitor->sex == 'Lalaki' ? 'selected' : '' }}>Male
                            </option>
                            <option value="Female" {{ $visitorRecord->visitor->sex == 'Babae' ? 'selected' : '' }}>Female
                            </option>
                        </select>
                    </div>
                    <div>
                        <label for="">Age</label><br>
                        <input type="text" name="age" value="{{ $visitorRecord->visitor->age }}">
                    </div>
                    <div>
                        <label for="">Religion</label><br>
                        <input type="text" name="religion" value="{{ $visitorRecord->visitor->religion }}">
                    </div>
                    <div>
                        <label for="">Email Address</label><br>
                        <input type="text" name="email" value="{{ $visitorRecord->visitor->email }}">
                    </div>
                </div>
            </div>

            <div style="margin-top: 2em;">
                <label for="">Type of Transaction or Service</label><br>
                <input value="{{ $visitorRecord->purpose }}" name="purpose" type="text"
                    style="width: 100%; padding: 1.5em; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;">
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
                            <input type="radio" name="q1" id="q1-1"
                                value="I know about CC, and I saw it in the office I visited">
                            <label for="q1-1">1. I know about CC, and I saw it in the office I visited.</label>
                        </div>

                        <div>
                            <input type="radio" name="q1" id="q1-2"
                                value="I know about CC, but I didn’t see it in the office I visited">
                            <label for="q1-2">2. I know about CC, but I didn’t see it in the office I
                                visited.</label>
                        </div>

                        <div>
                            <input type="radio" name="q1" id="q1-3"
                                value="I learned about CC when I saw it in the office I visited">
                            <label for="q1-3">3. I learned about CC when I saw it in the office I visited.</label>
                        </div>

                        <div>
                            <input type="radio" name="q1" id="q1-4"
                                value="I don’t know what CC is, and I didn’t see anything in the office I visited (Check ‘NA’)">
                            <label for="q1-4">4. I don’t know what CC is, and I didn’t see anything in the office I
                                visited (Check ‘NA’).</label>
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
                            <input type="radio" name="q2" id="q2-1" value="Easy to see">
                            <label for="q2-1">1. Easy to see.</label>
                        </div>

                        <div>
                            <input type="radio" name="q2" id="q2-2" value="Somewhat easy to see">
                            <label for="q2-2">2. Somewhat easy to see.</label>
                        </div>

                        <div>
                            <input type="radio" name="q2" id="q2-3" value="Difficult to see">
                            <label for="q2-3">3. Difficult to see.</label>
                        </div>

                        <div>
                            <input type="radio" name="q2" id="q2-4" value="Cannot be seen">
                            <label for="q2-4">4. Cannot be seen.</label>
                        </div>

                        <div>
                            <input type="radio" name="q2" id="q2-5" value="N/A">
                            <label for="q2-5">5. N/A.</label>
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
                            <input type="radio" name="q3" id="q3-1" value="Very helpful">
                            <label for="q3-1">1. Very helpful.</label>
                        </div>

                        <div>
                            <input type="radio" name="q3" id="q3-2" value="Somewhat helpful">
                            <label for="q3-2">2. Somewhat helpful.</label>
                        </div>

                        <div>
                            <input type="radio" name="q3" id="q3-3" value="Not helpful">
                            <label for="q3-3">3. Not helpful.</label>
                        </div>

                        <div>
                            <input type="radio" name="q3" id="q3-4" value="N/A">
                            <label for="q3-4">4. N/A.</label>
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
                        <input type="radio" id="sqd0-5" name="satisfaction_0" value="5">
                        <label for="sqd0-5">
                            <img src="{{ asset('images/icons/5.png') }}" alt="Very Satisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Very Satisfied</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd0-4" name="satisfaction_0" value="4">
                        <label for="sqd0-4">
                            <img src="{{ asset('images/icons/4.png') }}" alt="Satisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Satisfied</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd0-3" name="satisfaction_0" value="3">
                        <label for="sqd0-3">
                            <img src="{{ asset('images/icons/3.png') }}" alt="Neutral"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Neutral</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd0-2" name="satisfaction_0" value="2">
                        <label for="sqd0-2">
                            <img src="{{ asset('images/icons/2.png') }}" alt="Dissatisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Dissatisfied</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd0-1" name="satisfaction_0" value="1">
                        <label for="sqd0-1">
                            <img src="{{ asset('images/icons/1.png') }}" alt="Very Dissatisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Very Dissatisfied</div>
                    </div>

                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd0-0" name="satisfaction_0" value="0">
                        <label for="sqd0-0">
                            <p>
                                N/A
                            </p>
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
                        <input type="radio" id="sqd1-5" name="satisfaction_1" value="5">
                        <label for="sqd1-5">
                            <img src="{{ asset('images/icons/5.png') }}" alt="Very Satisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Very Satisfied</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd1-4" name="satisfaction_1" value="4">
                        <label for="sqd1-4">
                            <img src="{{ asset('images/icons/4.png') }}" alt="Satisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Satisfied</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd1-3" name="satisfaction_1" value="3">
                        <label for="sqd1-3">
                            <img src="{{ asset('images/icons/3.png') }}" alt="Neutral"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Neutral</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd1-2" name="satisfaction_1" value="2">
                        <label for="sqd1-2">
                            <img src="{{ asset('images/icons/2.png') }}" alt="Dissatisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Dissatisfied</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd1-1" name="satisfaction_1" value="1">
                        <label for="sqd1-1">
                            <img src="{{ asset('images/icons/1.png') }}" alt="Very Dissatisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Very Dissatisfied</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd1-0" name="satisfaction_1" value="0">
                        <label for="sqd1-0">
                            <p>
                                N/A
                            </p>
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
                        <input type="radio" id="sqd2-5" name="satisfaction_2" value="5">
                        <label for="sqd2-5">
                            <img src="{{ asset('images/icons/5.png') }}" alt="Very Satisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Very Satisfied</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd2-4" name="satisfaction_2" value="4">
                        <label for="sqd2-4">
                            <img src="{{ asset('images/icons/4.png') }}" alt="Satisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Satisfied</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd2-3" name="satisfaction_2" value="3">
                        <label for="sqd2-3">
                            <img src="{{ asset('images/icons/3.png') }}" alt="Neutral"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Neutral</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd2-2" name="satisfaction_2" value="2">
                        <label for="sqd2-2">
                            <img src="{{ asset('images/icons/2.png') }}" alt="Dissatisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Dissatisfied</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd2-1" name="satisfaction_2" value="1">
                        <label for="sqd2-1">
                            <img src="{{ asset('images/icons/1.png') }}" alt="Very Dissatisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Very Dissatisfied</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd2-0" name="satisfaction_2" value="0">
                        <label for="sqd2-0">
                            <p>
                                N/A
                            </p>
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
                        <input type="radio" id="sqd3-5" name="satisfaction_3" value="5">
                        <label for="sqd3-5">
                            <img src="{{ asset('images/icons/5.png') }}" alt="Very Satisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Very Satisfied</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd3-4" name="satisfaction_3" value="4">
                        <label for="sqd3-4">
                            <img src="{{ asset('images/icons/4.png') }}" alt="Satisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Satisfied</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd3-3" name="satisfaction_3" value="3">
                        <label for="sqd3-3">
                            <img src="{{ asset('images/icons/3.png') }}" alt="Neutral"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Neutral</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd3-2" name="satisfaction_3" value="2">
                        <label for="sqd3-2">
                            <img src="{{ asset('images/icons/2.png') }}" alt="Dissatisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Dissatisfied</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd3-1" name="satisfaction_3" value="1">
                        <label for="sqd3-1">
                            <img src="{{ asset('images/icons/1.png') }}" alt="Very Dissatisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Very Dissatisfied</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd3-0" name="satisfaction_3" value="0">
                        <label for="sqd3-0">
                            <p>
                                N/A
                            </p>
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
                        <input type="radio" id="sqd4-5" name="satisfaction_4" value="5">
                        <label for="sqd4-5">
                            <img src="{{ asset('images/icons/5.png') }}" alt="Very Satisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Very Satisfied</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd4-4" name="satisfaction_4" value="4">
                        <label for="sqd4-4">
                            <img src="{{ asset('images/icons/4.png') }}" alt="Satisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Satisfied</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd4-3" name="satisfaction_4" value="3">
                        <label for="sqd4-3">
                            <img src="{{ asset('images/icons/3.png') }}" alt="Neutral"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Neutral</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd4-2" name="satisfaction_4" value="2">
                        <label for="sqd4-2">
                            <img src="{{ asset('images/icons/2.png') }}" alt="Dissatisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Dissatisfied</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd4-1" name="satisfaction_4" value="1">
                        <label for="sqd4-1">
                            <img src="{{ asset('images/icons/1.png') }}" alt="Very Dissatisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Very Dissatisfied</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd4-0" name="satisfaction_4" value="0">
                        <label for="sqd4-0">
                            <p>
                                N/A
                            </p>
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
                        <input type="radio" id="sqd5-5" name="satisfaction_5" value="5">
                        <label for="sqd5-5">
                            <img src="{{ asset('images/icons/5.png') }}" alt="Very Satisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Very Satisfied</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd5-4" name="satisfaction_5" value="4">
                        <label for="sqd5-4">
                            <img src="{{ asset('images/icons/4.png') }}" alt="Satisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Satisfied</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd5-3" name="satisfaction_5" value="3">
                        <label for="sqd5-3">
                            <img src="{{ asset('images/icons/3.png') }}" alt="Neutral"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Neutral</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd5-2" name="satisfaction_5" value="2">
                        <label for="sqd5-2">
                            <img src="{{ asset('images/icons/2.png') }}" alt="Dissatisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Dissatisfied</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd5-1" name="satisfaction_5" value="1">
                        <label for="sqd5-1">
                            <img src="{{ asset('images/icons/1.png') }}" alt="Very Dissatisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Very Dissatisfied</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd5-0" name="satisfaction_5" value="0">
                        <label for="sqd5-0">
                            <p>
                                N/A
                            </p>
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
                        <input type="radio" id="sqd6-5" name="satisfaction_6" value="5">
                        <label for="sqd6-5">
                            <img src="{{ asset('images/icons/5.png') }}" alt="Very Satisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Very Satisfied</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd6-4" name="satisfaction_6" value="4">
                        <label for="sqd6-4">
                            <img src="{{ asset('images/icons/4.png') }}" alt="Satisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Satisfied</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd6-3" name="satisfaction_6" value="3">
                        <label for="sqd6-3">
                            <img src="{{ asset('images/icons/3.png') }}" alt="Neutral"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Neutral</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd6-2" name="satisfaction_6" value="2">
                        <label for="sqd6-2">
                            <img src="{{ asset('images/icons/2.png') }}" alt="Dissatisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Dissatisfied</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd6-1" name="satisfaction_6" value="1">
                        <label for="sqd6-1">
                            <img src="{{ asset('images/icons/1.png') }}" alt="Very Dissatisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Very Dissatisfied</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd6-0" name="satisfaction_6" value="0">
                        <label for="sqd6-0">
                            <p>
                                N/A
                            </p>
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
                        <input type="radio" id="sqd7-5" name="satisfaction_7" value="5">
                        <label for="sqd7-5">
                            <img src="{{ asset('images/icons/5.png') }}" alt="Very Satisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Very Satisfied</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd7-4" name="satisfaction_7" value="4">
                        <label for="sqd7-4">
                            <img src="{{ asset('images/icons/4.png') }}" alt="Satisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Satisfied</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd7-3" name="satisfaction_7" value="3">
                        <label for="sqd7-3">
                            <img src="{{ asset('images/icons/3.png') }}" alt="Neutral"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Neutral</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd7-2" name="satisfaction_7" value="2">
                        <label for="sqd7-2">
                            <img src="{{ asset('images/icons/2.png') }}" alt="Dissatisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Dissatisfied</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd7-1" name="satisfaction_7" value="1">
                        <label for="sqd7-1">
                            <img src="{{ asset('images/icons/1.png') }}" alt="Very Dissatisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Very Dissatisfied</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd7-0" name="satisfaction_7" value="0">
                        <label for="sqd7-0">
                            <p>
                                N/A
                            </p>
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
                        <input type="radio" id="sqd8-5" name="satisfaction_8" value="5">
                        <label for="sqd8-5">
                            <img src="{{ asset('images/icons/5.png') }}" alt="Very Satisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Very Satisfied</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd8-4" name="satisfaction_8" value="4">
                        <label for="sqd8-4">
                            <img src="{{ asset('images/icons/4.png') }}" alt="Satisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Satisfied</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd8-3" name="satisfaction_8" value="3">
                        <label for="sqd8-3">
                            <img src="{{ asset('images/icons/3.png') }}" alt="Neutral"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Neutral</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd8-2" name="satisfaction_8" value="2">
                        <label for="sqd8-2">
                            <img src="{{ asset('images/icons/2.png') }}" alt="Dissatisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Dissatisfied</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd8-1" name="satisfaction_8" value="1">
                        <label for="sqd8-1">
                            <img src="{{ asset('images/icons/1.png') }}" alt="Very Dissatisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Very Dissatisfied</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd8-0" name="satisfaction_8" value="0">
                        <label for="sqd8-0">
                            <p>
                                N/A
                            </p>
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
                style="width: 100%; resize:none; padding: 1em;"></textarea>
        </div>
        <br>

        <input type="text" name="lang" value="en" style="display: none;">

        <button type="submit"
            style="padding: 1em 0; width: 150px; border:none; border-radius: 5px; background-color: #4B4A4A; color:white; font-size: 18px;">Submit</button>

        <input type="text" name="control_no" value="" id="control" hidden>
    </form>
</x-admin.navbar.visitor-header>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    let control_num = localStorage.getItem('control_no');
    if (control_num) {
        document.getElementById('control').value = control_num;
    }


    $(document).ready(function() {
        $('#feedbackForm').submit(function(event) {
            event.preventDefault();

            var formData = $(this).serialize();


            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        // Clear local storage
                        localStorage.clear();

                        // Show success alert
                        Swal.fire({
                            title: 'Thank you!',
                            text: 'Your feedback has been submitted successfully.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.href = '/feedback-success';
                            }
                        });
                    } else {
                        // Handle unexpected responses
                        Swal.fire({
                            title: 'Submission Error',
                            text: response.message || 'Something went wrong. Please try again.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function(xhr) {
                    let errorMessage = 'There was an issue submitting your feedback.';

                    // Check if it's a known error message from the server
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }

                    Swal.fire({
                        title: 'Submission Failed',
                        text: errorMessage,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });

        });
    });
</script>
