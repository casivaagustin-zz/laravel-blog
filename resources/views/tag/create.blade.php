@extends('layout')

@section('content')
  <form action="{{ route('tag.store') }}" method="POST">
    <h3>Nuevo Tag</h3>
    {{ csrf_field() }}
    @include('tag.form-fields')
    <div class="actions">
      <a href="/" class="btn btn-secondary">Cancel</a>
      <input class="btn btn-primary" type="submit" value="Guardar"/>
    </div>
  </form>
@endsection