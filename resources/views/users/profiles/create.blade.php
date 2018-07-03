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

        $('.btn-subject').attr('id', 'addSubject')



    })
// var i = 0
//     $(document).on('click', '.btn-success', function(event){
//             if(i<4)
//             {
               
//             add_html  =   '<div class="form-inline"><label for="name">Subject</label><input type="text" name="subject_id[]" id="subject_id" class="form-control ml-3 mr-3"><button class="btn btn-success btn-sm form-control" id="addField">Add</button></div>'
            
//                 $(this).removeClass('btn-success').addClass("btn-warning").text('Remove')
//                 $(this).parent().after(add_html)
//                 i = i + 1
//             event.preventDefault()
//             }
//             else{
//                 event.preventDefault()
//             }
//             // $('.btn-success').after(add_html).removeClass('btn-success').addClass("btn-warning").attr('id','removeField').text('Remove')
//             // $(this).parent().addClass('remove')
//         });

//     $(document).on('click', '.btn-warning', function() {
//         $(this).parent().remove();
//         i = i-1
//             })

    
    @include('users.subjects.partials.js._store')
   

    $(document).on('click', '#editSubject', function(){

        editSubjectModal.modal('show')
        createSubjectModal.modal('hide')

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