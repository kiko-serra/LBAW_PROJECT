@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}
    <label for="email">E-mail</label>
    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
    @if ($errors->has('email'))
        <span class="error">
          {{ $errors->first('email') }}
        </span>
    @endif

    <label for="password" >Password</label>
    <input id="password" type="password" name="password" required>
    @if ($errors->has('password'))
        <span class="error">
            {{ $errors->first('password') }}
        </span>
    @endif

    <label class="hidden">
        <input type="checkbox" name="remember2" {{old('remember3') ? 'checked' : ''}}> Remember Me
    </label>

    <button type="submit" class="mt-4">
        Login
    </button>
    <a class="button button-outline" href="{{ route('register') }}">Register</a>
</form>
@endsection