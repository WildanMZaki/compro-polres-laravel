<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="./css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <style>
        main#opening {
            margin: 8% 0 0 0;
        }
        main#opening section {
            width: 50%;
        }
        main#opening .logo img {
            width: 200px;
            height: auto;
        }
        footer#fopening {
            position: fixed;
            bottom: 10%;
        }
        footer#fopening div { width: 25%; }

        @media (max-width: 660px) {
            main#opening {
                margin: 25% 0 0 0;
            }
            main#opening section {
                width: 90%;
            }
            footer#fopening div {
                width: 90%;
            }
        }
    </style>

</head>
<body class="bg-edark">

    <main id="opening" class="d-flex justify-content-center w-100">
        <section class="d-flex flex-column">
            <div class="logo w-100 text-center mb-4">
                <img src="{{ asset('img/blogo.png') }}" alt="Logo">
            </div>
            <div class="opening-msg container text-warning text-center">
                <p>Selamat Datang di website resmi Polres Subang. <br> Kami siap siaga melayani anda</p>
            </div>
        </section>
    </main>

    <footer id="fopening" class="d-flex justify-content-center w-100">
        <div>
            <div class="progress w-100">
                <div title="Memuat" class="progress-bar bg-warning text-dark" role="progressbar" aria-valuenow="0" aria-valuemin="0" style="width: 0;" aria-valuemax="100" id="progress"></div>
            </div>
        </div>
    </footer>

    <script>
        const redirect = url => location.href = url;
        const goHome = () => redirect(`{{ route('main') }}`);
        const changeWidth = w => {
            document.querySelector('#progress').style.width = `${w}%`;
            document.querySelector('#progress').innerText = `${w}%`;
        }
        function load() {
            var count = 0;
            var tid = setTimeout(mycode, 100);
            function mycode() {
                changeWidth(count);
                count++;
                tid = setTimeout(mycode, 100);
                if (count > 100) {
                    abortTimer();
                }
            }
            function abortTimer() {
                clearTimeout(tid);
                goHome();
            }
        }

        load();
    </script>
</body>
</html>
