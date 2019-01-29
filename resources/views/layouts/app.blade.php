<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="{{ secure_asset('/css/style.css') }}" rel="stylesheet">
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
        <nav class="navbar fixed-top navbar-toggleable-sm navbar-expand-lg navbar-light bg-light shadow-sm">
            <a class="navbar-brand" href="{{ route('index') }}">
                <img id="navLogo" src="{{ asset('logo_new.png') }}" height="100" alt="mb-logo">
            </a>
          <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                ☰
            </button>
          <div class="navbar-collapse collapse">
            <ul class="navbar-nav">
              <li class="nav-item active">
                <a class="nav-link" href="{{ route('temp_recipe') }}">Recipies</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('index') }}">Ingredients</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('support') }}">Help</a>
              </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                  <a class="mr-4" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('register') }}">Register</a>
                </li>
              </ul>
          </div>
        </nav>
      </div>
    </div>
  </div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>