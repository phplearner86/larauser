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
    <div class="modal" id="createAccountModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fa fa-lock"></i>
                            <span>Create Account</span>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                {{-- FORM --}}
                <form id="createAccountForm">
                    <div class="modal-body">

                        <!-- Role -->
                        <div class="form-group select-box">
                            <label for="role_id">Role</label>
                            <select class="role_id form-control req_place" name="role_id[]" id="role_id" multiple="multiple">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>

                            <span class="invalid-feedback role_id"></span>
                        </div>

                        {{-- Name --}}
                        <div class="form-group">
                            <label for="name">Name</label>

                            <input id="name" type="text" class="form-control name" name="name" placeholder="Enter name">
                            <span class="invalid-feedback name"></span>
                        </div>


                        {{-- Email --}}
                        <div class="form-group">
                            <label for="email">Email</label>

                            <input id="email" type="text" class="form-control email" name="email" placeholder="example@domain.com">
                            <span class="invalid-feedback email"></span>
                        </div>

                        {{-- Password --}}
                        <div class="form-group" >
                            <label for="password">Password</label>

                            <input id="password" type="password" class="form-control password" name="password" placeholder="Give password to the user">
                            <span class="invalid-feedback password"></span>
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="create-password" id="autoPassword" value="auto" checked="">
                                <label class="form-check-label" for="autoPassword">
                                    Auto generate password
                                </label>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-account" id="storeAccount">Create account</button>
                    </div>
                </form>

            </div>
        </div>
    </div>    
@endsection

@section('scripts')
    <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>
        var table = $('#accountsTable')
        var apiAccountsUrl = "{{ route('api.accounts.index') }}"
        var createAccountForm = $('#createAccountForm')

        var password = $('#password')
        password.hide()

        createAccountForm
            .find('select.role_id')
            .select2({
                placeholder: "Select roles",
                width: "100%"
            })

       // Datatable
        @include('users.accounts.js._datatable')


        // Create Account
        $(document).on('click', '#createAccount', function(){
            $('#createAccountModal').modal('show')
        })


    </script>
@endsection