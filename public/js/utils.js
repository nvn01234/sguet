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