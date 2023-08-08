(function () {
    "use strict";

    //Repeater initialization
    $('.repeater').repeater({
        defaultValues: {
          'text-input': 'foo'
        },
        show: function() {
          $(this).slideDown();
        },
        hide: function(deleteElement) {
          $(this).slideUp(deleteElement);
        },
        isFirstItemUndeletable: true
    });
})(jQuery);