var saveProfileModal = $('#saveProfileModal')
var profile_fields = ['name']
saveProfileModal.emptyModal(profile_fields)


$(document).on('click', '#openModal', function(){

   saveProfileModal.modal('show')

   var user = $(this).val()

   $('#saveProfile').val(user)

   var url = '/admin/profiles/' + user

   $.ajax({
        type:'GET',
        url:url,
        success:function(response)
        {
            var profile = response.user.profile
            $('#name').val(profile.name)
        }
   })

})

//Create profile

$(document).on('click', '#saveProfile', function(){


    var user = $(this).val()
    var saveProfileUrl = '/admin/profiles/' + user

    var name = $('#name').val()
    //console.log(name)
    var data = {
        'name':$('#name').val()
    }

    $.ajax({
        type:'PUT',
        url:saveProfileUrl,
        data:data,
        success: function(response)
        {
            $('#userName').load(location.href + ' #userName')
            //$('#userName').html(name)
            saveProfileModal.modal('hide')
        },
        error: function(response){
            errorResponse(saveProfileModal, response.responseJSON.errors)
        }
    })

    //console.log(saveProfileUrl)
})

//Change avatar

var avatarModal = $('#avatarModal')
var avatarForm = $('#avatarForm')
var fields = ['filename']

avatarModal.emptyModal(fields)




$(document).on('click', '#changeAvatar', function(){

    avatarModal.modal('show')

    var user = $(this).val()
    $('#saveAvatar').val(user)
})

$(document).on('click', '#saveAvatar', function(){
    
    var user = $(this).val()
    var saveAvatarUrl = '/admin/avatars/' + user


    var formData = new FormData(avatarForm[0])
    formData.append('_method', 'PUT')

    $.ajax({
        type:'POST',
        url:saveAvatarUrl,
        data:formData,
        contentType:false,
        processData:false,
        success: function(response){
            successResponse(avatarModal, response.message)

            $('#profileImage').load(location.href + ' #profileImage')

            avatarModal.modal('hide')
        },
        error: function(response)
        {
            errorResponse(avatarModal, response.responseJSON.errors)

        }
    })

})
