var datatable = table.DataTable({
     "ajax": {
         "url": adminAccountsUrl,
         "type": "GET"
     },
     deferRender: true,
     "columns": [
         {
            {{-- First column with ordinal nmbers --}}
             render:function(data, type, row, meta){
                 return ""
             },
             searchable: false,
             orderable: false,
         },
         {
             data: "name",
             render:function(data, type, row, meta){
                 return '<a href="#" data-user=' + row.id + ' id="editProfile">' + data + '</a>'
             },
         },
         {
             data: "email",
         },
         {
            data: "roles",
             render:function(data,type,row,meta){
                return getRoleNames(data).length > 0 ? getRoleNames(data) + "<a href='#' data-user=" + row.id + " id='editRoles'> Revoke</a>" : ''
            }
         },
         {
             data: "verified",
             render:function(data,type,row,meta){
                return getAccountStatus(data)
            }
         },
         {
             data: "created_at",
             render:function(data,type,row,meta){
                return getFormattedDate(data)
            }
         },
         {
             render:function(data, type, row, meta){
                 return '<button class="btn btn-xs btn-link btn-edit" id="editAccount" value="' + row.id + '">Edit</button><button class="btn btn-xs btn-link btn-delete" id="deleteAccount" value="' + row.id + '">Delete</button>'
             },
             searchable: false,
             orderable: false,
         },
         {
             data: "id",
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

{{-- Set ordinal numbers for first column --}}

 setTableCounterColumn(datatable)