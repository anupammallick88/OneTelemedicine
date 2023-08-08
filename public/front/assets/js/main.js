(function ($) {
  "use strict";
  /*-------------------------------------------
  preloader active
  --------------------------------------------- */
  $(document).ready(function () {
    $(".preloader").delay(100).fadeOut("slow");
  });

  /*-------------------------------------------
  Sticky Header
  --------------------------------------------- */
  $(window).on('scroll', function () {
    if ($(window).scrollTop() > 80) {
      $('#sticky').addClass('stick');
    } else {
      $('#sticky').removeClass('stick');
    }
  });

  jQuery(document).ready(function () {
    /*-------------------------------------------
    js scrollup
    --------------------------------------------- */
    $.scrollUp({
      scrollText: '<i class="fa fa-angle-up"></i>',
      easingType: 'linear',
      scrollSpeed: 900,
      animation: 'fade'
    });
    /*-------------------------------------------
    js counterUp
    --------------------------------------------- */
    $('.counter').counterUp({
      delay: 10,
      time: 1000
    });
    /*-------------------------------------------
    brand-slide active
    --------------------------------------------- */
    $('.brand-slide').slick({
      infinite: true,
      speed: 500,
      slidesToShow: 4,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 3000,
      dots: false,
      arrows: false,
      prevArrow: '<i class="slick-prev arrow fas fa-angle-left"></i> ',
      nextArrow: '<i class="slick-next arrow fas fa-angle-right"></i> ',
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 4,
            slidesToScroll: 1,
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1
          }
        }
      ]
    });
    /*-------------------------------------------
    Pophover Active
    --------------------------------------------- */
    $(function () {
        $('[data-toggle="popover"]').popover()
    })
    /*-------------------------------------------
    fileuplode active
    --------------------------------------------- */
    $(function () {
      $('#fileuplode').on('change', function (event) {
        var x = URL.createObjectURL(event.target.files[0]);
        $("#uplode-img").attr('src', x);
      });
    });

  });

  $('#new-appointment-form').on('click', function (e) {
    let targetTag = e.target;
    if (targetTag.classList.contains('alwayschecked')) {
      let targetParent = e.target.parentElement.parentElement.parentElement.parentElement.parentElement;
      $('#new-appointment-form .active').removeClass('active');
      targetParent.classList.add('active');
    }

  })

  if ($('#date').length > 0) {
    $('#date').on('change', function () {
      let date = new Date($(this).val());
      let date2 = new Date();
      let today = new Date(date2.getFullYear() + '-' + (date2.getMonth() + 1) + '-' + date2.getDate());

      function addDays(theDate, days) {
        return new Date(theDate.getTime() + days * 24 * 60 * 60 * 1000);
      }

      var nextDate = addDays(new Date(), 90);
      if (date >= today == false) {
        $('#nextBtn').hide();
      } else if (date > nextDate) {
        $('#nextBtn').hide();
      }
      else {
        $('#nextBtn').show();
      }
    })
  }

  $('#admin-credential-show').on('click', function() {
      $('#email').val('admin@gmail.com')
      $('#password').val('password')
  })

  $('#patient-credential-show').on('click', function() {
      $('#email').val('patient@gmail.com')
      $('#password').val('password')
  })

  $('#doctor-credential-show').on('click', function() {
      $('#email').val('doctor@gmail.com')
      $('#password').val('password')
  })

  $('#stuff-credential-show').on('click', function() {
      $('#email').val('stuff@gmail.com')
      $('#password').val('password')
  })

})(jQuery);



