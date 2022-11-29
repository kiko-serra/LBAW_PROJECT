<section class="sidepanel" id="leftPanel"> 
    @if($type=="profile")
        <div class="flex flex-row w-full">
            <h2 class="text-lg text-center mb-2 w-full border-b-2 border-b-black" >Friends</h2>
            <h2 class="text-lg text-center mb-2 w-full border-b-2 border-b-gray-400" >Groups</h2>

        </div>
        <div class="flex flex-col gap-4 max-h-96 overflow-y-scroll">
            @each('partials.rightPanel.friend', $friends, 'user')
        </div>
    @elseif($type="timeline")
    @else
    @endif
</section>