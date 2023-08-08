(function ($) {
    "use strict";
    let cardname;
    let cardnumber;
    let expirydate;
    let expiryyear;
    let cvv;

    $('#radio1').on('click', function () {
        $('#payment_type_paypal').val('online');
        $('#appointment_type').val(0);
        $('#paypalform').trigger('submit');
    })
    $('#radio3').on('click', function () {
        $('#payment_type_paypal').val('offline');
        $('#appointment_type').val(0);
        $('#paypalform').trigger('submit');
    })
    $('.stripefunc').on('keyup', function(){
        cardname = document.getElementById('cardname').value;
        cardnumber = document.getElementById('cardnumber').value;
        expirydate = document.getElementById('Expariydate').value;
        expiryyear = document.getElementById('Expariyyear').value;
        cvv = document.getElementById('ccv').value;
        $('#stripe_cardname').val(cardname)
        $('#stripe_cardnumber').val(cardnumber)
        $('#stripe_expirydate').val(expirydate)
        $('#stripe_expiryyear').val(expiryyear)
        $('#stripe_cvv').val(cvv)
    })
})(jQuery);
