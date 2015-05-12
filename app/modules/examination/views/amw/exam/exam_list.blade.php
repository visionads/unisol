@extends('layouts.layout')
@section('sidebar')
    @include('layouts._sidebar_amw')
@stop
@section('content')

<a class="pull-right btn btn-sm btn-info" href="{{ URL::to('examination/amw/create-exam/'.$course_conduct_id }}" data-toggle="modal" data-target="#exam-data" style="color: #ffffff" title="New Degree"><b>Add Examination</b></a>

<h3>Examination</h3>

<div class="row">
   <div class="col-md-12 ">
      <div class="box box-solid">
          <div>
               <p>
                  {{ Form::open(array('url'=>'admission/amw/degree/search','class'=>'form-horizontal')) }}
                    <div  class="col-lg-3">
                        <div class="input-group input-group-sm">
                            {{--{{ Form::select('search_department', $department , Input::old('search_department'),['class'=>'form-control input-sm '])}}--}}
                            <span class="input-group-btn">
                                <button class="btn btn-info btn-flat" type="submit" title="Search ..">Search</button>
                            </span>
                        </div>
                    </div>


                {{ Form::close() }}
               </p>
          </div>

          {{ Form::open(array('url' => 'examination/amw/batchDelete')) }}
                 <table id="example" class="table table-striped  table-bordered"  >
                        <thead>
                               {{ Form::submit('Delete Items', array('class'=>'btn btn-danger', 'id'=>'hide-button', 'style'=>'display:none'))}}

                               <br>
                               <tr>
                                  <th><input name="id" type="checkbox" id="checkbox" class="checkbox" value=""></th>
                                  <th>Title</th>
                                  <th>Dept</th>
                                  <th>Course</th>
                                  <th>Type</th>
                                  <th>Year</th>
                                  <th>Term</th>
                                  <th>Action</th>
                               </tr>
                        </thead>
                        <tbody>
                            @if(isset($exam_data))
                                @foreach($exam_data as $exam_list)
                                      <tr>
                                          <td><input type="checkbox" name="id[]" class="myCheckbox" value=""></td>
                                          <td>{{ $exam_list->title }}</td>
                                          <td>{{ $exam_list->relCourseConduct->relCourse->relSubject->relDepartment->title}}</td>
                                          <td>{{ $exam_list->relCourseConduct->relCourse->title}}</td>
                                          <td>{{ $exam_list->relAcmMarksDistItem['title']}}</td>
                                          <td>{{$exam_list->relYear->title}}</td>
                                          <td>{{$exam_list->relSemester->title}}</td>

                                          <td>
                                             <a href="{{ URL::route('examination.amw.view-exam-data', ['id'=>$exam_list->id])  }}" class="btn btn-default btn-xs" data-toggle="modal" data-target="#exam-data" title="Show" style="font-size: 11px;color: darkmagenta"><span class="fa fa-eye"></span></a>
                                             <a href="{{ URL::route('examination.amw.edit-exam-data', ['id'=>$exam_list->id])  }}" class="btn btn-default btn-xs" data-toggle="modal" data-target="#exam-data" title="Edit" style="font-size: 12px;color: lightseagreen"><i class="fa fa-edit"></i></a>
                                             <a data-href="{{URL::route('examination.amw.delete-exam-data', ['id'=>$exam_list->id]) }}" class="btn btn-xs btn-default" data-toggle="modal" data-target="#confirm-delete" style="font-size: 12px;color: lightcoral"><span class="fa  fa-trash-o"></span></a>
                                          </td>
                                      </tr>
                                @endforeach
                            @endif
                        </tbody>
                 </table>
             {{form::close() }}

             <p>&nbsp;</p>
      </div>
   </div>
</div>

<!-- Modal  -->
<div class="modal fade" id="exam-data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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