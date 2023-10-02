@extends('base')

@section('title', $property->title)

@section('content')
<!-- description de biens -->
<div class="container mt-4">
    <div class="row">
        <div class="col-8">
            <div id="carousel" class="carousel slide" data-bs-ride="carousel" style="max-width: 800px ;">
            <div class="carousel-inner">
                <!-- liste pictures -->
                @foreach($property->pictures as $k => $picture)
                    <div class="carousel-item {{ $k == 0 ? 'active' : '' }}">
                        <img src="{{ $picture->getImageUrl(800,530) }}" alt="">
                    </div>
                @endforeach
            </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
        </div>
        </div>
        <div class="col-4">
            <h1>{{ $property->title }}</h1>
            <h2>{{ $property->rooms }} pièces - {{ $property->surface }}m²</h2>
            <div class="text-primary fw-bold">
                {{number_format($property->price, thousands_separator: ' ')}} €
            </div>
        </div>
    </div>

    <hr>
    <div class="mt-4">
        <h4>Interessé par ce biens?</h4>

        <!-- Message flash -->
        @include('shared.flash')


        <!-- formulaire contact -->
        <form action="{{ route('property.contact', $property)}}" method="post" class="vstack gap-3">
            @csrf
            <div class="row">
                @include('shared.input',["class" => "col", "name" => "firstname", "label"=> "Nom"])
                @include('shared.input',["class" => "col", "name" => "lastname", "label"=> "Prénom"])
            </div>
            <div class="row">
                @include('shared.input',["class" => "col", "type" => "email", "name" => "email", "label"=> "Email"])
                @include('shared.input',["class" => "col", "name" => "phone", "label"=> "Téléphone"])
            </div>
            @include('shared.input',["type" => "textarea", "name" => "message", "label"=> "Votre message"])
            <div>
                <button class="btn btn-primary" type="submit">Valider</button>
            </div>
        </form>
    </div>
    <div class="mt-4">
       <p>{{nl2br($property->description)}}</p> 
       <div class="row">
        <div class="col-8">
            <h2>Caractéristique</h2>
            <table class="table table-striped">
                <tr>
                    <td>Surface habitable</td>
                    <td>{{$property->surface}}</td>
                </tr>
                <tr>
                    <td>Pièces</td>
                    <td>{{$property->rooms}}</td>
                </tr>
                <tr>
                    <td>Chambres</td>
                    <td>{{$property->bedrooms}}</td>
                </tr>
                <tr>
                    <td>Etaje</td>
                    <td>{{$property->floor ?: 'Rez de chaussé'}}</td>
                </tr>
                <tr>
                    <td>Adresse</td>
                    <td>
                    {{$property->adress }} <br>
                    {{$property->city }} ({{$property->postal_code}})
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-4">
            <!-- options des biens -->
            <h2>Spécificités</h2>
            <ul class="list-group">
                @foreach($property->options as $option)
                    <li class="list-group-item">
                        {{ $option->name }}
                    </li>
                @endforeach
            </ul>
        </div>
       </div>
    </div>
</div>

@endsection