@extends('layout')

@section('content')
  <div class="posts">
    @if (session('ok'))
      <h3>{{ session('ok') }}</h3>
    @endif
    @if (session('error'))
      <h1>{{ session('error') }}</h1>
    @endif

    <a href="{{ route('post.create') }}">Nuevo Post</a>
    @foreach ($posts as $post)
      <div class="post">
        <h2 class="title">
          <a href="/post/{{ $post->id }}">
            {{ $post->title }}
          </a>
        </h2>
      </div>
    @endforeach
  </div>
@endsection