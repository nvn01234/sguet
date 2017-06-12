@permission('manage-content')
<a href="{{route('manage.contact.edit', ['id' => $contact->id])}}"
   class="btn btn-sm green edit-btn">
    <i class="fa fa-edit"></i>Sửa
</a>
<a href="javascript:" onclick="bootbox.deleteDialog({id: parseInt('{{$contact->id}}'), redirect: 1}, '{{route('manage.contact.delete')}}')"
   class="btn btn-sm red delete-btn">
    <i class="fa fa-trash-o"></i> Xoá
</a>
@endpermission