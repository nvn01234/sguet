@extends('layouts.manage')

@section('manage.name', 'Q&A')

@section('menu.manage.faq', 'active')

@section('create_route', route('manage.faq.create'))

@section('thead')
    <tr>
        <td>ID</td>
        <td>Câu hỏi</td>
        <td>Thời gian tạo</td>
        <td>Cập nhật lần cuối</td>
        <td>Quản lý</td>
    </tr>
@endsection

@section('scripts')
    <script>
        var COLUMNS = [
            {data: 'id'},
            {data: 'question'},
            {data: 'created_at'},
            {data: 'updated_at'},
            {data: 'action', orderable: false, searchable: false}
        ]
    </script>
    @parent
@endsection