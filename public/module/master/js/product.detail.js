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
        $('#Description,#ProductInfo').summernote({
            height: 120,
            minHeight: null,
            maxHeight: null,
            focus: true,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ]
        });

        $(document).on('click', '#btn-save', function () {
            try {
                jConfirm(_msg_text[1][_sysLocate], function (r) {
                    if (r) {
                        saveFormData();
                    }
                });
            } catch (e) {
                alert('#btn-add-new' + e.message);

            }
        });

        //btn-back
        $(document).on('click', '#btn-back', function () {
            location.href = '/list/product'

        });

        //.remove-img
        $(document).on('click', '.remove-img', function () {
            var _path = $(this).parents('tr').find('.td-img').attr('src');
            var _this_tr = $(this).parents('tr');
            jConfirm(_msg_text[2][_sysLocate], function (r) {
                if (r) {
                    var data = {};
                    data.img_path = _path;

                    $.ajax({
                        type: 'POST',
                        url: '/common/remove-image',
                        dataType: 'json',
                        loading: true,
                        data: data,
                        success: function (res) {
                            switch (res['status']) {
                                // Success
                                case '200':
                                    jSuccess(_msg_text[14][_sysLocate], function () {
                                        _this_tr.remove();
                                    });
                                    break;
                                // Data Validate
                                case '201':
                                    alert('201');
                                    break;
                                //SQL + PHP Exception
                                case '202':
                                    alert('202');
                                    break;
                                case '203':
                                    console.log(res['data']);
                                    break;
                                default:
                                    break;
                            }
                        }
                    });
                }
            });
        });


        $(document).on('click', '#btn-delete', function () {

            // return;
            jConfirm(_msg_text[2][_sysLocate], function (r) {
                if (r) {
                    var arr = [];
                    arr.push($('#PrimaryKey').val());
                    var data = {};
                    data.id_lists = arr;

                    $.ajax({
                        type: 'POST',
                        url: '/master/product/delete',
                        dataType: 'json',
                        loading: true,
                        data: data,
                        success: function (res) {
                            switch (res['status']) {
                                // Success
                                case '200':
                                    jSuccess(_msg_text[12][_sysLocate], function () {
                                        location.reload(true);
                                    });
                                    break;
                                // Data Validate
                                case '201':
                                    alert('201');
                                    break;
                                //SQL + PHP Exception
                                case '202':
                                    alert('202');
                                    break;
                                case '203':
                                    console.log(res['data']);
                                    break;
                                default:
                                    break;
                            }
                        }
                    });
                }
            });
        });

        $(document).on('click', '.btn-search', function (e) {
            try {
                var _search_input = $(this).parent().find('.search-input');
                var _index = _search_input.attr('tabindex');
                var _key_search = $.trim(_search_input.val());
                _tmp_tabIndex = _index;

                searchProduct(_key_search, function () {
                    $("#modalProduct").on("shown.bs.modal", function (e, _tabindex = _index) {
                    }).modal('show');
                });
            } catch (e) {
                alert('add new row' + e.message);
            }

        });

        $(document).on('keypress', '.product-code', function (e) {
            try {
                var _index = $(this).attr('tabindex');
                var _key_search = $.trim($(this).val());
                _tmp_tabIndex = _index;
                if (e.keyCode == 13) {
                    searchProduct(_key_search, function () {
                        $("#modalProduct").on("shown.bs.modal", function (e, _tabindex = _index) {
                        }).modal('show');
                    });

                }
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

                $("#modalProduct").on("hidden.bs.modal", function (e) {
                    if (_product_code != '') {
                        var _tr = $('input[tabindex="' + _tmp_tabIndex + '"]').parents('tr');

                        $('input[tabindex="' + _tmp_tabIndex + '"]').val(_product_code);
                        _tr.find('.product-name').val(_product_name);
                        _tr.find('.product-unit').val(_product_unit);
                        _tr.find('.product-unitprice').val(_product_unitprice);
                        _tr.find('.quantity').val(1);
                    }
                }).modal('hide');
            } catch (e) {
                alert('dblclick choose modal row: ' + e.message);
            }

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
        return;
        $.ajax({
            type: 'POST',
            url: '/master/product/save',
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

function saveFormData() {
    try {
        var form_data = new FormData();

        //for files update
        var match = ["image/jpeg", "image/png", "image/jpg",];
        var type = '';
        var _validType = true;
        var file_data = $('#upload_imgs').prop('files');

        $.each(file_data, function (index) {
            type = $(this)[0].type;
            if (!(type == match[0] || type == match[1] || type == match[2])) {
                _validType = false;
            } else {
                form_data.append('file[]', file_data[index]);
            }
        });

        //for form data
        var data = {};
        var parent_data = getFormValue()[0];
        parent_data.IsActive = 1;
        parent_data.CreatedBy = 1;
        parent_data.ModifiedBy = 1;

        data.ParentData = parent_data;
        data.DetailData = getDetail();


        form_data.append('form_data', JSON.stringify(data));

        $.ajax({
            type: 'POST',
            url: '/master/product/save',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            loading: true,
            data: form_data,
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


    $("input.hastags").bind("keyup", function () {

        /* replaces text as you type with hashtags */

        var input = $(this);
        var value = input.val();
        var ends_with_space = (value.substr(-1) == " ");

        var hashed_value = "";
        var parts = value.split(" ");
        for (var i = 0; i < parts.length; i++) {
            var part = parts[i];
            if (part.indexOf("#") != 0) {
                part = "#" + part;
            }
            if (part != "#") {
                if (hashed_value == "") {
                    hashed_value = part;
                } else {
                    hashed_value += " " + part;
                }
            }
        }
        if (ends_with_space) {
            hashed_value = hashed_value + " ";
        }
        input.val(hashed_value.replace(",", ""));
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

function reRowIndex() {
    $('#tbl-detail tbody tr').each(function (i, row) {
        $(row).find('.zstt').text(i + 1);
    });
}

function getDetail() {
    var data = {};
    $('#tbl-detail tbody tr').each(function (i, row) {
        var rowdata = {};
        // rowdata['id'] = $(this).find('.detail_primary_key').text();
        rowdata['DetailNo'] = $(this).find('.zstt').text();
        rowdata['ParentProductCode'] = $('input[data-field="Code"]').val();
        rowdata['ChildProductCode'] = $(this).find('.product-code').val();
        if ($(this).find('.quantity').val().replace(/,/g, '') == '') {
            rowdata['Quantity'] = '0';
        } else {
            rowdata['Quantity'] = $(this).find('.quantity').val().replace(/,/g, '');
        }


        data[i] = rowdata;
    });

    return data;
}