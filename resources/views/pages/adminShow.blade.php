@extends ('layouts.app')

@section('title', 'Admin')

@section('content')
<section class="content">
    <div class="text-center text-black text-6xl">User Profiles</div>
    <div class="card-collection flex flex-col">
        @foreach ($users as $user)
            <div id={{$user->id_account}} class="card-body flex flex-row m-6 ml-9">
                <img src="{{ asset('storage/' . $user->profile_picture) }}" class="img-thumbnail" alt="">
                <a href="/user/{{ $user->id_account }}">{{ $user->name }}</a> 
                <p class="col-auto">{{ $user->account_tag }}</p>
                <p class="col-auto">{{ $user->email }}</p>
                <p class="col-auto">{{ $user->birthday }}</p>
                <p class="col-auto">{{ $user->university }}</p>
                <p class="col-auto">{{ $user->course }}</p>
                <p class="is_blocked col-auto">{{$user->is_blocked}}</p>
                
                @if ($user->is_blocked == true)
                    <input class="button" type="button" value="Unblock" onclick="block(this);">
                @else
                <input class="button" type="button" value="Block" onclick="block(this);">
                @endif
            </div>
        @endforeach 
    </div>
</section>
@endsection