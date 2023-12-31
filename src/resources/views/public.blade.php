<!doctype html>
<html lang="lv">

    <head>
        <meta charset="utf-8">
        <title>PD2 - {{ $title }}</title>
        <meta name="description" content="">
        <meta name ="viewport" content="width=device-width, initial-scale=1">
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
            crossorigin="anonymous"
        >

    </head>

    <body>
    <nav class="navbar bg-dark navbar-expand-md bg-primary mb-3" data-bs-theme="dark">
            <div class="container">
                <span class="navbar-brand mb-0 h1">PD2 - {{ $title }}</span>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="/">Sākumlapa</a>
                        </li>

                        @if(Auth::check())

                            <li class="nav-item">
                                <a class="nav-link" href="/movies">Filmas</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="/directors">Režisori</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="/genres">Žanri</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="/logout">Beigt darbu</a>
                            </li>

                        @else

                            <li class="nav-item">
                                <a class="nav-link" href="/login">Pieslēgties</a>
                            </li>

                        @endif

                    </ul>
                </div>
            </div>
        </nav>

        <main class="container">
            <div id="root"></div>
        </main>

        <footer class="mt-5 py-5">
            <div class="container">
                Rolands Safonovs, VeA, 2023
            </div>
        </footer>

        <script src="{{ asset('/js/app.js') }}"></script>
    </body>

</html>