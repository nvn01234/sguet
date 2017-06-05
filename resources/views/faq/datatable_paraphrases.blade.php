@foreach($paraphrases as $string)
    <a href="javascript:" class="tooltips" data-original-title="{{$string}}" style="display: inline-block; margin-top: 2.5px; margin-bottom: 2.5px">
        <span class="label label-info">{{str_limit($string, 40)}}</span>
    </a>
@endforeach