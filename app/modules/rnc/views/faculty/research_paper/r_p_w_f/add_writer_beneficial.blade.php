<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
     <h4> Writer and Beneficial list of "<b>{{ $r_p->title }}</b>" Research Paper </h4>
</div>


<div style="padding: 2%; width: 99%;">
    <div class="modal-body " >
        {{Form::open(['route'=>'faculty.research-paper-writer-beneficial.store-writer-beneficial'])}}
            @include('rnc::faculty.research_paper.r_p_w_f._w_f_form')
        {{ Form::close() }}
    </div>
</div>
