<section class="sidepanel left-sidepanel" id="leftPanel"> 
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
            No links to show.
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
            <span id="left_panel_group_counter" class="left-panel-button-counter hidden">0</span>
        </div>
        <ul id="left_panel_groups_list" class="left_panel_list hidden">
            <div id="left_panel_groups_create" class="left-panel-button m-2">
                Create new group
            </div>
            <div>
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

<div class="fixed flex justify-center items-center overflow-y-auto overflow-x-hidden h-screen w-screen top-0 right-0 left-0 z-50">
    <div class="absolute w-full h-full top-0 bg-black opacity-20"></div>
    <form action={{ route('group.create') }} method="post" enctype="multipart/form-data" id="left_panel_groups_create_modal" class="relative w-fit h-fit bg-white opacity-100 flex flex-col justify-start items-center p-4 rounded-lg mt-4 gap-y-4">
        @csrf
        <h3 class="text-2xl -mb-3 font-semibold">Create Group</h3>
        <div class="flex flex-row gap-x-12">
            <section class="flex flex-col justify-center items-center">
                <div class="group-square w-36 h-36 bg-blue-300 overflow-hidden hover:backdrop-saturate-125">
                    <span class="flex justify-center items-center w-full h-full cursor-pointer group">
                        <img src={{ asset('icons/edit.svg') }} alt="edit icon" width=28" height=28" class="hidden h-9 w-9 group-hover:block">
                    </span>
                </div>
                <input type="file" class="hidden" name="groupimg" id="left_panel_groups_create_groupimg">
            </section>
            <section class="gap-y-4"">
                <div class="flex flex-col gap-y-1">
                    <label for="groupdesc" class="mt-2">Group name:</label>
                    <input type="text" placeholder="Type Here" class="text-input" name="groupname" id="left_panel_groups_create_groupname">
                </div>
                <div class="flex flex-col gap-y-1">
                    <label for="groupdesc" class="mt-2">Group description:</label>
                    <textarea name="groupdesc" placeholder="Type Here" class="textarea-input" id="left_panel_groups_create_groupdesc" cols="30" rows="3"></textarea>
                </div>
                <div class="w-full flex justify-start gap-x-2 mt-2 items-center">
                    <input type="checkbox" name="groupprivate" class="w-5 h-5" id="left_panel_groups_create_groupprivate">
                    <label for="groupprivate">Private group</label>
                </div>
            </section>
        </div>
        <div class="flex flex-row w-full justify-evenly">
            <button type="submit" class="btn font-bold">CREATE</button>
            <button type="reset" class="btn font-bold">CANCEL</button>
        </div>
    </form>
</div>