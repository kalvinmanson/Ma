<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"  content="@yield('meta-description')" />
    <meta name="google-site-verification" content="ewO4x0NlUGO9gNkFMxcXPhUPPKHrWKPFbSruverP7tc" />
    <link rel="canonical" href="@yield('canonical')" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.6/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css" integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    @if(Auth::check())
      <script src="{{ asset('editor/ckeditor.js') }}"></script>
    @endif

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-113181598-2"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-113181598-2');
    </script>

</head>
<body>
  <div class="bmd-layout-container bmd-drawer-f-l fullHeight">
    <header class="bmd-layout-header">
      <div class="navbar navbar-light bg-faded">
        <button class="navbar-toggler" type="button" data-toggle="drawer" data-target="#dw-s1">
          <span class="sr-only">Toggle drawer</span>
          <i class="fas fa-bars text-white"></i>
        </button>
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link text-white" href="/">MA Virtual</a>
          </li>
          @if(Auth::check())
          <li class="nav-item">
            <a class="nav-link bg-white" href="/profile/{{ Auth::user()->username }}"><i class="far fa-user"></i> {{ Auth::user()->name }}</a>
          </li>
          @else
          <li class="nav-item">
            <a class="nav-link bg-white" href="/login/google"><i class="fab fa-google-plus-g"></i> Iniciar sesión</a>
          </li>
          @endif
        </ul>
      </div>
    </header>
    <div id="dw-s1" class="bmd-layout-drawer bg-faded">
      @include('partials.menu')
    </div>
    <main class="bmd-layout-content">
      @include('flash::message')
      @include('partials.errors')

      @yield('content')

      <p class="text-secondary text-center">&copy; 2019 By <a href="//droni.co">Droni.co</a></p>
    </main>
  </div>

  @yield('modal')



  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js" integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js" integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.6/jquery.fancybox.min.js"></script>
  <script src="/js/app.js"></script>
  @yield('scripts')
</body>
</html>
