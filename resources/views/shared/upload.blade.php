@php 

$class ??= null;
$multiple ??= false;

@endphp

<label for="{{ $name }}">{{ $label }}</label>
<input @if($multiple) multiple @endif class="form-control @error($name) is-invalid @enderror" type="file" name="{{ $name .($multiple ? '[]' : '' ) }}">
    @error($name)
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
    @enderror