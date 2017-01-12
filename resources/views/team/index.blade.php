@extends('scaffold-interface.layouts.defaultMaterialize')
@section('title','Index')
@section('content')

<div class = 'container'>
    <h1>
        team Index
    </h1>
    <div class="row">
        <form class = 'col s3' method = 'get' action = '{!!url("team")!!}/create'>
            <button class = 'btn red' type = 'submit'>Create New team</button>
        </form>
    </div>
    <table>
        <thead>
            <th>name</th>
            <th>actions</th>
        </thead>
        <tbody>
            @foreach($teams as $team) 
            <tr>
                <td>{!!$team->name!!}</td>
                <td>
                    <div class = 'row'>
                        <a href = '#modal1' class = 'delete btn-floating modal-trigger red' data-link = "/team/{!!$team->id!!}/deleteMsg" ><i class = 'material-icons'>delete</i></a>
                        <a href = '#' class = 'viewEdit btn-floating blue' data-link = '/team/{!!$team->id!!}/edit'><i class = 'material-icons'>edit</i></a>
                        <a href = '#' class = 'viewShow btn-floating orange' data-link = '/team/{!!$team->id!!}'><i class = 'material-icons'>info</i></a>
                    </div>
                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>
    {!! $teams->render() !!}

</div>
@endsection