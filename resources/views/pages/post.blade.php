@extends('layouts.app')

@section('title', $post->name)

@section('content')
  @include('partials.post', ['post' => $post])
@endsection
