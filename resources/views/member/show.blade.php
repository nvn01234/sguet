@extends('scaffold-interface.layouts.defaultMaterialize')
@section('title','Show')
@section('content')

<div class = 'container'>
    <h1>
        Show member
    </h1>
    <form method = 'get' action = '{!!url("member")!!}'>
        <button class = 'btn blue'>member Index</button>
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
                <td>{!!$member->name!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>avatar_url : </i></b>
                </td>
                <td>{!!$member->avatar_url!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>class : </i></b>
                </td>
                <td>{!!$member->class!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>joined_date : </i></b>
                </td>
                <td>{!!$member->joined_date!!}</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection