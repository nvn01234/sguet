@extends('scaffold-interface.layouts.defaultMaterialize')
@section('title','Show')
@section('content')

<div class = 'container'>
    <h1>
        Show article
    </h1>
    <form method = 'get' action = '{!!url("article")!!}'>
        <button class = 'btn blue'>article Index</button>
    </form>
    <table class = 'highlight bordered'>
        <thead>
            <th>Key</th>
            <th>Value</th>
        </thead>
        <tbody>
            <tr>
                <td>
                    <b><i>title : </i></b>
                </td>
                <td>{!!$article->title!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>content : </i></b>
                </td>
                <td>{!!$article->content!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>image_url : </i></b>
                </td>
                <td>{!!$article->image_url!!}</td>
            </tr>
            <tr>
                <td>
                    <b><i>short_description : </i></b>
                </td>
                <td>{!!$article->short_description!!}</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection