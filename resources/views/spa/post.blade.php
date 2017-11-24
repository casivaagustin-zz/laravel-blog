@extends('layout')

@section('title')
  SPA Blog - New Post
@endsection

@section('content')
  @include('alert')
  <div class="">
    <post-form></post-form>
  </div>
@endsection