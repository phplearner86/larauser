@extends('layouts.admin')
@section('links')
    <style>
        .is-hidden{
            display: none;
        }
    </style>
@endsection
@section('content')
  @if ($errors->any())
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  @endif
    <div class="row">
        <h1>Profile Schedule for {{ $profile->user->name }} NEw  </h1> <button class="btn btn-danger ml-3" id="addDay">Add day</button> 
    </div>

   <div class="row">
     <div class="col-md-10">
       <form action="{{ route('createSchedule', $profile->id) }}" method="POST">
        @csrf
        <div class="add-input">
           <div class="label">
               <label for="day">Day 1</label>
           </div>
           <div class="flex">
                <div>
                    <select class="form-control select" name="day[]" >
                        @foreach ($days as $day)
                        <option value="{{ $day->id }}">{{ $day->name }}</option>
                        @endforeach
                    </select>
                    <span class="invalid-feedback day"></span>
                </div>
                <div>
                    <input type="text" class="form-control" placeholder="00:00" name="start[]">
                    <span class="invalid-feedback start"></span>
                </div>

                <div>
                    <input type="text" class="form-control" placeholder="00:00" name="end[]">
                    <span class="invalid-feedback end"></span>
                </div>
                <button class="btn btn-warning btn-sm ml-3 is-hidden remove" id="removeDay" type="button">Remove</button>
            </div>
        </div>
        <button class="btn btn-success mt-2" id="save" type="button">Save</button>
       </form>
     </div>
   </div>

        
   
    
@endsection






@section('scripts')
    <script>
    
    
    var days = @json($days)

    // $.ajax({
    //     type:'GET',
    //     url:'/days/all/1',
    //     success:function(response)
    //     {
    //         console.log(response)
    //         var insert = $( ".add-input:last" )
    //         var input =  ".add-input:last"
    //         for(i=0; i< response.mydays.length; i++)
    //         {
                
    //           $(insert).after(insert.clone());
    //            $( ".add-input:last select" ).val(response.mydays[i].pivot.day_id)
    //             //$()

    //         }
    //     }
    // })

        var i = 0
        $(document).on('click', '#addDay', function(){
            var max = 5
            var total = $('.add-input').length
            i++
            if(total<max)
            {
                if($('.select:last').val())
                {

                   var div = $('.add-input:last').clone()

                   var label = div.find('label').text('Day ' + ($('.add-input').length +1)).end().find('.btn-warning').removeClass('is-hidden').attr('id', ($('.add-input').length +1)).end().find('input').val('')

                   $('.add-input:last').after(div)
                   

                }
                else
                {
                    $('.select:last').addClass('noData')
                //.css('border-color', 'red')
                }
            }

            


          
        
        })
        
        $(document).on('change', '.select:last', function(){
            $('.select:last').removeClass('noData')
        })
        
    
        $(document).on('click', '.remove', function(e){
         //var add_div = $('.add-input').first();
         //console.log($('.add-input').length)
         if($('.add-input').length > 1)
         {
            k = $('.add-input').length
            $( this ).parents()[1].remove()

            for(i=$(this).attr('id'); i< k; i++)
            {
                console.log(i)
            }
            
               // console.log(Array.from(document.getElementsByClassName("remove")).indexOf(e.target));

         }
         
         
        });

        var url = "{{ route('createSchedule', $profile) }}"



        $(document).on('click', '#save', function(){
            var days = $( "select[name*='day']" )
            var starts = $( "input[name*='start']" )
            var ends = $( "input[name*='end']" )

            var day_id = []
            var start = []
            var end = []

            $.each(days, function(index,day){
                day_id.push(day.value)
            })

            $.each(starts, function(index,s){
                start.push(s.value)
            })

            $.each(ends, function(index,e){
                end.push(e.value)
            })

            var data = {
                'day_id':day_id,
                'start':start,
                'end':end,
            }

            $.ajax({
                type:'POST',
                url:url,
                data:data,
                success:function(response){
                    console.log(response)
                },
                error:function(response)
                {
                    var errors = response.responseJSON.errors
                    
                    for(error in errors)
                    {
                        console.log(error)
                        $('span.invalid-feedback.end').text(errors[error][0]).show()
                    }
                }
            })
        })
        
    </script>
@endsection