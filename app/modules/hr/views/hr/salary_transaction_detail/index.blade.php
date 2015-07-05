<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
     <h3>Salary Transaction Details </h3>
</div>


<div style="padding: 2%; width: 99%;">
    <div class="modal-body">
        <div class="row">
            <div class="box box-solid ">
                <div class="col-sm-12">
                   <div class="pull-left col-sm-4"></div>
                   <div class="pull-right col-sm-4" style="padding: 5px;">
                        <button type="button" class="pull-right btn btn-sm btn-info" data-toggle="modal" data-target="#modal">
                          Add HR Salary Transaction
                        </button>
                   </div>
                </div>

                {{ Form::open([ 'route'=>'salary-transaction-detail-batch-delete' ])}}
                  <div class="box-body">
                    <table id="example" class="table table-striped  table-bordered" >
                        <thead>
                            {{ Form::submit('Delete Items', ['class'=>'btn btn-danger btn-xs', 'id'=>'hide-button', 'style'=>'display:none', 'onclick'=> "return confirm('Are you sure you want to delete?')"])}}
                            <tr>
                                <th><input name="id" type="checkbox" id="checkbox" class="checkbox" value=""></th>
                                <th>Type</th>
                                <th>Salary Allowance</th>
                                <th>Salary Deduction</th>
                                {{--<th>Over Time</th>--}}
                                <th>Bonus</th>
                                <th>Percentage(%)</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($model as $values)
                             <tr>
                                <td><input type="checkbox" name="id[]"  id="checkbox" class="myCheckbox" value="{{ $values->id }}"></td>
                                <td>{{ ucfirst($values->type) }}</td>
                                <td>{{ ucfirst($values->relHrSalaryAllowance->title) }}</td>
                                <td>{{ ucfirst($values->relHrSalaryDeduction->title) }}</td>
                                <td>{{ ucfirst($values->relHrBonus->title) }}</td>
                                <td>{{ $values->percentage }}</td>
                                <td>{{ $values->amount }}</td>
                                <td>
                                    <a href="{{ URL::route('show-salary-transaction-detail', ['s_t_d_id'=>$values->id ])  }}" class="btn btn-default btn-xs" title="Manage Applicant" data-toggle="modal" data-target="#modal-pc"><i style="color: #149bdf" class="fa fa-eye"></i></a>
                                    <a href="{{ URL::route('edit-salary-transaction-detail',['s_t_d_id'=>$values->id])  }}" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modal-pc"> <i style="color: #7b24dd" class="fa fa-edit"></i></a>
                                    <a data-href="{{ URL::route('destroy-salary-transaction-detail', ['s_t_d_id'=>$values->id ]) }}" class="btn btn-xs btn-default" data-toggle="modal" data-target="#confirm-delete" href="" ><i style="color: red" class="fa fa-trash-o" ></i></a>

                                </td>
                             </tr>
                            @endforeach
                        </tbody>
                    </table>
                  </div>
                {{form::close() }}

                {{Form::open(['route'=>'store-salary-transaction-detail', 'files'=>true])}}
                        @include('hr::hr.salary_transaction_detail._modal._modal')
                {{ Form::close() }}

                {{--Modal Area--}}
                <div class="modal fade" id="modal-pc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                    </div>
                  </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modal-footer">
    <a href="" class="pull-right btn btn-info" span class="glyphicon-refresh">Close</a>
</div>


