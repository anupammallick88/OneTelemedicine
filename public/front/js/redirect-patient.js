(function ($) {
    "use strict";

    let jsvar = document.getElementById('js_variable_data');
    let ds = jsvar.getAttribute('data-jsvar');

    let prvar = JSON.parse(ds);

    const test = {
        date: '',
        time: '',
        service: prvar.service,
        doctor: '',
        comment: '',
        fees: prvar.fees,
        name: prvar.name,
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

    var item = '';

    let cardname;
    let cardnumber;
    let expirydate;
    let expiryyear;
    let cvv;

    let slot = '';

    $(document).ready(function () {
        let selecteddocservice = document.getElementById('paypaldocservice').value;
        document.getElementById('paypal_doctorservice').value = selecteddocservice
    })



    let service = '';
    $('[name="DoctorsService"]').on('click', function (e) {
        test.service = e.target.value;
        service = e.target.value;
        document.getElementById('paypal_doctorservice').value = e.target.value
    })

    function addname() {
        let docname = test.name
        $('.form-inner-title').html(docname + ' ' + 'Appointment <span>(30 Min )</span>')
    }

    let doctorservice = '';
    const btn = document.querySelector('#nextBtn');


    function removeRadio() {
        test.service = ''
    }

    function doctorfunction() {
        getdata()

    };

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

    $('.stripefunc').on('keyup', function () {
        cardname = document.getElementById('cardname').value;
        cardnumber = document.getElementById('cardnumber').value;
        expirydate = document.getElementById('Expariydate').value;
        expiryyear = document.getElementById('Expariyyear').value;
        cvv = document.getElementById('ccv').value;
    })

    function getdata() {
        document.getElementById('app_date').innerText = test.date;
        document.getElementById('paypal_appdate').value = test.date;
        let date = new Date(test.date);
        let day = date.toLocaleString('en-us', {
            weekday: 'long'
        });

        document.getElementById('app_day').innerText = day;
        document.getElementById('app_specialist').innerText = test.service;
        document.getElementById('app_fees').innerText = test.fees + '₹';
        $('#doctor_get_fees').val(test.fees)

        if (test.fees != '') {
            document.getElementById('appinput').value = test.fees
            document.getElementById('paypal_appinput').value = test.fees
        }
        getfees()
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

    $('#apptime').on('change', function () {
        slot = $('#apptime').val();
        document.getElementById("paypal_apptime").value = slot;
        let myValue = '';

        for (item of $('#apptime option')) {

            if (item.getAttribute('value') == slot) {
                myValue = item.getAttribute('data-time');
            }

        }
        var res = myValue.split("-");

        function tConv24(time24) {
            var ts = time24;
            var H = +ts.substr(0, 2);
            var h = (H % 12) || 12;
            h = (h < 10) ? ("0" + h) : h; // leading 0 at the left for 1 digit hours
            var ampm = H < 12 ? " AM" : " PM";
            ts = h + ts.substr(2, 3) + ampm;
            return ts;
        };
        document.getElementById('app_time').innerText = tConv24(res[0]) + '-' + tConv24(res[1]);

        $("[name='slot_id']").val(slot)
    })

    function paypaldocid(docid) {
        document.getElementById('paypal_docid').value = docid.value
    }


    var currentTab = 0;
    showTab(currentTab);

    function showTab(n) {
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        if (n == 0) {
            addname()
            document.getElementById("prevBtn").style.display = "none";
            document.getElementById("nextBtn").removeAttribute('type');
        } else if (n == 2) {
            filterDoctor()
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

    function nextPrev(n) {
        var x = document.getElementsByClassName("tab");
        if (n == 1 && !validateForm()) return false;
        x[currentTab].style.display = "none";
        currentTab = currentTab + n;
        if (currentTab >= x.length) {

            stripeajax();

            setTimeout(function () {
                closecong()
            }, 5000);

            return false;
        }
        showTab(currentTab);
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

    function fixStepIndicator(n) {
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        x[n].className += " active";
    }

    //edit form validation
    var $ = jQuery;

    function addvalidation($class, $formeroorclass) {
        if ($($class).val() == '') {
            $($formeroorclass).removeClass('d-none');

            $('.changesave').attr("disabled", true).addClass('disabled');
        } else {
            $($formeroorclass).addClass('d-none');
            $('.changesave').attr("disabled", false).removeClass('disabled');
        }
    }

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
        $('.congratulation-wrap').addClass('d-none');
        $('#new-appointment-form').trigger('submit');
    }

    function checkappointment() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: prvar.checkappointmenturl,
            method: 'POST',
            data: {
                date: test.date,
                doctor_slot_id: test.slot_id,
                doctor_id: test.doc_id
            },
            success: function (data) {
                test.appcount = data
            },
            async: false
        });
    }


    function filterDoctor() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: prvar.filterdoctorurl + '/' + prvar.dcrid + '/' + slot,
            method: 'GET',
            success: function (data) {

                var html = ''
                $.each(data, function (index, value) {
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
                    test.fees = value.fees
                    test.slot_id = value.slotid
                    test.doc_id = value.docid

                    let image = value.image == null ? prvar.noimage : prvar.assetimgurl + '/' + value.image

                    checkappointment()
                    let dataOutput = '';
                    if (test.appcount == 1) {
                        dataOutput = `<div class="form-check "><span class="form-check-label primary-btn text-white">Boocked</span></div>`;
                    } else {
                        dataOutput = `
                        <div class="primary-btn">
                            <div class="form-check ">
                                <input class="form-check-input" type="radio" onclick="paypaldocid(this)" name="selectdoctory" id="doctor${value.docid}" value="${value.docid}" fees="${value.fees}">
                                <label class="form-check-label text-white" for="doctor${value.docid}">
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
                                <div class="team-overlay">
                                    ${dataOutput}
                                </div>
                            </div>
                            <div class="team-info">
                                <h4 class="team-name">${value.name}</h4>
                                <ul>
                                    <li class="catagory">${value.catname}</li>
                                    <li class="price" id="fee">Fee:${value.fees}₹</li>
                                </ul>
                            </div>
                        </div>
                    </div>`

                });


                $('.doctorajax').html(html);
            },

        });
    }

    function stripeajax() {

        $.ajax({
            url: prvar.stripeurl,
            method: 'POST',
            data: {
                "card_no": cardnumber,
                "exp_month": expirydate,
                "exp_year": expiryyear,
                "cvv": cvv,
                "holderName": cardname,
                "amount": test.fees,
                "_token": prvar.strtoken,
            }
        }).done(function (data) {
            $('.congratulation-wrap').removeClass('d-none');

            if (data == 'Your card number is incorrect.') {
                document.getElementById('card-error').innerHTML = '';
                document.getElementById('card-error').textContent += data;
            } else {

            }

        }).fail(function (data) {

            $('.congratulation-wrap').removeClass('d-none');

            document.getElementById('card-error').innerHTML = '';
            document.getElementById('month').innerHTML = '';
            document.getElementById('year').innerHTML = '';
            document.getElementById('cvv').innerHTML = '';
            document.getElementById('holder').innerHTML = '';

            document.getElementById('card-error').textContent += data.responseJSON.errors.card_no[0];
            document.getElementById('month').textContent += data.responseJSON.errors.exp_month[0];
            document.getElementById('year').textContent += data.responseJSON.errors.exp_year[0];
            document.getElementById('cvv').textContent += data.responseJSON.errors.cvv[0];
            document.getElementById('holder').textContent += data.responseJSON.errors.holderName[0];
        })
    }

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
            $('#payment_type_paypal').val('offline');
            $('#toggler').html(data);
        });
    });

    // dayoff collection
    const dayoff = $('#offday').attr('data-day').split(',');
    const day0 = dayoff.includes('sun') ? 0 : null;
    const day1 = dayoff.includes('mon') ? 1 : null;
    const day2 = dayoff.includes('tue') ? 2 : null;
    const day3 = dayoff.includes('wed') ? 3 : null;
    const day4 = dayoff.includes('thu') ? 4 : null;
    const day5 = dayoff.includes('fri') ? 5 : null;
    const day6 = dayoff.includes('sat') ? 6 : null;

    const validate = dateString => {
        const day = (new Date(dateString)).getDay();
        if (day == day0 || day == day1 || day == day2 || day == day3 || day == day4 || day == day5 || day == day6) {
            return false;
        }
        return true;
    }
    // Sets the value
    document.querySelector('input[name=appdate]').onchange = evt => {
        if (!validate(evt.target.value)) {
            evt.target.value = '';
        }
    }


})(jQuery)
