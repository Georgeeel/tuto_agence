@php 
    $label ??= ucfirst($name);
    $type ??= 'text';
    $class ??= 'null';
    $name ??= ' ';
    $value ??= '';
@endphp 


<div @class(['form-group', $class])>
    <label for="{{ $name }}">{{ $label }}</label>
    @if ($type === 'textarea')
        <textarea class="form-control @error($name) is-invalid @enderror" name="{{ $name }}" id="{{ $name }}">{{ old($name, $value) }}</textarea>
    @else
    <!-- input avec des valeur dynamique, dans le cas j'ai une erreur $name j'ai la class is-invalid pour la validation -->
    <!-- type text par default -->
    <!-- si je pas une class ça va etre null par default  et name par default chaine des characteres vide-->
    <input class="form-control @error($name) is-invalid @enderror" type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" value="{{ old($name, $value) }}">
    @endif
    @error($name)
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
    @enderror
</div>