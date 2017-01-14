@extends('scaffold-interface.layouts.defaultMaterialize')
@section('title','Create')
@section('content')

<div class = 'container'>
    <h1>
        Create member
    </h1>
    <form method = 'get' action = '{!!url("member")!!}'>
        <button class = 'btn blue'>member Index</button>
    </form>
    <br>
    <form method = 'POST' action = '{!!url("member")!!}'>
        <input type = 'hidden' name = '_token' value = '{{ Session::token() }}'>
        <div class="input-field col s6">
            <input id="name" name = "name" type="text" class="validate">
            <label for="name">name</label>
        </div>
        <div class="input-field col s6">
            <input id="avatar_url" name = "avatar_url" type="text" class="validate">
            <label for="avatar_url">avatar_url</label>
        </div>
        <div class="input-field col s6">
            <input id="class" name = "class" type="text" class="validate">
            <label for="class">class</label>
        </div>
        <div class="input-field col s6">
            <input id="joined_date" name = "joined_date" type="text" class="validate">
            <label for="joined_date">joined_date</label>
        </div>
        <button class = 'btn red' type ='submit'>Create</button>
    </form>
</div>
@endsection