@extends('layout')

@section('title')
  Mi Mega Blog : Secciones
@endsection

@section('content')
  <div class="sections">
    @foreach ($sections as $section)
      <div class="section">
        <a href="{{ route('section.show', [$section->id]) }}">
          {{ $section->section }}
        </a>
      </div>
    @endforeach
  </div>
@endsection