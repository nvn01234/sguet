function initSummernote(options) {
    $('.summernote').each(function (index, textarea) {
        textarea = $(textarea);

        var defaults = {
            height: 300
        };
        options = $.extend({}, defaults, options || {});

        textarea.summernote(options);

        var id = textarea.attr('id');
        textarea.attr('id', 'original_' + id);
        textarea.next().find('textarea').attr('id', id);
    });
}