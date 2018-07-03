 $(document).on('click', '#storeSubject', function(){

        
        var user = $('#addSubject').val()

        





        var data = {
            'subject_id': $('input[name="subject_id"').val()
        }
        var url = '/admin/profiles/' + user

        $.ajax({
            type:'PATCH',
            url:url,
            data:data,
            success:function(response)
            {
                successResponse(createSubjectModal, response.message)
                $('#profileSubjects').load(location.href + ' #profileSubjects')
                $('.btn-subject').attr('id', 'editSubject').text('Change')
            }
        })
    });