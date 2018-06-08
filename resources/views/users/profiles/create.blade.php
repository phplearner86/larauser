@extends('layouts.admin')

@section('title', '| Admin | Profile ')


@section('content')

<div class="row">
    <div class="col-md-6">
        <form action="{{ route('admin.profiles.store', $user->id) }}" method="POST">
            @csrf
        
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') ?: optional($user->profile)->name }}" placeholder="Enter name">
            </div>
            <div class="form-group">
                <button class="btn btn-info" type="submit">
                    {{ $user->profile ? 'Save changes' : 'Create profile' }}
                </button>
            </div>

        </form>
    </div>
</div>

@endsection

@section('scripts')
   
@endsection