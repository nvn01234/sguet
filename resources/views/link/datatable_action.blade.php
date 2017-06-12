<a href="{!! route('manage.links.edit', $link->id) !!}" class="btn btn-sm btn-outline green">
    <i class="fa fa-edit"></i>Sửa
</a>
<a href="javascript:" class="btn btn-sm btn-outline red" onclick="bootbox.deleteDialog({}, '{!! route('manage.links.delete', $link->id) !!}')">
    <i class="fa fa-trash-o"></i> Xoá
</a>