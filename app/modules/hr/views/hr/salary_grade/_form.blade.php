<div class='form-group'>
   {{ Form::label('title', 'Title') }}
   {{ Form::text('title', Input::old('title'),['class'=>'form-control', 'required']) }}
</div>

<div class='form-group'>
   {{ Form::label('code', 'Code') }}
   {{ Form::text('code', Input::old('code'),['class'=>'form-control', 'required']) }}
</div>

<div class='form-group'>
   {{ Form::label('description', 'Description') }}
   {{ Form::textarea('description',  Input::old('description'),['size' => '30x5', 'class'=>'form-control']) }}
</div>

<div class='form-group'>
   {{ Form::label('type', 'Type') }}
   {{ Form::text('type', Input::old('type'),['class'=>'form-control', 'required']) }}
</div>

<div class='form-group'>
   {{ Form::label('min_amount', 'Min Amount') }}
   {{ Form::text('min_amount', Input::old('min_amount'),['class'=>'form-control', 'required']) }}
</div>

<div class='form-group'>
   {{ Form::label('max_amount', 'Max Amount') }}
   {{ Form::text('max_amount', Input::old('max_amount'),['class'=>'form-control', 'required']) }}
</div>

{{ Form::submit('Save', array('class'=>'pull-right btn btn-info')) }}
<a href="" class="pull-right btn btn-default" style="margin-right: 5px">Close</a>

<p>&nbsp;</p>