    <div class="form-group">
        <div>{{ Form::label('department_id', 'DepartmentName') }}</div>
        <div>{{ Form::select('department_id',$department,Input::old('department'),['class'=>'form-control','required']) }}</div>
    </div>

    <div class='form-group'>
        <div>{{ Form::label('title', 'SubjectName') }}</div>
        <div>{{ Form::text('title', Input::old('title'),['class'=>'form-control','spellcheck'=> 'true','required'=>'required']) }}</div>
    </div>

    <div class='form-group'>
     <div>{{ Form::label('description', 'Description') }}</div>
     <div>{{ Form::textarea('description', Input::old('description'),['onkeyup'=>"javascript:this.value=this.value.replace(/[<,>]/g,'');",'class'=>'form-control','spellcheck'=> 'true','required'=>'required','size'=>'30x10']) }}</div>
 </div>

 <div>
    {{ Form::submit('Submit', array('class'=>'btn btn-primary')) }}
     <a href="{{URL::to('common/subject/list')}}" class="btn btn-default">Close </a>
</div>