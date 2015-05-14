@extends('layouts.layout')
@section('sidebar')
    @include('layouts._sidebar_amw')
@stop
@section('content')

<a class="pull-right btn btn-sm btn-info" href="{{ URL::route('amw.examiners.create',['exm_exam_list_id'=>$exm_exam_list_id]) }}" data-toggle="modal" data-target="#examiner-data" style="color: #ffffff" title="New Examination"><b>+ Add Examiner</b></a>

<h3>Examination :Examiners</h3>

<div class="row">
   <div class="col-md-12 ">
      <div class="box box-solid">
          {{ Form::open(array('url' => 'examination/amw/batchDelete')) }}
             <table id="example" class="table table-striped  table-bordered">
             <div style="background-color:lightgray; color:white; padding:8px;">
                 <b style="margin-left: 20px;color: #005580">Course Title: {{isset($year_title) ? $year_title : ''}}</b>
                 <b style="margin-left: 100px;color: #005580">Exam Type : {{isset($semester_title) ? $semester_title :''}}</b><br>
                 <b style="margin-left: 20px;color: #005580">Year: {{isset($year_title) ? $year_title : ''}}</b>
                 <b style="margin-left: 150px;color: #005580">Semester : {{isset($semester_title) ? $semester_title :''}}</b>
             </div>
                <thead>
                   {{ Form::submit('Delete Items', array('class'=>'btn btn-xs btn-danger', 'id'=>'hide-button', 'style'=>'display:none'))}}
                       <br>
                       <tr>
                          <th><input name="id" type="checkbox" id="checkbox" class="checkbox" value=""></th>
                          <th>Name of Examiner</th>
                          <th>Dept</th>
                          <th>Status</th>
                          <th>Action</th>
                       </tr>
                </thead>
                <tbody>
                    @if(isset($examiners_list))
                        @foreach($examiners_list as $exmr)
                            <tr>
                                <td><input type="checkbox" name="id[]"  id="checkbox" class="myCheckbox" value="{{ $exmr['id'] }}"></td>
                                <td>
                                     {{$exmr->relUser->relUserProfile->first_name.' '.$exmr->relUser->relUserProfile->middle_name.' '.$exmr->relUser->relUserProfile->last_name}}
                                </td>
                                <td>{{ $exmr->relExmExamList->relCourseConduct->relCourse->relSubject->relDepartment->title }}</td>
                                <td>{{ $exmr->status }}</td>
                                <td>
                                   {{--<a href="{{ URL::to('')}}" class=" btn btn-xs btn-info">Examiners</a>--}}
                                   {{--<a href="{{ URL::to('examination/amw/index',['exam_list_id'=>$exmr->id , 'course_man_id'=>$course_list->course_management_id]) }}" class="btn btn-default">Question Paper</a>--}}
                                </td>
                            </tr>
                        @endforeach
                        {{--<a class="pull-right btn btn-sm btn-info" href="{{ URL::route('amw.exam-list') }}"  style="color: #ffffff" ><b>All</b></a>--}}
                    @else
                    @endif
                </tbody>
             </table>
          {{form::close() }}

          <p>&nbsp;</p>
      </div>
   </div>
</div>

<!-- Modal  -->
 <div class="modal fade" id="examiner-data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" style="z-index:1050">
        <div class="modal-content">

        </div>
      </div>
 </div>

@stop