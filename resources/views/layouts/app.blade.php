<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name') }}</title>

  <!-- Fonts -->
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
  <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
    crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
    crossorigin="anonymous"></script>

</head>

<body>
  <div id="app">

    <div class="nav-container container-fluid">
      <div class="row">
        <div class="col-md-12">
          <nav class="navbar fixed-top navbar-toggleable-sm navbar-expand-lg navbar-light shadow-sm">
            <a class="navbar-brand" href="{{ route('index') }}">
                <img id="navLogo" src="{{ asset('logo_new.png') }}" height="100" alt="mb-logo">
            </a>
            <button class="navbar-toggler navbar-toggler-left order-first" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                ☰
            </button>

            <div class="navbar-collapse collapse">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('search') }}">Search</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('recipes.index') }}">Recipes</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('ingredients.index') }}">Ingredients</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('about') }}">About</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('support') }}">Help</a>
                </li>
              </ul>
            </div>
            <ul class="navbar-nav ml-auto mr-3 cartAndUser">
              @guest
              <li class="nav-item mt-1 mr-2">
                <a class="nav-link" href="{{ route('login') }}">Login</a>
              </li>
              @else
              <li class="nav-item dropdown">
                <!-- <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">{{ Auth::user()->name }}</a> -->
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                    <img id="userIcon" border="0" src="{{ asset('/img/user.png') }}" width="40" height="40">
                  </a>
                <div class="dropdown-menu dropdown-menu-right logoutDropdown">
                  <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                </div>
                @endguest
              </li>
              <li class="mt-2 ml-1 nav-item">
                <a href="#"><img id="cartIcon" border="0" src="{{ asset('/img/cart.png') }}" width="40" height="40"></a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>

    <main class="container" style="margin-top: 120px;">
      @yield('content')
    </main>
  </div>

  <footer class="mt-5 row justify-content-center">
    <div>© Copyright 2019 MealBasket</div>
  </footer>
</body>

</html>