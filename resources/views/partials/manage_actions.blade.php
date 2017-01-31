@foreach($actions as $action)
    <a href="{!! $action['url'] !!}" class="btn btn-sm btn-outline {{$action['color']}}">
        <i class="fa fa-{{$action['icon']}}"></i>
        {{$action['name']}}
    </a>
@endforeach
