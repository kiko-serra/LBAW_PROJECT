@extends('layouts.app')

@section('title', 'Timeline')

@section('content')

<?php echo view('partials.leftPanel.panel'); ?>


<section class="flex flex-col justify-start">
  <section class="bg-white rounded-2xl p-4">
    <div class="flex flex-row justify-between">
      <div class="group-square w-24 h-24 bg-blue-300 overflow-hidden hover:backdrop-saturate-125"></div>
      <div class="flex flex-col justify-evenly">
        <form action="" method="post">
          <button type="submit" class="btn bg-red-500 hover:bg-red-600">Leave</button>
        </form>
        <div class="btn bg-orange-500 hover:bg-orange-600">Invite</div>
      </div>
    </div>
    <h3 class="text-2xl mt-2">{{ $group->name }}</h3>
    <p class="text-base mt-2">
      {{ $group->description }}
    </p>
  </section>

  <span class="my-2"></span>
  
  <form method="POST" action="{{ route('newpost') }}"  class="bg-white rounded-2xl p-4">
    {{ csrf_field() }}
    <div class="flex flex-row">
      <div id="newPostCardLeftBar" class="flex flex-col">
        <div class="w-24 h-24 bg-blue-500 rounded-full"></div>
      </div>
      <input type="textarea" name="description" id="newPostDescription" placeholder="What are you thinking?" class="w-full">
    </div>
    <div class="flex flex-row justify-end mt-4">
      <select name="group" id="newpostvisibility" class="w-fit hidden">
        <option for="group" value="{{ $group->id_community}} ">Friends</option>
      </select>
      <button class="px-4 btn"> Publish </button>
    </div>
  </form>

  <span class="my-4"></span>
    
  <div id="posts" class="bg-white rounded-2xl">
    @each('partials.post', $posts, 'post')
  </div>

</section>

<?php echo view('partials.rightPanel.panel', ['type' => 'group', 'members' => $members]); ?>


@endsection