@extends('layouts.layout')
@section('top_menu')
    @include('layouts._top_menu')
@stop
@section('sidebar')
    @include('layouts._sidebar_amw')
@stop
@section('content')
    <div class="row" xmlns="http://www.w3.org/1999/html">
        <div class="col-md-12">
            <h3 class="text-blue text-uppercase">Fees::Billing Installment</h3>
        </div><!-- ./col -->
    </div><!-- /.row -->
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"></li>
                   {{-- <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            Settings  <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li role="presentation" data-toggle="modal" data-target="#addCategory"><a role="menuitem" tabindex="-1" href="#"> </a>
                            </li>
                        </ul>
                    </li>--}}
                </ul>
                <button type="button" class=" btn btn-success fa fa-plus pull-right" data-toggle="modal" data-target="#addInstallment" >Add Installment</button>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">

                        {{--****************** Filter :Starts ***********************--}}
                        {{Form::open(array('route'=> ['installment.setup']))}}
                        <fieldset class="well the-fieldset2">
                            <legend class="the-legend2"> SEARCH </legend>
                            <div class="col-sm-12">
                                <div class="col-sm-4">
                                    {{ Form::label('degree_id', 'Degree') }}
                                    {{ Form::select('degree_id',$degree,Input::old('degree_id'), array('class' => 'form-control') ) }}
                                </div>
                                <div class="col-sm-2 btn-padding">
                                    {{ Form::submit('Filter', array('class'=>'btn btn-success','id'=>'button'))}}
                                    {{ Form::reset('Reset', ['class' => 'btn btn-default','id'=>'button']) }}
                                </div>
                            </div>
                            {{Form::close()}}
                        </fieldset>

                        {{--*****************Filter :Ends **************************--}}

                        <div class="box-body table-responsive ">
                            <table id="example" class="table table-bordered table-hover table-striped">
                                <thead>
                                <th>SL.No</th>
                                <th>Degree</th>
                                <th>Batch</th>
                                <th>Action</th>
                                </thead>
                                <tbody>
                                <?php $sl=1;?>
                                @if(isset($data))
                                    @foreach($data as $value)
                                        <tr>
                                            <td class="sl-no-size">{{$sl++}}</td>
                                            <td>{{isset($value->relBatch->relDegree->relDegreeProgram->title) ? $value->relBatch->relDegree->relDegreeProgram->title :''}}
                                            </td>
                                            <td>{{isset($value->relBatch->batch_number) ? $value->relBatch->batch_number : ''}}</td>
                                            <td>
                                                <a href="{{ URL::route('installment.setup.view',['batch_id'=>$value->batch_id])}}" class="btn btn-xs btn-default"><i class="fa fa-eye" style="color: green"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                            <a href="{{ URL::route('installment.setup')}}" class="btn-link pull-right" style="margin-top: 6px"><i class="fa fa-backward text-red"></i> Back to All List</a>
                            {{ $data->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal add Installment --}}
    <div id="addInstallment" class="modal fade">
        <div class="modal-dialog modal_ex_lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">{{HTML::image('assets/icon/media-close-btn.png')}}</button>
                    <h4 class="modal-title" style="text-align: center;color: #800080;font-size: x-large">Add New Installment</h4>
                </div>
                <div class="modal-body">
                    @include('fees::installment_setup.add_installment')
                </div>
            </div>
        </div>
    </div>
    {{-- Modal for show --}}
    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showingModal">
        <div class="modal-dialog">
            <div class="modal-content">

            </div>
        </div>
    </div>




    {{--Ajax operation: depandable dropdown with loading gif--}}

    <script>
        $(function(){
            $('.loaderClass').hide();
            $('#batch_name').change(function(){
                $('.loaderClass').show();
                $.get("{{ url('fees/billing/drop-down-batch')}}",
                        { degree: $(this).val() },
                        function(data) {
                            $('.loaderClass').hide();
                            var model = $('#dependable-list');
                            model.empty();
                            $.each(data, function(key, element) {
                                model.append("<option value='"+ key +"'>" + element + "</option>");
                            });
                        });
            });
        });

    </script>

@stop