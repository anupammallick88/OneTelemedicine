(function ($) {
    "use strict";

    //Summernote initialization
    $(document).ready(function () {
        $('#summernote').summernote();
        $('#description').summernote({
            height: 300,
        });
    });
})(jQuery);