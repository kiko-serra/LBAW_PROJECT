<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script type="text/javascript">
        // Fix for Firefox autofocus CSS bug
    </script>
    <script src="https://kit.fontawesome.com/343294b271.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src={{ asset('js/app.js') }} defer>
</script>
  </head>
  <body>
    <main>
      <area id="background_color_1"></area>
      <header>
        <h1><a href="{{ url('/timeline') }}">Unilinks</a></h1> <!-- Mudar link! -->
        @if (Auth::check()) 
        <div class="search_bar flex flex-row">
          <!-- TODO -->
          <i class="fa-solid fa-magnifying-glass"></i>
          <form type= "get" action="{{url('/user_search')}}">
            <input id="account_tag" type="text" name="account_tag" required>
          </form>
        </div>
        <a class="logout_button" href="{{ url('/logout') }}"> Logout </a>
        <a href="{{ route('profile', Auth::user()->id_account) }}">{{ Auth::user()->name }}</a>
        @endif
      </header>
      <section id="content">
        @yield('content')
      </section>
    </main>
  </body>
</html>
