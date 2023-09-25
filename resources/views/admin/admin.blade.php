<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>@yield("title") | Administration</title>
    <!-- tom select -->
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.bootstrap5.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <style>
        /* style button nav-bar */
        @layer reset {
            button {
                all:unset;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-primary navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Agence</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toogler-icon"></span>
            </button>
            <!-- je recuper la route -->
            @php
                $route = request()->route()->getName();
            @endphp
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <!-- lien active si la route contient property. grace à la function str_contains -->
                        <a href="{{ route('admin.property.index')}}" @class(['nav-link', 'active' => str_contains($route, 'property.')])>Gérer les biens</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.option.index')}}" @class(['nav-link', 'active' => str_contains($route, 'option.')])>Gérer les options</a>
                    </li>
                </ul>
                <!-- button déconexion -->
                <div class="ms-auto">
                    @auth 
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="post">
                                @csrf 
                                @method('delete')
                                <button class="nav-link">Se deconnecter</button>
                            </form>
                        </li>
                    </ul>
                    @endauth
                </div>
            </div>
        </div>
    </nav>


    <div class="container mt-5">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif 
        <!-- dans le cas je suis rediriger sur la meme page et je vois pas les erreurs  -->
        <!-- message flash s'il ya des erreurs  -->
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="my-0">
                    <!-- ensemble des erreurs -->
                    @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </div>
    <script>
        // biblioteque tom select, system d'options qui as une interface 
        new TomSelect('select[multiple]',{plugins:{remove_button: {title: 'Supprimer'}}})
    </script>
    
</body>
</html>