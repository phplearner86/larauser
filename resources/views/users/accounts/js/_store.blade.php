$(document).on('click', '#storeAccount', function()
{

    var field = $('#autoPassword')
    var password = generatePassword(field)

    var data = {
        role_id: $('#role_id').val(), 
        name: $('#name').val(), 
        email: $('#email').val(), 
        password: password, 
    }

    $.ajax({
        url: adminAccountsUrl,
        type: 'POST',
        data: data,
        success: function(response)
        {

            datatable.ajax.reload()
            successResponse(createAccountModal, response.message)
        },
        error: function(response)
        {
            errorResponse(createAccountModal, response.responseJSON.errors)
        }
    })
})