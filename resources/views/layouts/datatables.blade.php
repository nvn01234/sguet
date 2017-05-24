@extends('layouts.page')

@section('page-level-plugins.styles')
    @parent
    {!! Html::style('metronic/global/plugins/datatables/datatables.min.css') !!}
    {!! Html::style('metronic/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') !!}
@endsection

@section('page-level-styles')
    @parent
    {!! Html::style('css/sguet/datatables.css') !!}
@endsection

@section('page-body')
    <div class="portlet light">
        <div class="portlet-body">
            @yield('table-toolbar')
            {!! $dataTable->table(['class' => 'table dataTable table-striped table-hover table-bordered']) !!}
        </div>
    </div>
@endsection

@section('page-level-plugins.scripts')
    @parent
    {!! Html::script('metronic/global/scripts/datatable.js') !!}
    {!! Html::script('metronic/global/plugins/datatables/datatables.min.js') !!}
    {!! Html::script('metronic/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') !!}
@endsection

@section('page-level-scripts')
    @parent
    {!! Html::script('js/sguet/datatables.js') !!}
    {!! $dataTable->scripts() !!}
@endsection