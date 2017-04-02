@extends('layouts.single_portlet')

@section('menu.statistics', 'active')

@section('page_level_plugins.styles')
    @parent
    {!! Html::style('metronic/global/plugins/datatables/datatables.min.css') !!}
    {!! Html::style('metronic/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') !!}
@endsection

@section('styles')
    @parent
    {!! Html::style('css/manage.css') !!}
@endsection

@section('portlet-body')
    {!! $dataTable->table(['class' => 'table dataTable table-striped table-hover table-bordered']) !!}
@endsection

@section('page_level_plugins.scripts')
    @parent
    {!! Html::script('metronic/global/scripts/datatable.js') !!}
    {!! Html::script('metronic/global/plugins/datatables/datatables.min.js') !!}
    {!! Html::script('metronic/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') !!}
@endsection

@section('scripts')
    @parent
    {!! Html::script('js/datatable_config.js') !!}
    {!! $dataTable->scripts() !!}
@endsection