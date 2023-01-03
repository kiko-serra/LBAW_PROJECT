<header class="bg-white flex flex-row justify-evenly py-3 items-center">
    <div class="w-full pl-24">
        <h1 class="text-primary text-3xl"><a href="{{ url('/timeline') }}">UniLinks</a></h1>
    </div>

    {{-- SEARCH BAR --}}
    <div class="w-full flex flex-row justify-center">
        <div class="flex flex-row w-80 h-full rounded-3xl border-primary border-2 overflow-hidden">
            <form type="get" action="{{ url('/user_search') }}" class="w-full h-full">
                <input id="account_tag" type="text" name="account_tag" required class="w-full px-2">
            </form>
            <i class="fa-solid fa-magnifying-glass text-primary pr-2"></i>
        </div>
    </div>

    {{-- PAGES --}}
    <div class="flex flex-row w-full justify-between px-24 ">

        <h1 class="text-primary text-xl cursor-pointer select-none whitespace-nowrap">FAQ</h1>
        <h1 class="text-primary text-xl cursor-pointer select-none whitespace-nowrap">CONTACTS</h1>
        <h1 class="text-primary text-xl cursor-pointer select-none whitespace-nowrap">LOG OUT</h1>

    </div>
</header>


{{-- <h1 class="desktop"><a href="{{ url('/timeline') }}">UniLinks</a></h1>

    @if (Auth::check())
        <h1 class="mobile">
            <a class="bars-menu">
                <i class="fa-sharp fa-solid fa-bars"></i>
            </a>
        </h1>
    @else
        <h1 class="mobile"><a href="{{ url('/timeline') }}">UniLinks</a></h1>
    @endif

    @if (Auth::check())
        <div class="search_bar flex flex-row">
            <i class="fa-solid fa-magnifying-glass"></i>
            <form type="get" action="{{ url('/user_search') }}">
                <input id="account_tag" type="text" name="account_tag" required>
            </form>
        </div>
        <div class="flex flex-row justify-evenly items-center">

            @if (Auth::user()->is_admin === true)
                <a class="justify-self-center desktop" href="{{ url('/users') }}">USERS</a>
                <a class="justify-self-center mobile" href="{{ url('/users') }}">
                    <i class="fa-solid fa-hammer"></i>
                </a>
            @endif

            <a class="logout_button desktop" href="{{ url('/logout') }}"> LOGOUT </a>
            <a class="logout_button mobile" href="{{ url('/logout') }}">
                <i class="fa-solid fa-right-from-bracket"></i>
            </a>
            <a class="mobile" href="{{ route('profile', Auth::user()->id_account) }}">
                <i class="fa-solid fa-user"></i>
            </a>
            <a class="desktop" href="{{ route('profile', Auth::user()->id_account) }}"> {{ Auth::user()->name }} </a>
        </div>
    @endif --}}
