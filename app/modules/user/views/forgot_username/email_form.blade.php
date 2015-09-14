@extends('layouts.layout')
@section('top_menu')
    @include('layouts._top_menu')
@stop
@section('sidebar')
    @include('layouts._sidebar_public')
@stop
@section('content')
    <div class="box-body">
        <div class="row">
            <div class="col-lg-6"  style="margin-left: 15%">
                <div class="box box-warning">
                    <div class="box-body">
                        <p class="text">Forgot UserName ?</p>
                        {{ Form::open(array('url'=>'user/username_reminder_mail', 'class'=>'form-signin')) }}
                        {{ Form::label('email','Email Address') }}
                        {{ Form::text('email', null, array('class'=>'form-control', 'placeholder'=>'Email Address','required')) }}
                        <p>&nbsp;</p>
                        {{ Form::submit('Submit', array('class'=>'pull-right btn btn-sm btn-primary'))}}
                        <br>
                        {{ Form::close() }}
                        <p>&nbsp;</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop