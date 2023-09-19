@extends('admin.admin')
<!-- titre dinamique -->
@section('title', $option->exists ? "Editer une option" : "Créer une option")

@section('content')

<h2>@yield('title')</h2>
<!-- action du formulaire éditer ou créer si la propriété exist je vais edit sinon créer -->
<!-- second parametre la entité option, ou il va extraire l'id du model et ajouter comme parametre dans cadre d'edition -->
<form class="vstack gap-2" action="{{ route($option->exists ? "admin.option.update" : "admin.option.store", $option) }}" method="post">
@csrf
@method($option->exists ? 'put' : 'post')
<div class="row">
    @include('shared.input',["class" => "col", "label" => "Nom", "name" => "name", "value" => $option->name])
    
</div>

<div>
    <button type="submit" class="btn btn-dark">
        @if($option->exist)
            Modifier 
        @else
            Créer
        @endif
    </button>
</div>

</form>


@endsection