@permission('manage-content')
<a href="{{route('manage.faq.edit', $faq->id)}}"
   class="btn btn-sm green edit-btn">
    <i class="fa fa-edit"></i>Sửa
</a>
<a href="{{route('manage.faq.delete', $faq->id)}}"
   class="btn btn-sm red delete-btn">
    <i class="fa fa-trash-o"></i> Xoá
</a>
@endpermission