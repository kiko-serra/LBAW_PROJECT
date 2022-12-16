<div id="groupInviteModal" data-id={{ $id }} class="fixed flex justify-center items-center overflow-y-auto overflow-x-hidden h-screen w-screen top-0 right-0 left-0 z-50 hidden">
    <div class="absolute w-full h-full top-0 bg-black opacity-20"></div>
    <form action={{ route('group.create') }} method="post" enctype="multipart/form-data" id="left_panel_groups_create_modal" class="relative w-fit h-fit bg-white opacity-100 flex flex-col justify-start items-center p-4 rounded-lg mt-4 gap-y-4">
        @csrf
        <h3 class="text-2xl -mb-3 font-semibold">Invite to Group</h3>
        <input type="text" name="query" id="inviteGroupQuery" class="text-input">
        <div id="groupInviteModalContent">
            Loading friends...
        </div>
        <div class="flex flex-row w-full justify-evenly">
            <button type="submit" class="btn font-bold" disabled>INVITE</button>
            <button id="toggleGroupInviteModalClose" type="reset" class="btn font-bold">CANCEL</button>
        </div>
    </form>
</div>