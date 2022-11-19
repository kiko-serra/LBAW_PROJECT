<article class="flex flex-row bg-gray-100 rounded-lg p-4 m-4">
  <div id="postCardLeftBar" class="flex flex-col">
    <div class="w-20 h-20 bg-blue-500 rounded-full"></div>
  </div>
  <div id="postCardRightBar" class="flex flex-row justify-between w-full">
    <div id="postCardInfo" class="flex flex-col ml-2">
      <header class="flex flex-row gap-x-2 mb-2">
        <p class="text-3xl">Username</p>
        <p class="text-2xl">@Usertag</p>
        <p class="text-2xl">{{ $post->edited_date }}</p>
      </header>
      <p> {{$post->description}} </p>
      <div class="flex flex-row justify-between mt-2">
        <p>comment_icon</p>
        <p>promote_icon</p>
        <p>send_icon</p>
        <p>options_icon</p>
      </div>
    </div>
    <div id="postCardInfo" class="flex flex-col justify-between ml-2">
        <p>up_icon</p>
        <p>counter</p>
        <p>down_icon</p>
    </div>
  </div>
</article>