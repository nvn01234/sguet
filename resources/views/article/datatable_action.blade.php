<a href="{!! route('manage.article.edit', ['id' => $article->id]) !!}" class="btn btn-sm btn-outline green">
    <i class="fa fa-edit"></i>Sửa
</a>
<a href="{!! route('manage.article.delete', ['id' => $article->id]) !!}" class="btn btn-sm btn-outline red">
    <i class="fa fa-trash-o"></i> Xoá
</a>