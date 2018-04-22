@extends('layouts.app')

@section('title', ' | My Account')

@section('side')
    @include('partials.side._auth')
@endsection

@section('content')
    <div class="card user-panel">
        <div class="card-header">
            <h4>
                <i class="fa fa-lock fa-panel mr-6"></i>My Account
            </h4>
        </div>
        <div class="card-body">

            @include('users.accounts.forms._edit')
            
        </div>
    </div>
@endsection
