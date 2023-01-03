<header>
    <h1 class="desktop"><a href="{{ url('/timeline') }}">UniLinks</a></h1>

    @if (Auth::check())
        <h1 class="mobile">
            <a class="bars-menu">
                <i class=" fa-sharp fa-solid fa-bars"></i>
            </a>
        </h1>
    @else
        <h1 class="mobile"><a href="{{ url('/timeline') }}">UniLinks</a></h1>
    @endif

    @if (Auth::check())
        <div class="search_bar flex flex-row">
            <!-- TODO -->
            <i class="fa-solid fa-magnifying-glass"></i>
            <form type="get" action="{{ url('/user_search') }}">
                <input id="account_tag" type="text" name="account_tag" required>
            </form>
        </div>
        <div class="flex flex-row justify-evenly items-center">

            @if (Auth::user()->is_admin === true)
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
            <a class="desktop" href="{{ route('profile', Auth::user()->id_account) }}"> {{ Auth::user()->name }} </a>
        </div>
    @endif
</header>
