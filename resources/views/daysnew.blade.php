@extends('layouts.admin')

@section('content')

    <div class="row">
        <h1>Profile Schedule for {{ $profile->user->name }} NEw  </h1> <button class="btn btn-danger ml-3" id="addDay">Add day</button> <button class="btn btn-warning ml-3" id="removeDay">Remove day</button>
    </div>

   <form action="{{ route('createSchedule', $profile->id) }}" method="POST">
        @csrf

        <div class="col-md-6">
            {{-- <div class="row add-input">
                <div class="form-group">
                    <label for="day">Day1</label>
                    <div class="flex">
                        <select class="form-control" name="day[]" >
                            <option value="" disabled="" selected="">Select day</option>
                            @foreach ($days as $day)
                            <option value="{{ $day->id }}">{{ $day->name }}</option>
                            @endforeach
                        </select>
                        <input type="text" class="form-control ml-2" placeholder="00:00" name="start[]">
                        <input type="text" class="form-control ml-2" placeholder="00:00" name="end[]">
                    </div>
                </div>
            </div>  --}}

            <div class="row add-input">
                    <label for="day">Day2</label>
                <div class="form-inline">
                    {{-- <div class="flex"> --}}
                        <select class="form-control select" name="day[]" >
                            <option value="" disabled="" selected>Select day</option>
                            @foreach ($days as $day)
                            <option value="{{ $day->id }}">{{ $day->name }}</option>
                            @endforeach
                        </select>
                        <input type="text" class="form-control" placeholder="00:00" name="start[]">
                        <input type="text" class="form-control" placeholder="00:00" name="end[]">
                    {{-- </div> --}}
                </div>
            </div>

           

            

            <button class="btn bg-indigo text-white" type="submit">Save</button>

        </div>
       
   </form> 
    
@endsection






@section('scripts')
    <script>
    
    
    

    $.ajax({
        type:'GET',
        url:'/days/all/1',
        success:function(response)
        {
            console.log(response)
            var insert = $( ".add-input:last" )
            var input =  ".add-input:last"
            for(i=0; i< response.mydays.length; i++)
            {
                
              $(insert).after(insert.clone());
               $( ".add-input:last select" ).val(response.mydays[i].pivot.day_id)
                //$()

            }
        }
    })


        $(document).on('click', '#addDay', function(){
         //var add_div = $('.add-input').first();
         
         var div = $( ".add-input:last" )
         //console.log($( ".select:last").val())
         if($( ".select:last").val())
         {
            div.clone().insertAfter(div);
           // $(this).text('adbjasdsd')

         }
         
        });

        $(document).on('click', '#removeDay', function(){
         //var add_div = $('.add-input').first();
         
         if($( ".add-input" ).length > 1)
         {
            $( ".add-input" ).last().remove()
         }
         
        });
    </script>
@endsection