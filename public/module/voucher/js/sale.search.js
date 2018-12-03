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
        checkAll('check-all');

        $(document).on('click', '#btn-add-new', function () {
            try {
                window.location.href = '/voucher/sale';
            } catch (e) {
                alert('#btn-add-new' + e.message);

            }
        });

        $(document).on('click', '#btn-delete', function () {
            jConfirm(_msg_text[2][_sysLocate], function (r) {
                if (r) {
                    delData();
                }
            });
        });

        $(document).on('dblclick', '#tbl-explorer tbody tr', function () {
            var _primary_key = $(this).attr('primary-key');
            var objRefer = {
                init_data: {
                    'primary_key': _primary_key
                },
                back_link: '/list/sale',
            };

            postParamToLink('f_sale', objRefer, '/voucher/sale');
        });
    } catch (e) {
        alert('initialize: ' + e.message);
    }
}

/**
 * Get all checkbox selected on table
 * @returns {Array}
 */
function getSelected() {
    var _arr = [];
    $('#tbl-explorer tbody .check-all:checked').each(function () {
        _arr.push($(this).attr('primary-key'));
    });
    return _arr;
}

function delData() {
    try {
        var data = {};
        data.id_lists = getSelected();

        $.ajax({
            type: 'POST',
            url: '/voucher/sale/delete',
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
                        console.log(res['data']['errorInfo'][2]);
                        alert(res['data']['errorInfo'][2]);
                        // _showError(res['data']['errorInfo'][2]);
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
