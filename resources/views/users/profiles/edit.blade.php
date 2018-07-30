@extends('layouts.admin')

@section('content')
    @php
        $profile = \App\Profile::first();
        $days = \App\Day::all();
    @endphp
    <div id="displaySchedule">
        @foreach ($profile->days as $day)
            <p>{{ $day->name }} {{ $day->work->start_at }} {{ $day->work->end_at }}</p>
        @endforeach

        <button class="btn btn-warning" id="{{ $profile->hasSchedule() ? 'editSchedule' : 'createSchedule' }}">
            {{ $profile->hasSchedule() ? 'Edit' : 'Add' }} Schedule
        </button>
    </div>

    <div class="modal schedule-modal" tabindex="-1" role="dialog" id="scheduleModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fa fa-calendar"></i>
                        <span></span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="scheduleForm">
                        <section id="days">
                            <fieldset id="0">
                                <div class="flex">
                                    <div class="form-group flex-1 mr-1">
                                        <label class="day-label">Day #1</label>
                                        <select name="day[0][day_id]" class="form-control">
                                            <option value="">Select a day</option>
                                            @foreach ($days as $day)
                                                <option value="{{ $day->id }}">{{ $day->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="invalid-feedback day day-0"></span>
                                    </div>
                                    <div class="form-group flex-1 mr-1">
                                        <label for="">Start</label>
                                        <input type="text" name="day[0][start_at]" class="form-control" placeholder="00:00">
                                        <span class="invalid-feedback start start-0"></span>
                                    </div>
                                    <div class="form-group flex-1 mr-1">
                                        <label for="">End</label>
                                        <input type="text" name="day[0][end_at]" class="form-control" placeholder="00:00">
                                        <span class="invalid-feedback end end-0"></span>
                                    </div>
                                    <div style="margin-top: 30px">
                                        <button type="button" class="btn btn-primary" id="addRow"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </fieldset>
                        </section>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="saveSchedule">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
  
        var scheduleUrl = "{{ route('admin.schedule.update', $profile) }}"
        var profileUrl = "{{ route('admin.profiles.show', $profile) }}"
        
        var scheduleModal = $('.schedule-modal');
        var modalTitle = $('.modal-title span');
        var days = @json($days);

        var container = $('section#days');
        var rows = container.children();
        var template = rows.first();
        var counter = 0;

        scheduleModal.emptyModal();
        scheduleModal.on('hidden.bs.modal', function() {
            container.empty();
        });

        // Create schedule
        $(document).on('click', '#createSchedule', function() {

            scheduleModal.modal('show');

            template.find('.invalid-feedback').text("").end()
                .appendTo(container);
            modalTitle.text('Create schedule');
        });

        // Add rows
        $(document).on('click', '#addRow', function(){

            var rows = container.children();
            var totalRows = rows.length;
            var maxRows = days.length;

            if(totalRows < maxRows)
            {
                addRow(container, counter)
                    .find('button').removeAttr('id').addClass('btn-remove').end()
                    .find('.fa').removeClass('fa-plus').addClass('fa-remove');
            }
        });

        // Remove rows
        $(document).on('click', '.btn-remove', function() {
            removeRow($(this));
        });

        // Save schedule
        $(document).on('click', '#saveSchedule', function() {

            var day = getSelectsValues('day_id');
            var start = getInputsValues('start_at');
            var end = getInputsValues('end_at');

            $.ajax({
                url: scheduleUrl,
                type: "PUT",
                data: {
                    day: day,
                    start: start,
                    end: end
                },
                success: function(response)
                {
                    //console.log(response)
                    $('#displaySchedule').load(location.href + ' #displaySchedule')
                   $('.btn-schedule').attr('id', 'editSchedule').text('Change')

                    successResponse(scheduleModal, response.message)
                },
                error: function(response)
                {
                    var errors = response.responseJSON.errors;

                    for(error in errors) {

                        var formattedError = error.replace(/\./g , "-");

                        $('span.'+formattedError).text(errors[error][0]).show()
                    }

                    removeErrorOnNewInput()
                }
            });
        });

        $(document).on('click', '#editSchedule', function(){
            scheduleModal.modal('show');

            modalTitle.text('Edit schedule');
            template.remove();

            $.ajax({
                type:'GET',
                url:profileUrl,
                success: function(response){

                    var days = response.profile.days;
                    console.log(days)
                    for(i=0; i<days.length; i++)
                    {
                        var btnId = i==0 ? 'addRow' : '';
                        var btnRemove = i==0 ? '' : 'btn-remove';
                        var faClass = i==0 ? 'fa-plus' : 'fa-remove';

                        cloneTemplate(template, container, i)
                            .find('button').attr('id', btnId).addClass(btnRemove).end()
                            .find('.fa').removeClass('fa-plus').addClass(faClass)

                        $("select")[i].selectedIndex = days[i].work.day_id;
                        $("input[name*='start_at']")[i].value = days[i].work.start_at;
                        $("input[name*='end_at']")[i].value = days[i].work.end_at;

                    }

                }

            });
        });

















        function getSelectsValues(selectName)
        {
            var selects = $( "select[name*='"+ selectName +"']" );

            var selectsValues = getValuesArray(selects);

            return selectsValues;
        }


        function getInputsValues(inputName)
        {
            var inputs = $( "input[name*='"+ inputName +"']" );

            var inputValues = getValuesArray(inputs);

            return inputValues;
        }


        function getValuesArray(array)
        {
            var tempArray = [];

            $.each(array, function(index, item)
            {
                tempArray.push(item.value);
            });

            return tempArray;
        }

        function removeRow(button)
        {
            button.parents().eq(2).remove();

            $('fieldset').each(function(i) {
                $(this).attr('id', i)
                .find('label.day').text('Day #'+(i+1)).end()
                .find("select").each(function(){
                    this.name = replaceValue(this.name, i)
                }).end()
                .find(':input').each(function() {
                    this.name = replaceValue(this.name, i)
                }).end()
                .find('.day').removeClass('day-'+(i+1)).addClass('day-'+ i).end()
                .find('.start').removeClass('start-'+ (i+1)).addClass('start-'+ i).end()
                .find('.end').removeClass('end-'+ (i+1)).addClass('end-'+ i)
            });
        }

        function addRow(container, counter)
        {
            var rows = container.children();
            var template = rows.first();
            var dynamicRows = rows.not(":first");
            var dynamicRowsIds = getIdsArray(dynamicRows);
            var index = getMissingValue(dynamicRowsIds);
            counter++;

            var addedRow = cloneTemplate(template, container, index);

            return addedRow;
        }

        function cloneTemplate(template, container, index)
        {
            var cloned = template.clone()
                .attr('id', index)
                .find('label.day').text('Day #'+(index+1)).end()
                .find("select").each(function(){
                    this.name = replaceValue(this.name, index)
                }).end()
                .find(':input').each(function(){
                    this.value = '';
                    this.name = replaceValue(this.name, index)
                }).end()
                .find('.invalid-feedback').text("").end()
                .find('.day').removeClass("day-0").addClass("day-" + index).end()
                .find('.start').removeClass("start-0").addClass("start-"+ index).end()
                .find('.end').removeClass("end-0").addClass("end-"+ index).end()
                .appendTo(container);

            return cloned;
        }


        function replaceValue(oldValue, newValue) {

            return oldValue.replace(/\d+/, newValue);
        }


        function getMissingValue(array)
        {
            var missing;

            for(var i=1; i<=array.length; i++)
            {
               if(array[i-1] != i) {

                  missing = i;
                  break;
               }
            }

            return i;
        }


        function getIdsArray(array)
        {
            var tempArray = []

            $.each(array, function(index, item) {

                tempArray.push(item.id);

                tempArray.sort();
            });

            return tempArray;
        };

    </script>
@endsection