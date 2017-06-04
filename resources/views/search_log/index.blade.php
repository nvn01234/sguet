@extends('layouts.datatables')

@section('page-title', 'Lịch sử tìm kiếm')

@section('page-breadcrumb')
    <li>
        <a href="javascript:" class="sidebar-toggler menu-toggler responsive-toggler" data-toggle="collapse"
           data-target=".navbar-collapse">Quản lý</a>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <span>Lịch sử tìm kiếm</span>
    </li>
@endsection

@section('table-toolbar')
    <div class="table-toolbar">
        <div class="row">
            <div class="col-md-12">
                <a href="javascript:" class="btn green" id="clean-up"><i class="fa fa-trash"></i> Dọn dẹp</a>
                <div hidden>
                    {{Form::open(['method' => 'post', 'route' => 'manage.search_log.cleanup', 'id' => 'cleanup-form'])}}
                    {{Form::hidden('option', null, ['id' => 'cleanup-option'])}}
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-level-scripts')
    @parent
    <script>
        $(function() {
            $('#cleanup-form').submit(function() {
                bootbox.loading({message: 'Đang dọn dẹp'});
            });

            $('#clean-up').click(function () {
                bootbox.prompt({
                    title: 'Chọn chế độ dọn dẹp',
                    value: 'keep_today',
                    inputType: 'select',
                    inputOptions: [
                        {
                            text: 'Giữ lại hôm nay',
                            value: 'keep_today'
                        }, {
                            text: 'Giữ lại 7 ngày gần nhất',
                            value: 'keep_7_days'
                        }, {
                            text: 'Giữ lại tháng này',
                            value: 'keep_this_month'
                        }, {
                            text: 'Xoá tất cả',
                            value: 'keep_nothing'
                        }
                    ],
                    buttons: {
                        confirm: {
                            label: '<i class="fa fa-trash"></i> Dọn dẹp'
                        }
                    },
                    callback: function(result) {
                        if (result) {
                            $('#cleanup-option').val(result);
                            $('#cleanup-form').submit();
                        }
                    }
                });
            });
        });
    </script>
@endsection