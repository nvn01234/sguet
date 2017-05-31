@extends('layouts.datatables')

@section('page-title', 'Danh sách Q&A')
@section('page-breadcrumb')
    <li>
        <a href="javascript:" class="sidebar-toggler menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">Quản lý</a>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <a href="javascript:" class="sidebar-toggler menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">UET Q&A</a>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <span>Danh sách Q&A</span>
    </li>
@endsection

@section('table-toolbar')
    <div class="table-toolbar">
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group">
                    <a href="{{route('manage.faq.create')}}" class="btn blue">
                        <i class="fa fa-plus"></i>
                        Tạo Q&A
                    </a>
                </div>
                @permission('manage-system')
                <div class="btn-group">
                    <button class="btn sbold blue" id="sync_to_search">
                        Cập nhật Máy tìm kiếm
                        <i class="fa fa-refresh"></i>
                    </button>
                </div>
                @endpermission
            </div>
        </div>
    </div>
@endsection

@section('page-level-scripts')
    @parent
    @permission('manage-system')
    <script>
        $('#sync_to_search').click(function () {
            var dialog = bootbox.loading({message: 'Đang cập nhật'});
            $.ajax({
                method: 'POST',
                url: '{!! route('manage.faq.sync') !!}',
                data: {_token: window.Laravel.csrfToken},
                success: function () {
                    @toastr(['level' => 'success', 'title' => 'Cập nhật thành công'])
                    dialog.modal('hide');
                },
                error: function () {
                    @toastr(['level' => 'error', 'title' => 'Cập nhật thất bại'])
                    dialog.modal('hide');
                }
            });
        });
    </script>
    @endpermission
@endsection