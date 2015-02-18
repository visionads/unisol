<div style="padding: 10px; width: 90%;">

             <h2>Welcome to View Examiners : <strong>{{ ucwords(Auth::user()->username) }}</strong> </h2> </br>
             {{ Form::open(array('route'=>'examination.faculty.viewExaminers','method' => '')) }}
                     <div class="jumbotron text-center">

                      <h3><strong> Department:</strong>{{ $view_examination_amw->title }} </h3> </br>

                         <p>
                            <strong> Subject:</strong></br>
                            <strong> Name of Faculty:</strong> </br>
                            <strong> Status:</strong> </br>
                            <strong> Comments:</strong> </br>

                            <div class="form-group">
                                     {{ Form::label('comment', 'Comment') }}
                                     {{ Form::textarea('comment', Null, ['size' => '40x6','placeholder'=>'Your Comments Here']) }}

                            </div>

                         </p>
                     </div>
                     <a href="{{URL::to('examination/amw/examiners')}}" class="btn btn-default">Close </a>
                     {{ Form::submit('Comments', array('class' => 'btn btn-primary')) }}
             {{ Form::close() }}
</div>