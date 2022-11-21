@extends ('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">User Profile</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ asset('storage/' . $user->profile_picture) }}" class="img-thumbnail" alt="Profile Picture">
                            </div>
                            <div class="col-md-8">
                                <h3>{{ $user->name }}</h3>
                                <p>{{ $user->email }}</p>
                                <p>{{ $user->birthday }}</p>
                                <p>{{ $user->university }}</p>
                                <p>{{ $user->course }}</p>
                                <p>{{ $user->account_tag }}</p>
                                <p>{{ $user->created_at }}</p>
                                <p>{{ $user->updated_at }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>