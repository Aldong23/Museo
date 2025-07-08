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

                    Tulungan mo kami mas mapabuti ang aming mga proseso at serbisyo
                </h1>
                <br>
                <p>
                    Ang Client Satisfaction Measurement (CSM) ay naglalayong masubaybayan ang karanasan ng taumbayan
                    hinggil sa kanilang pakikitransaksyon sa mga tanggapan ng gobyerno. Makakatulong ang inyong
                    kasagutan ukol sa inyong naging karanasan sa kakatapos lamang na transaksyon, upang mas mapabuti at
                    lalong mapahusay ang aming serbisyo publiko. Ang personal na impormasyon na iyong ibabahagi ay
                    mananatiling kumpidensyal. Maaari ring piliin na hindi sagutan ang sarbey na ito.
                </p>
            </div>

            <div class="inputs flex-col">
                <div class="flex">
                    <div>
                        <label for="">Uri ng Kliyente</label><br>
                        <select name="client" id="">
                            <option value="Citizen"
                                {{ $visitorRecord->client_type == 'Citizen' ? 'selected' : '' }}>Mamamayan
                            </option>
                            <option value="Business"
                                {{ $visitorRecord->client_type == 'Business' ? 'selected' : '' }}>Negosyo
                            </option>
                            <option value="Government (Employee or Agency)"
                                {{ $visitorRecord->client_type == 'Government (Employee or Agency)' ? 'selected' : '' }}>
                                Gobyerno (Empleyado o Ahensya)</option>
                        </select>
                    </div>
                    <div>
                        <label for="">Petsa</label><br>
                        <input type="date" id="dateInput" name="current_date" value="{{ $currentDate }}" disabled>
                    </div>
                </div>

                <div class="flex">
                    <div>
                        <label for="">Kasarian</label><br>
                        <select name="sex" id="">
                            <option value="Male" {{ $visitorRecord->visitor->sex == 'Lalaki' ? 'selected' : '' }}>Lalaki
                            </option>
                            <option value="Female" {{ $visitorRecord->visitor->sex == 'Babae' ? 'selected' : '' }}>Babae
                            </option>
                        </select>
                    </div>
                    <div>
                        <label for="">Edad</label><br>
                        <input type="text" value="{{ $visitorRecord->visitor->age }}" name="age">
                    </div>
                    <div>
                        <label for="">Relihiyon</label><br>
                        <input type="text" value="{{ $visitorRecord->visitor->religion }}" name="religion">
                    </div>
                    <div>
                        <label for="">Email Address</label><br>
                        <input type="text" value="{{ $visitorRecord->visitor->email }}" name="email">
                    </div>
                </div>
            </div>

            <div style="margin-top: 2em;">
                <label for="">Uri ng Transaksyon o serbisyo</label><br>
                <input value="{{  $visitorRecord->purpose }}" name="purpose" type="text"
                    style="width: 100%; padding: 1.5em; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;">
            </div>
        </div>

        {{-- CHECKBOXES --}}
        <div>

            <br><br>
            <div>
                <h3>
                    PANUTO: Lagyan ng tsek ( ) ang inyong sagot sa mga sumusunod na katanungan tungkol sa Citizen’s
                    Charter (CC). Ito ay isang opisyal na dokumento na naglalaman ng mga serbisyo sa isang ahensya /
                    opisina ng gobyerno, makikita rito ang mga kinakailangan ng dokumento, kaukulang bayarin, at
                    pangkabuuang oras ng pagproseso.
                </h3>
            </div>

            <div class="ccc">
                <div class="title">
                    <span style="font-weight:bold; margin-right: 20px;">CCC1</span> Alin sa mga sumusunod ang
                    naglalarawan sa inyong kaalaman sa CC?
                </div>

                <div class="choices">
                    <ol>
                        <div>
                            <input type="radio" name="q1" id="q1-1"
                                value="I know about CC, and I saw it in the office I visited">
                            <label for="q1-1">1. Alam ko ang CC at nakita ko ito sa napuntahang opisina.</label>
                        </div>

                        <div>
                            <input type="radio" name="q1" id="q1-2"
                                value="I know about CC, but I didn’t see it in the office I visited.">
                            <label for="q1-2">2. Alam ko ang CC pero hindi ko ito nakita sa napuntahang
                                opisina.</label>
                        </div>

                        <div>
                            <input type="radio" name="q1" id="q1-3"
                                value="I learned about CC when I saw it in the office I visited.">
                            <label for="q1-3">3. Nalaman ko ang CC nang makita ko ito sa napuntahang
                                opisina.</label>
                        </div>

                        <div>
                            <input type="radio" name="q1" id="q1-4"
                                value="I don’t know what CC is, and I didn’t see anything in the office I visited (Check ‘NA’).">
                            <label for="q1-4">4. Hindi ko alam kung ano ang CC at wala akong nakita sa napuntahang
                                opisina (Lagyan ng tsek ang ‘ NA ‘).</label>
                        </div>
                    </ol>
                </div>

            </div>

            <div class="ccc">
                <div class="title">
                    <span style="font-weight:bold; margin-right: 20px;">CCC2</span> Kung alam ang CC (Nag-tsek sa opsyon
                    1-3 sa CC1), masasabi mo ba na ang CC nang napuntahang opisina ay...
                </div>

                <div class="choices">
                    <ol>
                        <div>
                            <input type="radio" name="q2" id="q2-1" value="Easy to see">
                            <label for="q2-1">1. Madaling makita.</label>
                        </div>

                        <div>
                            <input type="radio" name="q2" id="q2-2" value="Somewhat easy to see">
                            <label for="q2-2">2. Medyo madaling makita.</label>
                        </div>

                        <div>
                            <input type="radio" name="q2" id="q2-3" value="Difficult to see">
                            <label for="q2-3">3. Mahirap makita.</label>
                        </div>

                        <div>
                            <input type="radio" name="q2" id="q2-4" value="Cannot be seen">
                            <label for="q2-4">4. Hindi makita.</label>
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
                    <span style="font-weight:bold; margin-right: 20px;">CCC3</span> Kung alam ang CC (Nag-tsek sa opsyon
                    1-3 sa CC1), gaano nakatulong ang CC sa transakyon mo?
                </div>

                <div class="choices">
                    <ol>
                        <div>
                            <input type="radio" name="q3" id="q3-1" value="Very helpful">
                            <label for="q3-1">1. Sobrang nakakatulong.</label>
                        </div>

                        <div>
                            <input type="radio" name="q3" id="q3-2" value="Somewhat helpful">
                            <label for="q3-2">2. Nakatulong naman.</label>
                        </div>

                        <div>
                            <input type="radio" name="q3" id="q3-3" value="Not helpful">
                            <label for="q3-3">3. Hindi nakatulong.</label>
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
                PANUTO: Para sa SQD 0-8, pumili na pinakaaangkop sa inyong sagot.
            </h3>

            <!-- SQD0 -->
            <div class="emotes sqd0">
                <div class="title">
                    <span style="font-weight: bold; margin-right: 20px;">SQD0</span> Nasiyahan ako sa serbisyo na aking
                    natanggap sa napuntahan na tanggapan.
                </div>
                <div class="choices">
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd0-5" name="satisfaction_0" value="5">
                        <label for="sqd0-5">
                            <img src="{{ asset('images/icons/5.png') }}" alt="Very Satisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Labis na sumasangayon</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd0-4" name="satisfaction_0" value="4">
                        <label for="sqd0-4">
                            <img src="{{ asset('images/icons/4.png') }}" alt="Satisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Sumasangayon</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd0-3" name="satisfaction_0" value="3">
                        <label for="sqd0-3">
                            <img src="{{ asset('images/icons/3.png') }}" alt="Neutral"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Walang kinikingan</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd0-2" name="satisfaction_0" value="2">
                        <label for="sqd0-2">
                            <img src="{{ asset('images/icons/2.png') }}" alt="Dissatisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Hindi sumasangayon</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd0-1" name="satisfaction_0" value="1">
                        <label for="sqd0-1">
                            <img src="{{ asset('images/icons/1.png') }}" alt="Very Dissatisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Lubos na hindi sumasangayon</div>
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
                    <span style="font-weight: bold; margin-right: 20px;">SQD1</span> Makatwiran ang oras na aking
                    ginugol sa pagproseso ng aking transakyon.
                </div>
                <div class="choices">
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd1-5" name="satisfaction_1" value="5">
                        <label for="sqd1-5">
                            <img src="{{ asset('images/icons/5.png') }}" alt="Very Satisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Labis na sumasangayon</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd1-4" name="satisfaction_1" value="4">
                        <label for="sqd1-4">
                            <img src="{{ asset('images/icons/4.png') }}" alt="Satisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Sumasangayon</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd1-3" name="satisfaction_1" value="3">
                        <label for="sqd1-3">
                            <img src="{{ asset('images/icons/3.png') }}" alt="Neutral"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Walang kinikingan</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd1-2" name="satisfaction_1" value="2">
                        <label for="sqd1-2">
                            <img src="{{ asset('images/icons/2.png') }}" alt="Dissatisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Hindi sumasangayon</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd1-1" name="satisfaction_1" value="1">
                        <label for="sqd1-1">
                            <img src="{{ asset('images/icons/1.png') }}" alt="Very Dissatisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Lubos na hindi sumasangayon</div>
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
                    <span style="font-weight: bold; margin-right: 20px;">SQD2</span> Ang opisina ay sumusunod sa mga
                    kinakailangang dokumento at mga hakbang batay sa impormasyong ibinigay.
                </div>
                <div class="choices">
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd2-5" name="satisfaction_2" value="5">
                        <label for="sqd2-5">
                            <img src="{{ asset('images/icons/5.png') }}" alt="Very Satisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Labis na sumasangayon</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd2-4" name="satisfaction_2" value="4">
                        <label for="sqd2-4">
                            <img src="{{ asset('images/icons/4.png') }}" alt="Satisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Sumasangayon</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd2-3" name="satisfaction_2" value="3">
                        <label for="sqd2-3">
                            <img src="{{ asset('images/icons/3.png') }}" alt="Neutral"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Walang kinikingan</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd2-2" name="satisfaction_2" value="2">
                        <label for="sqd2-2">
                            <img src="{{ asset('images/icons/2.png') }}" alt="Dissatisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Hindi sumasangayon</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd2-1" name="satisfaction_2" value="1">
                        <label for="sqd2-1">
                            <img src="{{ asset('images/icons/1.png') }}" alt="Very Dissatisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Lubos na hindi sumasangayon</div>
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
                    <span style="font-weight: bold; margin-right: 20px;">SQD3</span> Ang mga hakbang sa pagproseso,
                    kasama naang pagbayad ay madali at simple lamang.
                </div>
                <div class="choices">
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd3-5" name="satisfaction_3" value="5">
                        <label for="sqd3-5">
                            <img src="{{ asset('images/icons/5.png') }}" alt="Very Satisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Labis na sumasangayon</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd3-4" name="satisfaction_3" value="4">
                        <label for="sqd3-4">
                            <img src="{{ asset('images/icons/4.png') }}" alt="Satisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Sumasangayon</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd3-3" name="satisfaction_3" value="3">
                        <label for="sqd3-3">
                            <img src="{{ asset('images/icons/3.png') }}" alt="Neutral"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Walang kinikingan</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd3-2" name="satisfaction_3" value="2">
                        <label for="sqd3-2">
                            <img src="{{ asset('images/icons/2.png') }}" alt="Dissatisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Hindi sumasangayon</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd3-1" name="satisfaction_3" value="1">
                        <label for="sqd3-1">
                            <img src="{{ asset('images/icons/1.png') }}" alt="Very Dissatisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Lubos na hindi sumasangayon</div>
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
                    <span style="font-weight: bold; margin-right: 20px;">SQD4</span> Mabilis at madali akong nakahanap
                    ng impormasyon tungkol sa aking transaksyon mula sa opisina sa lahat, o sa website nito.
                </div>
                <div class="choices">
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd4-5" name="satisfaction_4" value="5">
                        <label for="sqd4-5">
                            <img src="{{ asset('images/icons/5.png') }}" alt="Very Satisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Labis na sumasangayon</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd4-4" name="satisfaction_4" value="4">
                        <label for="sqd4-4">
                            <img src="{{ asset('images/icons/4.png') }}" alt="Satisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Sumasangayon</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd4-3" name="satisfaction_4" value="3">
                        <label for="sqd4-3">
                            <img src="{{ asset('images/icons/3.png') }}" alt="Neutral"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Walang kinikingan</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd4-2" name="satisfaction_4" value="2">
                        <label for="sqd4-2">
                            <img src="{{ asset('images/icons/2.png') }}" alt="Dissatisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Hindi sumasangayon</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd4-1" name="satisfaction_4" value="1">
                        <label for="sqd4-1">
                            <img src="{{ asset('images/icons/1.png') }}" alt="Very Dissatisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Lubos na hindi sumasangayon</div>
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
                    <span style="font-weight: bold; margin-right: 20px;">SQD5</span> Nagbayad ako ngmakatwirang halaga
                    para sa aking transaksyon. (Kung ang serbisyo ay ibinigay ng libre, pindutin ang N/A).
                </div>
                <div class="choices">
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd5-5" name="satisfaction_5" value="5">
                        <label for="sqd5-5">
                            <img src="{{ asset('images/icons/5.png') }}" alt="Very Satisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Labis na sumasangayon</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd5-4" name="satisfaction_5" value="4">
                        <label for="sqd5-4">
                            <img src="{{ asset('images/icons/4.png') }}" alt="Satisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Sumasangayon</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd5-3" name="satisfaction_5" value="3">
                        <label for="sqd5-3">
                            <img src="{{ asset('images/icons/3.png') }}" alt="Neutral"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Walang kinikingan</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd5-2" name="satisfaction_5" value="2">
                        <label for="sqd5-2">
                            <img src="{{ asset('images/icons/2.png') }}" alt="Dissatisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Hindi sumasangayon</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd5-1" name="satisfaction_5" value="1">
                        <label for="sqd5-1">
                            <img src="{{ asset('images/icons/1.png') }}" alt="Very Dissatisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Lubos na hindi sumasangayon</div>
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
                    <span style="font-weight: bold; margin-right: 20px;">SQD6</span> Pakiramdam ko ay patas ang opisina
                    sa lahat, o “walang palakasan”, sa aking transaksyon.
                </div>
                <div class="choices">
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd6-5" name="satisfaction_6" value="5">
                        <label for="sqd6-5">
                            <img src="{{ asset('images/icons/5.png') }}" alt="Very Satisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Labis na sumasangayon</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd6-4" name="satisfaction_6" value="4">
                        <label for="sqd6-4">
                            <img src="{{ asset('images/icons/4.png') }}" alt="Satisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Sumasangayon</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd6-3" name="satisfaction_6" value="3">
                        <label for="sqd6-3">
                            <img src="{{ asset('images/icons/3.png') }}" alt="Neutral"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Walang kinikingan</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd6-2" name="satisfaction_6" value="2">
                        <label for="sqd6-2">
                            <img src="{{ asset('images/icons/2.png') }}" alt="Dissatisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Hindi sumasangayon</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd6-1" name="satisfaction_6" value="1">
                        <label for="sqd6-1">
                            <img src="{{ asset('images/icons/1.png') }}" alt="Very Dissatisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Lubos na hindi sumasangayon</div>
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
                    <span style="font-weight: bold; margin-right: 20px;">SQD7</span> Magalang akong trinato ng mga
                    tauhan, at (kung sakali ako ay humingi ng tulong) alam ko na sila ay handang tumulong sa akin.
                </div>
                <div class="choices">
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd7-5" name="satisfaction_7" value="5">
                        <label for="sqd7-5">
                            <img src="{{ asset('images/icons/5.png') }}" alt="Very Satisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Labis na sumasangayon</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd7-4" name="satisfaction_7" value="4">
                        <label for="sqd7-4">
                            <img src="{{ asset('images/icons/4.png') }}" alt="Satisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Sumasangayon</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd7-3" name="satisfaction_7" value="3">
                        <label for="sqd7-3">
                            <img src="{{ asset('images/icons/3.png') }}" alt="Neutral"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Walang kinikingan</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd7-2" name="satisfaction_7" value="2">
                        <label for="sqd7-2">
                            <img src="{{ asset('images/icons/2.png') }}" alt="Dissatisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Hindi sumasangayon</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd7-1" name="satisfaction_7" value="1">
                        <label for="sqd7-1">
                            <img src="{{ asset('images/icons/1.png') }}" alt="Very Dissatisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Lubos na hindi sumasangayon</div>
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
                    <span style="font-weight: bold; margin-right: 20px;">SQD8</span> Nakuha ko ang kinakailangan ko
                    mula sa tanggapan ng gobyerno, kung tinanggihan man, ito ay sapat na ipinaliwanag sa akin.
                </div>
                <div class="choices">
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd8-5" name="satisfaction_8" value="5">
                        <label for="sqd8-5">
                            <img src="{{ asset('images/icons/5.png') }}" alt="Very Satisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Labis na sumasangayon</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd8-4" name="satisfaction_8" value="4">
                        <label for="sqd8-4">
                            <img src="{{ asset('images/icons/4.png') }}" alt="Satisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Sumasangayon</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd8-3" name="satisfaction_8" value="3">
                        <label for="sqd8-3">
                            <img src="{{ asset('images/icons/3.png') }}" alt="Neutral"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Walang kinikingan</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd8-2" name="satisfaction_8" value="2">
                        <label for="sqd8-2">
                            <img src="{{ asset('images/icons/2.png') }}" alt="Dissatisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Hindi sumasangayon</div>
                    </div>
                    <div style="text-align: center;" class="emotes-flex">
                        <input type="radio" id="sqd8-1" name="satisfaction_8" value="1">
                        <label for="sqd8-1">
                            <img src="{{ asset('images/icons/1.png') }}" alt="Very Dissatisfied"
                                style="width: 50px; height: 50px;">
                        </label>
                        <div style="margin-top: 10px;">Lubos na hindi sumasangayon</div>
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
                <h3>Mga suhestiyon kung paano pa mapapabuti pa ang aming mga serbisyo (opsyonal):</h3>
            </label> <br>
            <textarea name="optional" id="optional" cols="30" rows="10"
                style="width: 100%; resize:none; padding: 1em;"></textarea>
        </div>
        <br>

        <input type="text" name="lang" value="fil" style="display: none;">

        <button type="submit"
            style="padding: 1em 0; width: 150px; border:none; border-radius: 5px; background-color: #4B4A4A; color:white; font-size: 18px;">Ipasa</button>

        <input type="text" name="control_no" id="control" hidden>
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
