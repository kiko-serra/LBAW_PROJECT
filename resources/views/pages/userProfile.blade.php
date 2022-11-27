@extends('layouts.app')

@section('title', 'UserProfile')

@section('content')

<?php echo view('partials.leftPanel.panel'); ?>

<section id="timeline">

@if (!$user->is_private || $isFriend || $user->id_account == Auth::user()->id_account)
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
    @if ($user->id_account == Auth::user()->id_account)
      <span id="connect_button" data-method="edit" class="bg-cyan-400 text-white py-2 px-8 text-center h-fit w-fit cursor-pointer select-none rounded-full">Edit</span>
    @else
      <span id="connect_button" data-method="connect" data-id={{ $user->id_account }} class="bg-cyan-400 text-white py-2 px-8 text-center h-fit w-fit cursor-pointer select-none rounded-full">Connect</span>
    @endif
    <div id="user_bio_section" class="flex flex-col">
      <div id="bio">{{ $user->description }}</div>
      <div id="userProfileConnections" class="cursor-pointer select-none">{{ count($friendships) }} connections</div>
      <!-- <div>X, Y and Z and H other friends in common</div> -->
      <div id="userProfileFriendConnections" class="flex flex-row items-center cursor-pointer select-none hover:underline"> 
        <?php
          if ($user->id_account != Auth::user()->id_account) {
            $i = 0;
            foreach ($commonFriendships as $friend) {
              echo view('partials.UserProfile.commonFriend', ['number'=> $i]); 
              $i++;
              if ($i > 2) break;
            }
            echo '<p class="text-2xl mr-2"></p>';
            $i = 0;
            foreach ($commonFriendships as $friend) {
              echo $friend->name;
              $i++;
              if ($i == count($commonFriendships)-1) {
                echo ' and';
                continue;
              } else if ($i > 2 || $i == count($commonFriendships)) break;
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
            echo '</p>';
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


  @if ($user->id_account == Auth::user()->id_account)
  <?php echo view('partials.UserProfile.editModal', ['user' => $user])?>
  @endif

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
    <a href="" id="connect_button" class="rounded-full">Connect</a>
  </section>
  
  @endif
</section>

<?php echo view('partials.rightPanel.panel', ['type' => 'profile', 'friends' => $friendships]); ?>

@endsection

