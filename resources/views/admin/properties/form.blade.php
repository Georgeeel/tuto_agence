@extends('admin.admin')
<!-- titre dinamique -->
@section('title', $property->exists ? "Editer un bien" : "Créer un bien")

@section('content')

<h2>@yield('title')</h2>
<!-- action du formulaire éditer ou créer si la propriété exist je vais edit sinon créer -->
<!-- second parametre la entité property, ou il va extraire l'id du model et ajouter comme parametre dans cadre d'edition -->
<form class="vstack gap-2" action="{{ route($property->exists ? "admin.property.update" : "admin.property.store", $property) }}" method="post" enctype="multipart/form-data">
@csrf
@method($property->exists ? 'put' : 'post')
<div class="row">
    <div class="col" style="flex:100">
            <div class="row">
            @include('shared.input',["class" => "col", "label" => "Titre", "name" => "title", "value" => $property->title])
            <div class="col row">
                @include('shared.input',["class" => "col",  "name" => "surface", "value" => $property->surface])
                @include('shared.input',["class" => "col",  "name" => "price", "label"=> "Prix", "value" => $property->price])
            </div>
        </div>
        @include('shared.input',["type" => "textarea",  "name" => "description", "value" => $property->description])
        <div class="row">
            @include('shared.input',["class" => "col", "label" => "étage", "name" => "floor", "value" => $property->floor])
            @include('shared.input',["class" => "col",  "name" => "rooms", "label"=> "Piéces", "value" => $property->rooms])
            @include('shared.input',["class" => "col",  "name" => "bedrooms", "label"=> "Chambres", "value" => $property->bedrooms])
        </div>
        <div class="row">
            @include('shared.input',["class" => "col", "name" => "city", "label" => "Ville", "value" => $property->city])
            @include('shared.input',["class" => "col", "name" => "address", "label"=> "Adresse", "value" => $property->address])
            @include('shared.input',["class" => "col", "name" => "postal_code", "label"=> "Code postal", "value" => $property->postal_code])
        </div>
        <div class="">
            @include('shared.select',["name" => "options", "label"=> "Options", "value" => $property->options()->pluck('id'), 'multiple' => true])
            @include('shared.checkbox',["label" => "Vendu", "name" => "sold", "value" => $property->sold, 'options' => $options])
        </div>
    </div>
    <div class="col vstack gap-2" style="flex:25">
    @foreach($property->pictures as $picture)
    <!-- button dinamique qui permet supprimer l'image  -->
      <div id="picture{{ $picture->id }}" class="position-relative ">
        <img src="{{ $picture->getImageUrl(800, 530); }}" alt="" class="w-100 d-block">
        <button type="button" class="btn btn-danger position-absolute bottom-0 w-100"
            hx-delete="{{ route ('admin.picture.destroy', $picture)}}"
            hx-target="#picture{{ $picture->id }}"
            hx-swap="delete"
        >Supprimer</button>
      </div>
    @endforeach
        @include('shared.upload',["class" => "col", "name" => "pictures", "label" => "Image", 'multiple' => true])
    </div>
</div>

<div>
    <button type="submit" class="btn btn-dark">
        @if($property->exist)
            Modifier 
        @else
            Créer
        @endif
    </button>
</div>

</form>


@endsection