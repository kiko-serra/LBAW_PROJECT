@extends ('layouts.app')

@section('title', 'Admin')

@section('content')
    <section class="content m-20">
        <div class="card-header mb-10">User Profiles</div>
        <div class="card-collection flex flex-col">
            @foreach ($users as $user)
                <div class="card-body flex flex-row m-6 ml-9">
                    <img src="{{ asset('storage/' . $user->profile_picture) }}" class="img-thumbnail" alt="">
                    <a href="/user/{{ $user->id_account }}">{{ $user->name }}</a> 
                    <p class="col-auto">{{ $user->account_tag }}</p>
                    <p class="col-auto">{{ $user->email }}</p>
                    <p class="col-auto">{{ $user->birthday }}</p>
                    <p class="col-auto">{{ $user->university }}</p>
                    <p class="col-auto">{{ $user->course }}</p>
                </div>
            @endforeach 
        </div>
    </section>