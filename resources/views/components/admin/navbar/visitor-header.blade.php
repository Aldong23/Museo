<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        * {
            margin: 0;
            padding: 0;
            text-decoration: none;
            font-family: 'Inter'
        }
        nav {
            background: #DC3546;
            color: white;

            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 2em;
        }

        nav a {
            color: white;
        }

        .sub_header {
            padding: 1em 3em;
            box-shadow: 0 4px 10px 0 rgb(173, 173, 173);
            background: white;

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        main {
            padding: 2em 3em;
        }

        input, select {
            padding: 1em;
        }

        @media only screen and (max-width: 768px) {
            .urda, .heading {
                display: none;
            }

            .sub_header {
                justify-content: center;
            }

            main {
                padding: 1em;
            }
        }
    </style>

    <nav>
       <div>
            <img class="urda" src="{{ asset('images/icons/city-of-urdaneta.png') }}" alt="" style="height: 70px;">
       </div>

       <div>
            <h2>Museo De Urdaneta</h2>
            <p>Alexander St, Urdaneta, Pangasinan</p>
            <a href="mailto:urdanetacitytourism2023@gmail.com">
                <p>Email: urdanetacitytourism2023@gmail.com</p>
            </a>

            <p>
                <span>
                    <a href="tel:6005231">Telephone No.: 600-5231 |</a> <a href="tel:0950046154"> Phone No.: 0950-0461-154</a>
                </span>
            </p>

            <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                <div style="display: flex; align-items:center; justify-content:center; gap: 10px;">
                    <img src="{{ asset('images/icons/icons8-facebook-48.png') }}" alt="">
                    <label for="">UrdanetaCityTourismOfficial</label>
                </div>

                <div style="display: flex; align-items:center; justify-content:center; gap: 10px;">
                    <img src="{{ asset('images/icons/icons8-youtube-48.png') }}" alt="">
                    <label for="">@Urdaneta-City-Tourism</label>
                </div>
            </div>
       </div>

       <div >
            <img class="urda" src="{{ asset('images/icons/urdaneta-logo.png') }}" alt="" style="height: 70px;">
       </div>


    </nav>

    @props(['heading' => 'Form', 'isHidden' => true, 'val' ])
    <div class="sub_header">
       <div>
            <h3 class="heading" style="font-size: 34px;">
                {{ $heading }}
            </h3>
       </div>

       <div>
            
       </div>
    </div>

    <main>
        {{ $slot }}
    </main>

</body>
</html>

<script>
    window.onload = function() {

        let controlNum = localStorage.getItem('control_no');

        if (controlNum) {
            document.getElementById('controlInput').value = controlNum;
        }
    }
</script>
