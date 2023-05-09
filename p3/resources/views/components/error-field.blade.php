@if ($errors->has($fieldName))
<div class="alert alert-danger" role="alert">
    @foreach ($errors->get($fieldName) as $error)
    {{ $error }}<br>
    @endforeach
</div>
@endif