@extends('layouts.layout')
@section('sidebar')
    @include('layouts._sidebar_amw')
@stop
@section('content')
   <h1>Batch Management </h1>

<div class="row">
           <div class="col-sm-12">
               <div class="pull-right col-sm-4">
                   <a class="pull-right btn btn-sm btn-info" href="{{ URL::to('batch/amw/create')}}" data-toggle="modal" data-target="#modal" >Add Batch</a>
               </div>


                <div class="col-sm-12">
                        <div style="width:100%; float:left;">
                            <div style="width:50%; float:left;" class="">
                                <div class="col-sm-6 row-">
                                    <div class='form-group'>
                                               {{ Form::label('status', 'Selct Status') }}
                                               {{ Form::select('status',
                                                   array('' => 'Select Status',
                                                   'Created (CRTD)' => 'Created',
                                                   'Ask for Application (AFA)' => 'Ask for Application',
                                                   'Application Time Over (ATO)' => 'Application Time Over',
                                                   'Selection and Scrutinizing (SNS)' => 'Selection and Scrutinizing',
                                                   'Admission Test (ADMT)' => 'Admission Test',
                                                   'Admission Test Evaluation (ADTE)' => 'Admission Test Evaluation',
                                                   'Merit List Preparation (MRPR)' => 'Merit List Preparation',
                                                   'Final Selection (FNLS)' => 'Final Selection',
                                                   'Admission (ADMN)' => 'Admission',
                                                   'Activity Start (ACTS)' => 'Activity Start',
                                                   'Running (Rung)' => 'Running',
                                                   'Cancelled (CNCL)' => 'Cancelled',
                                                   'Paused (PSD)' => ' Paused',
                                                   'Finished (FNSH)' => 'Finished',

                                               ),Input::old('status'),['class'=>'form-control']) }}
                                    </div>
                            	</div>
                            </div>

                            <div style="width:50%; float:left;">
                                <div class="col-sm-12 ">
                                    <div class='form-group'>
                                               {{ Form::label('degree_id', 'Degree with Program') }}
                                               {{ Form::select('degree_id',$dpg_list,null,['class'=>'form-control']) }}
                                    </div>
                                </div>
                                <div class="clearfix visible-md-block"></div>

                                <div class="col-sm-12 ">
                                    <div class='form-group'>
                                               {{ Form::label('department_id', 'Department') }}
                                               {{ Form::select('department_id',$department_list,null,['class'=>'form-control']) }}
                                    </div>

                                </div>
                                <div class="clearfix visible-md-block"></div>

                                <div class="col-sm-12 ">
                                        <div class='form-group'>
                                              {{ Form::label('year_id', 'Year') }}
                                              {{ Form::select('year_id',$year_list,null,['class'=>'form-control']) }}
                                        </div>

                                </div>
                                <div class="clearfix visible-sm-block"></div>

                            </div>

                        </div>
                    </div>






           </div>
</div>

{{ Form::open(array('url' => 'batch/amw/batchDelete')) }}

        <table id="example" class="table table-striped  table-bordered"  >
            <thead>
                  {{ Form::submit('Delete Items', array('class'=>'btn btn-danger', 'id'=>'hide-button', 'style'=>'display:none'))}}
                  <br>

                <tr>
                    <th><input name="id" type="checkbox" id="checkbox" class="checkbox" value=""></th>
                    <th>Title</th>
                    <th>BN</th>
                    <th>Department</th>
                    <th>Year</th>
                    <th>Term</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @if(isset($batch_management))
              @foreach($batch_management as $batch_list)
                <tr>

                   <td><input type="checkbox" name="id[]"  id="checkbox" class="myCheckbox" value="{{ $batch_list->id }}"></td>
                   <td>{{ $batch_list->relDegree->title }}</td>
                   <td>{{ $batch_list->batch_number }}</td>
                   <td>{{ $batch_list->relDegree->relDepartment->title }}</td>
                   <td>{{ $batch_list->relYear->title }}</td>
                   <td>{{ $batch_list->relSemester->title }}</td>
                    <td>{{ $batch_list->status }}</td>

                   <td>
                         <a href="{{ URL::to('batch/amw/show/'.$batch_list->id) }}" class="btn btn-xs btn-default" data-toggle="modal" data-target="#modal" style="font-size: 12px;color: darkmagenta"><span class="fa fa-eye"></span></a>
                         {{--<a class="btn btn-xs btn-default" href="{{ URL::to('batch/amw/edit/'.$batch_list->id) }}" data-toggle="modal" data-target="#modal" style="font-size: 12px;color: lightseagreen"><i class="fa fa-edit"></i></a>--}}

                   </td>

                </tr>
               @endforeach
             @endif

            </tbody>
        </table>

        {{form::close() }}
<div class="text-right">
    {{ $batch_management->links() }}
</div>
<p>&nbsp;</p><p>&nbsp;</p>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

         </div>
        </div>
   </div>


@stop