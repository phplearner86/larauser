@extends('layouts.admin')

@section('content')
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        
    <h1>Profile Schedule</h1>

   <form action="{{ route('createSchedule', $profile->id) }}" method="POST">
        @csrf

        <div class="col-md-6">
            <div id="createDays">
                <div class="row day" >
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
                            <button type="button" class="btn btn-success ml-2 add-more" id="addMore">Add</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <button class="btn bg-indigo text-white" type="submit">Add day</button>

        </div>
       
   </form> 
    
@endsection

@section('scripts')
    <script>

        var days = @json($days);

        var options = []

        $.each(days, function(index, day){
            options.push([day.id, day.name])
        })
       // console.log(options)

        var html = ''

        html += '<div class="row day"><div class="form-group"><label for="day">Day1</label><div class="flex">'

        html += '<select class="form-control" name="day[]" ><option value="" disabled="" selected="">Select day</option><option value="' +options[0][0] + '">' +options[0][1] + '</option><option value="' +options[1][0] + '">' +options[1][1] + '</option><option value="' +options[2][0] + '">' +options[2][1] + '</option><option value="' +options[3][0] + '">' +options[3][1] + '</option><option value="' +options[4][0] + '">' +options[4][1] + '</option></select>'

        html += '<input type="text" class="form-control ml-2" placeholder="00:00" name="start[]">'

        html += '<input type="text" class="form-control ml-2" placeholder="00:00" name="end[]">'

        html += '<button type="button" class="btn btn-danger ml-2 remove">Min</button>'

        html += '</div></div></div>'



        $(document).on('click', '#addMore',function(){

            var row = $('.day')
            var totalRows = row.length
            var maxRows = 5

            if(totalRows<maxRows)
            {
             $('#createDays').append(html)
            }
        })


        $(document).on('click', '.remove',function(){

            $(this).parents().eq(2).remove()
        })
    </script>
@endsection