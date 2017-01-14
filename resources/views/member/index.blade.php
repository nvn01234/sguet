@extends('scaffold-interface.layouts.defaultMaterialize')
@section('title','Index')
@section('content')

<div class = 'container'>
    <h1>
        member Index
    </h1>
    <div class="row">
        <form class = 'col s3' method = 'get' action = '{!!url("member")!!}/create'>
            <button class = 'btn red' type = 'submit'>Create New member</button>
        </form>
    </div>
    <table>
        <thead>
            <th>name</th>
            <th>avatar_url</th>
            <th>class</th>
            <th>joined_date</th>
            <th>actions</th>
        </thead>
        <tbody>
            @foreach($members as $member) 
            <tr>
                <td>{!!$member->name!!}</td>
                <td>{!!$member->avatar_url!!}</td>
                <td>{!!$member->class!!}</td>
                <td>{!!$member->joined_date!!}</td>
                <td>
                    <div class = 'row'>
                        <a href = '#modal1' class = 'delete btn-floating modal-trigger red' data-link = "/member/{!!$member->id!!}/deleteMsg" ><i class = 'material-icons'>delete</i></a>
                        <a href = '#' class = 'viewEdit btn-floating blue' data-link = '/member/{!!$member->id!!}/edit'><i class = 'material-icons'>edit</i></a>
                        <a href = '#' class = 'viewShow btn-floating orange' data-link = '/member/{!!$member->id!!}'><i class = 'material-icons'>info</i></a>
                    </div>
                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>
    {!! $members->render() !!}

</div>
@endsection