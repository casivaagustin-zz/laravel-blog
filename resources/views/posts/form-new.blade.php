@extends('layout')

@section('content')
    <form action="{{ route('post.store') }}" method="POST">
        {{ csrf_field() }}
        Titulo: <input type="text" name="title"/>
        <br/>
        Cuerpo: <textarea name="body"></textarea>
        <br/>
        Seccion: <select name="section">
                    <option value=""></option>
                    @foreach($sections as $section)
                        <option value="{{ $section->id }}">{{ $section->section }}</option>
                    @endforeach
                 </select>
        <br/>
        <input type="submit" value="Guardar" />
    </form>
@endsection