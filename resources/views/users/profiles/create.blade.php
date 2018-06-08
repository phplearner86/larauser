@extends('layouts.admin')

@section('title', '| Admin | Profile ')


@section('content')

<div class="row">

    <div class="col-md-6">
        <h2>User profile</h2>
        <p id="userName">Name: {{ optional($user->profile)->name ?: 'N/A' }}</p>
        <p>
            <button id="openModal" value="{{ $user->id }}">
                {{ $user->profile ? 'Save changes' : 'Create profile' }}
            </button>
        </p>
    </div>

    <div class="col-md-6">
        {{-- <form action="{{ route('admin.profiles.store', $user->id) }}" method="POST">
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

        </form> --}}
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="saveProfileModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">User profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

        <form id="saveProfileForm">
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name') ?: optional($user->profile)->name }}" placeholder="Enter name">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="saveProfile">Save Profile</button>
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

   </script>
@endsection