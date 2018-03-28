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
    
    {{-- Roles --}}
    @if ($roles->count())
        <div id="displayRoles">
            @foreach ($roles->chunk(3) as $chunk)
            <div id='roleCard' class="row mb-2">
                @each ('users.roles.partials._card', $chunk, 'role') 
            </div>
            @endforeach
        </div>
    @else
        No roles were found!
    @endif

    {{-- Modal --}}
    <div class="modal" id="roleModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                {{-- FORM --}}
                <form id="roleForm">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="role">Role</label>
                            <input class="form-control name" type="text" id="name" name="name" placeholder="Role name">

                            <span class="invalid-feedback name"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-role"></button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection


@section('scripts')

    <script>
        
        var roleModal = $('#roleModal');
        var roleForm = $('#roleForm');
        var adminRolesUrl = "{{ route('admin.roles.index') }}"
        var roleFields = ['name']

        roleModal.on('hidden.bs.modal', function(){

            clearForm(roleForm)

            clearServerErrors(roleFields)
        })

        roleModal.on('shown.bs.modal', function(){
            setAutofocus(roleModal, 'name')
        })
 
        // Create Role
        $(document).on('click', '#createRole', function(){

            roleModal.modal('show')

            $('.modal-title').text('Create Role')
            $('.btn-role').attr('id', 'storeRole').text('Save')
        })

        // Store Role
        $(document).on('click', '#storeRole', function(){

            data = {
                name: $('#name').val(),
            }


            $.ajax({
                url: adminRolesUrl,
                type: 'POST',
                data: data,
                success: function(response){
                    
                    $('#displayRoles').load(location.href + " #displayRoles")// !!! mind blank space
                    successResponse(response.message, roleModal)
                },
                error: function(response){
                    var errors = response.responseJSON.errors

                    for(let error in errors){

                        var field = $('.' + error)
                        var feedback = $('span.' + error)


                        field.addClass('is-invalid')
                        feedback.text(errors[error][0])
                    }
                }
            })
        })



    </script>

@endsection