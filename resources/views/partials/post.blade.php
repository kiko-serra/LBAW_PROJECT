<article class="flex flex-row bg-gray-100 rounded-lg p-4 m-4" href="/post/{{ $post->id_post }}">
  <a id="postCardLeftBar" class="flex flex-col" href="/user/{{ $post->owner_id }}">
    <div class="w-20 h-20 bg-blue-500 rounded-full"></div>
  </a>
  <div id="postCardRightBar" class="flex flex-row justify-between w-full">
    <div id="postCardInfo" class="flex flex-col ml-2">
      <header class="flex flex-row gap-x-2 mb-2">
        <a class="text-3xl" href="/user/{{ $post->owner_id }}">{{ $post->name }}</a>
        <a class="text-2xl" href="/user/{{ $post->owner_id }}"><span>@</span>{{ $post->account_tag}}</a>
        <a class="text-2xl" href="/post/{{ $post->id_post }}">{{ $post->edited_date }}</a>
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