<!-- extend fichier admin -->
@extends('admin.admin')
@section('title', 'Tout les options')
@section('content')
<div class="d-flex justify-content-between align-items-center">
    <h2>Les options</h2>
    <a href="{{ route('admin.option.create')}}" class="btn btn-primary">Ajouter une options</a>
</div>

<table class="table table-striped table-dark mt-2">
    <thead>
        <tr>
            <th>Nom</th>
            <th class="text-end">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($options as $option)
        <tr>
            <td>{{ $option->name }}</td>
            <td>
                <div class="d-flex justify-content-end gap-2 w-100">
                    <a href="{{ route('admin.option.edit', $option) }}" class="btn btn-primary">Editer</a>
                    <form action="{{ route('admin.option.destroy', $option) }}" method="post" >
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

{{ $options->links() }}

@endsection('content')