var _provinceRequestUrl = '/province/getSelectDistrict';
var _patientRequestUrl = '/patient/getSelectDetail';

function bss_number(number) {
    return (!number || typeof number == 'undefined' || number == 'undefined' || number == '0') ? 0 : parseInt(number);
}

function bss_string(txt) {
    return (!txt || typeof txt == 'undefined' || txt == 'undefined') ? '' : txt;
}

// calculate sum
function bss_sum_number() {
    let sum = 0;
    for (let i = 0; i < arguments.length; i++) {
        sum += bss_number(arguments[i]);
    }

    return bss_number(sum);
}

function bss_call_function(fc_name, clear_called = false) {
    if (typeof fc_name == 'function') {
        fc_name();
        if (clear_called) fc_name = function () { };
    }
}

function bss_swal_Success(title = '', text = '', fcCallBack) {
    Swal.fire({
        icon: 'success',
        title: bss_string(title),
        confirmButtonText: bss_string(text),
        timer: 1500
    }).then(() => {
        fcCallBack();
    });
}

function bss_swal_Error(txt) {
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: bss_string(txt),
    });
}

function bss_swal_Warning(title = '', text = '', fcCallBack) {
    Swal.fire({
        icon: 'warning',
        title: bss_string(title),
        confirmButtonText: bss_string(text),
        // timer: 1500
    }).then(() => {
        fcCallBack();
    });
}

// prepare form AJAX submission
$(document).ready(function () {
    $(document).on('click', '.submitFormAjx', function (e) {
        e.preventDefault(); // prevent form native submission
        let _form = $(this).parents('form');

        $.ajax({
            url: _form.attr('action'),
            method: bss_string(_form.attr('method')),
            data: bss_string(_form.serialize()),
            success: function (res) {
                if (typeof onAjaxSuccess == 'string') {
                    bss_swal_Success(onAjaxSuccess);
                    onAjaxSuccess = '';
                } else if (typeof onAjaxSuccess == 'function') {
                    onAjaxSuccess(res); onAjaxSuccess = function () { };
                }
            },
            error: function (request, status, error) {
                bss_swal_Error(bss_string(request.responseText) + ' : ' + bss_string(status) + ' : ' + bss_string(error));
            }
        });
    });

    // date picker
    if ($('.bssDateRangePicker').length >= 1) {
        $('.bssDateRangePicker').daterangepicker(
            {
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().startOf('month'),
                endDate: moment().endOf('month')
            },
            function (start, end) {
                $('#from').val(start.format('YYYY-MM-DD'));
                $('#to').val(end.format('YYYY-MM-DD'));
                getDatatable(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'))
            }
        )
    }

    if ($('[name="patient_id"]').length >= 1) {
        $(document).on('change', '[name="patient_id"]', function () {
            if ($(this).val() != '') {
                $.ajax({
                    url: bss_string(_patientRequestUrl),
                    type: 'post',
                    data: { id: bss_number($(this).val()) },
                }).done(function (result) {
                    // $('[name="pt_no"]').val(result.patient.no);
                    $('[name="pt_name"]').val(bss_string(result.patient.name));
                    $('[name="pt_phone"]').val(bss_string(result.patient.phone));
                    $('[name="pt_age"]').val(bss_string(result.patient.age));
                    $('[name="pt_age_type"]').val(bss_string(result.patient.age_type));
                    $('[name="pt_gender"]').val(bss_string(result.patient.pt_gender));
                    $('[name="pt_village"]').val(bss_string(result.patient.address_village));
                    $('[name="pt_commune"]').val(bss_string(result.patient.address_commune));

                    $('[name="pt_province_id"]').attr('data-bss_district_id', bss_number(result.patient.address_district_id));
                    $('[name="pt_province_id"]').val(bss_number(result.patient.address_province_id)).trigger('change');
                });
            }
        });
    }

    if ($('[name="pt_province_id"]').length >= 1) {
        $(document).on('change', '[name="pt_province_id"]', function (e) {
            let bss_district_id = $(this).data('bss_district_id');
            $('[name="pt_district_id"]').attr({ "disabled": true }); 
            $('[name="pt_district_id"]').html('<option value=""></option>');

            $.ajax({
                url: bss_string(_provinceRequestUrl),
                method: 'post',
                data: { id: bss_number($(this).val()) },
                success: function (data) {
                    $('[name="pt_district_id"]').attr({ "disabled": false });
                    $('[name="pt_district_id"]').html(data);
                    $('[name="pt_district_id"]').val(bss_number(bss_district_id));
                }
            });
        });
    }
});