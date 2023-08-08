(function ($) {
    "use strict";
    const test = {
        date: '',
        time: '',
        service: '',
        doctor: '',
        comment: '',
        fees: '',
        name: '',
        slot_id: '',
        appcount: '',
        doc_id: ''
    }
    const payment = {
        cardname: '',
        cardnumber: '',
        expirydate: '',
        expiryyear: '',
        cvv: ''
    }
    let service = '';
    let slot = '';

    let jsvar = document.getElementById('js_variable_data');
    let ds = jsvar.getAttribute('data-jsvar');

    let pvar = JSON.parse(ds);

    $('[name="DoctorsService"]').on('click', function (e) {
        test.service = e.target.value;
        service = e.target.value;
        document.getElementById('paypal_doctorservice').value = e.target.value
    })

    $('#date').on('change', function () {
        let dates = document.querySelector('#date').value;
        test.date = dates
        getdata()
    })

    $('#Comment').on('change', function () {
        let comment = document.querySelector('#Comment').value;
        test.comment = comment
        document.getElementById('paypal_comment').value = comment
        getdata()
    });

    let doctorservice = '';
    const btn = document.querySelector('#nextBtn');

    function removeRadio() {
        test.service = ''
    }

    function doctorfunction() {
        getdata()
    };

    function getdata() {
        document.getElementById('app_date').innerText = test.date;
        document.getElementById('paypal_appdate').value = test.date;
        let date = new Date(test.date);
        let day = date.toLocaleString('en-us', {
            weekday: 'long'
        });

        document.getElementById('app_day').innerText = day;
        document.getElementById('app_time').innerText = test.time;
        document.getElementById('app_specialist').innerText = test.service;
        document.getElementById('app_fees').innerText = test.fees + '₹';
        $('#doctor_get_fees').val(test.fees);

        if (test.fees != '') {
            document.getElementById('appinput').value = test.fees
            document.getElementById('paypal_appinput').value = test.fees
        }
        getfees()
    }

    function openfile() {
        $('file-input').trigger('click');
    }



    /*-------------------------------------------
        multistype form
    --------------------------------------------- */

    $('#apptime').on('change', function () {
        slot = $('#apptime').val();
        document.getElementById("paypal_apptime").value = slot;
    });

    $('#DashboardTabContent').on('click', function (e) {
        let className = e.target.classList;

        if (className.contains('form-check-input')) {
            if (e.target.parentElement.parentElement.parentElement.parentElement.parentElement.querySelector('.price') != null) {
                let price = e.target.parentElement.parentElement.parentElement.parentElement.parentElement.querySelector('.price').getAttribute('data-fees');
                test.fees = price;
            }

            if (e.target.parentElement.parentElement.parentElement.parentElement.parentElement.querySelector('.team-name') != null) {
                let name = e.target.parentElement.parentElement.parentElement.parentElement.parentElement.querySelector('.team-name').innerHTML;
                $('#formInnerTitle').html(name + ' ' + 'Appointment <span>(30 Min )</span>')
            }

            if (e.target.parentElement.parentElement.parentElement.parentElement.parentElement.querySelector('.catagory') != null) {
                let catagory = e.target.parentElement.parentElement.parentElement.parentElement.parentElement.querySelector('.catagory').innerHTML;
                test.service = catagory
            }
        }

    })

    function nextPrev(n, btn) {
        var x = document.getElementsByClassName("tab");
        if (n == 1 && !validateForm()) return false;
        x[currentTab].style.display = "none";
        currentTab = currentTab + n;
        if (currentTab >= x.length) {

            stripeajax();

            return false;
        }
        showTab(currentTab, btn);
    }

    var currentTab = 0;
    showTab(currentTab);

    function showTab(n, btn) {
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
            document.getElementById("nextBtn").removeAttribute('type');
        }
        else if (n == 1) {
            if (btn == 'next') {
                filterDoctor()
            }
            document.getElementById("prevBtn").style.display = "inline";
            document.getElementById("nextBtn").removeAttribute('type');

        } else {
            document.getElementById("prevBtn").style.display = "inline";
            document.getElementById("nextBtn").removeAttribute('type');
        }
        if (n == (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "Confirm";
            document.getElementById("nextBtn").setAttribute('type', 'submit');
        } else {
            document.getElementById("nextBtn").innerHTML = "Next";
            document.getElementById("nextBtn").removeAttribute('type');
        }
        fixStepIndicator(n)
    }

    function fixStepIndicator(n) {
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        x[n].className += " active";
    }



    function validateForm() {
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByTagName("input");
        for (i = 0; i < y.length; i++) {
            if (y[i].value == "") {
                y[i].className += " invalid";
                valid = false;
            }
        }
        if (valid) {
            document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        return valid;
    }

    $('#prevBtn').on('click', function () {
        nextPrev(-1, 'prev')
    })

    $('#nextBtn').on('click', function () {
        nextPrev(1, 'next')
        doctorfunction()
    })

    $('#closebtn').on('click', function () {
        closecong()
    })

    $('#openfile').on('click', function () {
        $('#file-input').trigger('click');
    });
    $('#file-input').on('change', function () {
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

    //edit form validation
    // var $ = jQuery;

    $('#editform #name').on('keyup', function () {
        if ($('#editform #name').val() == '') {
            $('#editform .nameerror').removeClass('d-none');
            $('.changesave').attr("disabled", true).addClass('disabled');
        } else {
            $('#editform .nameerror').addClass('d-none');
            $('.changesave').attr("disabled", false).removeClass('disabled');
        }
    });

    $('#editform #email2').on('keyup', function () {
        if ($('#editform #email2').val() == '') {
            $('#editform .emailerror').removeClass('d-none');
            $('.changesave').attr("disabled", true).addClass('disabled');
        } else {
            $('#editform .emailerror').addClass('d-none');
            $('.changesave').attr("disabled", false).removeClass('disabled');
        }
    });

    $('#editform #group').on('keyup', function () {
        if ($('#editform #group').val() == '') {
            $('#editform .dateerror').removeClass('d-none');
            $('.changesave').attr("disabled", true).addClass('disabled');
        } else {
            $('#editform .dateerror').addClass('d-none');
            $('.changesave').attr("disabled", false).removeClass('disabled');
        }
    });

    $('#editform #age').on('keyup', function () {
        if ($('#editform #age').val() == '') {
            $('#editform .ageerror').removeClass('d-none');
            $('.changesave').attr("disabled", true).addClass('disabled');
        } else {
            $('#editform .ageerror').addClass('d-none');
            $('.changesave').attr("disabled", false).removeClass('disabled');
        }
    });

    $('#editform #address').on('keyup', function () {
        if ($('#editform #address').val() == '') {
            $('#editform .addresserror').removeClass('d-none');
            $('.changesave').attr("disabled", true).addClass('disabled');
        } else {
            $('#editform .addresserror').addClass('d-none');
            $('.changesave').attr("disabled", false).removeClass('disabled');
        }
    });

    $('#editform #city').on('keyup', function () {
        if ($('#editform #city').val() == '') {
            $('#editform .cityerror').removeClass('d-none');
            $('.changesave').attr("disabled", true).addClass('disabled');
        } else {
            $('#editform .cityerror').addClass('d-none');
            $('.changesave').attr("disabled", false).removeClass('disabled');
        }
    });

    $('#editform #code').on('keyup', function () {
        if ($('#editform #code').val() == '') {
            $('#editform .codeerror').removeClass('d-none');
            $('.changesave').attr("disabled", true).addClass('disabled');
        } else {
            $('#editform .codeerror').addClass('d-none');
            $('.changesave').attr("disabled", false).removeClass('disabled');
        }
    });

    $(document).on('click', '#print', function () {
        printData();
    });

    function printData() {
        var print_ = document.getElementById("printable");
        var win = window.open("");
        win.document.write(print_.outerHTML);
        win.print();
        win.close();
    }

    function getfees() {
        if (test.fees != undefined) {
            document.getElementById('paypalvalue').value = (test.fees);
            return;
        }
    }


    function closecong() {
        setTimeout(function () {
            // $('.congratulation-wrap').addClass('d-none');
            // $('#new-appointment-form').trigger('submit');
        }, 5000);
    }



    $(document).ready(function () {

        $(document).on('click', '#PastAppominment a.pagin', function (event) {
            event.preventDefault();

            var page = $(this).attr('href').split('page=')[1];
            fetch_data_past(page);
        });

        function fetch_data_past(page) {
            $.ajax({
                url: pvar.fetchdatapagination + page,
                success: function (data) {
                    $('#PastAppominment').html(data);
                }
            });
        }

        $(document).on('click', '#TodayAppominment a.pagin', function (event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_data_today(page);
        });

        function fetch_data_today(page) {
            $.ajax({
                url: pvar.todaysfetchdatapagination + page,
                success: function (data) {
                    $('#TodayAppominment').html(data);
                }
            });
        }

        $(document).on('click', '#dashboardpagi a.pagin', function (event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_data(page);
        });

        function fetch_data(page) {
            $.ajax({
                url: pvar.dashboardfetchdatapagination + page,
                success: function (data) {
                    $('#dashboardpagi').html(data);
                }
            });
        }

    });

    $('.payment_type').on('click', function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: $('#payment_type_route').attr("data-id"),
            data: {
                payment_type: $(this).val()
            },

        }).done((data) => {
            $('#toggler').html(data);
        });
    });

    $('#appoinmentdate').on('keyup', function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: pvar.searchappointmentdateurl,
            data: {
                date: $('#appoinmentdate').val()
            },

        }).done(function (data) {
            if ($('#appoinmentdate').val() != '') {
                $('#pastsearch').hide()
                $('#todaypagination').hide()
                $('#searchhead').removeClass('d-none')
                $('#searchheadtoday').removeClass('d-none')
                $('tbody#searchbody').show()
                $('tbody#searchbodytoday').show()
                $('.pagination').hide()
                $('.pagination-past').hide()
                $('.pagination-today').hide()

                $('tbody#searchbody').html(data)
                $('tbody#searchbodytoday').html(data)
            } else {
                $('tbody#searchbody').hide()
                $('tbody#searchbodytoday').hide()
                $('#searchhead').addClass('d-none')
                $('#searchheadtoday').addClass('d-none')
                $('#pastsearch').show()
                $('#todaypagination').show()
                $('.pagination').show()
                $('.pagination-past').show()
                $('.pagination-today').show()
            }
        });
    });

    $('#appoinmentsearch').on('keyup', function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $.ajax({
            type: 'POST',
            url: pvar.searchappointmenturl,
            data: {
                msg: $('#appoinmentsearch').val()
            },

        }).done(function (data) {
            function tConv24(time24) {
                var ts = time24;
                var H = +ts.substr(0, 2);
                var h = (H % 12) || 12;
                h = (h < 10) ? ("0" + h) : h; // leading 0 at the left for 1 digit hours
                var ampm = H < 12 ? " AM" : " PM";
                ts = h + ts.substr(2, 3) + ampm;
                return ts;
            };
            if ($('#appoinmentsearch').val() != '') {
                $('#pastsearch').hide()
                $('#todaypagination').hide()
                $('#searchhead').removeClass('d-none')
                $('#searchheadtoday').removeClass('d-none')
                $('tbody#searchbody').show()
                $('tbody#searchbodytoday').show()
                $('.pagination').hide()
                $('.pagination-past').hide()
                $('.pagination-today').hide()
                $('tbody#searchbody').html(data)
                $('tbody#searchbodytoday').html(data)
            } else {
                $('tbody#searchbody').hide()
                $('tbody#searchbodytoday').hide()
                $('#searchhead').addClass('d-none')
                $('#searchheadtoday').addClass('d-none')
                $('#pastsearch').show()
                $('#todaypagination').show()
                $('.pagination').show()
                $('.pagination-past').show()
                $('.pagination-today').show()

            }
        });
    });

    function checkappointment() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: pvar.checkappointmenturl,
            method: 'POST',
            data: {
                date: test.date,
                time: test.time,
                doctor_slot_id: test.slot_id,
                doctor_id: test.doc_id
            },
            success: function (data) {
                test.appcount = data
            },
            async: false
        });
        console.log(test.appcount);
    }

    $('body').on('change', 'input,select', function () {
        $('#nextBtn').attr('disabled', false);
        document.getElementById("nextBtn").removeAttribute('type');
    })

    function filterDoctor() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: pvar.filterdoctorurl + '/' + service + '/' + slot,
            method: 'POST',
            success: function (data) {
                var html = ''
                if (data.length == 0) {
                    $('.doctorajax').html(`<div class="col-md-12"><p>No Doctor Found!</p></div>`);
                    $('#nextBtn').attr('disabled', true);
                }
                else {
                    $.each(data, function (index, value) {

                        // dayoff collection
                        const dayoff = value.offday.split(',');
                        const day0 = dayoff.includes('sun') ? 0 : null;
                        const day1 = dayoff.includes('mon') ? 1 : null;
                        const day2 = dayoff.includes('tue') ? 2 : null;
                        const day3 = dayoff.includes('wed') ? 3 : null;
                        const day4 = dayoff.includes('thu') ? 4 : null;
                        const day5 = dayoff.includes('fri') ? 5 : null;
                        const day6 = dayoff.includes('sat') ? 6 : null;

                        const day = (new Date(document.getElementById('date').value)).getDay();
                        if (day == day0 || day == day1 || day == day2 || day == day3 || day == day4 || day == day5 || day == day6) {

                        } else {
                            document.getElementById('slotid').value = value.slotid
                            document.getElementById('paypal_slotid').value = value.slotid

                            function tConv24(time24) {
                                var ts = time24;
                                var H = +ts.substr(0, 2);
                                var h = (H % 12) || 12;
                                h = (h < 10) ? ("0" + h) : h; // leading 0 at the left for 1 digit hours
                                var ampm = H < 12 ? " AM" : " PM";
                                ts = h + ts.substr(2, 3) + ampm;
                                return ts;
                            };

                            test.time = tConv24(value.start_time) + '-' + tConv24(value.end_time);
                            test.slot_id = value.slotid
                            test.doc_id = value.docid
                            let image = value.image == null ? pvar.noimage : pvar.assetimgurl + '/' + value.image

                            checkappointment()

                            let dataOutput = '';
                            console.log(test.appcount);
                            if (test.appcount == 1) {
                                dataOutput = `
                            <div class="primary-btn">
                            <div class="form-check booked-btn cus-pl0" id="selectdoc">
                                <input class="form-check-input alwayschecked d-none" type="radio" name="selectdoctory">
                                <label class="form-check-label text-white docselect" for="selectdoctory">
                                Booked
                                </label>
                            </div>
                            </div>`;
                            } else {
                                dataOutput = `
                            <div class="primary-btn">
                                <div class="form-check" id="selectdoc">
                                    <input class="form-check-input alwayschecked paypl_did"  type="radio" name="selectdoctory" id="doctor${value.docid}" value="${value.docid}" fees="${value.fees}">
                                    <label class="form-check-label text-white docselect" for="doctor${value.docid}">
                                    Select Doctor
                                    </label>
                                </div>
                            </div>`
                            }
                            html += `
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="single-team">
                                <div class="team-thumbnail">
                                    <img src="${image}" alt="taml image" />
                                    <div class="team-overlay" id="toverlay">
                                        ${dataOutput}
                                    </div>
                                </div>
                                <div class="team-info">
                                    <h4 class="team-name">${value.name.toUpperCase()}</h4>
                                    <ul>
                                        <li class="catagory">${value.catname.toUpperCase()}</li>
                                        <li class="price" id="fee" data-fees="${value.fees}">Fee:${value.fees}₹</li>
                                    </ul>
                                </div>
                            </div>
                        </div>`

                        }

                    });
                    if (html == '') {
                        $('.doctorajax').html(`<div class="col-md-12"><p>No Doctor Found!</p></div>`);
                        $('#nextBtn').attr('disabled', true);
                    } else {
                        $('.doctorajax').html(html);
                    }
                    // $('.paypl_did').on('click', function (e) {
                    //     document.getElementById('paypal_docid').value = e.target.value;
                    // });

                }

            },
            error: function () {
                $('.doctorajax').html(`<p>Date, time slot and service required!</p>`);
                $('#nextBtn').attr('disabled', true);
            },

        });
    }

    function stripeajax() {

        $.ajax({
            url: pvar.stripeurl,
            method: 'POST',
            data: {
                "card_no": $('#stripe_cardnumber').val(),
                "exp_month": $('#stripe_expirydate').val(),
                "exp_year": $('#stripe_expiryyear').val(),
                "cvv": $('#stripe_cvv').val(),
                "holderName": $('#stripe_cardname').val(),
                "amount": test.fees,
                "_token": pvar.strtoken,
            }
        }).done(function (data) {
            $('#charge_id').val(data);
            $('.congratulation-wrap').removeClass('d-none');
            setTimeout(function () {
                closecong()
            }, 5000);
            if (data == 'Your card number is incorrect.') {
                document.getElementById('card-error').innerHTML = '';
                document.getElementById('card-error').textContent += data;
            }

        }).fail(function (data) {
            //$('.congratulation-wrap').removeClass('d-none');

            document.getElementById('card-error').innerHTML = '';
            document.getElementById('month').innerHTML = '';
            document.getElementById('year').innerHTML = '';
            document.getElementById('cvv').innerHTML = '';
            document.getElementById('holder').innerHTML = '';

            //document.getElementById('card-error').textContent += data.responseJSON.errors.card_no[0];
            document.getElementById('month').textContent += data.responseJSON.errors.exp_month[0];
            document.getElementById('year').textContent += data.responseJSON.errors.exp_year[0];
            document.getElementById('cvv').textContent += data.responseJSON.errors.cvv[0];
            document.getElementById('holder').textContent += data.responseJSON.errors.holderName[0];
        })
    }

})(jQuery);







