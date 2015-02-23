
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title" id="myModalLabel"> Edit Waiver</h4>
</div>

<div class="modal-body">
   <div style="padding: 20px;">

{{ Form::open(['route' => ['waiver_manage.update',$waiver_model->id], 'class'=>'form-horizontal','files' => true,]) }}

     {{ Form::label('title', 'Title') }}
     {{ Form::text('title', $waiver_model->title,array('class' => 'form-control input-sm','placeholder'=>'Enter waiver title','required')) }}

      <br>

     {{ Form::label('description', 'Description') }}
     {{ Form::textarea('description', $waiver_model->description,array('class' => 'form-control input-sm','placeholder'=>'Enter Description','size' => '30x5')) }}

     <br>

     {{--{{ Form::label('is_percentage', 'Is Percentage ?') }}--}}
     {{--<label class="small">{{ Form::radio('is_percentage','1') }} Yes</label>--}}
     {{--<label class="small">{{ Form::radio('is_percentage','0') }} No</label>--}}

     {{--<p>&nbsp;</p>--}}

     {{--{{ Form::label('amount', 'Amount') }}--}}
     {{--{{ Form::text('amount', Input::old('amount'),array('class' => 'form-control input-sm' ,'required')) }}--}}

     {{--<br>--}}

     {{--{{ Form::label('billing_details_id', 'Billing Item') }}--}}
     {{--{{ Form::select('billing_details_id',$billing_item,Input::old('billing_details_id'),['class'=>'form-control input-sm','required']) }}--}}

     <p>&nbsp;</p>

     {{ Form::submit('Update ', array('class'=>'pull-right btn btn-primary')) }}

     <p>&nbsp;</p>

     {{Form::close()}}


   </div>

</div>


