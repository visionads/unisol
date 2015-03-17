<div class="modal-header">

    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title" id="myModalLabel"> Add Degree Group</h4>
</div>

<div class="modal-body">
      <div style="padding: 20px;">

          {{Form::open(array('url'=>'common/degree-group/store', 'class'=>'form-horizontal','files'=>true))}}

          <div class='form-group'>

              <div>{{ Form::label('title', 'Course Title') }}</div>
              <div>{{ Form::text('title',Input::old('title') ,['class'=>'form-control input-sm','required'])}}</div>
          </div>

          <div class='form-group'>

                <div>{{ Form::label('code', 'Course Code') }}</div>
                <div>{{ Form::text('code',Input::old('code') ,['class'=>'form-control input-sm','required'])}}</div>
          </div>

          <div class='form-group'>
                <div>{{ Form::label('description', 'Description') }}</div>
                <div>{{ Form::textarea('description',Input::old('description') ,['class'=>'form-control input-sm'])}}</div>
          </div>
          <p>&nbsp;</p>

          <div>

          {{ Form::submit('Save', array('class'=>'pull-left btn btn-primary')) }}
          <a  href="{{URL::previous() }}" class="pull-right btn btn-default">Close</a>

          </div>
          <p>&nbsp;</p>
          {{Form::close()}}
      </div>
</div>
