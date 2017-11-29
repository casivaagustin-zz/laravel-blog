<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mi Mega Blog</title>
  <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
  <!--- Incluimos Bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
        integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
          integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
          crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
          integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh"
          crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"
          integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ"
          crossorigin="anonymous"></script>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>
<div class="container" id="app">
  <div class="flex-center position-ref full-height">
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
      <a class="navbar-brand" href="#">
        <router-link to="/" class="nav-link">Mi Mega Blog SPA</router-link>
      </a>
      <div class=" navbar-collapse col align-self-end">
        <ul class="navbar-nav ">
          <li class="nav-item">
            <router-link to="/" class="nav-link">Posts</router-link>
          </li>
          <li class="nav-item">
            <router-link to="/sections" class="nav-link">Sections</router-link>
          </li>
          <li class="nav-item">
            <router-link to="/tags" class="nav-link">Tags</router-link>
          </li>
          @if (Auth::check())
            <li class="nav-item">
              <a class="nav-link"  href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
            </li>
          <li class="nav-item">
            <router-link to="/post/create" class="btn btn-primary ml-1">Nuevo Post</router-link>
          </li>
          @else
            <li>
              <a class="nav-link" href="/login">Login</a>
            </li>
          @endif
        </ul>
      </div>
    </nav>

    <div class="content">
      @include('alert')
      <router-view />
    </div>
  </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
