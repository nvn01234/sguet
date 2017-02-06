$(document).ready(function () {
    $('#manage-table').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: '',
            method: 'get',
            error: function () {
                toastr['error']('Vui lòng thử lại', 'Lỗi kết nối');
            }
        },
        order: ORDER,
        timeout: 10000,
        language: {
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
        },
        pagingType: 'full_numbers',
        columns: COLUMNS
    });
});