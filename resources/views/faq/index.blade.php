@php
    $thead_map = [
        ['data' => 'id', 'name' => 'ID'],
        ['data' => 'question', 'name' => 'Câu hỏi'],
        ['data' => 'created_at', 'name' => 'Thời gian tạo'],
        ['data' => 'updated_at', 'name' => 'Cập nhật lần cuối'],
        ['data' => 'action', 'name' => 'Quản lý', 'orderable' => false, 'searchable' => false]
    ]
@endphp

@extends('layouts.manage', compact('thead_map'))

@section('manage.name', 'Q&A')

@section('menu.manage.faq', 'active')

@section('create_route', route('manage.faq.create'))
