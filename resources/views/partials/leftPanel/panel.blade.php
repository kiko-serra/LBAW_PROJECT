<section class="sidepanel left-sidepanel" id="leftPanel"> 
    <a href={{ route('timeline') }} class="left-panel-button <?php if ($_SERVER['REQUEST_URI'] == "/timeline") echo "left-panel-button-selected"; ?>">
        <img src={{ asset('icons/home.svg') }} alt="house icon" width=28" height=28">
        <p>FEED</p>
    </a>
    <a href="/user/{{ Auth::user()->id_account }}" class="left-panel-button <?php if ($_SERVER['REQUEST_URI'] == "/user/" . Auth::user()->id_account) echo "left-panel-button-selected"; ?>">
        <img src={{ asset('icons/person.svg') }} alt="person icon" width=28" height=28">
        <p>PROFILE</p>
    </a>
    <a class="left-panel-button">
        <img src={{ asset('icons/contacts.svg') }} alt="contacts icon" width=28" height=28">
        <p>FRIENDS</p>
    </a>
    <a class="left-panel-button">
        <img src={{ asset('icons/group.svg') }} alt="group icon" width=28" height=28">
        <p>GROUPS</p>
    </a>
    <a class="left-panel-button">
        <img src={{ asset('icons/group_add.svg') }} alt="group add icon" width=28" height=28">
        <p>GROUP INVITES</p>
    </a>
    <div>
        <a class="left-panel-button">
            <img src={{ asset('icons/notifications.svg') }} alt="notifications icon" width=28" height=28">
            <p>NOTIFICATIONS</p>
            <span class="left-panel-button-counter">5</span>
        </a>
        <ul class="hidden">
            <?php echo view('partials.leftPanel.notification') ?>
        </ul>
    </div>
</section>