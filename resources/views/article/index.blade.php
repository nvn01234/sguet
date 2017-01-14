@extends('scaffold-interface.layouts.defaultMaterialize')
@section('title','Index')
@section('content')

<div class = 'container'>
    <h1>
        article Index
    </h1>
    <div class="row">
        <form class = 'col s3' method = 'get' action = '{!!url("article")!!}/create'>
            <button class = 'btn red' type = 'submit'>Create New article</button>
        </form>
    </div>
    <table>
        <thead>
            <th>title</th>
            <th>content</th>
            <th>image_url</th>
            <th>short_description</th>
            <th>actions</th>
        </thead>
        <tbody>
            @foreach($articles as $article) 
            <tr>
                <td>{!!$article->title!!}</td>
                <td>{!!$article->content!!}</td>
                <td>{!!$article->image_url!!}</td>
                <td>{!!$article->short_description!!}</td>
                <td>
                    <div class = 'row'>
                        <a href = '#modal1' class = 'delete btn-floating modal-trigger red' data-link = "/article/{!!$article->id!!}/deleteMsg" ><i class = 'material-icons'>delete</i></a>
                        <a href = '#' class = 'viewEdit btn-floating blue' data-link = '/article/{!!$article->id!!}/edit'><i class = 'material-icons'>edit</i></a>
                        <a href = '#' class = 'viewShow btn-floating orange' data-link = '/article/{!!$article->id!!}'><i class = 'material-icons'>info</i></a>
                    </div>
                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>
    {!! $articles->render() !!}

</div>
@endsection