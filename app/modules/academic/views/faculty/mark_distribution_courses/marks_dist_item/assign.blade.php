@extends('layouts.layout')
@section('sidebar')
    @include('academic::_sidebar')
@stop
@section('content')
<h2 class="page-header text-purple tab-text-margin">Assign of {{isset($acm->title) ? $acm->title : ''}} to Student</h2>
<div class="row">
    <div class="col-md-12">
        <!-- Custom Tabs -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab">Student List to Assign</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        Settings  <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li role="presentation" data-toggle="modal" data-target="#addCategory"><a role="menuitem" tabindex="-1" href="#"> </a></li>
                    </ul>
                </li>
                <li class="pull-right" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-gear"></i>&nbsp;</a>
                    <ul class="dropdown-menu">
                        <li role="presentation" data-toggle="modal" data-target="#addCategory"><a role="menuitem" tabindex="-1" href="#"> Add Category </a></li>
                    </ul>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <div class="box-body table-responsive ">
                        {{ Form::open(array('url' => 'batch/assign')) }}
                        {{ Form::hidden('acm_academic_id',$acm->id, ['class'=>'form-control acm_academic_id'])}}
                        <div class='form-group' style="width: 300px">
                            {{ Form::label('exam_question', 'Examination Question:') }}
                            {{ Form::select('exam_question',$exam_questions,Input::old('exam_question'),['class'=>'form-control','required']) }}
                        </div>
                        <p style="color: cornflowerblue">Help Text: If Question is not Prepared Then Tell Faculty to Create Question Paper.</p>
                        <table id="example" class="table table-bordered table-hover table-striped">
                            <thead>
                            <tr>
                                <th>
                                    <input name="id" type="checkbox" id="checkbox" >
                                </th>
                                <th>Name</th>
                                <th>Semester</th>
                                <th>Year </th>
                                <th>Department</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($course_enroll))
                            @foreach($course_enroll as $key => $value)
                                <tr>
                                    <td><input type="checkbox" name="chk[]" class="myCheckbox" value="{{$value->id}}">
                                        {{--{{ Form::text('assign_stu_id',$value->id , ['class'=>'assign_stu_id'])}}--}}
                                    </td>
                                    <td>{{$value->relUser->relUserProfile->last_name}}</td>
                                    <td>{{isset($value->taken_in_semester_id)? $value->relSemester->title : ''}}</td>
                                    <td>{{isset($value->taken_in_year_id) ? $value->relYear->title : ''}}</td>
                                    <td>{{isset($value->batch_course_id) ? $value->relBatchCourse->relCourse->relSubject->relDepartment->title : ''}}</td>
                                    <td>{{$value->status}}</td>
                                    <td>
                                        <a href="{{URL::route('item.comments',['acm_assign_stu_id'=>$value->id])}}" class="btn btn-info btn-xs" data-toggle="modal" data-target="#commentsModal"> Comments </a>

                                        <a href="" class="btn btn-primary btn-xs"> Evaluation </a>

                                        @if($value->status == 'Accepted')
                                            {{ Form::submit('Revoke', ['name' => 'revoke', 'class' => 'btn btn-danger btn-xs']) }}
                                        @else
                                            {{ Form::submit('Assign', ['name' => 'assign', 'class' => 'btn btn-success btn-xs']) }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            @endif
                            </tbody>
                        </table>
                        <div class="button" style="margin-top: 10px">
                            <a href="{{URL::previous()}}" class="btn btn-info btn-xs ">Back</a>
                            {{ Form::submit('Do Assign', ['name' => 'assign', 'class' => 'btn btn-success btn-xs']) }}
                            {{ Form::submit('Do Revoke', ['name' => 'revoke','class' => 'btn btn-danger btn-xs']) }}
                        </div>
                        {{ Form::close() }}
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    {{--Assign comments modal--}}
    <div class="modal fade" id="commentsModal" tabindex="-1" role="dialog" aria-labelledby="addScholarship" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@stop

