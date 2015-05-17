
<div class='form-group'>
   {{ Form::label('code', 'Category Code') }}
   {{ Form::text('code', Input::old('code'),['class'=>'form-control', 'style'=>'text-transform: uppercase;', 'required']) }}
</div>

<div class='form-group'>
   {{ Form::label('title', 'Title') }}
   {{ Form::text('title', Input::old('title'),['class'=>'form-control', 'required']) }}
</div>

<div class='form-group'>
   {{ Form::label('description', 'Description') }}
   {{ Form::textarea('description',  Input::old('description'),['onkeyup'=>"javascript:this.value=this.value.replace(/[<,>]/g,'');", 'size' => '30x5', 'class'=>'form-control']) }}
</div>

{{ Form::submit('Save', array('class'=>'pull-right btn btn-info')) }}
<a href="" class="pull-right btn btn-default" style="margin-right: 5px">Close</a>

<p>&nbsp;</p>