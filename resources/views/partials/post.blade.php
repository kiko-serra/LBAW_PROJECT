<article class="post" data-id="{{ $post->id_post }}">
<header>
  <h2><a href="/posts/{{ $post->id_post }}">{{ $post->id_post }}</a></h2>
  <a href="#" class="delete">&#10761;</a>
</header>
<p>
  {{ $post->description }}
</p>
<form class="new_item">
  <input type="text" name="description" placeholder="new item">
</form>
</article>
