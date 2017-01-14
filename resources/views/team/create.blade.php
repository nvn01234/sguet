@extends('scaffold-interface.layouts.defaultMaterialize')
@section('title','Create')
@section('content')

<div class = 'container'>
    <h1>
        Create team
    </h1>
    <form method = 'get' action = '{!!url("team")!!}'>
        <button class = 'btn blue'>team Index</button>
    </form>
    <br>
    <form method = 'POST' action = '{!!url("team")!!}'>
        <input type = 'hidden' name = '_token' value = '{{ Session::token() }}'>
        <div class="input-field col s6">
            <input id="name" name = "name" type="text" class="validate">
            <label for="name">name</label>
        </div>
        <button class = 'btn red' type ='submit'>Create</button>
    </form>
</div>
@endsection