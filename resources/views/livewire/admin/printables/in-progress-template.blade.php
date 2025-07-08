<div id="print-section">
    <header style="display: flex; justify-content: center; align-items: center; padding-bottom: 20px;">
        <div>
            <img src="{{ asset('images/icons/city-of-urdaneta.png') }}" alt="Image 1" style="height: 60px;">
        </div>
        <div>
            <img src="{{ asset('images/icons/urdaneta-logo.png') }}" alt="Image 2" style="height: 60px;">
        </div>

        <h1 class="text-xl font-bold">City Tourism Office </h1>
    </header>

    <hr>

    <br>
    <main>
        <section>
            <h3 style="text-align: center;">Acknowledgement Recepient</h3> <br>

            <div class="indent">
                This is to acknowledge that <span id="conservatorName">John Ruskin Saluria</span>,
                restoring the <span id="artifactName">World Trees Magic</span> at City Museum, Urdaneta City
                Cultural and Sport Complex.
            </div>
            <br>

            <div class="indent">
                <h5>Conservation Status item: </h5>

                <ul>
                    <li id="conservationStatus" style="width: 100%;"></li>
                </ul>
            </div>

            <br>
            <div class="indent">
                Released this <span id="day">19th</span> day of <span id="monthAndYear">January 2025</span>
                at City Tourism Office, LGU Urdaneta.
            </div>
            <br>


            <div>
                <h5 class="indent">Attachment Images</h5>

                <div>
                    <p>Before Restoring</p>
                    <div id="image-container" class="image-container"
                        style="display: flex; align-items: center; gap: 5px; flex-wrap: wrap;">

                    </div>
                </div>
            </div>

            <br>
            <div id="remarks-cont">
                Remarks
                <p style="font-size: 12px;" id="remarks">

                </p>
            </div>

            <br>
            <br>
            <div style="font-size: 14px;">
                Released by:
                <p style="text-decoration: underline; margin: 0;">
                    {{ Auth::user()->fname . ' ' . Auth::user()->mname . ' ' . Auth::user()->lname }}
                </p>
                <p style="margin-top: 0;">Clerical, Inspection and Communication Section</p>
            </div>

            <br>

            <div style="font-size: 14px;">
                Approved by:
                <p style="text-decoration: underline; margin: 0;">Aron Jimenez</p>
                <p style="margin-top: 0;">City Tourism Officer</p>
            </div>

            <br>

            <div
                style="position: absolute; bottom: 20px; left: 50%; transform: translate(-50%); width: 100%; padding: 0 2rem;">
                <hr>
                <p style="text-align: center; font-size: 9px; margin: 0;">1/F Cultural and Sports, Amadeo R. Pereze
                    Jr. Avenue Brgy. Poblacion, Urdaneta City University, Pangasinan 2428
                </p>
                <p style="text-align: center; font-size: 9px; margin: 0;">Website: www.urdaneta-city.gov.ph Email:
                    urdanetacitytourism@gmail.com Facebook: Urdaneta Tourism Contact No: 075-600-5231/0917-836-5748
                </p>
            </div>
        </section>
    </main>
</div>

@script
    <script>
        $wire.on('print-page', () => {
            let printContent = document.getElementById('print-section').innerHTML;
            let originalContent = document.body.innerHTML;

            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = originalContent;
            location.reload();
        });
    </script>
@endscript
