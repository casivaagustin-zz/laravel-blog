@extends('layout')

@section('content')
  <form action="{{ route('section.store') }}" method="POST">
    <h3>Nueva Sección</h3>
    {{ csrf_field() }}
    @include('section.form-fields')
    <div class="actions">
      <a href="/" class="btn btn-secondary">Cancel</a>
      <input class="btn btn-primary" type="submit" value="Guardar"/>
    </div>
  </form>
@endsection