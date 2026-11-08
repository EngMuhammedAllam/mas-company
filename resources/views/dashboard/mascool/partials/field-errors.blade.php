@if($errors->has($name))
    <span class="error" role="alert">{{ $errors->first($name) }}</span>
@endif
