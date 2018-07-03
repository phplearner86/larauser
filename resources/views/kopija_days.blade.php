@extends('layouts.admin')

@section('content')

    <h1>Profile Schedule</h1>

   <form action="{{ route('createSchedule', $profile->id) }}" method="POST">
        @csrf

        <div class="col-md-6">
            <div class="row">
                <div class="form-group add-group">
                    <label for="day">Day1</label>
                    <div class="flex">
                        <select class="form-control" name="day[0][day_id]" >
                            <option value="" disabled="" selected="">Select day</option>
                            @foreach ($days as $day)
                            <option value="{{ $day->id }}">{{ $day->name }}</option>
                            @endforeach
                        </select>
                        <input type="text" class="form-control ml-2" placeholder="00:00" name="day[0][start]">
                        <input type="text" class="form-control ml-2" placeholder="00:00" name="day[0][end]">
                        <button class="btn btn-success ml-2 add-more">Add</button>
                    </div>
                </div>
            </div>

         

            <button class="btn bg-indigo text-white" type="submit">Add day</button>

        </div>
       
   </form> 
    
@endsection






@section('scripts')
    <script>
        $(document).on('click', '.add-more',function(e){
            e.preventDefault()
            var add_row = $('.add-group').last()
           
            add_row.after(add_row.clone());
        })
    </script>
@endsection