@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div id="subjs">
        @foreach ($user->profile->subjects as $subject)
                <p class="klik">{{ $subject->name }}</p>
            @endforeach
        </div>
            <form action="{{ route('deleteall', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">REmove all</button>
                </form>
                <button class="btn btn-info" id="addSubjects" value="{{ $user->id }}">Add subjects</button>
                <button class="btn btn-primary" id="editSubjects" value="{{ $user->id }}">Edit subjects</button>

    </div>
    <div class="col-md-6">
        <div class="modal" tabindex="-1" role="dialog" id="createModal">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="createSubjectForm">

                    
                      <div class="form-inline">
                        <label for="name">Subject</label>
                        
                          <input type="text" name="subject_id[]"  class="form-control ml-3 mr-3">
                          <button class="btn btn-success btn-sm form-control" id="addField">Add</button>
                        
                      </div>
                        
                      
                    
                    
                <button class="btn btn-danger" type="submit" id="storeSubject" value="{{ $user->id }}">Submit</button>
                    
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

{{--              EDIT EDIT EDIT EDIT EDIT EDIT             --}}
        <div class="modal" tabindex="-1" role="dialog" id="editModal">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Edit <button id="addField">aAdd field</button></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="editSubjectForm">

                    
                    
                <button class="btn btn-danger" type="submit" id="updateSubject" value="{{ $user->id }}">Submit</button>
                    
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        

    </div>
</div>
@endsection

@section('scripts')
  <script>

    var html = '<div class="form-inline"><label for="name">Subject</label><input type="text" name="subject_id[]"  class="form-control ml-3 mr-3"><button class="btn btn-success btn-sm form-control" id="addField">Add</button></div>'

    var html_warning = '<div class="form-inline"><label for="name">Subject</label><input type="text" name="subject_id[]"  class="form-control ml-3 mr-3"><button class="btn btn-warning btn-sm form-control" id="addField">Remove</button></div>'

    $(document).on('click', '#addSubjects', function(){
        $('#createModal').modal('show')
    })

    $('#editModal').on('hidden.bs.modal', function () {
        $('#editModal .form-inline').remove()
})
    $(document).on('click', '#addField', function(){
        var inputs = [];
        var array1 = [1,2,3,4,5, '']
        $('#editModal input').each(function(){
            if(this.value == '')
            {
                
                $(this).css("border-color", "red")
            }
            inputs.push(this.value)
            
        })
        function isANumber(number)
        {
            return $.isNumeric(number)
        }
        if(inputs.every(isANumber))
        {
            $('#editModal .form-inline').last().append(html_warning)
        }
        // if(!inputs.inArray(false))
        // {
        //     
        // }
        
    })

     $(document).on('click', '#editSubjects', function(){
        $('#editModal').modal('show')
        var user = $('#storeSubject').val()
        var url = '/test/show/' + user
        $.ajax({
            type:'GET',
            url:url,
            success: function(response)
            {
                for(i=0; i<response.length; i++)
                {
                    var html = '<div class="form-inline"><label for="name">Subject</label><input type="text" name="subject_id[]"  class="form-control ml-3 mr-3" value="'+ response[i].id +'"><button class="btn btn-warning btn-sm form-control" >Remove</button></div>'
                    $('#updateSubject').before(html)
                }
               
            }
        })

    })

     $(document).on('click', '#updateSubject', function(event){
            event.preventDefault()
        var subjs = []
        $('#editModal input').each(function(){
            if(this.value != false)
            {
                subjs.push(this.value)
            }
        })

        var data = {
            'subject_id': subjs
        }
        console.log(data)
        //return false;
        var user = $('#updateSubject').val()
        var url = '/test/' + user
        $.ajax({
            type:'PUT',
            url:url,
            data:data,
            success:function(response)
            {
                //console.log(location)
                $('#subjs').load(location.href + ' .klik')
                var subj = response.profiles.subjects
                $('#editModal').modal('hide')
            }
        })
     })

    $(document).on('click', '.btn-success', function(e){
        e.preventDefault();
        // html = '<div class="form-inline"><label for="name">Subject</label><input type="text" name="subject_id[]"  class="form-control ml-3 mr-3"><button class="btn btn-success btn-sm form-control" id="addField">Add</button></div>'

        $(this).removeClass('btn-success').addClass("btn-warning").text('Remove')
               $(this).parent().after(html)
        //$(this).preventDefault();
        
    })
    $(document).on('click', '.btn-warning', function(e){
        e.preventDefault();
        //$(this).removeClass('btn-success').addClass("btn-warning").text('Remove')
        //$(this).parent().after(html)
               $(this).parent().remove()
        //$(this).preventDefault();
        
    })


    $(document).on('click', '#storeSubject', function(e){
        e.preventDefault()
        //console.log($('#storeSubject').val())
        var user = $('#storeSubject').val()
        var url = '/test/' + user
        var subjects = []
        //console.log($( "select" ).val())
        $("input[name*='subject_id']").each(function() {
            if(this.value != false)
            {
                subjects.push(this.value)
            }
});
        
        var data = {
            'subject_id': subjects
        }

        
        $.ajax({
            type:'POST',
            url:url,
            data:data,
            success:function(response)
            {
                //console.log()
                $('#subjs').load(location.href + ' .klik')
                var subj = response.profiles.subjects
                $('#createModal').modal('hide')
                $('#createModal input').val('');
                                                                    var date1 = new Date(subj[0].created_at);
                //var date2 = new Date("12/15/2010");
                                                                            date1.getTime()
                // for(i=0; i<response.length; i++)
                // {
                //     var html = '<div class="form-inline"><label for="name">Subject</label><input type="text" name="subject_id[]"  class="form-control ml-3 mr-3" value="'+ response[i].id +'"><button class="btn btn-warning btn-sm form-control" >Remove</button></div>'
                //     $('#updateSubject').before(html)
                // }
            
             
            }
        })
    })
  </script>
@endsection