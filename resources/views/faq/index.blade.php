@extends('layouts.manage')

@section('title', 'Quản lý Q&A')

@section('menu.manage.faq', 'active')

@section('create_route', route('manage.faq.create'))

@section('thead')
    <tr>
        <th>ID</th>
        <th>Câu hỏi</th>
        <th>Thời gian tạo</th>
        <th>Cập nhật lần cuối</th>
        <th>Quản lý</th>
    </tr>
@endsection

@section('scripts')
    <script>
        var COLUMNS = [
            {data: 'id', name: 'id'},
            {data: 'question', name: 'question'},
            {data: 'created_at', name: 'created_at'},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
        var LENGTH_MENU = [
            [10, 50, 50, 20, 20, -1],
            [10, 50, 50, 20, 20, "All"]
        ];
        var ORDER = [
            [2, 'desc']
        ];
    </script>
    @parent
@endsection