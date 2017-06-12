@extends('layouts.page')

@section('page-breadcrumb')
    <li>
        @if(Route::currentRouteNamed('manage.contact'))
            <a href="javascript:" class="sidebar-toggler menu-toggler responsive-toggler" data-toggle="collapse"
               data-target=".navbar-collapse">Quản lý</a>
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
@endsection

@section('page-body')
    <div class="alert alert-info alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
        <strong>Hướng dẫn: </strong> Chọn một cá nhân/đơn vị để xem thông tin chi tiết. @permission('manage-content') Chuột phải để truy cập các chức năng quản lý. @endpermission
    </div>
    <div class="portlet light">
        <div class="portlet-body">
            <div class="table-toolbar">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet-input input-inline input-small">
                            <div class="input-icon right" style="min-width: 300px">
                                <i class="fa fa-search"></i>
                                <input type="text" class="form-control" placeholder="Tìm kiếm..."
                                       id="search"></div>
                        </div>
                        @permission('manage-content')
                        <div class="btn-group pull-right" id="manage">
                            <a class="btn btn-default " href="javascript:;" data-toggle="dropdown"
                               aria-expanded="false">
                                <i class="fa fa-cog"></i> Quản lý
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li>
                                    <a href="{{route('manage.contact.create')}}">
                                        <i class="fa fa-plus"></i> Thêm liên hệ </a>
                                </li>
                                <li>
                                    <a href="javascript:" id="upload">
                                        <i class="fa fa-upload"></i> Tải lên </a>
                                </li>
                                <li>
                                    <a href="{{route('manage.contact.export')}}" target="_blank">
                                        <i class="fa fa-download"></i> Tải xuống </a>
                                </li>
                            </ul>
                        </div>
                        @endpermission
                    </div>
                </div>
            </div>
            <div class="alert alert-info" id="alert-loading">
                <i class="fa fa-spin fa-spinner"></i> Danh bạ vẫn đang tải. Tìm kiếm hiện giờ có thể không chính xác.
            </div>
            <div id="tree" class="jstree jstree-default"></div>
        </div>
    </div>

    @permission('manage-content')
    <div id="upload-dialog" hidden>
        {!! Form::open(['method' => 'post', 'route' => 'manage.contact.upload', 'class' => 'form', 'role' => 'form', 'enctype' =>"multipart/form-data"]) !!}
        <div class="form-body">
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <strong>Chú ý: </strong> Nên <a href="{{route('manage.contact.export')}}" target="_blank" class="alert-link">tải về danh bạ</a> để xem cấu trúc file mẫu.
            </div>
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
    @endpermission
@endsection

@section('page-level-plugins.scripts')
    @parent
    {!! Html::script('metronic/global/plugins/jstree/dist/jstree.min.js') !!}
    {!! Html::script('metronic/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') !!}
@endsection

@section('page-level-scripts')
    @parent
    <script>
        $(function () {
            $('#tree').on('ready.jstree', function () {
                $('#alert-loading').slideUp();
            }).on('select_node.jstree', function(e, data) {
                bootbox.detailDialog({id: data.node.id}, '{{route('contact.detail')}}');
            }).jstree({
                plugins: ["search", "wholerow", @permission('manage-content') "contextmenu", @endpermission],
                core: {
                    strings: {
                        'Loading ...': '<i class="fa fa-spin fa-spinner"></i> Đang tải ...'
                    },
                    check_callback: true,
                    expand_selected_onload: true,
                    multiple: false,
                    force_text: true,
                    dblclick_toggle: true,
                    themes: {
                        variant: 'large',
                        dots: true,
                        icons: false
                    },
                    data: {
                        url: function (node) {
                            return node.id === '#' ? '{{route('api.contacts.roots')}}' : ('{{route('api.contacts.children')}}?id=' + node.id);
                        },
                        data: function (node) {
                            return '{{route('api.contacts.data')}}?id=' + node.id;
                        }
                    }
                },
                search: {
                    show_only_matches: true,
                    close_opened_onclear: false
                },
                @permission('manage-content')
                contextmenu: {
                    select_node: false,
                    items: function (node) {
                        var tree = $('#tree').jstree(true);
                        return {
                            create: {
                                label: "Thêm cá nhân/đơn vị trực thuộc",
                                icon: 'fa fa-plus',
                                action: function () {
                                    window.location = '{{route('manage.contact.create')}}?parent_id=' + node.id;
                                }
                            },
                            edit: {
                                label: "Sửa thông tin",
                                icon: 'fa fa-edit',
                                action: function() {
                                    window.location = '{{route('manage.contact.edit')}}?id=' + node.id
                                }
                            },
                            remove: {
                                label: "Xoá",
                                icon: 'fa fa-trash-o',
                                action: function() {
                                    bootbox.deleteDialog({id: node.id}, '{{route('manage.contact.delete')}}', {
                                        message: "Bạn có chắc chắn muốn xoá liên hệ này và các cá nhân/đơn vị trực thuộc nó?",
                                        callback: function() {
                                            toastr['success']('', 'Xoá liên hệ thành công');
                                            tree.delete_node(node);
                                        }
                                    })
                                }
                            }
                        }
                    }
                }
                @endpermission
            });

            var to = false;
            $('#search').keyup(function () {
                if (to) {
                    clearTimeout(to);
                }
                to = setTimeout(function () {
                    var v = $('#search').val();
                    $('#tree').jstree(true).search(v);
                }, 250);
            });

            @permission('manage-content')
            var uploadDialogHtml = $('#upload-dialog').getHtmlAndRemove();
            $('#upload').click(function () {
                var uploadDialog = bootbox.dialog({
                    title: 'Tải lên danh bạ',
                    message: uploadDialogHtml
                });
                uploadDialog.find('form').submit(function () {
                    uploadDialog.modal('hide');
                    bootbox.dialog({
                        message: '<p><i class="fa fa-spin fa-spinner"></i> Đang tải lên...</p>',
                        closeButton: false
                    });
                })
            });
            @endpermission
        });
    </script>
@endsection