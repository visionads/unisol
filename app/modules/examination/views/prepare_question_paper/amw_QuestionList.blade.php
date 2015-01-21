@extends('layouts.master')

@section('sidebar')
    @include('examination::prepare_question_paper._sidebar')
@stop

@section('content')


             <h1>Welcome to Question List : AMW </h1> <br>


              <table id="example" class="table table-striped  table-bordered"  >
                     <thead>

                           <div class="btn-group" style="margin-right: 10px">
                              <a class="btn btn-default" data-toggle="modal" data-target="#AddQuestionModal">Add Question</a>
                           </div>

                           {{--page content start from here--}}
                          <br>
                               {{ Form::submit('Delete Items', array('class'=>'btn btn-danger', 'id'=>'hide-button', 'style'=>'display:none'))}}
                          <br>


                         <tr>
                             <th><input name="id" type="checkbox" id="checkbox" class="checkbox" value=""></th>

                             <th>Title</th>
                             <th>Type</th>
                             <th>Marks</th>
                             <th>Action</th>
                         </tr>
                     </thead>
                     <tbody>

                       @foreach($QuestionListAmw as $question_list_amw)
                         <tr>

                             <td><input type="checkbox" name="id[]"  id="checkbox" class="myCheckbox" value="  {{ $question_list_amw->id }}"></td>

                             <td>a</td>
                             <td>a</td>
                             <td>a</td>
                            <td>
                              <a type="button" class="btn btn-info" data-toggle="modal" data-target="#EditQuestionPaperModal"> Edit Question Papers </a>


                            </td>

                         </tr>
                             @endforeach

                     </tbody>
              </table>



@include('examination::prepare_question_paper/_modal');
@stop

