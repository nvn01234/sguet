@if($category)
    @if($category->id == 1)
        <span class="label label-info">{{$category->name}}</span>
    @else
        <span class="label label-success">{{$category->name}}</span>
    @endif
@endif