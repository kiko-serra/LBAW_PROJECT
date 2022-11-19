@extends('layouts.app')

@section('title', 'Timeline')

@section('content')

<section class="sidepanel" id="left"> 
    
</section>
<section class="flex flex-col justify-start">
  <form method="POST" action="{{ route('createpost') }}"  class="bg-white rounded-2xl p-4">
    <div class="flex flex-row">
      <div id="newPostCardLeftBar" class="flex flex-col">
        <div class="w-24 h-24 bg-blue-500 rounded-full"></div>
      </div>
      <input type="textarea" name="description" id="newPostDescription" placeholder="What are you thinking?" class="w-full">
    </div>
    <div class="flex flex-row justify-between">
      <select name="showoptions" id="newpostvisibility" class="w-fit">
        <option disabled> Show to everyone </option>
        <option value="0">Friends</option>
        <option value="1">FSI 22/23</option> <!--The user's groups -->
      </select>
      <button class="px-4"> Publish </button>
    </div>
  </form>

  <span class="my-4"></span>
    
  <div id="posts" class="bg-white rounded-2xl">
    @each('partials.post', $posts, 'post')
  </div>

</section>

<section class="sidepanel" id="right"> 
    
</section>

@endsection