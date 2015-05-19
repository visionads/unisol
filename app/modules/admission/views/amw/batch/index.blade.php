@extends('layouts.layout')
@section('sidebar')
    @include('layouts._sidebar_amw')
@stop
@section('content')

    <div class="row">

    <div class="box box-solid ">

        <div class="col-sm-12">
           <div class="pull-left col-sm-4"> <h3> Batch Manage </h3>  </div>
           <div class="pull-right col-sm-4" style="padding-top: 1%;">
               <a class="pull-right btn btn-sm btn-info" href="{{ URL::to('admission/amw/batch-create/'.$degree_id )}}" data-toggle="modal" data-target="#modal" >Add Batch</a>
           </div>
        </div>

        {{ Form::open(array('url' => 'admission/amw/batch/batchDelete')) }}
       <div class="box-body">
        <table id="example" class="table table-striped  table-bordered" >
            <thead>
                  {{ Form::submit('Delete Items', array('class'=>'btn btn-danger btn-xs', 'id'=>'hide-button', 'style'=>'display:none'))}}
                <tr>
                    <th><input name="id" type="checkbox" id="checkbox" class="checkbox" value=""></th>
                    <th>Title</th>
                    <th>BN</th>
                    <th>Department</th>
                    <th>Year</th>
                    <th>Term</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @if(isset($batch))
              @foreach($batch as $b)
                <tr>
                   <td><input type="checkbox" name="id[]"  id="checkbox" class="myCheckbox" value="{{ $b->id }}"></td>
                   <td>{{ $b->relVDegree->title }}</td>
                   <td>{{ $b->batch_number }}</td>
                   <td>{{ $b->relVDegree->dept_title }}</td>
                   <td>{{ $b->relYear->title }}</td>
                   <td>{{ $b->relSemester->title }}</td>
                   <td>{{ $b->status }}</td>
                   <td>
                     <a href="{{ URL::to('admission/amw/batch/show/'.$b->id) }}" class="btn btn-xs btn-default" data-toggle="modal" data-target="#modal" style="font-size: 12px;color: darkmagenta"><span class="fa fa-eye"></span></a>
                     <a class="btn btn-xs btn-default" href="{{ URL::to('admission/amw/batch/edit/'.$b->id) }}" data-toggle="modal" data-target="#modal" style="font-size: 12px;color: lightseagreen"><i class="fa fa-edit"></i></a>
                     <a href="{{ URL::to('admission/amw/batch-adm-test-subject/'.$b->id)  }}" class="btn btn-info btn-xs" title="Manage AdmTest Subject" >MATS</a>
                     <a href="{{ URL::route('admission.amw.batch-waiver.index',['batch_id'=>$b->id ])  }}" class="btn btn-success btn-xs" title="Manage Waiver"  >MW</a>
                     <a href="{{ URL::route('admission.amw.batch-applicant.index',['id'=>$b->id ])  }}" class="btn btn-info btn-xs" title="Manage Applicant"  >MA</a>
                     <a href="{{ URL::route('admission.amw.batch_course',['id'=>$b->id,'degree_id'=>$b->degree_id])  }}" class="btn btn-success btn-xs" >BC</a>
                   </td>
                </tr>
               @endforeach
             @endif
            </tbody>

        </table>
        </div>

        {{form::close() }}

    </div>
</div>
    <div class="text-right">
        {{ $batch->links() }}
        <a class="pull-right btn btn-xs btn-primary" href="{{ URL::route('admission.amw.degree.index')}}"> <i class="fa fa-arrow-circle-left"></i> Back To Degree</a>
    </div>

    <p>&nbsp;</p>
    <p>&nbsp;</p>

    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="z-index:1050">
          <div class="modal-content">

         </div>
        </div>
    </div>
</div>

@stop