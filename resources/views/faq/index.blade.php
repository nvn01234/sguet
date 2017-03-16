@extends('layouts.manage')

@section('title', 'Quản lý Q&A')

@section('menu.manage.faq', 'active')

@section('create_route', route('manage.faq.create'))

@section('table-toolbar-more')
    @parent
    <div class="btn-group">
        <button class="btn sbold blue" id="sync_to_search">
            Cập nhật Máy tìm kiếm
            <i class="fa fa-refresh"></i>
        </button>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        $('#sync_to_search').click(function () {
            UI('sync_to_search').block();
            $('#sync_to_search').attr('disabled', '');
            toastr['info']('Đang cập nhât...', 'Cập nhật Máy tìm kiếm');
            $.ajax({
                method: 'POST',
                url: '{!! route('api.faq.sync') !!}',
                data: {_token: window.Laravel},
                success: function () {
                    toastr['success']('Cập nhật thành công', 'Cập nhật Máy tìm kiếm');
                    $('#sync_to_search').attr('disabled', null);
                    UI('sync_to_search').unblock();
                },
                error: function () {
                    toastr['error']('Cập nhật thất bại', 'Cập nhật Máy tìm kiếm');
                    $('#sync_to_search').attr('disabled', null);
                    UI('sync_to_search').unblock();
                }
            });
        });
    </script>
@endsection