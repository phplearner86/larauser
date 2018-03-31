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