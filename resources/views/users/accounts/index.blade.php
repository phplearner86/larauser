@extends('layouts.admin')

@section('title', '| Admin | Accounts ')
@section('links')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" />
    <style>
        .dataTables_wrapper{
            font-size: 13px;
        }
    </style>
@endsection
   

@section('content')

    {{-- Title --}}
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Accounts</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button class="btn btn-warning" id="createAccount">New Account</button>
        </div>
    </div>

    {{-- Table --}}
    <div class="table-responsive admin-table-wrapper">
        <table id="accountsTable" class="table hover order-column admin-table-class" width="100%" cellspacing="0">
            <thead>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Status</th>
                <th>Joined</th>
                <th>Actions</th>
            </thead>
            <tbody>
                {{-- datatable --}}
            </tbody>
        </table>
    </div>

    {{-- Create Modal --}}
    @include('users.accounts.partials.modals._create')

    {{-- Edit Modal --}}
    @include('users.accounts.partials.modals._edit')

    {{-- Revoke roles --}}
    @include('users.roles.partials._revokeRoles')


@endsection

@section('scripts')
    <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>
        var table = $('#accountsTable')
        var adminAccountsUrl = "{{ route('admin.accounts.index') }}"

        // Create account
        var createAccountForm = $('#createAccountForm')
        var createAccountModal = $('#createAccountModal')
        var accountFields = ['role_id', 'name', 'email', 'password']

        var auto_password = $('#autoPassword')
        var password = $('#password')
        password.hide()
        
        
        createAccountModal.setAutofocus('role_id')
        createAccountModal.emptyModal(accountFields, createAccountForm, auto_password, password)


        createAccountForm
            .find('select.role_id')
            .select2({
                placeholder: "Select roles",
                width: "100%"
            })

        // Edit account
        var editAccountForm = $('#editAccountForm')
        var editAccountModal = $('#editAccountModal')

        var _auto_password = $('#_autoPassword')
        var _password = $('#_password')
        _password.hide()

        editAccountForm
            .find('select.role_id')
            .select2({
                placeholder: "Select roles",
                width: "100%"
            })

       // Datatable
        @include('users.accounts.partials.tables._datatable')


        // Create Account
        $(document).on('click', '#createAccount', function(){
            $('#createAccountModal').modal('show')

            toggleHiddenFieldWithCheckbox(auto_password, password)
        })

        //Store account
        $(document).on('click', '#storeAccount', function()
        {

            var field = $('#autoPassword')
            var password = generatePassword(field)

            var data = {
                role_id: $('#role_id').val(), 
                name: $('#name').val(), 
                email: $('#email').val(), 
                password: password, 
            }

            $.ajax({
                url: adminAccountsUrl,
                type: 'POST',
                data: data,
                success: function(response)
                {
                    successResponse(createAccountModal, response.message)
                    datatable.ajax.reload()
                },
                error: function(response)
                {
                    errorResponse(createAccountModal, response.responseJSON.errors)
                }
            })
        })

        //Edit account
        $(document).on('click','#editAccount', function(){

            $('#editAccountModal').modal('show');

            toggleHiddenFieldWithRadio('manual', _password)

            var user = $(this).val()
            var editAccountUrl =  adminAccountsUrl + '/' + user

            $('#updateAccount').val(user)

            $.ajax({
                type: "GET",
                url: editAccountUrl,
                success: function(response){

                    var user = response.user
                    var roleIds = getUserRoles(user.roles)

                    $('#_name').val(user.name)
                    $('#_email').val(user.email)
                    $('#_role_id').val(roleIds).trigger('change')

                }
            })
        })


        //Update account
        $(document).on('click', '#updateAccount', function(){

            var user = $(this).val()
            var updateAccountUrl =  adminAccountsUrl + '/' + user
            var password = changePassword()

            var data = 
            {
                role_id:$('#_role_id').val(),
                name:$('#_name').val(),
                email:$('#_email').val(),
                password: password,
                password_confirmation: password
            }

            $.ajax({
                type:'PUT',
                url: updateAccountUrl,
                data: data,
                success: function(response)
                {
                    successResponse(editAccountModal, response.message)
                    datatable.ajax.reload()
                },
                error: function(response)
                {
                    errorResponse(editAccountModal, response.responseJSON.errors)
                }
            })
        });

        // Revoke roles
         
        var revokeRolesModal = $('#revokeRolesModal')

        $(document).on('click', '#editRoles', function(){

            revokeRolesModal.modal('show')

            var user = $(this).attr('data-user')
            var userRolesUrl = adminAccountsUrl + '/' + user

            $('#revokeRoles').val(user)

            $.ajax({
                type:'GET',
                url: userRolesUrl,
                success: function(response){
                    $('#role').html(response.revoke_roles_html)
                }
            })
        });

        $(document).on('click', '#revokeRoles', function(){

           
           var user = $(this).val()
           var revokeRolesUrl = '/admin/roles-revoke/' + user

           var roleIds =  getCheckBoxValues('role_id')

           var data = {
            'role_id': roleIds
           }

           $.ajax({
                type:'DELETE',
                url:revokeRolesUrl,
                data:data,
                success: function(response){
                    successResponse(revokeRolesModal, response.message)
                    datatable.ajax.reload()
                },
                error: function(response){
                    errorResponse(revokeRolesModal, response.responseJSON.errors)
                }
           })

        })

        

    </script>
@endsection