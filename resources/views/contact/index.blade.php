@extends('layouts.page')

@section('page-breadcrumb')
    <li>
        @if(Route::currentRouteNamed('manage.contact'))
            <a href="javascript:" class="sidebar-toggler menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">Quản lý</a>
        @else
            <a href="{{route('home')}}">Trang chủ</a>
        @endif
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <span>Danh bạ</span>
    </li>
@endsection

@section('page-title', 'Danh bạ Trường Đại học Công nghệ')

@section('page-level-plugins.styles')
    @parent
    {!! Html::style('metronic/global/plugins/jstree/dist/themes/default/style.min.css') !!}
    {!! Html::style('metronic/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') !!}
    {!! Html::style('css/jstreegrid.css') !!}
@endsection

@section('page-body')
    <div class="portlet light">
        <div class="portlet-body">
            <div class="table-toolbar">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet-input input-inline input-small">
                            <div class="input-icon right" style="min-width: 300px">
                                <i class="fa fa-spin fa-spinner"></i>
                                <input type="text" class="form-control" placeholder="Đang tải..."
                                       id="search" disabled></div>
                        </div>
                        @if(Auth::check())
                            <div class="btn-group pull-right" id="manage">
                                <a class="btn btn-default " href="javascript:;" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-cog"></i> Quản lý
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li>
                                        <a href="javascript:" id="upload">
                                            <i class="fa fa-upload"></i> Tải lên </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <i class="fa fa-download"></i> Tải xuống </a>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div id="tree" class="jstree jstree-default"></div>
            @if(Auth::check())
                <div id="bootbox-content" hidden>
                    {!! Form::open(['method' => 'post', 'route' => 'manage.contact.upload', 'class' => 'form', 'role' => 'form', 'enctype' =>"multipart/form-data"]) !!}
                    <div class="form-body">
                        <div class="form-group">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="input-group input-large">
                                    <div class="form-control uneditable-input input-fixed input-medium"
                                         data-trigger="fileinput">
                                        <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                        <span class="fileinput-filename"> </span>
                                    </div>
                                    <span class="input-group-addon btn default btn-file">
                                        <span class="fileinput-new"> Chọn </span>
                                        <span class="fileinput-exists"> Đổi </span>
                                        <input type="file" name="file" required="required"
                                               accept="application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                                </span>
                                    <a href="javascript:;" class="input-group-addon btn red fileinput-exists"
                                       data-dismiss="fileinput"> Xoá </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions" style="background-color: transparent">
                        <button type="submit" class="btn blue">Tải lên</button>
                        <button type="button" class="bootbox-close-button btn default">Đóng</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            @endif
        </div>
    </div>
@endsection

@section('page-level-plugins.scripts')
    @parent
    @if(Route::currentRouteNamed('manage.contact'))
        {!! Html::script('metronic/global/plugins/jquery.pulsate.min.js') !!}
        <script async>
            Scroll('manage').toVisible();
            $('#manage').pulsate({
                color: "#399bc3",
                repeat: 3
            })
        </script>
    @endif
    {!! Html::script('metronic/global/plugins/jstree/dist/jstree.min.js') !!}
    {!! Html::script('js/jstreegrid.js') !!}
    {!! Html::script('metronic/global/plugins/bootbox/bootbox.min.js') !!}
    {!! Html::script('metronic/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') !!}
@endsection

@section('page-level-scripts')
    @parent
    <script>
        function onError(ex) {
            toastr['error']('Vui lòng tải lại trang', 'Đã có lỗi xảy ra');
            // $('html').html(ex.responseText);
        }

        $(function () {
            var tree = $('#tree');
            var search = $('#search');

            tree
                .on('search.jstree', function (e, data) {
                    if (data.nodes.length > 0) {
                        var first = data.nodes[0];
                        Scroll(first.id).toVisible();
                    }
                })
                .on('ready.jstree', function () {
                    search.attr('placeholder', 'Tên/chức vụ').attr('disabled', null);
                    search.prev().removeClass('fa fa-spin fa-spinner').addClass('icon-magnifier');
                    $('.tooltips').tooltip();
                })
                .jstree({
                    plugins: ["grid"],
                    grid: {
                        columns: [
                            {header: "Tên", width: "50%"},
                            {header: "CQ", value: "phone_cq", width: "10%"},
                            {header: "NR", value: "phone_nr", width: "10%"},
                            {header: "DĐ", value: "phone_dd", width: "10%"},
                            {header: "Fax", value: "fax", width: "10%"},
                            {header: "Email", value: "email", width: "10%"}
                        ]
                    },
                    core: {
                        strings: {
                            'Loading ...': 'Đang tải ...'
                        },
                        check_callback: true,
                        expand_selected_onload: true,
                        multiple: true,
                        force_text: true,
                        dblclick_toggle: true,
                        themes: {
                            variant: "large",
                            dots: true,
                            icons: false,
                            responsive: true
                        },
                        data: {
                            url: function (node) {
                                return node.id === '#' ? '{{route('api.contacts.roots')}}' : '{{route('api.contacts.children', '_ID_')}}'.replace('_ID_', node.id);
                            },
                            data: function (node) {
                                return '{{route('api.contacts.show', '_ID_')}}'.replace('_ID_', node.id);
                            }
                        }
                    }
                });

            search.keyup(function (e) {
                const code = e.which | e.code;
                if (code === 13) {
                    doSearch(search.val());
                }
            });
        });

        function doSearch(q) {
            var searchDialog = bootbox.dialog({
                message: '<p><i class="fa fa-spin fa-spinner"></i> Đang tìm kiếm...</p>',
                closeButton: false
            });
            var show_all = function (inst) {
                inst.show_all();
                $('.jstree-grid-cell').removeClass('jstree-hidden');
                $('.tooltips').tooltip();
            };
            if (q.trim() === '') {
                const inst = $.jstree.reference(tree);
                show_all(inst);
                searchDialog.modal('hide');
            } else {
                $.ajax({
                    url: "{{route('api.contacts.search')}}?q=" + q.trim(),
                    method: 'GET',
                    success: function (response) {
                        var inst = $.jstree.reference(tree);
                        var opened = response.opened;
                        var hidden = response.hidden;
                        var result = response.result;
                        console.log(result);
                        show_all(inst);
                        var callback = function () {
                            hidden.forEach(function (id) {
                                $('#' + id).addClass('jstree-hidden');
                                $('.jstree-grid-cell[data-jstreegrid="' + id + '"]').addClass('jstree-hidden');
                            });
                            if (result.length > 0) {
                                result.forEach(function (id) {
                                    $('#' + id + '_anchor').addClass('jstree-search');
                                });
                            } else {
                                toastr['warning']('Rất tiếc chúng tôi không tìm thấy tên bạn cần tìm', 'Không có kết quả');
                            }
                            searchDialog.modal('hide');
                            $('.tooltips').tooltip();
                        };
                        if (opened.length > 0) {
                            const recursive = function () {
                                opened = opened.splice(1);
                                if (opened.length > 0) {
                                    inst.open_node(opened[0] + '', recursive);
                                } else {
                                    callback();
                                }
                            };
                            inst.open_node(opened[0] + '', recursive);
                        } else {
                            callback();
                        }
                    },
                    error: onError
                })
            }
        }
    </script>
    @if(Auth::check())
        <script>
            var bootbox_content = $('#bootbox-content');
            var bootbox_message = bootbox_content.html();
            bootbox_content.remove();
            $('#upload').click(function () {
                var uploadDialog = bootbox.dialog({
                    title: 'Tải lên danh bạ',
                    message: bootbox_message
                });
                uploadDialog.find('form').submit(function() {
                    uploadDialog.modal('hide');
                    bootbox.dialog({
                        message: '<p><i class="fa fa-spin fa-spinner"></i> Đang tải lên...</p>',
                        closeButton: false
                    });
                })
            });
        </script>
    @endif
@endsection