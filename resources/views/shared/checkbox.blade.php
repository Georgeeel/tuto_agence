@php
 $class ??= null;
@endphp

<div @class(['form-check form-switch', $class])>
    <!-- créer la valeur par default -->
    <input type="hidden" name="{{ $name }}" value="0">
    <!-- valeur par default cocher et si la valeur n'existe pas c'est false  -->
    <input type="checkbox" name="{{ $name }}" id="{{ $name }}" value="1" @checked(old($name, $value ?? false)) 
        class="form-check-input @error($name) is-invalid @enderror" role="switch">
        <label for="{{ $name }}" class="form-check-label">{{ $label }}</label>
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
