<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
     <h4> Update:  <b>{{$model->title}}</b> </h4>
</div>

<div style="padding: 2%; width: 99%;">
<div class="modal-body">

    {{Form::model($model, ['route'=> ['product/category/edit', $model->id], 'method' => 'patch', 'role' => 'form', 'files' => true,])}}
            {{ Form::hidden('id', $model->id) }}
            @include('inventory::product_category._form')
    {{ Form::close() }}

</div>
</div>

{{--
<div class="modal-footer">
    <a href="" class="pull-right btn btn-info" span class="glyphicon-refresh">Close</a>
</div>--}}
