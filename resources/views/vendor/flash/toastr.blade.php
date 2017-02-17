<script type="text/javascript">
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "positionClass": "toast-top-right",
        "onclick": null,
        "showDuration": "1000",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
</script>

@if (session()->has('toastr'))
    @foreach(session('toastr') as $toastr)
        @php
            if(!isset($toastr['level'])) $toastr['level'] = 'info';
            if(!isset($toastr['title'])) $toastr['title'] = $toast['level'];
            if(!isset($toastr['message'])) $toastr['message'] = '';
        @endphp
        <script async type="text/javascript">
            toastr['{{$toastr['level']}}']('{{$toastr['message']}}', '{{$toastr['title']}}');
        </script>
    @endforeach
@endif