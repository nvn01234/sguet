function load(source) {
    return $.Deferred(function (task) {
        var image = new Image();
        image.onload = function () {
            task.resolve(image);
        };
        image.onerror = function () {
            task.reject();
        };
        image.src = source;
    }).promise();
}

function loadImgAsync(url, target, options) {
    $.when(load(url)).done(function (image) {
        if (options && 'class' in options) {
            $(image).addClass(options.class);
        }
        if (options && 'append' in options && options.append) {
            $(target).append(image);
        } else {
            $(target).replaceWith(image);
        }
    });
}

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

function tagsinput() {
    var tagsinput = $('.tagsinput');
    tagsinput.tagsinput({
        trimValue: true
    });

    var container = $('.bootstrap-tagsinput');

    container.addClass('form-control')
        .append($('<div>').addClass('form-control-focus').css('bottom', '10px'))
        .append($('<span>').addClass('help-block').text(container.prev().data('help-block')));

    container.find('input').addClass('form-control').attr('id', 'tags')
        .css('border-bottom-color', 'transparent')
        .css('padding-bottom', '10px')
        .css('display', 'inline');
}