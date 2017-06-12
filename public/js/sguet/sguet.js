// app config
App.setAssetsPath(window.Laravel.appUrl + '/metronic');
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// bootbox config
bootbox.addLocale('vi', {
    OK: 'Đồng ý',
    CANCEL: 'Huỷ',
    CONFIRM: 'Xác nhận'
});

bootbox.setLocale("vi");

bootbox.loading = function (options) {
    var renderMessage = function(message) {
        return '<p><i class="fa fa-spin fa-spinner"></i> ' + message + '...</p>';
    };

    var defaults = {
        message: 'Đang xử lý',
        closeButton: false
    };
    options = $.extend({}, defaults, options || {});
    options.message = renderMessage(options.message);
    var dialog = bootbox.dialog(options);

    dialog.updateMessage = function (message) {
        dialog.find('.bootbox-body').html(renderMessage(message));
    };

    return dialog;
};

bootbox.detailDialog = function(data, url, options) {
    var defaults = {
        message: 'Đang tải',
        closeButton: true,
        size: 'large',
        onEscape: true
    };
    options = $.extend({}, defaults, options || {});
    bootbox.hideAll();
    var dialog = bootbox.loading(options);
    window.dialog = dialog;
    $.ajax({
        method: 'get',
        url: url,
        data: data
    }).done(function(response) {
        dialog.find('.bootbox-body').html(response);
    }).fail(function(e) {
        console.log(e);
        toastr['error']('Đã có lỗi xảy ra, vui lòng thử lại sau', 'Lỗi không xác định');
        dialog.modal('hide');
    });
    return dialog;
};

bootbox.ajaxConfirm = function(data, url, message) {
    return bootbox.confirm(message || "Bạn có chắc chắn muốn thực hiện hành động này?", function(result) {
        if (result) {
            var loadingDialog = bootbox.loading();
            data = $.extend({}, {_token: window.Laravel.csrfToken}, data || {});
            $.ajax({
                method: "post",
                url: url,
                data: data
            }).done(function(response) {
                if ('redirectTo' in response) {
                    window.location.href = response.redirectTo;
                } else {
                    window.location.reload();
                }
            }).fail(function(e) {
                console.log(e);
                toastr['error']("Đã có lỗi gì đó xảy ra. Vui lòng thử lại sau", "Lỗi không xác định");
                loadingDialog.modal('hide');
            })
        }
    });
};

bootbox.deleteDialog = function(data, url) {
    return bootbox.ajaxConfirm(data, url, "Bạn có chắc chắn muốn xoá?");
};

function getHtmlAndRemove(id) {
    var target = $('#' + id);
    var html = target.html();
    target.remove();
    return html;
}

$.fn.getHtmlAndRemove = function() {
    if (this.length === 1) {
        var html = this.html();
        this.remove();
        return html;
    } else {
        var htmls = this.map(function(i, el) {
            return el.html();
        });
        this.remove();
        return htmls;
    }
};

function copyToClipboard(text) {
    var $temp = $('<input>');
    var modal = $('.modal-body');
    if (modal.length > 0) {
        modal.append($temp);
    } else {
        $("body").append($temp);
    }
    $temp.val(text).select();
    document.execCommand("copy");
    $temp.remove();
    toastr['success'](text, 'Đã sao chép vào bộ đệm');
}

String.prototype.replaceAll = function (search, replacement) {
    var target = this;
    return target.replace(new RegExp(search, 'g'), replacement);
};

String.prototype.copyToClipboard = function() {
    copyToClipboard(this);
};