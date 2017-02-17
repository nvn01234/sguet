<a href="{!! route('manage.user.edit', ['id' => $user->id]) !!}" class="btn btn-sm btn-outline green">
    <i class="fa fa-edit"></i>Sửa
</a>
<a href="{!! route('manage.user.delete', ['id' => $user->id]) !!}" class="btn btn-sm btn-outline red">
    <i class="fa fa-trash-o"></i> Xoá
</a>