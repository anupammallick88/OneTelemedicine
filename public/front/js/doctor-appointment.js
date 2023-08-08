(function ($) {
    "use strict";

    let jsvar = document.getElementById('js_variable_data');
    let ds = jsvar.getAttribute('data-jsvar');

    let dvar = JSON.parse(ds);

    $('#showPass').on('click', function () {
        var passInput = $("#passInput");
        if (passInput.attr('type') === 'password') {
            $(this).removeClass('fa-eye');
            $(this).addClass('fa-eye-slash');
            passInput.attr('type', 'text');
        } else {
            $(this).removeClass('fa-eye-slash');
            $(this).addClass('fa-eye');
            passInput.attr('type', 'password');
        }
    })

    $('#showConfirmPass').on('click', function () {
        var passConfirmInput = $("#passConfirmInput");
        if (passConfirmInput.attr('type') === 'password') {
            $(this).removeClass('fa-eye');
            $(this).addClass('fa-eye-slash');
            passConfirmInput.attr('type', 'text');
        } else {
            $(this).removeClass('fa-eye-slash');
            $(this).addClass('fa-eye');
            passConfirmInput.attr('type', 'password');
        }
    })

    $('.default-pass').on('click', function () {
        if ($('.default-pass').is(':checked')) {
            $("#passInput").prop("readonly", true);
            $("#passConfirmInput").prop("readonly", true);
            $('#passInput').val('123456789');
            $('#passConfirmInput').val('123456789');
        } else {
            $("#passInput").prop("readonly", false);
            $("#passConfirmInput").prop("readonly", false);
            $('#passInput').val('');
            $('#passConfirmInput').val('');
        }
    })


    function tConv24(time24) {
        var ts = time24;
        var H = +ts.substr(0, 2);
        var h = (H % 12) || 12;
        h = (h < 10) ? ("0" + h) : h; // leading 0 at the left for 1 digit hours
        var ampm = H < 12 ? " AM" : " PM";
        ts = h + ts.substr(2, 3) + ampm;
        return ts;
    };

    let tbody = document.getElementById('medicine');
    let testtable = document.getElementById('testtable');
    let addBtn = document.getElementById('add-tablebtn');
    let i = 0
    let x = 0
    $(document).ready(function () {
        add();
        addTest();
        $(document).on('click', '#add-tablebtn', function () {
            add();
        });
        $(document).on('click', '#add-testbtn', function () {
            addTest();
        });
        $(document).on('click', '#btnremove', function () {
            $(this).closest('tr').remove();
        });
        $(document).on('click', '#delete-test', function () {
            $(this).closest('tr').remove();
        });

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

        $('#editform #bio').on('keyup', function () {
            if ($('#editform #bio').val() == '') {
                $('#editform .bioerror').removeClass('d-none');
                $('.changesave').attr("disabled", true).addClass('disabled');
            } else {
                $('#editform .bioerror').addClass('d-none');
                $('.changesave').attr("disabled", false).removeClass('disabled');
            }
        });

        $(document).on('click', '#print', function () {
            printData()
        });

        $(document).on('click', '#PastAppominment a.pagin', function (event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_data_past(page);
        });
        function fetch_data_past(page) {
            $.ajax({
                url: dvar.doctorfetchdatapagin + page,
                success: function (data) {
                    $('#PastAppominment').html(data);
                }
            });
        }

        $('#appoinmentdate').on('keyup', function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: dvar.doctorsearchappointmentdateurl,
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
                    $('.pagination-past').hide()
                    $('tbody#searchbody').html(data)
                    $('tbody#searchbodytoday').html(data)
                } else {
                    $('tbody#searchbody').hide()
                    $('tbody#searchbodytoday').hide()
                    $('#searchhead').addClass('d-none')
                    $('#searchheadtoday').addClass('d-none')
                    $('#pastsearch').show()
                    $('#todaypagination').show()
                    $('.pagination-past').show()
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
                url: dvar.patientappointment,
                data: {
                    msg: $('#appoinmentsearch').val()
                },
            }).done(function (data) {
                $('#pastsearch').hide()
                $('#todaypagination').hide()
                $('#searchhead').removeClass('d-none')
                $('#searchheadtoday').removeClass('d-none')
                $('tbody#searchbody').show()
                $('tbody#searchbodytoday').show()
                $('.pagination-past').hide()
                if ($('#appoinmentsearch').val() != '') {
                    $('tbody#searchbody').html(data)
                    $('tbody#searchbodytoday').html(data)
                } else {
                    $('tbody#searchbody').hide()
                    $('tbody#searchbodytoday').hide()
                    $('#searchhead').addClass('d-none')
                    $('#searchheadtoday').addClass('d-none')
                    $('#pastsearch').show()
                    $('#todaypagination').show()
                    $('.pagination-past').show()
                }
            });
        });

        $(document).on('click', '#TodayAppominment a.pagin', function (event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_data_today(page);
        });
        function fetch_data_today(page) {
            $.ajax({
                url: dvar.doctortodaysfetchdataurl + page,
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
                url: dvar.doctordashboardfetchdataurl + page,
                success: function (data) {
                    $('#dashboardpagi').html(data);
                }
            });
        }
        // prescription frevenDefault 
        // $(document).on('click', '#presBtnSubmit', function (e) {
        //     e.preventDefault();
        // });
    });

    function addTest() {
        x++
        var html = `
                <tr>
                    <td>
                    <div class="form-group">
                        <input type="text" class="form-control" id="MedicineName6" name="testname[${x}]" placeholder="Name" />
                    </div>
                    </td>
                    <td>
                    <div class="form-group">
                        <input type="text" class="form-control" id="Comment4" name="testcomment[${x}]" placeholder="Comment" />
                    </div>
                    </td>
                    <td>
                    <a class="delet-btn  ${x == 1 ? 'd-none' : ''}" id="delete-test"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            `;
        $('#testtable').append(html);
    }
    function add() {
        i++
        var html = `
                <tr>
                    <td>
                    <div class="form-group">
                        <input type="text" class="form-control" id="MedicineName" name="MedicineName[${i}]" placeholder="Name" required />
                    </div>
                    </td>
                    <td>
                    <div class="form-group">
                        <select name="type[${i}]" class="form-control">
                        <option>Tablet</option>
                        <option>Capsule</option>
                        <option>Syrup</option>
                        </select>
                    </div>
                    </td>
                    <td>
                    <div class="form-group">
                        <input type="text" name="mg[${i}]" placeholder="mg" class="form-control" />
                    </div>
                    </td>
                    <td>
                    <div class="form-group">
                        <input type="text" class="form-control dose" id="Dose" name="Dose[${i}]" placeholder="0 - 1 - 0 - 1" />
                    </div>
                    </td>
                    <td>
                    <div class="form-group">
                        <input type="text" class="form-control day" id="Day" name="Day[${i}]" placeholder="15" />
                    </div>
                    </td>
                    <td>
                    <div class="form-group">
                        <input type="text" class="form-control" id="Comment" name="Comment[${i}]" placeholder="Comment" />
                    </div>
                    </td>
                    <td>
                    <a class="delet-btn ${i == 1 ? 'd-none' : ''}" id="btnremove" href="javascript:void(0)"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            `;
        $('#medicine').append(html);
    }

    function printData() {
        var print_ = document.getElementById("printable");
        var win = window.open("", "Doctor Appointment", "height=400,width=600");
        win.document.write(print_.outerHTML);
        win.document.close();
        win.focus(); // necessary for IE >= 10
        // win.document.write("<p>This is 'myWindow'</p>");
        win.print();
        // win.close();
    }


})(jQuery)
