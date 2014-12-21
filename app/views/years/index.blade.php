@extends('layouts.master')

@section('sidebar')
    @include('years.sidebar')
@stop

@section('content')
<h1>{{$title}}</h1>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="margin-bottom: 20px">
                 Add New Subject
                </button>
     {{ Form::open(array('url' => 'batch/delete')) }}
        <table id="example" class="table table-bordered">
        <thead>
            <tr>
              <th>
              <input name="id" type="checkbox" id="checkbox" class="checkbox" value="">
               </th>
                <th>Id</th>
                <th>Year </th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
 
        <tbody>
            @foreach ($datas as $value)
            <tr>
                <td><input type="checkbox" name="id[]"  id="checkbox" class="myCheckbox" value="{{ $value->id }}">
                </td>
                <td>{{$value->id}}</td>
                <td>{{$value->title}}</td>
                <td>{{$value->description}}</td>
                <td> 
                  <a data-href="{{ URL::to('years/delete/'.$value->id) }}" class="btn btn-sm btn-default" data-toggle="modal" data-target="#confirm-delete" href="" ><span class="glyphicon glyphicon-trash text-danger"></span></a>

                   <a href="{{ URL::route('years.edit', ['id'=>$value->id]) }}" class="subEdit btn btn-sm btn-default" data-toggle="modal" data-target="#edit-modal" href="" ><span class="glyphicon glyphicon-edit text-info"></span></a>

                   <a href="{{ URL::route('years.show', ['id'=>$value->id])  }}" class="btn btn-default" data-toggle="modal" data-target="#show-modal" href=""><span class="glyphicon glyphicon-list-alt text-info"></span></a>
                </td>
            </tr>
            @endforeach
          </tbody>
          {{ Form::submit('Delete Items', array('class'=>'btn btn-danger', 'id'=>'hide-button', 'style'=>'display:none'))}}
    </table>
    {{ Form::close() }}

    {{ $datas->links() }}
         

    <!-- Modal for Edit -->
   <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="showingModal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

        </div>
        <div class="modal-footer">
       <!--  <button type="button" class="btn btn-default close" data-dismiss="modal">Close</button> -->
      </div>
      </div>
   </div>

          
<!-- Modal for show -->
   <div class="modal fade" id="show-modal" tabindex="-1" role="dialog" aria-labelledby="showingModal" aria-hidden="true">
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
                <button type="button" class="btn btn-default close" data-dismiss="modal">Cancel</button>
                <a href="#" class="btn btn-danger danger">Delete</a>

              </div>
        </div>
      </div>
    </div>

    <!-- Modal add new subject -->
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Add New Subject</h4>
                </div>
                <div class="modal-body">
                   {{ Form::open(array('url' => 'years/save', 'method' =>'post', 'role'=>'form','files'=>'true')) }}

                       @include('years._form')

                  <button type="button" class="btn btn-danger close" data-dismiss="modal">Cencel</button>
                    {{ Form::close() }}

                </div>
                <div class="modal-footer">                  
                </div>
            </div>
        </div>
    </div>


@stop