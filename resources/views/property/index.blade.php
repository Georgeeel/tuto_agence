@extends('base')

@section('title','bien')

@section('content')

<div class="bg-light p-5  mb-5 text-center">  
    <form action="" method="get" class="container d-flex gap-2">
        <input type="number" class="form-control" name="price" placeholder="Budget max" value="{{ $input['price'] ?? '' }}">
        <input type="number" class="form-control" name="surface" placeholder="Surface " value="{{ $input['surface'] ?? '' }}">
        <input type="number" class="form-control" name="rooms" placeholder="Piéces  " value="{{ $input['rooms'] ?? '' }}">
        <input type="text" class="form-control" name="title" placeholder="Titre " value="{{ $input['title'] ?? '' }}">
        <button class="btn btn-primary flex-grow-0">Recherche</button>
    </form>
</div>


<div class="container">
    <div class="row mt-3">
        @forelse($properties as $property)
        <div class="col-3">
            @include('property.card')
        </div>
        @empty
        <div class="col fw-bold">
            Aucun bien correspond à votre recherche
        </div>
        @endforelse
    </div>
    <div class="my-3">
        {{ $properties->links() }}
    </div>
    
</div>

@endsection