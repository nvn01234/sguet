var search_btn = $('#search_btn');
var search_input = $('#search_input');

$('.fullscreen').click(function () {
    var slimScrollDiv = $('.slimScrollDiv');
    var scroller = $('.scroller');

    if ($(this).hasClass('on')) {
        slimScrollDiv.css('height', '200px');
        scroller.css('height', '200px')
    } else {
        slimScrollDiv.css('height', 'auto');
        scroller.css('height', 'auto')
    }
});

search_input.keyup(function (e) {
    var code = e.keyCode || e.which;
    if (code == 13) {
        search_btn.click();
    }
});

search_btn.click(function () {
    q = search_input.val().trim();
    if (q != '') {
        $.ajax({
            type: "GET",
            url: "api/tim-kiem/faq",
            data: {q: q},
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            async: true,
            cache: true,
            success: function (response) {
                var cache = response;
                var result_body = $('#search_result_body');
                var result_title = $('#search_result_title');

                $('#top_heading').removeClass('margin-top-20').addClass('margin-top-40');
                $('#search_result').show();
                result_title.text('Kết quả tìm kiếm cho "' + q + '"');
                result_body.empty();

                if (response.length == 0) {
                    result_body.text('Không có kết quả nào')
                } else {
                    var ul = $('<ul>');
                    result_body.append(ul);
                    response.forEach(function (faq, index) {
                        var ahref = $('<a>').attr('href', 'javascript:').attr('data-index', index).text(faq.title);
                        ul.append($('<li>').append(ahref));
                        ahref.click(function () {
                            var index = $(this).data('index');
                            var faq = cache[index];
                            result_title.text(faq.title);
                            result_body.empty().append(
                                $('<p>').html(faq.body)
                            )
                        });
                    });
                }
            },
            error: function () {
                toastr['error']('Có lỗi gì đó đã xảy ra trong quá trình tìm kiếm, vui lòng thử lại sau.', 'Lỗi không xác định');
            }
        })
    } else {
        toastr['info']('Nhập cái gì đi chứ :v', 'Tìm gì?');
    }
});
