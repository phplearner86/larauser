function userNotification(message, type='success')
{
    return $.notify(message, type)
}

/**
 * Set datatable counter column
 *
 * @param {object} datatable
 * @return {void}
 */
function setTableCounterColumn(datatable)
{
    datatable.on('order.dt search.dt', function () {
        datatable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            x = i+1
            cell.innerHTML = '<span>'+ x +'</span>';
        } );
    } ).draw();
}

function clearForm(form)
{
    form
        .find('input[type=text], input[type=password], textarea').val("").end()
        .find('select').val(null).trigger('change')
        .find('input[type=checkbox], input[type=radio]').prop('checked', "").end()
        .find('#autoPassword').prop('checked', true)

        $('#password').hide()
}

function setAutofocus(modal, inputId)
{
    modal.find('#' + inputId).focus()
}

function clearError(name)
{
    var field = $('.' + name)
    var feedback = $('span.' + name)


    field.removeClass('is-invalid')
    feedback.text('')
}

function clearServerErrors(formFields)
{
    $.each(formFields, function(index, name){
        clearError(name)
    });
}

function successResponse(message, modal)
{
    userNotification(message)
    modal.modal('hide')
}

function clearErrorOnNewInput()
{
    $('input,textarea').on('keydown', function(){
        clearError($(this).attr('name'))
    })
}

function displayErrors(errors)
{
    for(let error in errors){

        var field = $('.' + error)
        var feedback = $('span.' + error)


        field.addClass('is-invalid')
        feedback.text(errors[error][0])
    }
}

function errorResponse(errors)
{
    displayErrors(errors)

    clearErrorOnNewInput()
}

/**
 * Toggle hidden field visibility by changing checkbox field value
 *
 * @param  {string} checked_field
 * @param  {string} hidden_field
 * @return {void}
 */
function toggleHiddenFieldWithCheckbox(checked_field, hidden_field)
{
    checked_field.change(function() {

        this.checked ? hidden_field.hide().val('').end() : hidden_field.show()

    });
}
