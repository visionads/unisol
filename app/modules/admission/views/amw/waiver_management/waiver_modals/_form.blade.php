
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title" id="myModalLabel"> Add Waiver</h4>
</div>

<div class="modal-body">
   <div style="padding: 20px;">

{{--{{ Form::open(['route' => ['degree_waiver.store'], 'class'=>'form-horizontal','files' => true,]) }}--}}

     {{ Form::label('title', 'Title') }}
     {{ Form::text('title', Input::old('title'),array('class' => 'form-control input-sm','placeholder'=>'Enter waiver title')) }}

      <br>

     {{ Form::label('description', 'Description') }}
     {{ Form::textarea('description', Input::old('description'),array('class' => 'form-control input-sm','placeholder'=>'Enter Description','size' => '30x5')) }}

     <br>

     {{ Form::label('is_percentage', 'Is Percentage ?') }}
     <label class="small">{{ Form::radio('is_percentage','1') }} Yes</label>
     <label class="small">{{ Form::radio('is_percentage','0') }} No</label>

     <p>&nbsp;</p>

     {{ Form::label('amount', 'Amount') }}
     {{ Form::text('amount', Input::old('amount'),array('class' => 'form-control input-sm')) }}


     {{ Form::submit('Save ', array('class'=>'pull-right btn btn-primary')) }}

     {{Form::close()}}


   </div>

</div>


