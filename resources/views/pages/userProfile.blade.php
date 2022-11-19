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
        <span class="text-2xl">Bachelors in Informatics and Computer Engineering</span>
      </div>
      <div class="user_school flex flex-row" >
        <i class="fa-solid fa-school"></i>
        <span class="text-2xl">Faculdade de Engenharia da Universidade do Porto</span>
      </div>
      <div class="user_school flex flex-row" >
        <i class="fa-sharp fa-solid fa-location-dot"></i>
        <span class="text-2xl">Faculdade de Engenharia da Universidade do Porto</span>
      </div>
    </div>
    <div id="user_identity_info" class="flex flex-col">
      <div id="name">André Ávila</div>
      <div id="details" class="flex flex-row justify-between items-center text-gray-200">
        <div id="username">@andreavila</div>
        <i class="fa-solid fa-circle"></i>
        <div id="pronouns">he/him</div>
        <i class="fa-solid fa-circle"></i>
        <div id="age">20 years old</div>
      </div>
    </div>
    <a href="" id="follow_button" class="rounded-full">Connect</a>
    <div id="user_bio_section" class="flex flex-col">
      <div id="bio">Hello, my name is André, feel free to add me if you know me!</div>
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

</section>

<section class="sidepanel" id="right"> 
    
</section>

@endsection