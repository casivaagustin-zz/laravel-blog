@extends('layout')

@section('title')
  Mi Mega Blog : Tags
@endsection

@section('content')
  <div class="tags">
    @foreach ($tags as $tag)
      <div class="tag">
        <a href="{{ route('tag.show', [$tag->id]) }}">
          {{ $tag->tag }}
        </a>
      </div>
    @endforeach
  </div>
@endsection