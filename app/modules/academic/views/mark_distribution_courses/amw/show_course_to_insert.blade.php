<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title">Show Course Item config</h4>
</div>
<div class="modal-body">

    <p> Total Marks: {{ $datas->evaluation_total_marks}}</p>


    <div class="form-horizontal">
        <div class="form-group">
            {{ Form::text('course_id', $datas->course_id, ['class'=>'form-control course_id'])}}
            {{ Form::text('course_title', $datas->course_title, ['class'=>'form-control course_title'])}}
            {{--{{ Form::text('course_type', $datas->course_type_title, ['class'=>'form-control course_type'])}}--}}
            {{ Form::hidden('course_evaluation_total_marks', $datas->evaluation_total_marks, ['class'=>'form-control course_evalution_marks'])}}
        </div>
        <div class="form-group">
            <div class="col-md-4">
                {{ Form::select('acm_marks_dist_item_id', [''=>'Select Option'] + AcmMarksDist::orderBy('title')->lists('title', 'id'),Input::old('acm_marks_dist_item_id'), ['class'=>'form-control addConfigListItem']) }}
            </div>
            <div class="col-md-4">
                {{ Form::submit('ADD', ['class'=>'btn btn-info addConfigList','onClick'=>'addCourseListItem()']) }}
            </div>
        </div>
    </div>


    {{ Form::open(array('url'=>'amw/course/marks/save','method' => '')) }}
    <table class="table table-bordered small-header-table">
        <thead>
        <th>Item</th>
        <th>Marks (%)</th>
        <th>Actual Marks</th>
        <th>Read Only</th>
        <th>Default Item?</th>
        <th>Is Attendance</th>
        <th>Action</th>
        </thead>
        {{ Form::text('course_type', $datas->course_type_id, ['class'=>'form-control course_type'])}}

        {{ Form::text('course_type', $datas->course_type_title, ['class'=>'form-control course_type'])}}
        <tbody class="acm_course_config_list">


        {{--To edit data Retrive value from database--}}
        {{--@foreach($course_data as $key=>$value)--}}
            {{--<tr>--}}
                {{--<td width="130">--}}
                    {{--{{ Form::text('acm_config_id[]', $value->id)}}--}}
                    {{--{{ Form::text('acm_marks_dist_item_id[]', $value->item_id )}}--}}
                    {{--{{ $value->acm_dist_item_title }}--}}
                {{--</td>--}}
                {{--<td> <input type="text" name="marks_percent[]" value="{{ ($value->actual_marks/$value->evaluation_total_marks) * 100 }}" class="amw_marks_percent{{$key}}" onkeyup="calculateActualMarks(this.className, {{$value->evaluation_total_marks}},this.value)" required/> </td>--}}
                {{--<td>--}}
                    {{--<input type="text" name="actual_marks[]" value="{{$value->actual_marks}}" class="amw_actual_marks" readonly/>--}}
                {{--</td>--}}
                {{--<td>--}}
                    {{--<span><input type="checkbox" name="isReadOnly[]" value="1" class="amw_isReadOnly" {{ ($value->readonly == 1) ? 'checked' : '' }} /> </span>--}}
                {{--</td>--}}
                {{--<td width="120">--}}
                    {{--<input type="radio" id="isDefault1" name="isDefault[]" value="1" class="amw_isDefault" {{ ($value->default_item == 1) ? 'checked' : '' }}/>--}}
                {{--</td>--}}
                {{--<td width="120">--}}
                    {{--<span><input type="radio" name="isAttendance[]" value="1" class="amw_isAttendance" {{ ($value->is_attendance == 1) ? 'checked' : '' }}/></span>--}}
                {{--</td>--}}
                {{--<td>--}}
                    {{--<a class="btn btn-default btn-sm" id="removeTrId{{$key}}" onClick="deleteNearestTr(this.id)"><span class="glyphicon glyphicon-trash text-danger"></span></a>--}}
                {{--</td>--}}
            {{--</tr>--}}
        {{--@endforeach--}}
       {{--End Edit--}}


        </tbody>
        <tr>
            <td colspan="6">{{ Form::submit('Submit', ['class'=>'btn btn-info'] ) }}</td>
        </tr>

    </table>
    {{Form::close()}}


</div>
<div class="modal-footer">
    <a href="{{URL::to('amw/config/index')}}" class="btn btn-default">Close </a>
</div>