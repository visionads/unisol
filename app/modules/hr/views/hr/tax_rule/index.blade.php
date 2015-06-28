@extends('layouts.layout')
@section('top_menu')
    @include('layouts._top_menu')
@stop
@section('sidebar')
    @include('layouts._sidebar_hr')
@stop
@section('content')

<div class="row">
    <div class="box box-solid ">
        <div class="col-sm-12">
           <div class="pull-left col-sm-4"> <h3> {{$pageTitle}} </h3>  </div>
           <div class="pull-right col-sm-4" style="padding-top: 1%;">
                <button type="button" class="pull-right btn btn-sm btn-info" data-toggle="modal" data-target="#modal">
                  Add HR Bank
                </button>
           </div>
        </div>

        {{ Form::open([ 'route'=>'tax_rule.batch_delete' ])}}

        <div class="box-body">
         <table id="example" class="table table-striped  table-bordered" >
            <thead>
                  {{ Form::submit('Delete Items', ['class'=>'btn btn-danger btn-xs', 'id'=>'hide-button', 'style'=>'display:none', 'onclick'=> "return confirm('Are you sure you want to delete?')"])}}
                <tr>
                    <th><input name="id" type="checkbox" id="checkbox" class="checkbox" value=""></th>
                    <th>Salary From</th>
                    <th>Salary To</th>
                    <th>Tax</th>
                    <th>Gender</th>
                    <th>Nationality</th>
                    <th>Additional Tax Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($model as $values)
                 <tr>
                    <td><input type="checkbox" name="id[]"  id="checkbox" class="myCheckbox" value="{{ $values->id }}"></td>
                    <td>{{ $values->salary_from }}</td>
                    <td>{{ $values->salary_to }}</td>
                    <td>{{ $values->tax }} %</td>
                    <td>{{ ucfirst($values->gender) }}</td>
                    <td>{{ $values->nationality }}</td>
                    <td>{{ $values->additional_tax_amount }}</td>
                    <td>
                        <a href="{{ URL::route('tax_rule.show', ['t_r_id'=>$values->id ])  }}" class="btn btn-default btn-xs" title="Manage Applicant" data-toggle="modal" data-target="#modal-pc"><i style="color: #149bdf" class="fa fa-eye"></i></a>
                        <a href="{{ URL::route('tax_rule.edit',['t_r_id'=>$values->id])  }}" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modal-pc"> <i style="color: #7b24dd" class="fa fa-edit"></i></a>
                        <a data-href="{{ URL::route('tax_rule.destroy', ['t_r_id'=>$values->id ]) }}" class="btn btn-xs btn-default" data-toggle="modal" data-target="#confirm-delete" href="" ><i style="color: red" class="fa fa-trash-o" ></i></a>
                    </td>
                 </tr>
                @endforeach
            </tbody>
         </table>
        </div>
        {{form::close() }}
    </div>
</div>
{{Form::open(['route'=>'tax_rule.store', 'files'=>true])}}
        @include('hr::hr.tax_rule._modal._modal')
{{ Form::close() }}

{{-- Modal Area --}}
<div class="modal fade" id="modal-pc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    </div>
  </div>
</div>

@stop