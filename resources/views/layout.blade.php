<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Faculdade</title>
    <link href="{{ asset('css/estilo.css') }}" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-dark bg-dark">
        @guest
            <a class="navbar-brand" href="/inicio">
                Faculdade
            </a>
        @endguest
            @auth
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="/inicio" class="nav-link">INÍCIO</a>
                    </li>
                </ul>
            @endauth
        @auth
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="/sair" class="nav-link">SAIR</a>
                </li>
            </ul>
        @endauth
        @guest
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="/entrar" class="nav-link">ENTRAR</a>
                </li>
            </ul>
        @endguest
    </nav>

    <div class="container">
        <div class="jumbotron mt-2">
            <h1>@yield('cabecalho')</h1>
        </div>
        @yield('conteudo')
    </div>
</body>
</html>
