function setupSearch(btn, input, result, result_title, result_body, top_heading) {
    var cache = [];
    $(input).keyup(function (e) {
        var code = e.keyCode || e.which;
        if (code == 13) {
            $(btn).click();
        }
    });
    $(btn).click(function () {
        q = $(input).val().trim();
        if (q != '') {
            $.ajax({
                type: "GET",
                url: "api/faq",
                data: {q: q},
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                async: true,
                cache: true,
                success: function (response) {
                    cache = response;
                    $(top_heading).addClass('has-result');
                    $(result).show();
                    $(result_title).text('Kết quả tìm kiếm cho "' + q + '"');
                    $(result_body).empty();
                    if (response.length == 0) {
                        $(result_body).text('Không có kết quả nào')
                    } else {
                        var ul = $('<ul>');
                        $(result_body).append(ul);
                        response.forEach(function (faq, index) {
                            var ahref = $('<a>').attr('href', 'javascript:').attr('data-index', index).text(faq.title);
                            $(ul).append($('<li>').append(ahref));
                            $(ahref).click(function () {
                                var index = $(this).data('index');
                                var faq = cache[index];
                                $(result_title).text(faq.title);
                                $(result_body).empty().html(faq.body);
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
    })
}