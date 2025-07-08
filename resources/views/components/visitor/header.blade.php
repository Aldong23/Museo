<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    * {
        margin: 0;
        padding: 0;
        text-decoration: none;
        font-family: 'Inter';
    }

    nav {
        background: #DC3546;
        color: white;
        width: 100%;
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
    }

    main {
        padding: 2em 3em;
    }

    input,
    select {
        padding: 1em;
    }

    img{
        height: 70px;
    }

    @media (max-width: 640px) {

        .my-headings {
            font-size: 8px;
        }

        img{
            height: 30px;
        }
        
    }
</style>

<nav>
    <div>
        <img src="{{ asset('images/icons/city-of-urdaneta.png') }}" alt="">
    </div>

    <div class="my-headings">
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
    </div>

    <div>
        <img src="{{ asset('images/icons/urdaneta-logo.png') }}" alt="">
    </div>
</nav>
