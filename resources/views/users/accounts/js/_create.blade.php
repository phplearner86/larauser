$(document).on('click', '#createAccount', function(){
    $('#createAccountModal').modal('show')

    toggleHiddenFieldWithCheckbox(auto_password, password)
})