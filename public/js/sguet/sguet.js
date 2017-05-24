// app config
App.setAssetsPath(window.Laravel.appUrl + '/metronic');

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
        dialog.find('bootbox-body').html(renderMessage(message));
    };

    return dialog;
};

// string
String.prototype.replaceAll = function (search, replacement) {
    var target = this;
    return target.replace(new RegExp(search, 'g'), replacement);
};

function getHtmlAndRemove(id) {
    var target = $('#' + id);
    var html = target.html();
    target.remove();
    return html;
}