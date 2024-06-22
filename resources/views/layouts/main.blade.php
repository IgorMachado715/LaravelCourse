<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body>

    <header>
    <nav class="navbar navbar-expand-lg bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand text-white" href="/">Laravel Events</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a href="/" class="nav-link active link-primary text-white" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a href="/" class="nav-link link-primary text-white" >Events</a>
        </li>
        <li class="nav-item">
          <a href="/events/create" class="nav-link link-primary text-white" >Create Event</a>
        </li>
        <li class="nav-item">
          <a href="/contact" class="nav-link link-primary text-white" >Contact</a>
        </li>
      </ul>
      @auth
      <form class="d-flex navbar-nav " role="search">
      <li class="nav-item">
        <a href="/dashboard" class="nav-link link-primary text-white me-2" type="submit">My access</a>
        </li>
        <li class="nav-item">
            <form action="/logout" method="POST">
                @csrf
                <a class="nav-link link-primary text-white" href="/logout" 
                onClick="event.preventDefault();
                        this.closest('form').submit();">
                        Logout
                </a>
            </form>
        </li>
      </form>
      @endauth
      @guest
      <form class="d-flex" role="search">
        <a href="/login" class="btn btn-outline-success me-2" type="submit">Login</a>
        <a href="/register" class="btn btn-outline-success" type="submit">Register</a>
      </form>
      @endguest
    </div>
  </div>
</nav>
</header>

<main class="container-fluid">
  <div class="row">
    @if(session ('msg'))
      <p class="msg">{{ session ('msg') }}</p>
    @endif
    @yield('content')
  </div>
</main>

<footer class="bg-body-tertiary text-center text-lg-start mt-5">
      <div class="text-center p-3 text-white" style="background-color: rgb(33, 37, 41);">
        © 2020 Copyright:
        <a class="nav-link link-primary text-white" href="https://igormachado715.github.io/">igormachado.com</a>
      </div>
</footer>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    </body>
</html>
