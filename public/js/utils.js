function loadImgAsync(source) {
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

function replaceImgAsync(url, img, options) {
    $.when(loadImgAsync(url)).done(function (image) {
        if (options && 'class' in options) {
            image.addClass(options.class);
        }
        $(img).replaceWith(image);
    });
}