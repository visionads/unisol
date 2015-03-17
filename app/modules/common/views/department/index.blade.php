@extends('layouts.layout')
@section('sidebar')
    @include('layouts._sidebar_amw')
@stop
@section('content')
    <h4 style="text-align: center;color: #800080;font-size: x-large">All Department List</h4>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#CreateModal" style="margin-bottom: 20px">
        Add New
    </button>
    {{ Form::open(array('url' => 'department/batchDelete')) }}
    <table id="example" class="table table-bordered table-hover table-striped">

        <thead>
        <tr>
            <th>
                <input name="id" type="checkbox" id="checkbox" class="checkbox" value="">
            </th>
            <th>Department Name</th>
            <th>Department Head</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($departmentList as $department)
            <tr>
                <td><input type="checkbox" name="ids[]"  class="myCheckbox" value="{{ $department->id }}"></td>
                <td align="left">{{ $department->title }}</td>
                <td align="left">{{ User::FullName($department->dept_head_user_id)  }}</td>
                <td>{{ $department->description }}</td>
                <td>
                    <a data-href="{{ URL::to('department/delete/'.$department->id) }}" class="btn btn-sm btn-default" data-toggle="modal" data-target="#confirm-delete" href="" ><i class="fa  fa-trash-o" style="font-size: 12px;color: red"></i></a>

                    <a href="{{ URL::to('department/edit/' . $department->id ) }}" class="subEdit btn btn-sm btn-default" data-toggle="modal" data-target="#myeditModal" href="" ><i class="fa fa-pencil-square-o" style="font-size: 12px;color: #0044cc"></i></a>

                    <a href="{{ URL::to('department/show/'.$department->id) }}" class="btn btn-sm btn-default" data-toggle="modal" data-target="#confirm-show"><i class="fa fa-eye" style="font-size: 12px;color: green"></i></a>
                </td>
            </tr>
        @endforeach
        <div>
        </div>
        </tbody>
        {{ Form::submit('Delete Items', array('class'=>'btn btn-danger', 'id'=>'hide-button', 'style'=>'display:none'))}}
    </table>
    {{ Form::close() }}
    <div class="text-left">
        {{ $departmentList->links() }}
    </div>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <!-- Modal :: Delete Confirmation -->
    <div class="modal fade " id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" style="text-align: center;color: #800080;font-size: x-large">Confirm Delete</h4>
                </div>
                <div class="modal-body">
                    <strong>Are you sure to delete?</strong>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-danger danger">Delete</a>
                    <a href="{{URL::to('common/department/index')}}" class="btn btn-default">Close </a>
                </div>
            </div>
        </div>
    </div>
    {{--Model: for showing single row info--}}
    <div class="modal fade " id="confirm-show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

            </div>
        </div>
    </div>

    <!-- Modal :Add new Department-->
    <div class="modal fade" id="CreateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add New Department</h4>
                </div>
                <div class="modal-body">
                    {{ Form::open(array('url' => 'department/store', 'method' =>'post', 'role'=>'form','files'=>'true')) }}
                    @include('common::department._form')
                    {{ Form::close() }}
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    {{--Modal : edit --}}

    <div class="modal fade" id="myeditModal" tabindex="-1" role="dialog" aria-labelledby="showingModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">

            </div>
        </div>
    </div>
@stop

