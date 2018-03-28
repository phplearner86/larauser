@extends('layouts.admin')

@section('title', '| Admin | Roles')
   

@section('content')

    {{-- Title --}}
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h2>Roles</h2>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button class="btn btn-warning" id="createRole">New Role</button>
        </div>
    </div>
    
    @if ($roles->count())
        @foreach ($roles->chunk(3) as $chunk)
        <div id='roleCard' class="row mb-2">
            @each ('users.roles.partials._card', $chunk, 'role') 
        </div>
        @endforeach
    @else
        No roles were found!
    @endif


@endsection

@section('scripts')
    {{-- expr --}}
@endsection