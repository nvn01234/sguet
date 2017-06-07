{{ Html::script('js/sguet/toastr.js') }}
@if (session()->has('toastr'))
    <script async>
        @foreach(session('toastr') as $toastr)
            @toastr($toastr)
        @endforeach
    </script>
@endif