<a href="{{route('manage.backup.download', $file->name)}}" class="btn btn-sm green">
    <i class="fa fa-download"></i> Tải xuống
</a>
{{Form::open(['method' => 'post', 'route' => 'manage.backup.delete', 'style' => 'display: inline;'])}}
{{Form::hidden('file_name', $file->name)}}
<button class="btn btn-sm red" type="submit">
    <i class="fa fa-trash"></i> Xoá
</button>
{{Form::close()}}