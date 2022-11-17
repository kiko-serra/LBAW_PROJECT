@extends('layouts.app')

@section('title', 'Timeline')

@section('content')

<section id="cards">
  @each('partials.post', $posts, 'post')
</section>

@endsection