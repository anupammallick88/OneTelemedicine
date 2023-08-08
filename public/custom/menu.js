"use strict";

$('body').on('click', '.itemAdd', function () {
    var $template = $('.itemCopy').html();
    $('.itemNew').append($template);
});

$('body').on('click', '.itemRemove', function (e) {
    $(this).parent().remove();
});
