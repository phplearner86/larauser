@extends('layouts.admin')

@section('title', '| Admin | Accounts ')
@section('links')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.dataTables.min.css" />
    <style>
        .dataTables_wrapper{
            font-size: 13px;
        }
    </style>
@endsection
   

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Accounts <i class="fa fa-heart"></i></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">

            </div>

        </div>
    </div>

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
@endsection

@section('scripts')
    <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>

    <script>
        var table = $('#accountsTable')
        var apiAccountsUrl = "{{ route('api.accounts.index') }}"

       var datatable = table.DataTable({
            "ajax": {
                "url": apiAccountsUrl,
                "type": "GET"
            },
            deferRender: true,
            "columns": [
                {
                    render:function(data, type, row, meta){
                        return ""
                    },
                    searchable: false,
                    orderable: false,
                },
                {
                    data: "name",
                    render:function(data, type, row, meta){
                        return '<a href="#" data-user=' + row.user + ' id="editProfile">' + data + '</a>'
                    },
                },
                {
                    data: "email",
                },
                {
                    data: "status",
                },
                {
                    data: "joined",
                },
                {
                    render:function(data, type, row, meta){
                        return '<button class="btn btn-xs btn-link btn-edit" id="editAccount" value="' + row.user + '">Edit</button><button class="btn btn-xs btn-link btn-delete" id="deleteAccount" value="' + row.user + '">Delete</button>'
                    },
                    searchable: false,
                    orderable: false,
                },
                {
                    data: "user",
                    visible: false
                }
            ],
            "order": [2, "desc"],
            responsive: true,
            columnDefs: [
                {responsivePriority: 1, targets: 0},
                {responsivePriority: 2, targets: 2},
                {responsivePriority: 3, targets: 3},
            ]

        });


        setTableCounterColumn(datatable)


    </script>
@endsection