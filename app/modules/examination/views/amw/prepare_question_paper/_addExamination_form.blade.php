<fieldset style="padding: 10px; width: 90%;">

            <div class="form-group">
                   {{ Form::label('title', 'Title') }}
                   {{ Form::text('title', Input::old('title'), array('class' => 'form-control','required'=>'required')) }}
            </div>
           <div class="form-group">
                {{ Form::label('deadline', 'Deadline') }}
                {{ Form::text('deadline', Input::old('deadline'), array('class' => 'form-control datepicker','required'=>'required')) }}
           </div>
           <div class="form-group">
                 {{ Form::label('total_marks', 'Total Marks') }}
                 {{ Form::text('total_marks', Input::old('total_marks'), array('class' => 'form-control','required'=>'required')) }}
           </div>
            {{--<div class="form-group">--}}
                 {{--{{ Form::label('created_by', 'Created by') }}--}}
                 {{--{{ Form::text('created_by', Input::old('created_by'), array('class' => 'form-control','required'=>'required')) }}--}}
            {{--</div>--}}
           {{--<div class="form-group">--}}
                  {{--{{ Form::label('updated_by', 'Updated By') }}--}}
                  {{--{{ Form::text('updated_by', Input::old('updated_by'), array('class' => 'form-control','required'=>'required')) }}--}}
           {{--</div>--}}
            {{--<div class="form-group">--}}
                  {{--{{ Form::label('assign_to', 'Assign To') }}--}}
                  {{--{{ Form::select('assign_to', Input::old('assign_to'), array('class' => 'form-control','required'=>'required'))}}--}}
            {{--</div>--}}
            {{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
            <a href="{{URL::to('examination/amw/examination')}}" class="btn btn-default">Close </a>
</fieldset>