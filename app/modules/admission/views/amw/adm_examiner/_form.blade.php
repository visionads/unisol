<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title" id="myModalLabel"> Admission Test Examiner : Add</h4>
</div>

<div class="modal-body">
     <div style="padding: 20px;">
        {{Form::open(array('url'=>'admission/amw/admission-test-examiner/store-admission-test-examiner', 'class'=>'form-horizontal','files'=>true))}}

                    <div class='form-group'>
                        <strong> Degree Name: </strong> </br>
                    </div>

                    <div class='form-group'>
                        <strong> Department: </strong>
                    </div>


                    <div class='form-group'>
                        {{ Form::label('type', 'Examiner Type') }}
                        {{ Form::select('type',
                        array('Question Setter' => 'Question Setter(QS)','Question Evaluator' => 'Question Evaluator(QE)','Both' => 'Both(BOTH)'),
                        Input::old('type'),['class'=>'form-control','required'=>'required']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('user_id', 'Name of Faculty:') }}
                        {{ Form::select('user_id', User::AmwList(),null, array('class' => 'form-control','required'=>'required') ) }}
                    </div>

                {{--<div class="form-group">--}}
                         {{--{{ Form::label('comment', 'Comment:') }}--}}
                         {{--{{ Form::textarea('comment', Null, ['size' => '40x6','placeholder'=>'Your Comments Here']) }}--}}
                {{--</div>--}}

              {{ Form::submit('Save', array('class'=>'pull-right btn btn-info')) }}
              <a href="" class="pull-right btn btn-default" style="margin-right: 5px">Close</a>

              <p>&nbsp;</p>
        {{Form::close()}}
     </div>
</div>

