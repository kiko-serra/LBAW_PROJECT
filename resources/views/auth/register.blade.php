@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('register') }}" class = "rounded-2xl bg-white">
    {{ csrf_field() }} 

    <!-- Obligatory and Unique-->
    <label for="username"> Username </label>
    <input id="username" type="text" name="username" value="{{ old('username') }}"" required autofocus> 
    @if ($errors->has('username'))
      <span class="error">
          {{ $errors->first('username') }} {{-- Need to create validator --}}
      </span>
    @endif

    <!-- Obligatory -->
    <label for="name">Name</label>
    <input id="name" type="text" name="name" value="{{ old('name') }}" required>
    @if ($errors->has('name'))
      <span class="error">
          {{ $errors->first('name') }} {{-- Need to create validator --}}
      </span>
    @endif
    
    <!-- Obligatory and Unique-->
    <label for="email">E-Mail (use educational email for premium verification)</label>
    <input id="email" type="email" name="email" value="{{ old('email') }}" required>
    @if ($errors->has('email'))
      <span class="error">
          {{ $errors->first('email') }} {{-- Need to create validator --}}
      </span>
    @endif

    <!-- Obligatory-->
    <label for="birthday">Birthday</label>
    <input id="birthday" type="date" name="birthday" value="{{ old('birthday') }}" required>
    @if ($errors->has('birthday'))
      <span class="error">
          {{ $errors->first('birthday') }} {{-- Need to create validator --}}
      </span>
    @endif

    <!-- Obligatory-->
    <label for="privacy">Profile Privacy</label>

    <input type="radio" id="private" name="privacy" value="private" checked="checked">
    <label for="private">Private</label><br>
    <input type="radio" id="public" name="privacy" value="public">
    <label for="public">Public</label><br>

    <!-- TO DO: UNIVERSITIES LIST -->
    <!-- Obligatory -->
    <label for="university">University</label>
    <select name="university" id="university" value="{{ old('university') }}" required>
      <option value="porto">Universidade Porto</option>
      <option value="minho">Universidade Minho</option>
      <option value="coimbra">Universidade Coimbra</option>
      <option value="lisboa">Universidade Lisboa</option>
    </select>

    <!-- Obligatory -->
    <label for="course">Course</label>
    <input id="course" type="text" name="course" value="{{ old('course') }}" required>
    @if ($errors->has('course'))
      <span class="error">
          {{ $errors->first('course') }} {{-- Need to create validator --}}
      </span>
    @endif


    <!-- Obligatory-->
    <label for="password">Password</label>
    <input id="password" type="password" name="password" required>
    @if ($errors->has('password'))
      <span class="error">
          {{ $errors->first('password') }}
      </span>
    @endif



    <label for="password-confirm">Confirm Password</label>
    <input id="password-confirm" type="password" name="password_confirmation" required>

    <button type="submit">
      Register
    </button>
    <a class="button button-outline" href="{{ route('login') }}">Login</a>
</form>
@endsection
