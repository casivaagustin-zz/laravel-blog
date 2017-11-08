@extends('layout')

@section('content')
  <form action="{{ route('post.store') }}" method="POST">
    <h3>Nuevo Post</h3>
    {{ csrf_field() }}
    @include('posts.form-fields')
    <div class="actions">
      <a href="/" class="btn btn-secondary">Cancel</a>
      <input class="btn btn-primary" type="submit" value="Guardar"/>
    </div>
  </form>
@endsection