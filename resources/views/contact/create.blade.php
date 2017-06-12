@extends('layouts.page')

@section('page-title', 'Thêm liên hệ')
@section('page-breadcrumb')
    <li>
        <a href="javascript:" class="sidebar-toggler menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">Quản lý</a>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <a href="{{route('manage.contact')}}" >Danh bạ</a>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <span>Thêm liên hệ</span>
    </li>
@endsection

@section('page-level-plugins.styles')
    @parent
    {{Html::style('metronic/global/plugins/select2/css/select2.min.css')}}
    {{Html::style('metronic/global/plugins/select2/css/select2-bootstrap.min.css')}}
@endsection

@section('page-body')
    <div class="portlet light">
        <div class="portlet-body form">
            {!! Form::open(['method' => 'post', 'role' => 'form', 'class' => 'form-horizontal', 'route' => 'manage.contact.store']) !!}
            <div class="form-body">

                <div class="form-group form-md-line-input @if($errors->has('name')) has-error @endif">
                    {!! Form::label('name', 'Tên <span class="required">*</span>', ['class' => 'col-md-2 control-label'], false) !!}
                    <div class="col-md-10">
                        {!! Form::text('name', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Tên', 'autofocus' => true, 'maxlength' => 255]) !!}
                        <div class="form-control-focus"></div>
                        <span class="help-block {{$errors->has('name') ? 'help-block-error' : ''}}">{{$errors->first('name')}}</span>
                    </div>
                </div>

                <div class="form-group form-md-line-input @if($errors->has('description')) has-error @endif">
                    {!! Form::label('description', 'Chức vụ', ['class' => 'col-md-2 control-label']) !!}
                    <div class="col-md-10">
                        {!! Form::text('description', null, ['class' => 'form-control','placeholder' => 'Chức vụ','maxlength' => 255]) !!}
                        <div class="form-control-focus"></div>
                        <span class="help-block {{$errors->has('description') ? 'help-block-error' : ''}}">{{$errors->first('description')}}</span>
                    </div>
                </div>

                <div class="form-group form-md-line-input @if($errors->has('parent_id')) has-error @endif">
                    {!! Form::label('parent_id', 'Thuộc đơn vị', ['class' => 'col-md-2 control-label']) !!}
                    <div class="col-md-10">
                        {!! Form::select('parent_id', $contacts, null, ['class' => 'form-control', 'placeholder' => 'Chọn đơn vị']) !!}
                        <div class="form-control-focus"></div>
                        <span class="help-block help-block-info">Không thuộc đơn vị nào thì để trống</span>
                        <span class="help-block {{$errors->has('parent_id') ? 'help-block-error' : ''}}">{{$errors->first('parent_id')}}</span>
                    </div>
                </div>

                <div class="form-group form-md-line-input @if($errors->has('phone_nr')) has-error @endif">
                    {!! Form::label('phone_nr', 'SĐT nhà riêng', ['class' => 'col-md-2 control-label']) !!}
                    <div class="col-md-10">
                        {!! Form::text('phone_nr', null, ['class' => 'form-control', 'placeholder' => 'SĐT nhà riêng', 'maxlength' => 255]) !!}
                        <div class="form-control-focus"></div>
                        <span class="help-block {{$errors->has('phone_nr') ? 'help-block-error' : ''}}">{{$errors->first('phone_nr')}}</span>
                    </div>
                </div>

                <div class="form-group form-md-line-input @if($errors->has('phone_cq')) has-error @endif">
                    {!! Form::label('phone_cq', 'SĐT cơ quan', ['class' => 'col-md-2 control-label']) !!}
                    <div class="col-md-10">
                        {!! Form::text('phone_cq', null, ['class' => 'form-control', 'placeholder' => 'SĐT cơ quan', 'maxlength' => 255]) !!}
                        <div class="form-control-focus"></div>
                        <span class="help-block {{$errors->has('phone_cq') ? 'help-block-error' : ''}}">{{$errors->first('phone_cq')}}</span>
                    </div>
                </div>

                <div class="form-group form-md-line-input @if($errors->has('phone_dd')) has-error @endif">
                    {!! Form::label('phone_dd', 'SĐT di động', ['class' => 'col-md-2 control-label']) !!}
                    <div class="col-md-10">
                        {!! Form::text('phone_dd', null, ['class' => 'form-control', 'placeholder' => 'SĐT di động', 'maxlength' => 255]) !!}
                        <div class="form-control-focus"></div>
                        <span class="help-block {{$errors->has('phone_dd') ? 'help-block-error' : ''}}">{{$errors->first('phone_dd')}}</span>
                    </div>
                </div>

                <div class="form-group form-md-line-input @if($errors->has('fax')) has-error @endif">
                    {!! Form::label('fax', 'Fax', ['class' => 'col-md-2 control-label']) !!}
                    <div class="col-md-10">
                        {!! Form::text('fax', null, ['class' => 'form-control', 'placeholder' => 'Fax', 'maxlength' => 255]) !!}
                        <div class="form-control-focus"></div>
                        <span class="help-block {{$errors->has('fax') ? 'help-block-error' : ''}}">{{$errors->first('fax')}}</span>
                    </div>
                </div>

                <div class="form-group form-md-line-input @if($errors->has('email')) has-error @endif">
                    {!! Form::label('email', 'Email', ['class' => 'col-md-2 control-label']) !!}
                    <div class="col-md-10">
                        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email', 'maxlength' => 255]) !!}
                        <div class="form-control-focus"></div>
                        <span class="help-block {{$errors->has('email') ? 'help-block-error' : ''}}">{{$errors->first('email')}}</span>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-10 col-md-offset-2">
                        <button type="submit" class="btn blue">
                            Thêm liên hệ
                        </button>
                    </div>
                </div>
            </div>
            {{Form::close()}}
        </div>
    </div>
@endsection

@section('page-level-plugins.scripts')
    @parent
    {{Html::script('metronic/global/plugins/select2/js/select2.full.min.js')}}
    {{Html::script('metronic/global/plugins/select2/js/i18n/vi.js')}}
@endsection

@section('page-level-scripts')
    @parent
    <script>
        window.Laravel.$apiContactsSearch = '{{route('api.contacts.search')}}';
    </script>
    {{Html::script('js/sguet/create-edit-contact.js')}}
@endsection