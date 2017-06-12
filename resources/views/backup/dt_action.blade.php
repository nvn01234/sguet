<a href="{{route('manage.backup.download', $file->name)}}" class="btn btn-sm green">
    <i class="fa fa-download"></i> Tải xuống
</a>
<a class="btn btn-sm red" href="javascript:" onclick="bootbox.deleteDialog({}, '{{route('manage.backup.delete', $file->name)}}')">
    <i class="fa fa-trash"></i> Xoá
</a>
