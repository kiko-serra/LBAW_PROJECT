@extends('layouts.app')

@section('title', 'UserProfile')

@section('content')

<section class="sidepanel" id="left"> 
    
</section>
<section id="timeline">

@if (!$user->is_private)
  <section id="profile">
    <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" id="profile_image" class="m-auto rounded-full">
    <div id="user_life_info_container" class="m-auto flex flex-col justify-between ">
      <div class="user_school flex flex-row" >
        <i class="fa-solid fa-graduation-cap"></i>
        <span class="text-2xl">{{$user->course}}</span>
      </div>
      <div class="user_school flex flex-row" >
        <i class="fa-solid fa-school"></i>
        <span class="text-2xl">{{$user->university}}</span>
      </div>
      <div class="user_school flex flex-row" >
        <i class="fa-sharp fa-solid fa-location-dot"></i>
        <span class="text-2xl">{{$user->location}}</span>
      </div>
    </div>
    <div id="user_identity_info" class="flex flex-col">
      <div id="name">{{$user->name}}</div>
      <div id="details" class="flex flex-row justify-between items-center text-gray-400">
        <div id="username"> {{'@'.$user->account_tag}}</div>
        <i class="fa-solid fa-circle"></i>
        <div id="pronouns">{{$user->pronouns}}</div>
        <i class="fa-solid fa-circle"></i>
        <div id="age">{{$user->age}} years old</div>
      </div>
    </div>
    <a href="" id="follow_button" class="rounded-full">Connect</a>
    <div id="user_bio_section" class="flex flex-col">
      <div id="bio">{{ $user->description }}</div>
      <div>X connections</div>
      <div>X, Y and Z and H other friends in common</div>
    </div>
    <div id="filters" class="flex flex-row justify-between">
      <a href="">All</a>
      <a href="">Posts</a>
      <a href="">Promotions</a>
      <a href="">Reactions</a>
      <a href="">Responses</a>
    </div>
  </section>
  
  <div id="posts">
    @each('partials.post', $posts, 'post')
  </div>

  @else 

  <section id="private_profile">
    <div id="private_profile_info" class="flex flex-col">
      <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" id="profile_image" class="m-auto rounded-full">
      <div id="user_identity_info" class="m-auto flex flex-col">
        <div id="name">{{$user->name}}</div>
        <div id="username"> {{'@'.$user->account_tag}}</div>  
      </div>
    </div>
    <div id="warning_private_profile">
      <span>This profile is private</span><br>
      <span>Connect with {{$user->name}} to see it </span>
    </div>
    <a href="" id="follow_button" class="rounded-full">Connect</a>
  </section>
  
  @endif
</section>

<section class="sidepanel" id="right"> 
    
</section>

@endsection

