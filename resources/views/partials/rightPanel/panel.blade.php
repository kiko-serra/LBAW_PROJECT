<section class="sidepanel" id="leftPanel"> 
    @if($type=="profile")
        <div class="flex flex-row w-full mb-2">
            <h2 class="text-lg text-center w-full border-b-2 border-b-black" >Links</h2>
            <h2 class="text-lg text-center w-full border-b-2 border-b-gray-400" >Groups</h2>
        </div>
        <div class="flex flex-row w-full mb-2 gap-x-1">
            <input type="text" name="usersearch" data-id="{{ $userID }}" id="linksfilter" placeholder="Search" class="rounded-lg border-blue-400 border-2 w-full">
            <span data-id="{{ $userID }}" id="right-panel-common-link-filter" class="w-fit flex flex-row whitespace-nowrap p-1 gap-x-1 items-center cursor-pointer select-none border-2 border-blue-400 rounded-lg active:common-link-filter-active">
                <img src="/icons/diversity.svg" alt="diversity icon" h="24" w="24" class="w-7 h-7">
                <p class="mr-7">Common links</p>
            </span>
        </div>
        <div id="right-panel-links" class="flex flex-col gap-4 max-h-96 overflow-y-scroll">
            @each('partials.rightPanel.friend', $friends, 'user')
        </div>
    @elseif($type="timeline")
    @else
    @endif
</section>