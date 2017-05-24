function initTagsinput(options) {
    $('.tagsinput').each(function (i, tagsinput) {
        tagsinput = $(tagsinput);
        var id = tagsinput.attr('id');

        var defaults = {
            trimValue: true
        };
        options = $.extend({}, defaults, options || {});
        tagsinput.tagsinput(options);

        var container = tagsinput.next();

        container.addClass('form-control')
            .css('height', 'auto')
            .append($('<div>').addClass('form-control-focus'))
            .append($('<span>').addClass('help-block').text(tagsinput.data('help-block')));

        container.find('input')
            .addClass('form-control')
            .attr('id', id);

        if (tagsinput.data('placeholder')) {
            container.find('input')
                .attr('placeholder', tagsinput.data('placeholder'));
        }

        tagsinput.attr('id', 'original_' + id);
    });
}