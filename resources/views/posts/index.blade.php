@extends('layout')

@section('content')
  <div class="posts">

    @include('alert')

    @forelse($posts as $post)
        @include('posts.teaser')
    @empty
      <div class="center-block">
        No hay post
      </div>
    @endforelse
  </div>
@endsection