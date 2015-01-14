@extends('layouts.master')

@section('sidebar')
    @include('test._sidebar')
@stop

@section('content')

@if(Session::has('message'))
<p class="alert">{{ Session::get('message') }}</p>
@endif
<div class="span6 well">
{{ Form::open(array('url'=>'user/login', 'class'=>'form-signin')) }}
<h2 class="form-signin-heading">Please Login</h2>

        {{ Form::text('username', null, array('class'=>'form-control', 'placeholder'=>'Email Address')) }}
        <br>
        {{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')) }}
        <br>
        {{ Form::submit('Login', array('class'=>'btn btn-large btn-primary '))}}
        <br>
        {{ Form::close() }}


</div>

 @stop