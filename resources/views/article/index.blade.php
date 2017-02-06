@extends('layouts.manage')

@section('title', 'Quản lý Tin tức - Hoạt động')

@section('menu.manage.article', 'active')

@section('create_route', route('manage.article.create'))

@section('thead')
    <tr>
        <th>ID</th>
        <th>Tiêu đề</th>
        <th>Mô tả</th>
        <th>Loại</th>
        <th>Thời gian tạo</th>
        <th>Cập nhật lần cuối</th>
        <th>Quản lý</th>
    </tr>
@endsection

@section('scripts')
    <script>
        var COLUMNS = [
            {data: 'id', name: 'id'},
            {data: 'title', name: 'title'},
            {data: 'short_description', name: 'short_description'},
            {data: 'category_name', name: 'category_name'},
            {data: 'created_at', name: 'created_at'},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ];
        var LENGTH_MENU = [
            [10, 50, 50, 20, 20, -1],
            [10, 50, 50, 20, 20, "All"]
        ];
        var ORDER = [
            [4, 'desc']
        ];
    </script>
    @parent
@endsection