function summernote() {
    $('.summernote').each(function (index, textarea) {
        textarea = $(textarea);

        textarea.summernote({
            height: 300
        });

        var id = textarea.attr('id');
        textarea.attr('id', null);
        textarea.next().find('textarea').attr('id', id);
    });
}

function tagsinput(init) {
    $('.tagsinput').each(function (i, tagsinput) {
        tagsinput = $(tagsinput);
        tagsinput.tagsinput({
            trimValue: true
        });
        if (init) {
            init[i](tagsinput);
        }

        const container = tagsinput.next();

        container.addClass('form-control')
            .append($('<div>').addClass('form-control-focus').css('bottom', '10px'))
            .append($('<span>').addClass('help-block').text(container.prev().data('help-block')));

        container.find('input').addClass('form-control').attr('id', 'tags')
            .css('border-bottom-color', 'transparent')
            .css('padding-bottom', '10px')
            .css('display', 'inline');
    });
}

function logout() {
    $('#logout-form').submit();
}

function UI(id) {
    return {
        block: function () {
            App.blockUI({
                target: '#' + id,
                animation: true,
                boxed: false,
                overlayColor: 'none',
                message: ''
            });
        },
        unblock: function () {
            App.unblockUI('#' + id);
        }
    }
}