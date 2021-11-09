<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    {{-- Bootstrap --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.8.0/dist/css/uikit.min.css" />
    <!-- Styles -->
    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.8.0/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.8.0/dist/js/uikit-icons.min.js"></script>
    {{-- Bootstrap --}}
    <script src="{{ asset('js/app.js') }}"></script>
</head>

<body class="antialiased">
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">
                    <img class="icon" src="storage/icon.jpg" alt="">
                </a>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="ajouterPlante">Ajouter une plante</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="generationExcel">Générer le fichier excel</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="editerPlante">Gestion des plantes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="editerFichiers">Liste des fichiers</a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>
    </header>
@show
<div class="body">
    @yield('content')
</div>
<footer>

</footer>
</body>

</html>
