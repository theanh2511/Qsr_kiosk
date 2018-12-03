var _tmp_tabIndex = -1;

$(document).ready(function () {
    try {
        initialize();
        initEvents();
        initTrigger();
    } catch (e) {
        alert('ready: ' + e.message);
    }
});

function initTrigger() {
    try {

    } catch (e) {
        alert('iniTrigger' + e.message);
    }
}

function initialize() {
    try {

    } catch (e) {
        alert('initialize: ' + e.message);
    }
}

function initEvents() {
    try {
        $(document).on('click', '#btn-save', function () {
            try {
                jConfirm(_msg_text[1][_sysLocate], function (r) {
                    if (r) {
                        save();
                    }
                });
            } catch (e) {
                alert('#btn-add-new' + e.message);

            }
        });

        //btn-back
        $(document).on('click', '#btn-back', function () {
            location.href = window.history.go(-1);

        });

        //add new row
        $(document).on('click', '#btn-add-row', function () {
            try {
                var row = $("#tbl-detail tbody tr:first").clone().find('input').val('').removeAttr("tabindex").end();
                row.find('input.input-popup').attr('value_member', '');
                row.find('input.input-popup').attr('display_member', '');
                $('#tbl-detail tbody').append(row);
                reRowIndex();
                _setTabIndex();
            } catch (e) {
                alert('add new row' + e.message);
            }

        });

        //remove row table
        $(document).on('click', '.remove-row', function () {
            try {
                var _tr_count = $("#tbl-detail tbody tr").length;
                if (_tr_count == '1') {
                    var row = $("#tbl-detail tbody tr:first").clone().find('input').val('').end();
                    $(this).parents('tr').remove();
                    $('#tbl-detail tbody').append(row);
                    reRowIndex();
                } else {
                    var row = $(this).parents('tr');
                    row.remove();
                    reRowIndex();
                }
            } catch (e) {
                alert('Remove row: ' + e.message);
            }

        });


        $(document).on('keypress', '.product-code', function (e) {
            try {
                var _index = $(this).attr('tabindex');
                var _key_search = $.trim($(this).val());
                _tmp_tabIndex = _index;
                if (e.keyCode == 13) {
                    searchProduct(_key_search, function () {
                        $("#myModal").on("shown.bs.modal", function (e, _tabindex = _index) {
                        }).modal('show');
                    });

                }
            } catch (e) {
                alert('add new row' + e.message);
            }

        });

        $(document).on('click', '.btn-search', function (e) {
            try {
                var _search_input = $(this).parent().find('.search-input');
                var _index = _search_input.attr('tabindex');
                var _key_search = $.trim(_search_input.val());
                _tmp_tabIndex = _index;

                searchProduct(_key_search, function () {
                    $("#myModal").on("shown.bs.modal", function (e, _tabindex = _index) {
                    }).modal('show');
                });
            } catch (e) {
                alert('add new row' + e.message);
            }

        });


        //modal-tr
        $(document).on('dblclick', '.modal-tr', function (e) {
            try {
                var _product_code = $(this).find('.product-code').text();
                var _product_name = $(this).find('.product-name').text();
                var _product_unit = $(this).find('.product-unit').text();
                var _product_unitprice = $(this).find('.product-unitprice').text();
                //console.log(_product_code);
                $("#myModal").on("hidden.bs.modal", function (e) {
                    var _tr = $('input[tabindex="' + _tmp_tabIndex + '"]').parents('tr');
                    console.log(_product_name);
                    $('input[tabindex="' + _tmp_tabIndex + '"]').val(_product_code);
                    _tr.find('.product-name').val(_product_name);
                    _tr.find('.product-unit').val(_product_unit);
                    _tr.find('.product-unitprice').val(_product_unitprice);
                }).modal('hide');
            } catch (e) {
                alert('dblclick choose modal row: ' + e.message);
            }

        });
    } catch (e) {
        alert('initialize: ' + e.message);
    }
}

function save() {
    try {
        var data = {};
        var parent_data = getFormValue()[0];
        parent_data.IsActive = 1;
        parent_data.CreatedBy = 1;
        parent_data.ModifiedBy = 1;
        data.ParentData = parent_data;
        data.DetailData = getDetail();
        console.log(data);

        $.ajax({
            type: 'POST',
            url: '/save/discount',
            dataType: 'json',
            loading: true,
            data: data,
            success: function (res) {
                switch (res['status']) {
                    // Success
                    case '200':
                        jSuccess(_msg_text[11][_sysLocate]);
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

function getDetail() {
    var data = {};
    $('#tbl-detail tbody tr').each(function (i, row) {
        var rowdata = {};
        rowdata['id'] = $(this).find('.detail_primary_key').text();
        rowdata['DetailNo'] = $(this).find('.zstt').text();
        rowdata['ProductCode'] = $(this).find('.product-code').val();
        rowdata['ProductName'] = $(this).find('.product-name').val();
        rowdata['Unit'] = $(this).find('.product-unit').val();
        if ($(this).find('.discount-rate').val().replace(/,/g, '') == '') {
            rowdata['DiscountRate'] = '0';
        } else {
            rowdata['DiscountRate'] = $(this).find('.discount-rate').val().replace(/,/g, '')/100;
        }

        if ($(this).find('.discount-amount').val().replace(/,/g, '') == '') {
            rowdata['DiscountAmount'] = '0';
        } else {
            rowdata['DiscountAmount'] = $(this).find('.discount-amount').val().replace(/,/g, '');
        }

        data[i] = rowdata;
    });

    return data;
}

function reRowIndex() {
    $('#tbl-detail tbody tr').each(function (i, row) {
        $(row).find('.zstt').text(i + 1);
    });
}

function searchProduct(keySearch, callback) {
    try {
        var data = {};
        data.key_search = keySearch;

        $.ajax({
            type: 'POST',
            url: '/master/product/search',
            dataType: 'html',
            loading: true,
            data: data,
            success: function (res) {
                $('#modal-search-result').empty();
                $('#modal-search-result').append(res);
                callback();
            }
        });
    } catch (e) {
        alert('searchProduct: ' + e.message);
    }
}


