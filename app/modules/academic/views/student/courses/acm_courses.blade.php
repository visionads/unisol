@extends('layouts.layout')

@section('sidebar')
 @include('layouts._sidebar_student')
@stop

@section('content')
<div>
     <a class="pull-right btn btn-xs btn-info btn-link" href="{{ URL::route('academic.student.enrollment')}}"  title="Enrollment"><strong style="color: darkgreen;font-size: medium">Enrollment</strong></a>
</div>
<h3 class="box-title">Courses</h3>
<div style="background-color:lightgray; color:white; padding:8px;">
   <b style="margin-left: 80px;color: #005580">Total Credit : {{ isset($total_credit->relBatch->relDegree->total_credit) ? $total_credit->relBatch->relDegree->total_credit:'0' }}</b>
   <b style="margin-left: 60px;color: #005580">Accomplished Credit : {{isset($accomplished_credit->accomplished_credit) ? $accomplished_credit->accomplished_credit:'0'}}</b>
   <b style="margin-left: 60px;color: #005580">Left Yet(Credit) : {{isset($left_credit) ? $left_credit : ''}}</b>
</div>
<br>
<div class="row">
    <div class="col-lg-12">
        <div class="box box-solid">
            <div class="box-header">

            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="box-group" id="accordion">

                    <div class="panel box box-primary">
                        <div class="box-header">

                            <h5 class="box-title">

                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" style="font-size: smaller;text-decoration: underline">
                                   Completed
                                </a>
                            </h5>
                        </div>
                        <div id="collapseOne" class="panel-collapse">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                         <table class="table  table-bordered">
                                             @if(isset($completed_course_in_year))
                                                <a  style="font-size:medium;text-decoration: underline;color:teal">
                                                    {{$completed_course_in_year->relBatchCourse->relSemester->title}},{{$completed_course_in_year->relBatchCourse->relYear->title}}
                                                </a>
                                             @endif
                                            <thead>
                                                <tr>
                                                   <th>Course</th>
                                                   <th>Credit</th>
                                                   <th>GPA</th>
                                                   <th>Status</th>
                                                   <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               @if(isset($completed_course))
                                                  @foreach($completed_course as $value)
                                                     <tr>
                                                          <td>{{($value->relBatchCourse->relCourse->title )}}</td>
                                                          <td>{{ $value->relBatchCourse->relCourse->credit}}</td>
                                                          <td></td>
                                                          <td>
                                                              @if($value['status']== 'pass')
                                                                 {{strtoupper($value->status)}}
                                                              @else
                                                                 <b style="color: lightcoral">{{strtoupper($value->status)}}</b>
                                                              @endif
                                                          </td>
                                                          <td>
                                                               @if($value['status']== 'pass')
                                                                 <a class="btn btn-xs btn-success" href="{{ URL::route('academic.student.enrollment')}}"  title="Retake">Retake</a>
                                                               @endif
                                                          </td>
                                                     </tr>
                                                  @endforeach
                                               @else
                                                   {{"No Data found !"}}
                                               @endif
                                            </tbody>
                                         </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel box box-danger">
                        <div class="box-header">
                            <h5 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" style="font-size: smaller;text-decoration: underline">
                                    Running
                                </a>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="panel-collapse ">
                             <div class="box-body">
                                   <div class="row">
                                         <div class="col-lg-12">
                                             <table class="table  table-bordered">
                                                  @if(isset($running_course_in_year))
                                                     <a  style="font-size:medium;text-decoration: underline;color:#005580">
                                                         {{$running_course_in_year->relBatchCourse->relYear->title}},{{$running_course_in_year->relBatchCourse->relSemester->title}}
                                                     </a>
                                                  @endif
                                                 <thead>
                                                     <tr>
                                                        <th>Course</th>
                                                        <th>Credit</th>
                                                        <th>GPA</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                     </tr>
                                                 </thead>
                                                 <tbody>
                                                    @if(isset($running_course))
                                                       @foreach($running_course as $value)
                                                          <tr>
                                                               <td>{{($value->relBatchCourse->relCourse->title )}}</td>
                                                               <td>{{ $value->relBatchCourse->relCourse->credit}}</td>
                                                               <td></td>
                                                               <td>
                                                                 {{strtoupper($value->status)}}
                                                               </td>
                                                               <td>
                                                                   @if($value->status == 'enrolled')
                                                                      <a class="btn btn-xs btn-info" href="{{ URL::route('academic.student.enrollment')}}"  title="Retake">Revoke</a>
                                                                   @endif
                                                                   @if($value->status == 'revoked')
                                                                      <a class="btn btn-xs btn-info" href="{{ URL::route('academic.student.enrollment')}}"  title="Retake">Invoke</a>
                                                                   @endif
                                                               </td>
                                                          </tr>
                                                       @endforeach
                                                    @else
                                                        {{"No Data found !"}}
                                                    @endif
                                                 </tbody>
                                             </table>
                                         </div>
                                     </div>

                             </div>
                        </div>
                    </div>
                      {{-------------Left Courses ----------------------------------------------------------}}
                    <div class="panel box box-success">
                        <div class="box-header">

                        </div>
                        <div class="box-header">
                            <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" style="font-size:smaller;text-decoration: underline;color:lightcoral">
                                  Left
                                </a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse">
                            <div class="box-body">
                                <div class="row">

                                      <div class="col-lg-12">
                                          @if(isset($left_courses))
                                               @foreach($left_courses as $yr => $semesters)
                                                   @foreach($semesters as $sm => $courses)
                                                   <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" style="font-size:medium;text-decoration: underline;color:lightseagreen">
                                                        {{$sm}}, {{$yr}}
                                                   </a>
                                                       <div id="collapseThree" class="panel-collapse ">
                                                           @if(isset($left_courses))
                                                              <table class="table  table-bordered">
                                                                  <thead>
                                                                      <tr>
                                                                          <th>Course</th>
                                                                          <th>Credit</th>
                                                                          <th>GPA</th>
                                                                          <th>Status</th>
                                                                          <th>Action</th>
                                                                      </tr>
                                                                  </thead>
                                                                  <tbody>
                                                                     @foreach($courses as $c => $v)
                                                                        <tr>
                                                                           <td>{{$v['title']}}</td>
                                                                           <td>{{$v['credit']}}</td>
                                                                           <td></td>
                                                                           <td></td>
                                                                           <td></td>
                                                                        </tr>
                                                                     @endforeach
                                                                  </tbody>
                                                              </table>
                                                           @else
                                                                {{"No Data found !"}}
                                                           @endif
                                                       </div>
                                                   @endforeach
                                               @endforeach
                                          @else
                                               {{"No Data found !"}}
                                          @endif
                                      </div>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->


@stop