@extends('scaffold-interface.layouts.defaultMaterialize')
@section('title','Create')
@section('content')

<div class = 'container'>
    <h1>
        Create tag
    </h1>
    <form method = 'get' action = '{!!url("tag")!!}'>
        <button class = 'btn blue'>tag Index</button>
    </form>
    <br>
    <form method = 'POST' action = '{!!url("tag")!!}'>
        <input type = 'hidden' name = '_token' value = '{{ Session::token() }}'>
        <div class="input-field col s6">
            <input id="name" name = "name" type="text" class="validate">
            <label for="name">name</label>
        </div>
        <button class = 'btn red' type ='submit'>Create</button>
    </form>
</div>
@endsection