@extends('layouts.admin')

@section('title', '| Admin | Profile ')


@section('content')

<div class="row">

    <div class="col-md-2">
        <h2>User profile</h2>
        <p id="userName">Name: {{ optional($user->profile)->name ?: 'N/A' }}</p>

        
        <p>
            <button id="openModal" id="" value="{{ $user->id }}">
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

        <button class="btn btn-default btn-subject" id="{{ optional($user->profile->subjects)->count() ? 'editSubject' : 'addSubject' }}"  value="{{ $user->id }}">
            {{ optional($user->profile->subjects)->count() ? 'Change' : 'Add' }}
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

@include('users.subjects.partials.modals._edit')

@endsection

@section('scripts')
   <script>
    
    @include('users.profiles.partials.js._all')

    //Subject
    
    var createSubjectModal = $('#createSubjectModal')
    var editSubjectModal = $('#editSubjectModal')

    $(document).on('click', '.btn-subject', function(){

        createSubjectModal.modal('show')

        //$('.btn-subject').attr('id', 'addSubject')

    })

    @include('users.subjects.partials.js._store')
   

    $(document).on('click', '#editSubject', function(){

        editSubjectModal.modal('show')

        var user = $(this).val()
        var url = '/admin/profiles/' + user

        $.ajax({
            type:'GET',
            url:url,
            success: function(response){

                var subjects = response.user.profile.subjects

                var subjectIds = []
                $.each(subjects, function(key, value){

                    subjectIds.push(value.id)
                })

                 var html = ''
                 
                

                for (i = 0; i < subjectIds.length; i++) { 

                    html = '<div class="form-group"><label for="name">Subject</label><input type="text" name="subject_id" id="subject_id'+ i +'" class="form-control"></div>'
                    
                    $('#updatedSubject').append(html)

                    $('#editSubjectForm #subject_id'+i+'').val(subjectIds[i])
                    console.log(subjectIds[i])

                }
            }
        })
    })

   </script>
@endsection