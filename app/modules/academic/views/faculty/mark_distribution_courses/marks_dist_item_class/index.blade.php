@extends('layouts.layout')
@section('sidebar')
    @include('academic::_sidebar')
@stop
@section('content')
    <h4 style="text-align: center ;color: #800080; font-size: large">{{$title}}</h4>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addClass" style="margin-bottom: 5px">Add Class</button>
    <table id="example" class="table table-bordered table-hover table-striped">
        <thead>
        <th>Title</th>
        <th>Description</th>
        <th>status</th>
        <th>Class date</th>
        <th>Action</th>
        </thead>
        <tbody>

        @foreach ($datas as $value)
            <tr>
                <td>{{$value->title}}</td>
                <td>{{$value->description}}</td>
                <td>{{($value->status == 1) ? 'Active' : 'Inactive';}}</td>
                <td>{{$value->relAcmClassSchedule->day}}</td>
                <td>
                    <a href="{{ URL::route('class.edit', ['id'=>$value->id]) }}" class="subEdit btn btn-xs btn-default" data-toggle="modal" data-target="#editModal" href="" ><i class="fa fa-pencil-square-o" style="font-size: 18px"></i></a>

                    <a href="{{ URL::route('class.show', ['id'=>$value->id])  }}" class="btn btn-xs btn-default" data-toggle="modal" data-target="#showModal" href=""><i class="fa fa-eye" style="font-size: 18px"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{--All Modal--}}
    {{---------------------------------------------}}
    <!-- Add New class Modal -->
    <div id="addClass" class="modal fade" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"style="text-align: center ;color: #800080">Marks Distribution Item:Class</h4>
                </div>
                <div class="modal-body">
                    {{ Form::open(array('url' => 'academic/faculty/marksdistitem/class/save', 'method' =>'post', 'role'=>'form','files'=>'true')) }}
                    {{ Form::hidden('course_management_id', $cmid, ['class'=>'form-control course_management_id'])}}
                    {{ Form::hidden('marks_dist_id', $marks_dist_id, ['class'=>'form-control course_management_id'])}}
                    @include('academic::faculty.mark_distribution_courses.marks_dist_item_class._form')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

    {{--Show single class info --}}
    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="addScholarship" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Edit Class Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="addScholarship" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@stop
@section('script_section')
    <script>
        function deleteAcaDetailsImage(getId, acaId)
        {
            var aca_details_id = acaId;
            var url = '{{URL::to('academic/faculty/acadetailsdelete/ajax')}}' ;
            var token = $('.edit_modal_aca').find('input[name="_token"]').val();
            //console.log(url);
            if(aca_details_id > 0){

                var check = confirm("Are you sure to delete this item??");
                if(check)
                {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        dataType: 'json',
                        data: {aca_academic_details_id: aca_details_id, token: token}
                    })
                            .done(function(msg) {
                                console.log(msg);
                                var whichtr = $('#'+getId).closest("p");
                                whichtr.fadeOut(500).remove();
                            });
                }
                else
                {
                    return false;
                }
            }
        }
    </script>

@stop