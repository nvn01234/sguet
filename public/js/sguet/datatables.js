$.fn.dataTable.ext.errMode = 'none';
$.extend(true, $.fn.dataTable.defaults, {
    responsive: true,
    processing: true,
    serverSide: true,
    pagingType: 'full_numbers',
    timeout: 10000,
    language: {
        "processing": "Đang xử lý...",
        "lengthMenu": "Xem _MENU_ mục",
        "zeroRecords": "Không tìm thấy dòng nào phù hợp",
        "emptyTable": "Không có dữ liệu trong bảng",
        "info": "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
        "infoEmpty": "Đang xem 0 đến 0 trong tổng số 0 mục",
        "infoFiltered": "(được lọc từ _MAX_ mục)",
        "infoPostFix": "",
        "search": "Tìm:",
        "url": "",
        "paginate": {
            "first": "<i class=\"fa fa-angle-double-left\"></i>",
            "previous": "<i class=\"fa fa-angle-left\"></i>",
            "next": "<i class=\"fa fa-angle-right\"></i>",
            "last": "<i class=\"fa fa-angle-double-right\"></i>"
        }
    }
});


var retry_count = 0;
function handleDataTableError(e, settings, techNote, message) {
    console.log('An error has been reported by DataTables: ', message);
    if (retry_count < 3) {
        retry_count++;
        toastr['warning']('Đã có lỗi xảy ra. Đang tải lại bảng lần ' + retry_count + '/3 ...', 'Lỗi không xác định');
        window.setTimeout(function() {
            window.LaravelDataTables["dataTableBuilder"].ajax.reload();
        }, 1000);
    } else {
        toastr['error']('Đã thử tải lại bảng 3 lần không thành công. Vui lòng quay lại sau.', 'Lỗi không xác định');
    }
}

function updateSearchInputWidth() {
    var inputs = $('#dataTableBuilder_filter').find('input[placeholder]');
    if (inputs.length) {
        var input = inputs[0];
        var oldSize = input.size;
        var newSize = $(input).attr('placeholder').length;
        if (newSize > oldSize) {
            $(input).attr('size', newSize);
        }
    }
}

function initToggleVisCb() {
    var toggleVis = $('.toggle-vis').not('.initialed');
    toggleVis.change(function () {
        var column_index = $(this).data('column');
        var is_visible = $(this).is(':checked');

        var table = window.LaravelDataTables["dataTableBuilder"];
        var column = table.column(column_index);
        column.visible(is_visible);

        if ($.cookie) {
            $.cookie('column_' + column_index + '_is_visible', is_visible);
        }
    });
    toggleVis.each(function(i, cb) {
        var column_index = $(this).data('column');
        if ($.cookie && $.cookie('column_' + column_index + '_is_visible') === "false") {
            $(cb).click();
        }
    });
    toggleVis.addClass('initialed');
}

function initCheckboxUniform() {
    App.initUniform($('#dataTableBuilder').find('tbody input[type="checkbox"]'));
}

function initButtons() {
    $('body').on('click', 'li > a.tool-action', function() {
        var action = $(this).attr('data-action');
        window.LaravelDataTables["dataTableBuilder"].button(action).trigger();
    });
}

function initTooltips() {
    $('.tooltips').tooltip();
}

$('#dataTableBuilder')
    .on('error.dt', handleDataTableError)
    .on('draw.dt', function() {
        updateSearchInputWidth();
        initToggleVisCb();
        initButtons();
        initTooltips();
    })
    .on('init.dt order.dt length.dt page.dt', function() {
        retry_count = 0;
        initCheckboxUniform();
    });

function initCheckboxColumn(cb_all_id, cb_one_class) {
    $('#' + cb_all_id).change(function() {
        var cbs = $('.' + cb_one_class);
        cbs.prop('checked', $(this).is(':checked'));
        App.updateUniform(cbs);
    });

    $('#dataTableBuilder').on('init.dt', function() {
        $('.' + cb_one_class).change(function() {
            var cb_all = $('#' + cb_all_id);
            cb_all.prop('checked', $('.' + cb_one_class).not(':checked').length === 0);
            App.updateUniform(cb_all);
        })
    });
}