@extends('layout')

@section('title')
  Mi Mega Blog : Tags
@endsection

@section('content')
  @include('alert')
  <div class="tags">
    @foreach ($tags as $tag)
      <div class="tag row mb-1">
        <a href="{{ route('tag.show', [$tag->id]) }}" class="col-md-4">
          {{ $tag->tag }}
        </a>
        <a class="btn btn-success col-md-1 mr-1" href="{{ route('tag.edit', ['id' => $tag->id]) }}">
          Edit
        </a>
        <form action="{{ route('tag.destroy', ['id' => $tag->id]) }}" method="POST" style="display: inline">
          {{ csrf_field() }}
          <input name="_method" type="hidden" value="DELETE">
          <input type="submit" value="Borrar" onclick="return confirm('Are you sure?');" class="btn btn-danger"/>
        </form>
      </div>
    @endforeach
  </div>
@endsection