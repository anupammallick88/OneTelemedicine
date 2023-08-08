(function ($) {
    "use strict";

    // Show the time
    $(window).on('load', function() {
        showTime();
    })

    //time load function
    function showTime() {
        var date = new Date();
        var hours = date.getHours();
        var minutes = date.getMinutes();
        var seconds = date.getSeconds();
        var session = hours >= 12 ? 'pm' : 'am';
        hours = hours % 12;
        hours = hours ? hours : 12;
        minutes = minutes < 10 ? '0' + minutes : minutes;
        seconds = seconds < 10 ? '0' + seconds : seconds;
        var time = hours + ":" + minutes + ":" + seconds + " " + session;
        document.getElementById("liveClock").innerText = time;
        document.getElementById("liveClock").textContent = time;
        setTimeout(showTime, 1000);
    }
})(jQuery);
