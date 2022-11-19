@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('endregister') }}" class = "rounded-2xl bg-white">
    {{ csrf_field() }} 

    <h3 class="text-4xl">Almost there!</h3>

    <!-- Obligatory -->
    <label for="name">Name</label>
    <input id="name" type="text" name="name" value="{{ old('accounttag') }}">
    @if ($errors->has('name'))
      <span class="error">
          {{ $errors->first('name') }} {{-- Need to create validator --}}
      </span>
    @endif

    <label for="privacy">Privacy</label>
    <div class="flex flex-row">
        <input type="radio" name="privacy" value="private" id="profilePrivacy">
        <label for="privacy">Private</label>
    </div>
    <div class="flex flex-row">
        <input type="radio" name="privacy" value="public" id="profilePrivacy">
        <label for="privacy">Public</label>
    </div>

    <label for="pronouns">Pronouns</label>
    <input type="text" name="pronouns" id="pronouns">

    <label for="location">Location</label>
    <input type="text" name="location" id="location">

    <label for="description">Description</label>
    <textarea name="description" id="description" cols="30" rows="10"></textarea>
    


    <div class="flex flex-row justify-between">
        <button type="submit">
            Continue
        </button>
        <a href="{{ route('timeline') }}" class="self-center">
            Skip
        </a>
    </div>
</form>
@endsection
