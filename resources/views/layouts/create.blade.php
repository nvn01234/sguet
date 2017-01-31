@extends('layouts.single_portlet')

@section('title')
    Thêm mới @yield('create.name')
@endsection

@section('portlet-body')
    {!! Form::open(['method' => 'post', 'route' => isset($route) ? $route : null, 'role' => 'form', 'class' => 'form-horizontal']) !!}
    <div class="form-body">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('form-body')
    </div>
    <div class="form-actions">
        <div class="row">
            <div class="col-md-offset-2 col-md-10">
                {!! Form::submit(isset($button) ? $button : 'Tạo', ['class' => 'btn blue']) !!}
                @yield('form-actions')
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection