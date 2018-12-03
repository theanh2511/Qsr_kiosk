$(document).ready(function () {
    try {
        initEvents();
    } catch (e) {
        alert('ready: ' + e.message);
    }
});


function initEvents() {
    try {
        // $("#myModal").on("shown.bs.modal", function () {
        //     setTimeout(function () {
        //         $("#video")[0].play(); // note the [0] to access the native element
        //     }, 2000); // 10 seconds = 10000 ms
        // }).modal('show');

        $(document).on('click', '.btn-view-detail', function () {
            location.href = '/master/product-detail/' + $(this).attr('primary-key');
        });

        //add-to-cart
        $(document).on('click', '.add-to-cart', function () {
            var _cart = {};
            _cart.ProductCode = $(this).attr('product-code');
            _cart.ProductName = $(this).attr('product-name');
            _cart.Unit = $(this).attr('product-unit');
            _cart.UnitPrice = $(this).attr('product-unitprice');
            _cart.Quantity = 1;
            _cart.Amount = $(this).attr('product-unitprice');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var objRefer = {
                cart_info: _cart
            };

            $.ajax({
                type: 'POST',
                url: '/common/session-add-to-cart',
                dataType: 'json',
                data: objRefer,
                success: function (res) {
                    var _quan = parseInt($('.label-cart').text()) + 1;
                    $('.label-cart').text(_quan);
                },
                error: function (xhr, stt, err) {
                    console.log(stt);
                    console.log(err);
                    console.log(xhr);
                }
            });
        });

        //btn-print
        $(document).on('click', '#btn-print', function () {
            try {
                // $('#tbl-explorer').print();
                save();
            } catch (e) {
                alert('#btn-print ' + e.message);
            }
        });

        //btn-plus click
        $(document).on('click', '.btn-plus', function () {
            var _val = 1 * $(this).siblings('input.numeric-input').val();
            $(this).siblings('input.numeric-input').val(_val + 1).change();
        });

        //btn-minus click
        $(document).on('click', '.btn-minus', function () {
            var _val = 1 * $(this).siblings('input.numeric-input').val();
            if (_val > 1) {
                $(this).siblings('input.numeric-input').val(_val - 1).change();
            }
        });

        $(document).on('change', '.quantity', function () {
            var _quan = 1 * $(this).val();
            var _unit_price = 1 * $(this).parents('tr').find('.unit-price').text().replace(/,/gi, '');
            $(this).parents('tr').find('.amount').text(addCommas(_quan * _unit_price));

            var sum = 0;
            $(".amount").each(function () {

                var value = $(this).text().replace(/,/gi, '');
                if (!isNaN(value) && value.length != 0) {
                    sum += parseFloat(value);
                }
            });

            $('#total-amount').text(addCommas(sum));
            // console.log(sum);
        });

    } catch (e) {
        alert('initialize: ' + e.message);
    }
}

function save() {
    try {
        var data = {};
        var parent_data = {};//getFormValue()[0];
        parent_data.IsActive = 1;
        parent_data.CreatedBy = 1;
        parent_data.ModifiedBy = 1;
        parent_data.TotalAmount = ($('#total-discount').text().replace(/,/g, '') == '' ? '0' : $('#total-discount').text().replace(/,/g, ''));
        parent_data.TotalTaxAmount = ($('#total-tax').text().replace(/,/g, '') == '' ? '0' : $('#total-tax').text().replace(/,/g, ''));
        parent_data.TotalAmount = ($('#total-amount').text().replace(/,/g, '') == '' ? '0' : $('#total-amount').text().replace(/,/g, ''));
        data.ParentData = parent_data;
        data.DetailData = getDetail();
        console.log(JSON.stringify(data));

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: '/save/sale',
            dataType: 'json',
            loading: true,
            data: data,
            success: function (res) {
                switch (res['status']) {
                    // Success
                    case '200':
                        jSuccess(_msg_text[11][_sysLocate], function () {
                            location.href = '/';
                        });
                        break;
                    // Data Validate
                    case '201':
                        alert('201');
                        break;
                    //SQL + PHP Exception
                    case '202':
                        jError(res['data']);
                        break;
                    case '203':
                        console.log(res['data']['errorInfo'][2]);
                        jError(res['data']['errorInfo'][2]);
                        break;
                    default:
                        break;
                }
            }
        });
    } catch (e) {
        alert('save: ' + e.message);
    }
}

function addCommas(nStr, is_percent) {
    if (is_percent != true) {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    } else {
        return nStr;
    }
}

function getDetail() {
    var data = {};
    $('#tbl-explorer tbody tr').each(function (i, row) {
        var rowdata = {};
        rowdata['DetailNo'] = i + 1;
        rowdata['ProductCode'] = $(this).find('.product-code').text();
        rowdata['ProductName'] = $(this).find('.product-name').text();
        rowdata['Unit'] = $(this).find('.product-unit').text();
        rowdata['UnitPrice'] = ($(this).find('.unit-price').text().replace(/,/g, '') == '' ? '0' : $(this).find('.unit-price').text().replace(/,/g, ''));
        rowdata['Amount'] = ($(this).find('.amount').text().replace(/,/g, '') == '' ? '0' : $(this).find('.amount').text().replace(/,/g, ''));
        rowdata['Quantity'] = ($(this).find('.quantity').val().replace(/,/g, '') == '' ? '0' : $(this).find('.quantity').val().replace(/,/g, ''));

        data[i] = rowdata;
    });

    return data;
}