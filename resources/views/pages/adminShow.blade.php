@extends ('layouts.app')
@section('title', 'Admin')

@section('content')
    <div class="container">
        <div class="flex flex-col">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">User Profile</div>
                    <div class="card-body">
                        <div class="flex flex-col">
                            @foreach ($users as $user)
                                <div class="col-md-4">
                                    <img src="{{ asset('storage/' . $user->profile_picture) }}" class="img-thumbnail" alt="Profile Picture">
                                </div>
                                <div class="grid-col-6 m-6 ml-9">
                                    <a href="/user/{{ $user->id_account }}">{{ $user->name }}
                                        <p class="col-auto">{{ $user->account_tag }}</p>
                                        <p class="col-auto">{{ $user->email }}</p>
                                        <p class="col-auto">{{ $user->birthday }}</p>
                                        <p class="col-auto">{{ $user->university }}</p>
                                        <p class="col-auto">{{ $user->course }}</p>
                                    </a>  
                                </div>
                            @endforeach 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>