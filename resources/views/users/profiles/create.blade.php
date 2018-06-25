@extends('layouts.admin')

@section('title', '| Admin | Profile ')


@section('content')

<div class="row">

    <div class="col-md-2">
        <h2>User profile</h2>
        <p id="userName">Name: {{ optional($user->profile)->name ?: 'N/A' }}</p>

        
        <p>
            <button id="openModal" value="{{ $user->id }}">
                {{ $user->profile ? 'Save changes' : 'Create profile' }}
            </button>
        </p>
    </div>

   {{--  <div class="col-md-3">
        <div class='text-center' id="profileAvatar">
            <div id="profileImage">
            <img src="{{ asset('images/avatars/'.optional($user->profile->avatar)->filename) }}"  alt="" width="150px">
        </div>
            <button class="btn btn-link" id="changeAvatar" value="{{ $user->profile->id }}">Change Avatar</button>
        </div>
    </div> --}}
</div>

<div class="row">
    <div class="col-md-12">

        <button class="btn btn-default btn-subject"  value="{{ $user->id }}">
            {{ $user->profile->subjects->count() ? 'Change' : 'Add' }}
        </button>
        
        <div id="profileSubjects">

            @foreach ($user->profile->subjects as $subject)
                <p>{{ $subject->name }}</p>
            @endforeach

        </div>
    </div>
</div>

@include('users.profiles.partials.modals._create')

@include('users.avatars.partials.modals._create')

@include('users.subjects.partials.modals._create')

@endsection

@section('scripts')
   <script>
    
    @include('users.profiles.partials.js._all')

    //Subject
    
    var createSubjectModal = $('#createSubjectModal')

    $(document).on('click', '.btn-subject', function(){

        createSubjectModal.modal('show')

        $('.btn-subject').attr('id', 'addSubject')

    })

    $(document).on('click', '#storeSubject', function(){

        var user = $('#addSubject').val()
        var data = {
            'subject_id': $('#createSubjectForm #subject_id').val()
        }
        var url = '/admin/profiles/' + user

        $.ajax({
            type:'PATCH',
            url:url,
            data:data,
            success:function(response)
            {
                successResponse(createSubjectModal, response.message)
                $('#profileSubjects').load(location.href + ' #profileSubjects')
                $('.btn-subject').attr('id', 'updateSubject').text('Change')
            }
        })
    })

   </script>
@endsection