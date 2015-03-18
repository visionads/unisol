@extends('layouts.layout')

@section('sidebar')
 @include('layouts._sidebar_amw')
@stop

@section('content')





 <div class="box box-solid ">
        <div class="box box-info">
              <div class="box-header">
              <h3 class="box-title">Degree </h3>
              <div class="box-tools pull-right">
                                     <a class="pull-right btn btn-sm btn-info" href="{{ URL::to('admission/amw/degree/create')}}" data-toggle="modal" data-target="#degreeModal" style="color: #ffffff"><b>Add Degree</b></a>
                                </div>
              <p>&nbsp;</p>
 {{-------------------------------------------------------------Searching Starts--------------------------------------------------------------}}
   {{--<table id="example1">--}}

            {{--{{ Form::open(array('url'=>'admission/amw/degree/search','class'=>'form-horizontal')) }}--}}

             {{--<div  class="col-lg-3">{{ Form::label('search_department', 'Department') }}--}}
             {{--{{ Form::select('search_department', $department , Input::old('search_department'),['class'=>'form-control input-sm '])}}</div>--}}
             {{--<p>&nbsp;</p>--}}
            {{--{{ Form::submit('Search',['class'=>'pull-left btn btn-xs btn btn-success']) }}--}}
    {{--</table>--}}
             {{--{{ Form::close() }}--}}

 {{--------------------------------------------------------------Searching Ends--------------------------------------------------------------------}}
              </div>
              <div class="box-body">
                   <div class="row">
                       <div class="col-lg-12">
                       {{ Form::open(array('url' => 'admission/amw/degree/batch_delete')) }}
                          <table class="table table-bordered">
                                 <thead>
                                         <tr>
                                             <th>
                                                 <input name="id" type="checkbox" id="checkbox" class="checkbox" value="">
                                             </th>
                                            <th>Degree Program(Title)</th>
                                            <th>Department</th>
                                            <th>Total Credit</th>
                                            <th>Duration</th>
                                            <th>Action</th>
                                         </tr>
                                 </thead>
                                        <tbody>
                                              @if(isset($model))
                                                    @foreach($model as $value)
                                                        <tr>
                                                            <td><input type="checkbox" name="ids[]"  class="myCheckbox" value="{{ $value->id }}">
                                                            </td>
                                                            <td>{{ $value->relDegreeProgram->title }}</td>
                                                            <td>{{ $value->relDepartment->title }}</td>
                                                            <td>{{ $value->total_credit}}</td>
                                                            <td>{{ $value->duration}}</td>


                                                            <td>
                                                                 <a href="{{ URL::to('admission/amw/degree/show/'.$value->id) }}" class="btn btn-xs btn-default" data-toggle="modal" data-target="#degreeModal" style="font-size: 12px;color: darkmagenta"><span class="fa fa-eye"></span></a>
                                                                 <a class="btn btn-xs btn-default" href="{{ URL::to('admission/amw/degree/edit/'.$value->id) }}" data-toggle="modal" data-target="#degreeModal" style="font-size: 12px;color: lightseagreen"><i class="fa fa-edit"></i></a>
                                                                 <a data-href="{{ URL::to('admission/amw/degree/delete/'.$value->id) }}" class="btn btn-xs btn-default" data-toggle="modal" data-target="#confirm-delete" style="font-size: 12px;color: lightcoral"><span class="fa  fa-trash-o"></span></a>
                                                                 <a href="{{ URL::route('degree_manage.waiver', $value->id) }}" class="btn btn-xs btn-default" style="font-size: 12px;color: darkmagenta">DC</a>

                                                            </td>
                                                        </tr>
                                                    @endforeach
                                              @endif
                                        </tbody>
                       {{ Form::submit('Delete Items', array('class'=>'btn btn-xs btn-danger', 'id'=>'hide-button', 'style'=>'display:none'))}}
                          </table>
                       {{ Form::close() }}
                       </div>
                   </div>
              </div>
        </div>

 </div>
<div class="text-right">
    {{ $model->links() }}
</div>

{{----------------------------------------------Modal : degreeGroupModal--------------------------------------------------------------------------}}
<div class="modal fade" id="degreeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

       </div>
      </div>
 </div>


 <!-- Modal for delete -->
    <div class="modal fade " id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
              </div>
              <div class="modal-body">
                    <strong>Are you sure to delete?</strong>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a href="#" class="btn btn-danger danger">Delete</a>

              </div>
        </div>
      </div>
    </div>

@stop