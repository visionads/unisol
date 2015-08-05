@extends('layouts.layout')
@section('sidebar')
    @include('layouts._sidebar_amw')
@stop
@section('content')

<div class="row">

    <div class="box box-solid ">

        <div class="col-sm-12">
           <div class="pull-left col-sm-4"> <h3> {{$pageTitle}} </h3>  </div>
           <div class="pull-right col-sm-4" style="padding-top: 1%;">
                <a href="{{ URL::route('manage-library-bill') }}" type="button" class="pull-right btn btn-sm btn-info" > >> Library Bill Manage </a>
           </div>
        </div>

       <div class="box-body">
        <table id="example" class="table table-striped  table-bordered" >
            <thead>
                <tr>
                    <th> Library TRN No# </th>
                    <th> User Name </th>
                    <th> Total Amount </th>
                    <th> status </th>
                    <th> Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $values)
                 <tr style="{{$values->status=='invoiced' ? 'background-color: burlywood' : '' }}">
                    <td><b>
                        {{ link_to_route($values->status!="invoiced" ?'library-details' : 'library-details', $values->lib_trn_no,['lib_id'=>$values->id], ['data-toggle'=>"modal", 'data-target'=>"#modal-pc"]) }}
                    </b></td>
                    <td> {{ $values->user_id }}</td>
                    <td>{{ $values->total_amount }}  </td>
                    <td>{{Str::title($values->status)}}</td>
                    <td>@if($values->status != 'invoiced')
                            <a href="{{ URL::route('library-create-invoice', ['lib_id'=>$values->id ])  }}" class="btn btn-default btn-xs" title="Create Invoice"><span class="fa fa-pencil"></span> + Invoice</a>
                            @endif
                    </td>

                 </tr>
                @endforeach
            </tbody>

        </table>
        </div>

    </div>

{{--    {{$data->links();}}--}}

</div>


{{-- Modal Area --}}
<div class="modal fade" id="modal-pc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    </div>
  </div>
</div>



@stop