@if(Auth::user()->roleLevel() < $user->roleLevel())
    <button class="btn btn-sm btn-outline green" type="button" disabled>
        <i class="fa fa-edit"></i>Sửa
    </button>
    <button class="btn btn-sm btn-outline red" type="button" disabled>
        <i class="fa fa-trash-o"></i> Xoá
    </button>
@else
    <a href="{!! route('manage.user.edit', ['id' => $user->id]) !!}" class="btn btn-sm btn-outline green">
        <i class="fa fa-edit"></i>Sửa
    </a>
    <a href="{!! route('manage.user.delete', ['id' => $user->id]) !!}" class="btn btn-sm btn-outline red">
        <i class="fa fa-trash-o"></i> Xoá
    </a>
@endif
