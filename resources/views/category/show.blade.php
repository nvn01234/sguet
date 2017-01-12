@extends('scaffold-interface.layouts.defaultMaterialize')
@section('title','Show')
@section('content')

<div class = 'container'>
    <h1>
        Show category
    </h1>
    <form method = 'get' action = '{!!url("category")!!}'>
        <button class = 'btn blue'>category Index</button>
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
                <td>{!!$category->name!!}</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection