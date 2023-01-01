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
    <script type="text/javascript" src={{ asset('js/app.js') }} defer> </script>

  </head>
  <body>
    <main>
      <area id="background_color_1"></area>
      <header>
        <h1 class="desktop"><a href="{{ url('/timeline') }}">UniLinks</a></h1>
        <h1 class="mobile">
          <a class="bars-menu">
              <i class=" fa-sharp fa-solid fa-bars"></i>
          </a>
        </h1>
        @if (Auth::check()) 
        <div class="search_bar flex flex-row">
          <!-- TODO -->
          <i class="fa-solid fa-magnifying-glass"></i>
          <form type= "get" action="{{url('/user_search')}}">
            <input id="account_tag" type="text" name="account_tag" required>
          </form>
        </div>
        <div class="flex flex-row justify-evenly items-center">
        @if(Auth::user()->is_admin === true)
        <a class="justify-self-center desktop" href="{{ url('/users') }}">Users</a>
        <a class="justify-self-center mobile" href="{{ url('/users') }}">
          <i class="fa-solid fa-hammer"></i>
        </a>
        @endif
        <a class="logout_button desktop" href="{{ url('/logout') }}"> Logout </a>
        <a class="logout_button mobile" href="{{ url('/logout') }}"> 
          <i class="fa-solid fa-right-from-bracket"></i>
       </a>
        <a class="mobile" href="{{ route('profile', Auth::user()->id_account) }}">
          <i class="fa-solid fa-user"></i>
        </a>
        <a class="desktop" href="{{ route('profile', Auth::user()->id_account) }}"> {{Auth::user()->name}} </a>
        </div>
        @endif
      </header>

      <!-- Mobile  -->
      <nav class="mobile-menu mobile">
          <section class="sidepanel-mobile left-sidepanel" id="leftPanel"> 
              <a href={{ route('timeline') }} class="left-panel-button <?php if ($_SERVER['REQUEST_URI'] == "/timeline") echo "left-panel-button-selected"; ?>">
                  <img src={{ asset('icons/home.svg') }} alt="house icon" width=28" height=28" class="h-7 w-7">
                  <p>FEED</p>
              </a>
              <a href="/user/{{ Auth::user()->account_tag }}" class="left-panel-button <?php if ($_SERVER['REQUEST_URI'] == "/user/" . Auth::user()->account_tag) echo "left-panel-button-selected"; ?>">
                  <img src={{ asset('icons/person.svg') }} alt="person icon" width=28" height=28" class="h-7 w-7">
                  <p>PROFILE</p>
              </a>
              <div>
                  <div id="left_panel_link_button" class="left-panel-button">
                      <img src={{ asset('icons/group.svg') }} alt="links icon" width=28" height=28" class="h-7 w-7">
                      <p>LINKS</p>
                      <span id="left_panel_link_counter" class="left-panel-button-counter hidden">0</span>
                  </div>
                  <ul id="left_panel_links_list" class="left_panel_list hidden">
                      <div class="flex flex-row h-9 w-full gap-x-1">
                          <input type="text" name="usersearch" id="leftpanellinksfilter" placeholder="Search" class="rounded-lg border-blue-400 border-2 w-full">
                      </div>                
                      <div id="left_panel_links_list_content" class="w-full flex flex-col items-center">
                          No links to show.
                      </div>
                  </ul>
              </div>
              <div>
                  <div id="left_panel_link_add_button" class="left-panel-button">
                      <img src={{ asset('icons/group_add.svg') }} alt="link add icon" width=28" height=28" class="h-7 w-7">
                      <p>LINK REQUESTS</p>
                      <span id="left_panel_link_add_counter" class="left-panel-button-counter hidden">0</span>
                  </div>
                  <ul id="left_panel_links_add_list" class="left_panel_list hidden">
                      No link requests to show.
                  </ul>
              </div>
              <div>
                  <div id="left_panel_group_button" class="left-panel-button">
                      <img src={{ asset('icons/groups.svg') }} alt="groups icon" width=28" height=28" class="h-7 w-7">
                      <p>GROUPS</p>
                  </div>
                  <ul id="left_panel_groups_list" class="left_panel_list hidden">
                      <div id="left_panel_groups_create" class="left-panel-button my-2">
                          Create new group
                      </div>
                      <div id="left_panel_groups_list_content" class="w-full flex flex-col items-center">
                          No groups to show.
                      </div>
                  </ul>
              </div>
              <div>
                  <div id="left_panel_group_add_button" class="left-panel-button">
                      <img src={{ asset('icons/groups_add.svg') }} alt="groups add icon" width=28" height=28" class="h-7 w-7">
                      <p>GROUP REQUESTS</p>
                      <span id="left_panel_group_add_counter" class="left-panel-button-counter hidden">0</span>
                  </div>
                  <ul id="left_panel_groups_add_list" class="left_panel_list hidden">
                      No group requests to show.
                  </ul>
              </div>
              <div>
                  <div id="left_panel_notification_button" class="left-panel-button">
                      <img src={{ asset('icons/notifications.svg') }} alt="notifications icon" width=28" height=28" class="h-7 w-7">
                      <p>NOTIFICATIONS</p>
                      <span id="left_panel_notification_counter" class="left-panel-button-counter hidden">0</span>
                  </div>
                  <ul id="left_panel_notifications_list" class="left_panel_list hidden">
                      No notifications to show.
                      <img src={{ asset('icons/refresh.svg') }} alt="refresh icon" width=28" height=28" class="h-7 w-7 m-2 cursor-pointer">
                  </ul>
              </div>
          </section>
      </nav>
      <section id="content">
      <!-- ------ -->

        @yield('content')
      </section>
    </main>
  </body>
</html>
