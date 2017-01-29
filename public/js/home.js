/*BEGIN VARIABLES*/
var search_btn = $('#search_btn');
var search_input = $('#search_input');
var back_btn = $('#back_btn');
var copylink_btn = $('#copylink_btn');
var result_body = $('#search_result_body');
var result_title = $('#search_result_title');
var result_count = $('#search_result_count');
var cache = {
    index: undefined,
    query: undefined,
    response: undefined
};
/*END DECLARATIONS*/

/*BEGIN FUNCTIONS*/
// Don't know why default jquery's show() & hide() don't work
back_btn.show = function () {
    back_btn.removeClass('hide');
};

back_btn.hide = function () {
    back_btn.addClass('hide');
};

copylink_btn.show = function () {
    copylink_btn.removeClass('hide');
};

copylink_btn.hide = function () {
    copylink_btn.addClass('hide');
};

function generateOneResult(faq, index) {
    var a = $('<a>')
        .addClass('accordion-toggle')
        .attr('href', 'javascript:')
        .attr('data-index', index)
        .text(faq.title).click(function () {
            cache.index = $(this).data('index');
            var faq = cache.response[cache.index];
            result_title.text(faq.title);
            result_body.empty().append(
                $('<p>').html(faq.body)
            );
            back_btn.show();
            copylink_btn.show();
        });
    result_body.append(
        $('<div>').addClass('panel panel-default').append(
            $('<div>').addClass('panel-heading').append(
                $('<h4>').addClass('panel-title').append(
                    $('<i>').addClass('fa fa-question')
                ).append(a)
            )
        )
    )
}

function onsuccess(response) {
    cache.response = response;
    cache.index = undefined;

    $('#top_heading').removeClass('margin-top-20').addClass('margin-top-40');
    $('#search_result').show();
    back_btn.hide();
    copylink_btn.hide();

    result_title.text('Kết quả tìm kiếm cho "' + cache.query + '"');
    result_count.text(cache.response.length + ' kết quả');
    result_body.empty();

    if (cache.response.length == 0) {
        result_body.text('Không có kết quả nào')
    } else {
        cache.response.forEach(generateOneResult);
    }
}

function copyToClipboard(text) {
    var aux = document.createElement("input");
    aux.setAttribute("value", text);
    document.body.appendChild(aux);
    aux.select();
    document.execCommand("copy");
    document.body.removeChild(aux);
}
/*END FUNCTION*/

/*BEGIN HANDLE EVENTS*/
$('.fullscreen').click(function () {
    var slimScrollDiv = $('.slimScrollDiv');
    var scroller = $('.scroller');
    var portlet_body = $('.portlet-body');

    if ($(this).hasClass('on')) {
        slimScrollDiv.css('height', '200px');
        scroller.css('height', '200px');
        portlet_body.removeClass('fullscreen');
    } else {
        slimScrollDiv.css('height', 'auto');
        scroller.css('height', 'auto');
        portlet_body.addClass('fullscreen');
    }
});

search_input.keyup(function (e) {
    var code = e.keyCode || e.which;
    if (code == 13) {
        search_btn.click();
    }
});

search_btn.click(function () {
    var query = search_input.val().trim();
    if (cache.query != query) {
        cache.query = query;
        if (cache.query != '') {
            $.ajax({
                type: "GET",
                url: SEARCH_URL,
                data: {q: cache.query},
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                async: true,
                cache: true,
                success: onsuccess,
                error: function () {
                    toastr['error']('Có lỗi gì đó đã xảy ra trong quá trình tìm kiếm, vui lòng thử lại sau.', 'Lỗi không xác định');
                }
            })
        } else {
            toastr['info']('Nhập cái gì đi chứ :v', 'Tìm gì?');
        }
    } else {
        onsuccess(cache.response)
    }
});

back_btn.click(function () {
    onsuccess(cache.response);
});

copylink_btn.click(function () {
    if (cache.index != undefined) {
        var id = cache.response[cache.index].id;
        var url = HOME_URL + '?faq=' + id;
        copyToClipboard(url);
        toastr['info'](url + ' đã được sao chép vào clipboard', 'Copy đường dẫn');
    }
});
/*END HANDLE EVENTS*/

// portlet tooltips
$('.portlet > .portlet-title .back').tooltip({
    container: 'body',
    title: 'Quay lại'
});

$('.portlet > .portlet-title .copylink').tooltip({
    container: 'body',
    title: 'Copy đường dẫn'
});