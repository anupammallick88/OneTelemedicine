(function ($) {
    "use strict";

    //1st Preview image
    $('#putImage').on('change', function () {
        var src = this;
        var target = document.getElementById('target'); 
        target.style.width = '120px';
        target.style.height = '80px';
        var reader = new FileReader();
        reader.onload = function (e) {
           $('#target').attr('src', e.target.result);
        }
       reader.readAsDataURL(src.files[0]);
    });

    //2nd Preview image
    $('#putImage2').on('change', function () {
        var src = this;
        var target = document.getElementById('target2'); 
        target.style.width = '120px';
        target.style.height = '80px';
        var reader = new FileReader();
        reader.onload = function (e) {
           $('#target2').attr('src', e.target.result);
        }
       reader.readAsDataURL(src.files[0]);
    });

    //3rd Preview image
    $('#putImage3').on('change', function () {
        var src = this;
        var target = document.getElementById('target3'); 
        target.style.width = '120px';
        target.style.height = '80px';
        var reader = new FileReader();
        reader.onload = function (e) {
           $('#target3').attr('src', e.target.result);
        }
       reader.readAsDataURL(src.files[0]);
    });
})(jQuery);