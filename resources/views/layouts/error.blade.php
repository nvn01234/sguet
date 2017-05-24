@extends('layouts.page')

@section('page-level-styles')
    @parent
    {!! Html::style('metronic/pages/css/error.min.css') !!}
@endsection

@section('page-body')
    <div class="row">
        <div class="col-md-12 page-404">
            <div class="number font-@yield('color','red')">@yield('code')</div>
            <div class="details">
                <h3>@yield('heading')</h3>
                <p>@yield('description')</p>
                <div class="input-group input-medium">
                    <span class="input-group-btn">
                        <a href="{{URL::route('home')}}" class="btn btn @yield('color', 'red')">
                            <i class="fa fa-arrow-left"></i>
                            Trang chủ
                        </a>
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection