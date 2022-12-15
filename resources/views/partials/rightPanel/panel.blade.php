<section class="sidepanel" id="leftPanel"> 
    @if($type=="profile")
        <div class="flex flex-row w-full mb-2">
            <h2 id="right-sidepanel-left-tab-button" class="right-sidepanel-tab-button right-sidepanel-tab-button-selected" >Links</h2>
            <h2 id="right-sidepanel-right-tab-button" class="right-sidepanel-tab-button" >Groups</h2>
        </div>
        <div class="flex overflow-x-hidden">
            <div id="right-sidepanel-left-tab" class="right-sidepanel-tab">
                <div class="flex flex-row w-full mb-2 gap-x-1">
                    <input type="text" name="usersearch" data-id="{{ $userID }}" id="linksfilter" placeholder="Search" class="rounded-lg border-blue-400 border-2 w-full">
                    <span data-id="{{ $userID }}" id="right-panel-common-link-filter" class="w-fit flex flex-row whitespace-nowrap p-1 gap-x-1 items-center cursor-pointer select-none border-2 border-blue-400 rounded-lg active:common-link-filter-active">
                        <img src="/icons/diversity.svg" alt="diversity icon" h="24" w="24" class="w-7 h-7">
                        <p class="mr-7">Common links</p>
                    </span>
                </div>
                <div id="right-sidepanel-left-tab" class="right-sidepanel-tab">
                    @each('partials.rightPanel.friend', $friends, 'user')
                </div>
            </div>
            <div id="right-sidepanel-right-tab" class="right-sidepanel-tab">
                TBD
            </div>
        </div>
    @elseif($type=="timeline")
    @elseif($type=="group")
        <div class="flex flex-row w-full mb-2">
            <h2 id="right-sidepanel-left-tab-button" class="right-sidepanel-tab-button right-sidepanel-tab-button-selected" >Members</h2>
            <h2 id="right-sidepanel-right-tab-button" class="right-sidepanel-tab-button" >Options</h2>
        </div>
        <div class="flex overflow-x-hidden">
            <div id="right-sidepanel-left-tab" class="right-sidepanel-tab">
                @each('partials.rightPanel.friend', $members, 'user')
            </div>
            <div id="right-sidepanel-right-tab" class="right-sidepanel-tab">
                <form action="/group/leave" method="post">
                {{ csrf_field() }}
                <input type="number" name="group_id" value="{{ $group->id_community }}" class="hidden">
                <button type="submit" class="btn bg-red-500 hover:bg-red-600">Leave</button>
                </form>
            </div>
        </div>
    @else
    @endif
</section>