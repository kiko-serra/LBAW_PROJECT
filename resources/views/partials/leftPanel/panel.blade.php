<section class="sidepanel left-sidepanel" id="leftPanel"> 
    <a href={{ route('timeline') }} class="left-panel-button <?php if ($_SERVER['REQUEST_URI'] == "/timeline") echo "left-panel-button-selected"; ?>">
        <img src={{ asset('icons/home.svg') }} alt="house icon" width=28" height=28">
        <p>FEED</p>
    </a>
    <a href="/user/{{ Auth::user()->id_account }}" class="left-panel-button <?php if ($_SERVER['REQUEST_URI'] == "/user/" . Auth::user()->id_account) echo "left-panel-button-selected"; ?>">
        <img src={{ asset('icons/person.svg') }} alt="person icon" width=28" height=28">
        <p>PROFILE</p>
    </a>
    <div id="left_panel_link_button" class="left-panel-button">
            <img src={{ asset('icons/group.svg') }} alt="links icon" width=28" height=28">
            <p>LINKS</p>
            <span id="left_panel_link_counter" class="left-panel-button-counter">5</span>
        </div>
        <ul id="left_panel_links_list" class="hidden">
            <p>refresh</p>
            <?php echo view('partials.leftPanel.notification') ?>
        </ul>
    </div>
    <div id="left_panel_group_button" class="left-panel-button">
            <img src={{ asset('icons/groups.svg') }} alt="links icon" width=28" height=28">
            <p>GROUPS</p>
            <span id="left_panel_group_counter" class="left-panel-button-counter">5</span>
        </div>
        <ul id="left_panel_groups_list" class="hidden">
            <p>refresh</p>
            <?php echo view('partials.leftPanel.notification') ?>
        </ul>
    </div>
    <div>
        <div id="left_panel_notification_button" class="left-panel-button">
            <img src={{ asset('icons/notifications.svg') }} alt="notifications icon" width=28" height=28">
            <p>NOTIFICATIONS</p>
            <span id="left_panel_notification_counter" class="left-panel-button-counter">5</span>
        </div>
        <ul id="left_panel_notifications_list" class="hidden">
            <p>refresh</p>
            <?php echo view('partials.leftPanel.notification') ?>
        </ul>
    </div>
</section>