@extends('layout')

@section('content')
  <form action="{{ route('tag.update', ['id' => $tag->id]) }}" method="POST">
    <input name="_method" type="hidden" value="PUT">
    <h3>Edit Tag</h3>
    {{ csrf_field() }}
    @include('tag.form-fields')
    <div class="actions">
      <a href="/" class="btn btn-secondary">Cancel</a>
      <input class="btn btn-primary" type="submit" value="Guardar"/>
    </div>
  </form>
@endsection