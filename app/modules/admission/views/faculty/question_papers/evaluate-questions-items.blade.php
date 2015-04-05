@extends('layouts.layout')
@section('sidebar')
    @include('layouts._sidebar_faculty')
@stop

@section('content')
    <!-- START CUSTOM TABS -->
            <h2 class="page-header">Evaluate Question Items </h2>
            <div class="row">
                <div class="col-md-12">
                    <!-- Custom Tabs -->
                    <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab_1" data-toggle="tab">Evaluation Question Items  </a></li>
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        Settings  <span class="caret"></span>
                                    </a>
                                        <ul class="dropdown-menu">
                                            <li role="presentation" data-toggle="modal" data-target="#addCategory"><a role="menuitem" tabindex="-1" href="#"> Blank </a></li>

                                        </ul>
                                </li>
                                <li class="pull-right" class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-gear"></i>&nbsp;</a>
                                    <ul class="dropdown-menu">
                                        <li role="presentation" data-toggle="modal" data-target="#addCategory"><a role="menuitem" tabindex="-1" href="#"> Blank </a></li>

                                    </ul>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    {{--<button class="pull-right btn btn-success btn-sm"  data-toggle="modal" data-target="#addExtraCurricular" >--}}
                                        {{--Add Extra-curricular--}}
                                    {{--</button><br>--}}

                                      <strong> Degree: </strong>
                                             {{ $data_evaluate->relBatchAdmtestSubject->relBatch->relDegree->relDegreeProgram->code.''
                                                 .$data_evaluate->relBatchAdmtestSubject->relBatch->relDegree->relDegreeGroup->code.' in '
                                                 .$data_evaluate->relBatchAdmtestSubject->relBatch->relDegree->relDepartment->title.' , '
                                                 .$data_evaluate->relBatchAdmtestSubject->relBatch->relSemester->title.' , '
                                                 .$data_evaluate->relBatchAdmtestSubject->relBatch->relYear->title
                                             }}

                                       <br> <br>


                                      <strong> Subject: </strong>{{ $data_evaluate->relBatchAdmtestSubject->relAdmtestSubject->title }}
                                       <br> <br>


                                      <strong> Total Marks: </strong> {{ $data_evaluate->total_marks }} <br><br>

                                      <strong> Marks Obtained So Far: </strong> {{ $evaluate_qp->relAdmQuestion->marks  }} <br><br>

                                    <div class="box-body table-responsive">
                                          {{Form::open(array('url'=>'admission/faculty/question-papers/store-evaluated-questions', 'class'=>'form-horizontal','files'=>true))}}
                                                <strong> Question No: # out of: # </strong>
                                                 <br><br>
                                                <strong> Question Title Here: </strong> {{ $evaluate_qp->relAdmQuestionItems->title }}
                                                    <br><br>

                                                <div class='form-group'>
                                                  {{ Form::label('answer', 'Answer') }}
                                                  {{ Form::text('answer',$eva_q_ans->answer, Input::old('answer'),['class'=>'form-control','required'=>'required']) }}
                                                </div>
                                                {{--$eva_q_ans->answer--}}

                                               {{ Form::submit('Evaluate and Next', array('id'=>'submit_if', 'class'=>'btn btn-primary btn-xs')) }}
                                               <a href="{{ URL::previous() }}" class="btn bg-orange btn-xs " >Back</a>

                                          {{ Form::close()  }}
                                    </div><!-- /.box -->
                                </div><!-- /.tab-pane -->
                            </div><!-- /.tab-content -->
                    </div><!-- nav-tabs-custom -->
                </div><!-- /.col -->
            </div> <!-- /.row -->
            <!-- END CUSTOM TABS -->

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="z-index:1050">
          <div class="modal-content">

          </div>
    </div>
</div>

@stop