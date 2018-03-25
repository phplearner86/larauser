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
