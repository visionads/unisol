@extends('layouts.layout')
@section('sidebar')
    @include('layouts._sidebar_faculty')
@stop
@section('content')
<h3>Examination List </h3>

<div class="row">
<div class="box box-solid ">
<div class="box-body">
  <div class="col-sm-12">
    {{ Form::open(array('url' => 'examination/faculty/examination-list')) }}
      <div class="col-sm-8">
       <div class="col-sm-3">
        {{ Form::label('year_id', 'Year') }}
        {{ Form::select('year_id', $year_id, Input::old('year_id'), array('class' => 'form-control','required'=>'required') ) }}
       </div>
       <div class="col-sm-3">
        {{ Form::label('semester_id', 'Semester') }}
        {{ Form::select('semester_id', $semester_id, Input::old('semester_id'), array('class' => 'form-control','required'=>'required')) }}
       </div>
       <div class="col-sm-2" style="padding-top: 1%">
       </br>
       {{ Form::submit('Filter', array('class'=>'btn btn-success btn-sm' ))}}
       </div>
      </div>
    {{ Form::close() }}

  </div>

  <br><br><br><br>


  {{ Form::open(array('url' => 'examination/faculty/examination-list/batchDelete')) }}
      <table id="example" class="table table-striped  table-bordered"  >
         <thead>
            {{ Form::submit('Delete Items', array('class'=>'btn btn-danger', 'id'=>'hide-button', 'style'=>'display:none'))}}

                <br>
                <tr>
                   <th><input name="id" id="checkbox" type="checkbox" class="checkbox" value=""></th>
                   <th>Title</th>
                   <th>Department</th>
                   <th>Course</th>
                   <th>Type</th>
                   <th>Year</th>
                   <th>Term</th>
                   <th>Status</th>
                   <th>Action</th>
                </tr>
         </thead>
             <tbody>
                @if(isset($data))
                 @foreach($data as $values)
                   <tr>
                       <td><input type="checkbox" name="id[]" class="myCheckbox" value="{{ $values->id }}"></td>
                       <td>{{ $values->relExmExamList->title }}</td>
                       {{--<b>{{ HTML::linkAction('AdmAmwController@viewAdmTestExaminers',User::FullName($values->user_id),['id'=>$values->batch_id], ['data-toggle'=>"modal", 'data-target'=>"#modal"]) }}</b>--}}
                       <td>{{ $values->relExmExamList->relCourseConduct->relDegree->relDepartment->title }}</td>
                       <td>{{ $values->relExmExamList->relCourseConduct->relCourse->title }}</td>
                       <td>{{ $values->relExmExamList->relAcmMarksDistItem->title }}</td>
                       <td>{{ $values->relExmExamList->relYear->title }}</td>
                       <td>{{ $values->relExmExamList->relSemester->title }}</td>
                       <td >{{ $values->status }}</td>


                       <td>
                          @if($values->status == 'Requested' )
                                  <a class="btn btn-primary btn-xs" data-href="{{ URL::route('examination.faculty.admission-test.change-status-to-accept',['id'=>$values->id]) }}" data-toggle="modal" data-target="#confirm-delete" href="">Accept</a>
                                  <a class="btn btn-success btn-xs" data-href="{{ URL::route('examination.faculty.examination-list.change-status-to-deny',['id'=>$values->id]) }}" data-toggle="modal" data-target="#confirm-delete" href="">Deny</a>
                          @elseif( $values->status == 'Accepted' )
                                  <a href="{{ URL::route('examination.faculty.exm-question-paper', ['exm_list_id'=>$values->exm_exam_list_id]) }}" class="btn btn-info btn-xs" >Questions</a>
                          @endif
                       </td>
                   </tr>
                 @endforeach
                @endif
             </tbody>
      </table>
  {{form::close() }}


  {{--{{ $admission_test_home->links() }}--}}


<p>&nbsp;</p><p>&nbsp;</p>

</div>
</div>
</div>


<!-- Modal :: Confirmation -->
            <div class="modal fade " id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="confirm-delete" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
                      </div>
                      <div class="modal-body">
                            <strong>Are you sure ?</strong>
                      </div>
                      <div class="modal-footer">
                            <a href="" class="btn-sm btn-default">Close</a>
                            <a href="#" class="btn btn-Success danger">OK</a>
                      </div>
                </div>
              </div>
            </div>

            <script>
                      $('#confirm-delete').on('show.bs.modal', function(e) {
                         $(this).find('.danger').attr('href', $(e.relatedTarget).data('href'));
                         $('.debug-url').html('Delete URL: <strong>' + $(this).find('.danger').attr('href') + '</strong>');
                     })
            </script>

@stop