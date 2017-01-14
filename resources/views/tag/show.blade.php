@extends('scaffold-interface.layouts.defaultMaterialize')
@section('title','Show')
@section('content')

<div class = 'container'>
    <h1>
        Show tag
    </h1>
    <form method = 'get' action = '{!!url("tag")!!}'>
        <button class = 'btn blue'>tag Index</button>
    </form>
    <table class = 'highlight bordered'>
        <thead>
            <th>Key</th>
            <th>Value</th>
        </thead>
        <tbody>
            <tr>
                <td>
                    <b><i>name : </i></b>
                </td>
                <td>{!!$tag->name!!}</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection