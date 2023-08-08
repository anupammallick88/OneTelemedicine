(function ($) {
    "use strict";

    //Select2, tags, html-editor initialization
    $(document).ready(function () {
        $(".select2").select2();
        $('#tags').tagsinput('items');
        $('.html-editor').summernote({
            height: 300,
            tabsize: 2
        });
    });
})(jQuery);