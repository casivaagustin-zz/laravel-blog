@extends('layout')

@section('content')
  <h1 class="mb-3 mt-2">
    {{ $post->title }}
  </h1>
  @if (Auth::check())
  <div class="tabs mb-3">
    <a href="{{ route('post.edit', ['id' => $post->id]) }}" class="btn btn-success">Edit</a>
    <form action="{{ route('post.destroy', ['id' => $post->id]) }}" method="POST" style="display: inline">
      {{ csrf_field() }}
      <input name="_method" type="hidden" value="DELETE">
      <input type="submit" value="Borrar" onclick="return confirm('Are you sure?');" class="btn btn-danger"/>
    </form>
  </div>
  @endif
  <div class="body mb-3">
    {{ $post->body }}
  </div>
  <div class="date">
    <strong>Fecha:</strong> {{ $post->created_at }}
  </div>
  <div class="footer">
      <span class="section">
        <span class="label"><strong>Seccion:</strong></span>
        <a href="{{ route('section.show', [$post->section()->first()->id]) }}" class="card-link">
          {{ $post->section()->first()->section }}
        </a>
      </span>
    <span class="tags">
      <span class="label"><strong>Tags:</strong></span>
      @foreach ($post->tags() as $tags)
        <a href="{{ route('tag.show', [$tags->id]) }}" class="card-link">
          {{ $tags->tag }}
        </a>
      @endforeach
      </span>
  </div>
@endsection