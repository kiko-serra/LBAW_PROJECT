<article class="grid grid-cols-[auto_1fr_auto] bg-gray-200 p-2">
    <div class="bg-blue-500 rounded-full w-16 h-16 items-center"></div>
    <div class="ml-1">
        <div class="flex flex-row justify-start">
            <p class="text-black text-base">{{ $user->name }}</p>
            <span></span>
        </div>
        <p class="text-gray-600 text-sm">{{ "@" . $user->account_tag }}</p>
    </div>
    <a href="/user/{{$user->account_tag}}" class="text-black self-center">
        VIEW
    </a>
</article>