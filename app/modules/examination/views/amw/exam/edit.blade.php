<div class="modal-header">

    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title" id="myModalLabel"> Edit Degree Program</h4>
</div>

<div class="modal-body">
      <div style="padding: 20px;">

          {{Form::open(array('route'=> ['amw.update-exam-data',$model->id], 'class'=>'form-horizontal','files'=>true))}}

          <div class='form-group'>

              <div>{{ Form::label('title', ' Title') }}</div>
              <div>{{ Form::text('title' ,$model->title,['class'=>'form-control input-sm','required'])}}</div>
          </div>

          <div class="form-group">
                        {{ Form::label('acm_marks_dist_item_id', 'Exam Type') }}
                        {{ Form::select('acm_marks_dist_item_id', $exam_type, Input::old('acm_marks_dist_item_id'), array('class' => 'form-control','required'=>'required')) }}
                    </div>

                    <div class="form-group">
                          {{ Form::label('semester_id', 'Semester') }}
                          {{ Form::select('semester_id', $semester_id, $model->semester_id, array('class' => 'form-control', 'id'=>'sem-data')) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('year_id', 'Year') }}
                        {{ Form::select('year_id',$year_id, $model->year_id, ['id'=>'course_name','class'=>'form-control'] ) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('course_conduct_id', 'Course Name') }}
                        {{ Form::select('course_conduct_id', $courses, $model->course_conduct_id, ['id'=>'dependable-list', 'class'=>'form-control','placeholder'=>'']) }}
                    </div>

          <p>&nbsp;</p>

          <div>
          {{ Form::submit('Update', array('class'=>'pull-right btn btn-primary')) }}
          <a  href="" class="pull-right btn btn-default" style="margin-right: 5px">Close</a>
          </div>
          <p>&nbsp;</p>

          {{Form::close()}}
      </div>
</div>


{{----------------Ajax operation: Dropdown CourseList  ----------------------------------}}
<script>
 $('#course_name').change(function(){
    $.get("{{ url('amw/edit-exam-data/')}}",
        { year: $(this).val(), semester:$('#sem-data').val() },
        function(data) {
             var model = $('#dependable-list');
             model.empty();
            $.each(data, function(key, element) {
                model.append("<option value='"+ key +"'>" + element + "</option>");
            });
        });
 });
 </script>