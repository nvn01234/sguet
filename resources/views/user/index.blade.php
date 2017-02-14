@extends('layouts.manage')

@section('title', 'Quản lý người dùng')

@section('menu.manage.user', 'active')

@section('create_route', route('manage.user.create'))

@section('thead')
    <tr>
        <th>ID</th>
        <th>Tên đăng nhập</th>
        <th>Tên người dùng</th>
        <th>Phân quyền</th>
        <th>Thời gian tạo</th>
        <th>Cập nhật lần cuối</th>
        {{--<th>Quản lý</th>--}}
    </tr>
@endsection

@section('scripts')
    <script>
        var COLUMNS = [
            {data: 'id', name: 'id'},
            {data: 'username', name: 'username'},
            {data: 'name', name: 'name'},
            {data: 'role_name', name: 'role_name'},
            {data: 'created_at', name: 'created_at'},
            {data: 'updated_at', name: 'updated_at'},
//            {data: 'action', name: 'action', orderable: false, searchable: false}
        ];
        var ORDER = [
            [4, 'desc']
        ];
    </script>
    @parent
@endsection