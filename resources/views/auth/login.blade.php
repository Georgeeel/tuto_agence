@extends('base')

@section('titre', 'Se connecter')
@section('content')

<div class="mt-4 container">
    <!-- titre -->
    <h1>@yield('title')</h1>
    <!-- message flash -->
    @include('shared.flash')
    <form action="{{ route('login')}}" method="post" class="form-group vstack gap-2">
        @csrf 
        @include('shared.input',["class" => "col", "label" => "Email", "name" => "email", "type" => "email"])
        @include('shared.input',["class" => "col", "label" => "Mot de passe", "name" => "password", "type" => "password"])
        
        <div>
            <button class="btn btn-primary">Se connecter</button>
        </div>

    </form>
</div>


@endsection

