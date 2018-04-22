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

    {{-- Modals --}}

    @include('users.accounts.partials._createModal')
    @include('users.accounts.partials._editModal')

@endsection

@section('scripts')
    <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>

        // ACCOUNT
        var table = $('#accountsTable')
        var adminAccountsUrl = "{{ route('admin.accounts.index') }}"

        // Create
        var createAccountForm = $('#createAccountForm')
        var createAccountModal = $('#createAccountModal')
        var accountFields = ['role_id', 'name', 'email', 'password']

        var auto_password = $('#autoPassword')
        var password = $('#password')
        password.hide()

        createAccountModal.setAutofocus('role_id')
        createAccountModal.emptyModal(accountFields, createAccountForm, auto_password, password)

        //Edit
        var editAccountModal = $('#editAccountModal')
        var editAccountForm = $('#editAccountForm')
        var _autoPassword = $('#_autoPassword')
        var _password = $('#_password')
        _password.hide()

        editAccountModal.setAutofocus('_role_id')
        editAccountModal.emptyModal(accountFields, editAccountForm, _autoPassword, _password)


        createAccountForm
            .find('select.role_id')
            .select2({
                placeholder: "Select roles",
                width: "100%"
            })

            editAccountForm
            .find('select.role_id')
            .select2({
                placeholder: "Select roles",
                width: "100%"
            })

       // Datatable
        @include('users.accounts.js._datatable')

        // Create Account
        @include('users.accounts.js._create')

        //Store account
        @include('users.accounts.js._store')

        //Edit account
        $(document).on('click', '#editAccount', function()
        {
            editAccountModal.modal('show')
            toggleHiddenFieldWithRadio('manual', _password)
             
        })

    </script>
@endsection