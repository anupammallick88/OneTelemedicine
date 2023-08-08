
$(document).on('click', '.doctorPayDetails', function() {
    var route = $(this).data("route")

    $('#dataModal').modal('show');
    $.ajax({
        url: route,
        success: function (data) {
            $('.appendDoctorPayDetails').html(data);
        }
    });
})
