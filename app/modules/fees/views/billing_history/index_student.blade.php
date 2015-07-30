@extends('layouts.layout')
@section('top_menu')
    @include('layouts._top_menu')
@stop
@section('sidebar')
    @include('layouts._sidebar_amw')
@stop
@section('content')
    <div class="row" xmlns="http://www.w3.org/1999/html">
        <div class="col-md-12">
            <h3 class="text-blue text-uppercase">Student :: FEES History</h3>
        </div><!-- ./col -->
    </div><!-- /.row -->
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Student Fees History</a></li>
                </ul>

                <a href="{{ URL::route('billing-student')}}" class="btn-link pull-right"><i class="fa fa-backward text-aqua"></i> Student (Fees)</a>

                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">

                        {{--================= Filter :Starts ==========================--}}
                        <script>
                            $(document).ready(function(){
                                $(".the-legend").click(function(){
                                    $("#search-student-panel").hide();
                                });

                                $(".the-legend").click(function(){
                                    $("#search-student-panel").show();
                                });
                            });
                        </script>

                        {{Form::open(array('route'=> ['student-billing-history']))}}
                        <fieldset class="well the-fieldset">
                            <legend class="the-legend"> SEARCH </legend>
                            <div id="search-student-panel" style="display: none">
                                <div class="col-sm-12" >
                                    <div class="col-sm-4">
                                        {{ Form::label('department_id', 'Department') }}
                                        {{ Form::select('department_id',$department,Input::old('department_id'), array('class' => 'form-control') ) }}
                                    </div>
                                    <div class="col-sm-4">
                                        {{ Form::label('degree_id', 'Degree') }}
                                        {{ Form::select('degree_id',$degree,Input::old('degree_id'), array('class' => 'form-control') ) }}
                                    </div>
                                    <div class="col-sm-4">
                                        {{ Form::label('batch_id', 'Batch') }}
                                        {{ Form::select('batch_id',$batch, Input::old('batch_id'), array('class' => 'form-control')) }}
                                    </div>
                                </div>
                                <div class="col-lg-9 inline-textbox">
                                    <div class="form-inline">
                                        <div class="form-group ">
                                            <div class="col-lg-12">
                                                {{ Form::text('student_id',Input::old('student_id'), array('class'=>'search-tbox-style','placeholder'=>'Enter id')) }}
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <div class="col-lg-12">
                                                {{ Form::text('student_name',Input::old('student_name'), array('class'=>'search-tbox-style','placeholder'=>'Enter name')) }}
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <div class="col-lg-12" style="margin-top: 5px">
                                                {{ Form::submit('Filter', array('class'=>'btn btn-success','id'=>'button'))}}
                                                {{ Form::reset('Reset', ['class' => 'btn btn-default','id'=>'button']) }}
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        {{Form::close()}}
                        </fieldset>

                        {{--================= Filter :Ends ==========================--}}

                            <div class="box-body table-responsive ">
                                <table id="example" class="table table-bordered table-hover table-striped">
                                    <thead>
                                    <tr>
                                        <th>SL.No</th>
                                        <th>Student</th>
                                        <th>Schedule</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $sl=1;?>
                                    @if(isset($data))
                                        @foreach($data as $value)
                                            <tr>
                                                <td class="sl-no-size">{{$sl++}}</td>
                                                <td>{{isset($value->first_name) ? $value->first_name:''}} {{isset($value->last_name) ? $value->last_name:''}}</td>
                                                <td>{{isset($value->schedule_title) ? $value->schedule_title:''}}</td>
                                                <td>{{isset($value->amount) ? $value->amount : ''}}</td>
                                                <td>
                                                <a href="{{URL::route('billing.history.student.view',['id'=>$value->id])}}" class="btn btn-xs btn-default"data-toggle="modal"data-target="#showModal"><i class="fa fa-eye text-green"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                                <a href="{{ URL::route('student-billing-history')}}" class="btn-link pull-right"><i class="fa fa-backward text-red"></i> Back to All List</a>
                                </br>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal for show --}}
    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showingModal" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

            </div>
        </div>
    </div>

@stop
