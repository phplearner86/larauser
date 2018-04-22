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
            <form action="{{ route('users.accounts.update') }}" method="POST">
                @method('PUT')
                @csrf

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" placeholder="Enter your name" value="{{ old('name') ?: $user->name }}">

                        @if ($errors->has('name'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" name="email" placeholder="Enter your email" value="{{ old('email') ?: $user->email }}"> 

                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                    <div class="col-md-6">
                        <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="password" name="password" placeholder="Choose your password">

                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm password</label>

                    <div class="col-md-6">
                        <input type="password" class="form-control" id="password-confirm" name="password-confirmation" placeholder="Retype your password">
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-info">Save changes</button>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
@endsection
