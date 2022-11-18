@extends('layouts.app')

@section('title', 'Timeline')

@section('content')

<section class="sidepanel" id="left"> 
    
</section>
<section id="timeline">

  <section id="profile">
    <div id="profile_image"></div>
    <div id="user_life_info"></div>
    <div id="user_identity_info"></div>
    <div id="follow_button"></div>
    <div id="user_bio"></div>
    <div id="filters"></div>
  </section>

  <div id="posts">
    @each('partials.post', $posts, 'post')
  </div>

</section>

<section class="sidepanel" id="right"> 
    
</section>

@endsection