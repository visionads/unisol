@extends('layouts.layout')

@section('sidebar')
 @include('layouts._sidebar_student')
@stop

@section('content')

<h3 class="box-title">Courses</h3>
<div class="row">
        <div class="col-lg-12">
            <div class="box box-solid">
                <div class="box-header">

                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="box-group" id="accordion">
                        <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                        @if(isset($total_credit))
                             <strong style="color:midnightblue;font-size: medium">Total Credit  : {{$total_credit->relBatchCourse->relBatch->relDegree->total_credit}}</strong>
                        @endif
                        <div class="panel box box-primary">
                            <div class="box-header">

                                <h5 class="box-title">

                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" style="font-size: smaller;text-decoration: underline">
                                       Completed
                                    </a>
                                </h5>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="box-body">
                                    <div class="row">

                                          <div class="col-lg-12">
                                          @if(isset($courses))
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

                                                                @foreach($courses as $value)
                                                                   <tr>
                                                                        <td>{{($value->relBatchCourse->relCourse->title )}}</td>
                                                                        <td>{{ $value->relBatchCourse->relCourse->credit}}</td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                   </tr>
                                                                @endforeach

                                                        </tbody>

                                                        <strong style="color:midnightblue">{{$value->relBatchCourse->relBatch->relSemester->title.' ,'.
                                                        $value->relBatchCourse->relBatch->relYear->title}}</strong>
                                             </table>
                                          @else
                                               {{"No Data found !"}}
                                          @endif
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
                            <div id="collapseTwo" class="panel-collapse collapse">
                                 <div class="box-body">
                                       <div class="row">

                                             <div class="col-lg-12">
                                                 <table class="table table-bordered">
                                                       <thread>

                                                       </thread>

                                                 </table>
                                             </div>
                                         </div>

                                 </div>
                            </div>
                        </div>
                        <div class="panel box box-success">
                            <div class="box-header">
                                <h4 class="box-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" style="font-size: smaller;text-decoration: underline">
                                        Left
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse">
                                <div class="box-body">
                                    <table class="table table-bordered">
                                      <thread>

                                      </thread>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->


    @stop