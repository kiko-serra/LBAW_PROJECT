<div id="connectionsModal" class="hidden fixed flex justify-center items-center overflow-y-auto overflow-x-hidden h-screen w-screen top-0 right-0 left-0 z-50">
    <div id="connectionsModalBack" class="absolute w-full h-full top-0 bg-black opacity-20">
    </div>
    <div class="relative w-fit h-fit bg-white opacity-100 flex flex-col justify-start items-center p-4 rounded-lg mt-4">
        <p class="text-3xl">Connections</p>
        <div class="grid grid-cols-2 border-b-2 border-b-black w-full">
            <span id="connectionsModalTab0Button" class="p-2 text-center select-none cursor-pointer"> In common </span>
            <span id="connectionsModalTab1Button" class="p-2 text-center select-none cursor-pointer"> All </span>
        </div>
        <div>
            <section id="connectionsModalTab0" class="hidden">
                @each('partials.UserProfile.userCard', $commonFriends, 'user')
            </section>
            <section id="connectionsModalTab1">
                @each('partials.UserProfile.userCard', $friends, 'user')
            </section>
        </div>
    </div>
</div>