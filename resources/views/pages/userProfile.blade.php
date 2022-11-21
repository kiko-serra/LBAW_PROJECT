@extends('layouts.app')

@section('title', 'UserProfile')

@section('content')

<section class="sidepanel" id="left"> 
    
</section>
<section id="timeline">

  <section id="profile">
    <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" id="profile_image" class="m-auto rounded-full"></div>
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
      <div>{{ count($friendships) }} connections</div>
      <!-- <div>X, Y and Z and H other friends in common</div> -->
      <div class="flex flex-row"> 
        <?php
          if ($user->id_account != Auth::user()->id_account) {
            $i = 0;
            foreach ($friendships as $friend) {
              echo view('partials.UserProfile.commonFriend', ['number'=> $i, 'userId' => $friend->id_account]); 
              $i++;
              if ($i > 3) break;
            }
            $i = 0;
            foreach ($friendships as $friend) {
              echo $friend->name;
              $i++;
              if ($i > 3 || $i == count($friendships)) break;
              else {
                echo ', ';
              }
            }

            if ($i > 3) {
              echo ' and ' . count($friendships) - $i . ' other connections in common.';
            } else if ($i == 0) {
              echo 'No friends in common.';
            } else {
              echo ' in common.';
            }
          }
        ?>
      </div>
    </div>
    <div id="filters" class="grid grid-cols-5 gap-x-4 mx-4 h-fit">
      <a class="profile-page-filter-button profile-page-filter-button-selected"> All</a>
      <a class="profile-page-filter-button">Posts</a>
      <a class="profile-page-filter-button">Promotions</a>
      <a class="profile-page-filter-button">Reactions</a>
      <a class="profile-page-filter-button">Responses</a>
    </div>
  </section>

  <div id="posts">
    @each('partials.post', $posts, 'post')
  </div>

</section>

<section class="sidepanel" id="right"> 
    
</section>

@endsection