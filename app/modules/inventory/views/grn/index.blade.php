@extends('layouts.layout')
@section('sidebar')
    @include('inventory::_sidebar._inventory')
@stop
@section('content')

<div class="row">

    <div class="box box-solid ">

        <div class="col-sm-12">
           <div class="pull-left col-sm-4"> <h3> {{ $pageTitle }} </h3>  </div>
        </div>

       <div class="box-body">
        <table id="example" class="table table-striped  table-bordered" >
            <thead>
                <tr>
                    <th> PO No: </th>
                    <th> Voucher No: </th>
                    <th> date </th>
                    <th> Supplier  </th>
                    <th> Req. No:</th>
                    <th> Pay Terms </th>
                    <th> Tax (%) </th>
                    <th> Tax Amt.</th>
                    <th> Discount (%) </th>
                    <th> Disc. Amt</th>
                    <th> Amount </th>
                    <th> Net Amt.</th>
                    <th> status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @if(isset($data))
                @foreach($data as $values)
                 <tr style="{{$values->status=='approved' ? 'background-color: burlywood' : '' }}">
                    <td width="80"><b>
                        {{ link_to_route($values->status!="approved" ?'show-grn-detail' : 'create-grn', $values->relInvPurchaseOrderHead->purchase_no ,['po_id'=>isset($values->inv_po_head_id) ? $values->inv_po_head_id : ""], ['data-toggle'=>"modal", 'data-target'=>"#modal-pc"]) }}
                    </b></td>
                    <td>{{ $values->voucher_no}}</td>
                    <td>{{ $values->date }}  </td>
                    <td>{{ $values->inv_supplier_id }}</td>
                    <td>{{ $values->inv_requisition_head_id }}</td>
                    <td>{{ $values->pay_terms }} </td>
                    <td>{{ round($values->tax_rate, 0) }}</td>
                    <td>{{ round($values->tax_amount, 2) }}</td>
                    <td>{{ round($values->discount_rate, 0) }}</td>
                    <td>{{ round($values->discount_amount, 2) }}</td>
                    <td>{{ round($values->amount, 2) }}</td>
                    <td>{{ round($values->net_amount, 2) }}</td>
                    <td>{{ Str::title($values->status) }}</td>

                    <td>
                        @if($values->status != 'approved')
                            <a href="{{ URL::route('create-grn', ['grn_id'=>$values->id,'po_id'=>$values->inv_po_head_id ]) }}" class="btn btn-xs btn-default" data-toggle="modal" data-target="#modal-pc" ><i class="fa fa-2x" style="color: darkslategray" data-toggle="tooltip" data-placement="bottom" title="Cancel"></i> + Create GRN</a>
                            <a href="{{ URL::route('create-grn', ['po_id'=>$values->id ]) }}" class="btn btn-xs btn-default" data-toggle="modal" data-target="#confirm-delete" ><i class="fa fa-2x" style="color: darkslategray" data-toggle="tooltip" data-placement="bottom" title="Cancel"></i> Confirm GRN</a>
                        @endif
                    </td>

                 </tr>
                @endforeach
            @endif
            </tbody>

        </table>
        </div>

    </div>

{{--    {{$data->links();}}--}}

</div>


{{-- Modal Area --}}
<div class="modal fade" id="modal-pc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="z-index:1050">
    <div class="modal-content">
    </div>
  </div>
</div>



@stop