@extends('layout')

@section('title')
  Mi Mega Blog : Secciones
@endsection

@section('content')
  @include('alert')
  <div class="sections">
    @foreach ($sections as $section)
      <div class="section row mb-1">
        <a href="{{ route('section.show', [$section->id]) }}" class="col-md-4">
          {{ $section->section }}
        </a>
        <a class="btn btn-success col-md-1 mr-1" href="{{ route('section.edit', ['id' => $section->id]) }}">
          Edit
        </a>
        <form action="{{ route('section.destroy', ['id' => $section->id]) }}" method="POST" style="display: inline">
          {{ csrf_field() }}
          <input name="_method" type="hidden" value="DELETE">
          <input type="submit" value="Borrar" onclick="return confirm('Are you sure?');" class="btn btn-danger"/>
        </form>
      </div>
    @endforeach
  </div>
@endsection