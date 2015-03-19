@extends('layouts.layout')
@section('sidebar')
    @include('layouts._sidebar_amw')
@stop
@section('content')
    <div class="box-body">
        <div class="row">
            <div class="col-lg-12">
                <h4 style="color: #800080"><strong>Year:</strong></h4>
                <h4 style="color: #800080">Spring</h4>
                <table id="" class="table table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th>Title With Code</th>
                        <th>Department</th>
                        <th>Type</th>
                        <th>Credit</th>
                        <th>Mandatory</th>
                        <th>Faculty</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{--@foreach ($deg_course_info as $value)--}}
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <a data-href="" class="btn btn-xs btn-default" data-toggle="modal" data-target="#confirm-delete" href="" ><i class="fa fa-trash-o" style="color: red"></i></a>
                            </td>
                        </tr>
                    {{--@endforeach--}}
                    </tbody>
                </table>
                <h4 style="color: #800080">Summer</h4>
                <table id="" class="table table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th>Title With Code</th>
                        <th>Department</th>
                        <th>Type</th>
                        <th>Credit</th>
                        <th>Mandatory</th>
                        <th>Faculty</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{--@foreach ($deg_course_info as $value)--}}
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <a data-href="" class="btn btn-xs btn-default" data-toggle="modal" data-target="#confirm-delete" href="" ><i class="fa fa-trash-o" style="color: red"></i></a>
                        </td>
                    </tr>
                    {{--@endforeach--}}
                    </tbody>
                </table>
                <h4 style="color: #800080">Fall</h4>
                <table id="" class="table table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th>Title With Code</th>
                        <th>Department</th>
                        <th>Type</th>
                        <th>Credit</th>
                        <th>Mandatory</th>
                        <th>Faculty</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{--@foreach ($deg_course_info as $value)--}}
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <a data-href="" class="btn btn-xs btn-default" data-toggle="modal" data-target="#confirm-delete" href="" ><i class="fa fa-trash-o" style="color: red"></i></a>
                        </td>
                    </tr>
                    {{--@endforeach--}}
                    </tbody>
                </table>

                <h4 style="color: #800080"><strong>Courses of__Degree</strong></h4>

            </div>
        </div>
    </div>

    {{-- Modal for delete --}}
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
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