<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
     <h5> View Examination "{{ User::FullName($view_examination->user_id) }}"</h5>
</div>

<div style="padding-left: 8%; width: 90%;">
    {{Form::open(array('route'=>'faculty.examination-list.save-examiner-comment','method' => 'POST')) }}
                {{Form::hidden('exm_exam_list_id', $view_examination->exm_exam_list_id)}}
                {{Form::hidden('commented_to', $view_examination->user_id)}}
                <table class="table table-striped  table-bordered">
                    <tr>
                        <td><strong> Department:</strong></td>
                        <td>{{ $view_examination->relExmExamList->relCourseConduct->relDegree->relDepartment->title }}</td>
                    </tr>
                    <tr>
                        <td><strong> Subject:</strong></td>
                        <td>{{ $view_examination->relExmExamList->relCourseConduct->relCourse->relSubject->title }}</td>
                    </tr>
                    <tr>
                        <td><strong> Name Of Faculty:</strong></td>
                        <td>{{ isset($view_examination->user_id) ? User::FullName($view_examination->user_id) : 'No Faculty' }}</td>
                    </tr>

                    <tr>
                        <td><strong> Status:</strong></td>
                        <td>{{ ucfirst($view_examination->status) }}
                            @if($view_examination->status == 'requested' )
                                <a class="btn btn-primary btn-xs" data-href="{{ URL::route('faculty.examination-list.change-status-to-accept',['id'=>$view_examination->id]) }}" data-toggle="modal" data-target="#confirm-delete" href="">Accept</a>
                                <a class="btn btn-success btn-xs" data-href="{{ URL::route('faculty.examination-list.change-status-to-deny',['id'=>$view_examination->id]) }}" data-toggle="modal" data-target="#confirm-delete" href="">Deny</a>
                            @endif
                        </td>
                    </tr>
                </table>

                 <small>Comments: </small>

                         @if(isset($view_examiner_comments))
                             @foreach($view_examiner_comments as $do_comments)
                                <p style="padding: 1%; background: #efefef;">
                                  To:<b><small>{{ User::FullName($do_comments->commented_to); }}</small></b>
                                  As &nbsp; <b><small>{{  strtoupper(Role::RoleName($do_comments->commented_to)) }} </small></b><br>

                                    &nbsp; &nbsp; &nbsp; {{ $do_comments->comment }} </b><br>

                                  By:<b><small>{{ User::FullName($do_comments->commented_by); }}</small></b>
                                  As &nbsp; <b><small>{{  strtoupper(Role::RoleName($do_comments->commented_by)) }} </small></b><br>
                                </p>
                            @endforeach
                         @endif

                        <div class="form-group">
                              {{ Form::textarea('comment', Null, ['onkeyup'=>"javascript:this.value=this.value.replace(/[<,>]/g'');",'class' => 'form-control', 'placeholder'=>'Your Comments Here', 'style'=>'height: 100px;']) }}
                        </div>

                        {{ Form::submit('Submit Comment', array('class'=>'pull-right btn-sm btn-info')) }}
                        <a href="" class="pull-right btn-sm btn-primary" style="margin-right: 5px" span class="glyphicon-refresh">Close</a>
                        &nbsp;
                        </br>
                        &nbsp;

    {{ Form::close() }}



             <!-- Modal :: Delete Confirmation -->
                     <div class="modal fade " id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="confirm-delete" aria-hidden="true">
                       <div class="modal-dialog">
                         <div class="modal-content">
                               <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                 <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
                               </div>
                               <div class="modal-body">
                                     <strong>Are you sure ?</strong>
                               </div>
                               <div class="modal-footer">
                                     <a href="" class="btn-sm btn-default">Close</a>
                                     <a href="#" class="btn-sm bg-blue btn-Success danger">OK</a>
                               </div>
                         </div>
                       </div>
                     </div>

                     <script>
                               $('#confirm-delete').on('show.bs.modal', function(e) {
                                  $(this).find('.danger').attr('href', $(e.relatedTarget).data('href'));
                                  $('.debug-url').html('Delete URL: <strong>' + $(this).find('.danger').attr('href') + '</strong>');
                              })
                     </script>

</div>