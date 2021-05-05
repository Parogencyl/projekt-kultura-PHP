<!doctype html>
<html lang="PL">

<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="/projekt-kultura/public/graphics/Logo.png" />

    <meta name="description" content="" />
    <meta name="author" content="Damian Bohonos" />
    <meta name="copyright" content="Copyright owner" />
    <meta name="keywords" content="" />
    <meta name="robots" content="follow" />

    <title> Projekt kultura </title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
        integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="/projekt-kultura/public/styles/normalize.css" rel="stylesheet">
    <link href="/projekt-kultura/public/styles/nav.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Bitter:ital,wght@0,400;0,700;1,400;1,700&family=Lora:ital,wght@1,400;1,700&display=swap"
        rel="stylesheet">

</head>

<body class="d-flex flex-column min-vh-100">
    <div id="app">
        <nav class="navbar navbar-expand-md bg-white shadow py-0 sticky-top">
            <div class="container">
                <a class="navbar-brand py-0" href="/projekt-kultura">
                    <img src="/projekt-kultura/public/graphics/Logo.png" alt="logo" style="height: 80px">
                </a>
                <button class="navbar-toggler my-3 navbar-light" style="border-color: gray;" type="button"
                    data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto text-uppercase"
                        style="font-family: 'Open Sans Condensed', sans-serif;">
                        <li class="nav-item text-md-left text-center mr-2">
                            <a class="nav-link pb-1" href="/projekt-kultura"> Aktualności </a>
                        </li>
                        <li class="nav-item text-md-left text-center mr-2">
                            <a class="nav-link pb-1" href="/projekt-kultura/?page=coursesShop"> Szkolenia </a>
                        </li>
                        <li class="nav-item text-md-left text-center mr-2">
                            <a class="nav-link pb-1" href="/projekt-kultura/?page=workshops"> Warsztaty </a>
                        </li>
                        <li class="nav-item text-md-left text-center mr-2">
                            <a class="nav-link pb-1" href="/projekt-kultura/?page=teams"> Zespoły </a>
                        </li>
                        <li class="nav-item text-md-left text-center mr-2">
                            <a class="nav-link pb-1" href="/projekt-kultura/?page=about"> Poznaj nas </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            <?php require_once("templates/pages/$page.php"); ?>
        </main>
    </div>

    <footer class="mt-auto" style="font-family: 'Open Sans Condensed', sans-serif; font-size:17px;">
        <div class="container mb-4">
            <hr class="mt-4">
            <div class="justify-content-center d-flex align-items-center social pt-3">
                <a href="https://www.facebook.com/ProjektKultura2020" target="_blank" class="mx-4 fb">
                    <i class="fab fa-facebook-square"></i>
                </a>
                <div class="line"> </div>
                <a href="https://www.instagram.com/projekt_kultura/?hl=pl" class="mx-4 inst" target="_blank">
                    <i class="fab fa-instagram"></i>
                </a>
                <div class="line"> </div>
                <a href="#" class="mx-4 yt" target="_blank">
                    <i class="fab fa-youtube"></i>
                </a>
            </div>
        </div>
        <p class="mb-0 text-center text-dark font-weight-bold"> Copyright 2021. Wszelkie prawa zastrzeżone. </p>
    </footer>
</body>

</html>