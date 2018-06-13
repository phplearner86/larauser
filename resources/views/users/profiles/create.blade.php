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

    <div class="col-md-3">
        <div class='text-center' id="profileAvatar">
            <img src="" alt="" class="image">
            <button class="btn btn-link" id="changeAvatar" value="{{ $user->profile->id }}">Change</button>
        </div>
    </div>
</div>

@include('users.profiles.partials.modals._create')

<div class="modal" tabindex="-1" role="dialog" id="avatarModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Profile avatar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

        <form id="saveAvatarForm" enctype="multipart/form-data">
            <div class="modal-body">
                <label for="avatar">Avatar</label>
                <div class="form-group">
                    <input type="file" name="filename" id="avatar">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="saveAvatar">Save Avatar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </form>

    </div>
  </div>
</div>

@endsection

@section('scripts')
   <script>

    var saveProfileModal = $('#saveProfileModal')

    $(document).on('click', '#openModal', function(){

       saveProfileModal.modal('show')

       var user = $(this).val()

       $('#saveProfile').val(user)

    })

    //Create profile
    
    $(document).on('click', '#saveProfile', function(){


        var user = $(this).val()
        var saveProfileUrl = '/admin/profiles/' + user

        var name = $('#name').val()
        console.log(name)
        var data = {
            'name':$('#name').val()
        }

        $.ajax({
            type:'PUT',
            url:saveProfileUrl,
            data:data,
            success: function(response)
            {
                console.log(response)
                $('#userName').load(location.href + ' #userName')
                saveProfileModal.modal('hide')
            }
        })

        console.log(saveProfileUrl)
    })

    //Change avatar
    
    var avatarModal = $('#avatarModal')
    
    $(document).on('click', '#changeAvatar', function(){
        avatarModal.modal('show')
        var user = $(this).val()
        $('#saveAvatar').val(user)
    })

    $(document).on('click', '#saveAvatar', function(){
        
        var user = $(this).val()
        var saveAvatarUrl = '/admin/avatars/' + user
        var data = {
            filename:$('#avatar').val()
        }

        $.ajax({
            type:'PUT',
            url:saveAvatarUrl,
            data:data,
            success: function(response){
                console.log(response)
            }
        })

    })


   </script>
@endsection