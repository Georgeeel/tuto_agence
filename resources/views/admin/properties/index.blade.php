<!-- extend fichier admin -->
@extends('admin.admin')
@section('title', 'Tout les biens')
@section('content')
<div class="d-flex justify-content-between align-items-center">
    <h2>Les bien</h2>
    <a href="{{ route('admin.property.create')}}" class="btn btn-primary">Ajouter un bien</a>
</div>

<table class="table table-striped table-dark mt-2">
    <thead>
        <tr>
            <th>Titre</th>
            <th>Surface</th>
            <th>Prix</th>
            <th>Ville</th>
            <th class="text-end">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($properties as $property)
        <tr>
            <td>{{ $property->title }}</td>
            <td>{{ $property->surface }} m²</td>
            <td>{{ number_format($property->price, thousands_separator:'') }}</td>
            <td>{{ $property->city }}</td>
            <td>
                <div class="d-flex justify-content-end gap-2 w-100">
                    <a href="{{ route('admin.property.edit', $property) }}" class="btn btn-primary">Editer</a>
                    <form action="{{ route('admin.property.destroy', $property) }}" method="post" >
                    @csrf
                    @method("delete")
                    <button class="btn btn-danger">Supprimer</button>
                </form>
                </div>
            </td>

        </tr>
        @endforeach
    </tbody>
</table>

{{ $properties->links() }}

@endsection('content')