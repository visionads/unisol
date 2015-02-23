<div class="modal fade" id="AddExamination" tabindex="-1" role="dialog" aria-labelledby="showingModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Examination</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => 'examination/amw/storeExamination', 'method' =>'post', 'role'=>'form','files'=>'true'))  }}
                        @include('examination::amw/prepare_question_paper/_addExamination_form')
                {{ Form::close() }}
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>