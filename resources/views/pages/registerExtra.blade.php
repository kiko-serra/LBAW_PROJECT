@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('endregister') }}" class = "rounded-2xl bg-white">
    {{ csrf_field() }} 

    <h3 class="text-4xl">Almost there!</h3>

    <!-- Obligatory -->
    <label for="name">Name</label>
    <input id="name" type="text" name="name" value="{{ old('accounttag') }}" maxlength="32">
    @if ($errors->has('name'))
      <span class="error">
          {{ $errors->first('name') }} {{-- Need to create validator --}}
      </span>
    @endif

    <label for="privacy">Privacy</label>
    <div class="flex flex-row">
        <input type="radio" name="privacy" value="private" id="profilePrivacy" checked>
        <label for="privacy">Private</label>
    </div>
    <div class="flex flex-row">
        <input type="radio" name="privacy" value="public" id="profilePrivacy">
        <label for="privacy">Public</label>
    </div>

    <label for="pronouns">Pronouns</label>
    <input type="text" name="pronouns" id="pronouns" maxlength="20">
    @if ($errors->has('pronouns'))
      <span class="error">
          {{ $errors->first('pronouns') }}
      </span>
    @endif

    <label for="location">Location</label>
    <input type="text" name="location" id="location" maxlength="32">
    @if ($errors->has('location'))
      <span class="error">
          {{ $errors->first('location') }}
      </span>
    @endif

    <label for="description">Description</label>
    <textarea name="description" id="description" cols="30" rows="10" maxlength="255"></textarea>
    @if ($errors->has('description'))
      <span class="error">
          {{ $errors->first('description') }} {{-- Need to create validator --}}
      </span>
    @endif


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
