@extends('scaffold-interface.layouts.defaultMaterialize')
@section('title','Edit')
@section('content')

<div class = 'container'>
    <h1>
        Edit tag
    </h1>
    <form method = 'get' action = '{!!url("tag")!!}'>
        <button class = 'btn blue'>tag Index</button>
    </form>
    <br>
    <form method = 'POST' action = '{!! url("tag")!!}/{!!$tag->
        id!!}/update'> 
        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
        <div class="input-field col s6">
            <input id="name" name = "name" type="text" class="validate" value="{!!$tag->
            name!!}"> 
            <label for="name">name</label>
        </div>
        <button class = 'btn red' type ='submit'>Update</button>
    </form>
</div>
@endsection