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

        $(document).on('click', '#btn-back', function () {
            try {
                location.href = '/list/catalog';
            } catch (e) {
                alert('#btn-back: ' + e.message);

            }
        });

    } catch (e) {
        alert('initialize: ' + e.message);
    }
}

function save() {
    try {
        var form_data = new FormData();

        //for files update
        var match = ["image/jpeg", "image/png", "image/jpg",];
        var type = '';
        var _validType = true;
        var file_data = $('input[type="file"][data-field]').prop('files');
        if (typeof file_data != 'undefined') {
            $.each(file_data, function (index) {
                type = $(this)[0].type;
                if (!(type == match[0] || type == match[1] || type == match[2])) {
                    _validType = false;
                } else {
                    form_data.append('file[]', file_data[index]);
                }
            });
            form_data.append('file_datafield', 'ImageUrl');
        }

        //for form data
        var data = getFormValue()[0];
        data.IsActive = 1;
        data.CreatedBy = 1;
        data.ModifiedBy = 1;
        form_data.append('form_data', JSON.stringify(data));

        $.ajax({
            type: 'POST',
            url: '/master/catalog/save',
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
}
