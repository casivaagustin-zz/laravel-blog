@extends('layout')

@section('title')
  SPA Blog
@endsection

@section('content')
  @include('alert')
  <div class="">
    <blog-index></blog-index>
  </div>
@endsection