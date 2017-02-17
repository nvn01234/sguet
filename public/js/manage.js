$.extend(true, $.fn.dataTable.defaults, {
    responsive: true,
    processing: true,
    serverSide: true,
    pagingType: 'full_numbers',
    ajax: {
        url: '',
        method: 'GET',
        data: {_token: window.Laravel},
        error: function () {
            toastr['error']('Vui lòng tải lại trang', 'Lỗi tải trang')
        }
    },
    timeout: 10000,
    language: {
        "emptyTable": "Không có dữ liệu trong bảng",
        "processing": "Đang xử lý...",
        "lengthMenu": "Xem _MENU_ mục",
        "zeroRecords": "Không tìm thấy dòng nào phù hợp",
        "info": "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
        "infoEmpty": "Đang xem 0 đến 0 trong tổng số 0 mục",
        "infoFiltered": "(được lọc từ _MAX_ mục)",
        "infoPostFix": "",
        "search": "Tìm:",
        "url": "",
        "paginate": {
            "first": "<i class=\"fa fa-angle-double-left\"></i>",
            "previous": "<i class=\"fa fa-angle-left\"></i>",
            "next": "<i class=\"fa fa-angle-right\"></i>",
            "last": "<i class=\"fa fa-angle-double-right\"></i>"
        }
    }
});
