@php
    $thead_map = [
        ['data' => 'id', 'name' => 'ID'],
        ['data' => 'title', 'name' => 'Tiêu đề'],
        ['data' => 'short_description', 'name' => 'Mô tả'],
        ['data' => 'created_at', 'name' => 'Thời gian tạo'],
        ['data' => 'updated_at', 'name' => 'Cập nhật lần cuối'],
    ]
@endphp

@extends('layouts.manage', ['thead_map' => $thead_map])

@section('manage.name', 'Q&A')

@section('menu.manage.faq', 'active')

@section('manage.api-datatable', route('api.faq.datatable'))
