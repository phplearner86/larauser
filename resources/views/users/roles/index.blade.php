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
    @include('users.roles.partials._modal')

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

                     errorResponse(response.responseJSON.errors)

                }
            })
        })

        //Edit Role
        $(document).on('click', '#editRole', function(){
            roleModal.modal('show')

            var role = $(this).val()
            var editRoleUrl = adminRolesUrl + '/' + role

            $('.modal-title').text('Edit role')
            $('.btn-role').attr('id', 'updateRole').text('Save changes').val(role)// !!! Assign role value to update button

            $.ajax({
                url: editRoleUrl,
                type: 'GET',
                success: function(response)
                {
                    var role = response.role

                    $('#name').val(role.name)
                }
            })
        })


        //Update Role
        $(document).on('click', '#updateRole', function(){

            var role = $(this).val()
            var updateRoleUrl = adminRolesUrl + '/' + role

            data = {
                name: $('#name').val(),
            }

            $.ajax({
                url: updateRoleUrl,
                type: 'PUT',
                data: data,
                success: function(response)
                {
                    $('#displayRoles').load(location.href + " #displayRoles")// !!! mind blank space
                    successResponse(response.message, roleModal)
                },
                error: function(response){

                     errorResponse(response.responseJSON.errors)

                }
            })
        })

        //Delete Role
        
        $(document).on('click', '#deleteRole', function(){

            var role = $(this).val()
            var deleteRoleUrl = adminRolesUrl + '/' + role 

            $.ajax({
                url: deleteRoleUrl,
                type: 'DELETE',
                success: function(response)
                {
                    $('#displayRoles').load(location.href + " #displayRoles")// !!! mind blank space
                    successResponse(response.message, roleModal)
                }
            })
        })
        



    </script>

@endsection