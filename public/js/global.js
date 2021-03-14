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
                    Swal.fire({
                        icon: 'success',
                        title: bss_string(onAjaxSuccess),
                        confirmButtonText: "{{ __('alert.swal.button.yes') }}",
                    })
                } else if (typeof onAjaxSuccess == 'function') {
                    onAjaxSuccess(res);
                }
            },
            error: function (request, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: bss_string(request.responseText) + ' : ' + bss_string(status) + ' : ' + bss_string(error),
                })
            }
        });
    });

    // date picker
    if ($('.bssDatePicker').length >= 1) {
        $('.bssDatePicker').daterangepicker(
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
});