@extends('layouts.layout')
@section('sidebar')
    @include('layouts._sidebar_amw')
@stop
@section('content')
<h1><strong>Manage Admission Test Subject </strong> </h1> <br>

            {{--{{ Form::open(array('url' => 'examination/amw/batchDelete')) }}--}}

            <div class="row">
                    <div class="col-sm-12">

                        <div class="col-sm-12">
                           <div class="pull-right col-sm-4">
{{--                        {{ URL::route('admission.amw.batch-applicant.index',['id'=>$batch_list->id ])  }}--}}
                               <a class="pull-right btn btn-sm btn-info" href="{{ URL::route('admission.amw.create_admtest_subject',['batch_id'=>$degree_name->batch_id])}}"
                                data-toggle="modal" data-target="#modal" >Add Subject To Degree</a>
                           </div>
                       </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-6">
                            <strong> Degree: </strong>

                            {{ $degree_name->relBatch->relDegree->title }}




                            {{--@foreach($degree_name as $degree_show)--}}
                                    {{--@if (($degree_show->relBatch->relDegree->relDegreeGroup->code) === 'Com')--}}
                                        {{--{{ $degree_show->relBatch->relDegree->relDepartment->title.',--}}
                                        {{--'.$degree_show->relBatch->relSemester->title.',--}}
                                        {{--'.$degree_show->relBatch->relYear->title  }}--}}
                                    {{--@else--}}
                                        {{--{{ $degree_show->relBatch->relDegree->relDegreeProgram->code.'--}}
                                        {{--'.$degree_show->relBatch->relDegree->relDegreeGroup->code.' in--}}
                                        {{--'.$degree_show->relBatch->relDegree->relDepartment->title.',--}}
                                        {{--'.$degree_show->relBatch->relSemester->title.',--}}
                                        {{--'.$degree_show->relBatch->relYear->title  }}--}}
                                    {{--@endif--}}
                            {{--@endforeach--}}
                        </div>
                    </div>
            </div>


                <table id="example" class="table table-striped  table-bordered"  >
                      <thead>
                           {{ Form::submit('Delete Items', array('class'=>'btn btn-danger btn-xs', 'id'=>'hide-button', 'style'=>'display:none'))}}

                             <br>
                             <tr>
                                <th><input name="id" type="checkbox" id="checkbox" class="checkbox" value=""></th>
                                <th>Subject</th>
                                <th>Marks</th>
                                <th>Exam Duration</th>
                                <th>Action</th>
                             </tr>
                  </thead>
                  <tbody>
                        @if(isset($degree_test_sbjct))
                          @foreach($degree_test_sbjct as $batch_adm_tst_sbjct)
                                <tr>
                                    <td><input type="checkbox" name="id[]" class="myCheckbox" value="{{ $batch_adm_tst_sbjct['id'] }}"></td>
                                    <td>{{ $batch_adm_tst_sbjct->relAdmTestSubject->title }} </td>
                                    <td>{{ $batch_adm_tst_sbjct->marks }} </td>
                                    <td>{{ $batch_adm_tst_sbjct->duration }} &nbsp; Minutes</td>

                                    <td>
                                          <a href="{{ URL::route('admission.amw.view_admtest_subject', ['id'=>$batch_adm_tst_sbjct->id])  }}" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modal" data-placement="left" title="Show" href="#">View</a>
                                          <a href="{{ URL::route('admission.amw.edit_admtest_subject', ['id'=>$batch_adm_tst_sbjct->id])  }}" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modal" data-placement="left" title="Edit" href="#">Edit</a>
                                    </td>
                                </tr>
                          @endforeach
                        @endif
                  </tbody>
                </table>
            {{form::close() }}

{{--            {{ $dgr_adm_tst_add_sbjct->links() }}--}}


<p>&nbsp;</p><p>&nbsp;</p>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="z-index:1050">
          <div class="modal-content">

         </div>
        </div>
</div>


@stop
