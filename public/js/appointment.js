function appDetails(id) {
    $('#dataModal').modal('show');
    $.ajax({
        url: ROUTE_APP_DETAILS.replace("1", id),
        success: function (data) {
            $('.modal-content').html(data);
        }
    });
}