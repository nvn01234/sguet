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

function Scroll(id) {
    const target = $('#' + id);
    return {
        toTop: function() {
            $('html, body').animate({
                scrollTop: target.offset().top
            }, 1000);
        },
        toVisible: function() {
            var offset = target.offset().top - $(window).scrollTop();

            if (offset > window.innerHeight) {
                // Not in view so scroll to it
                $('html,body').animate({scrollTop: offset}, 1000);
            }
        }
    }
}

String.prototype.replaceAll = function(from, to) {
    return this.split(from).join(to);
};

function copyToClipboard(text) {
    const aux = document.createElement("input");
    aux.setAttribute("value", text);
    document.body.appendChild(aux);
    aux.select();
    document.execCommand("copy");
    document.body.removeChild(aux);
}