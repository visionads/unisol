<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
     <h4><b> Update of Bonus</b> </h4>
</div>

<div style="padding: 2%; width: 99%;">
    <div class="modal-body">

        {{Form::model($model, ['route'=> ['bonus.edit', $model->id], 'method' => 'patch', 'role' => 'form', 'files' => true,])}}
                {{ Form::hidden('id', $model->id) }}
                @include('hr::hr.bonus._form')
        {{ Form::close() }}

    </div>
</div>
