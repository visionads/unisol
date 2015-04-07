@extends('layouts.layout')
@section('sidebar')
    @include('layouts._sidebar_applicant')
@stop
@section('content')
    <!-- START CUSTOM TABS -->
    <h2 class="page-header text-purple tab-text-margin">Admission Test</h2>
    <div class="row">
        <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Admission Test</a></li>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <div class="box-body table-responsive ">
                            <table class="table table-striped  table-bordered">
                                <thead>
                                <tr>
                                    <th>Degree</th>
                                    <th>Test Date</th>
                                    <th>Test Time</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($data))
                                    @foreach ($data as $value)
                                    <tr>
                                        <td><a href="{{URL::route('subject-details.show',['batch_id'=>$value->batch_id])}}" class="btn-link">
                                                {{isset($value->relBatch->relDegree->title)? $value->relBatch->relDegree->title : ''}},
                                                {{isset($value->relBatch->relSemester->title) ? $value->relBatch->relSemester->title : '' }},
                                                {{isset($value->relBatch->relYear->title)?$value->relBatch->relYear->title : ''}}</a></td>
                                        <td>{{isset($value->relBatch->admtest_date) ? $value->relBatch->admtest_date : ''}}</td>
                                        <td>{{isset($value->relBatch->admtest_start_time) ? $value->relBatch->admtest_start_time : ''}}</td>
                                        {{--<td>{{isset($value->relBatch->admtest_start_time) ? date($value->relBatch->admtest_start_time)->format('d-m-Y') : ''}}</td>--}}
                                    </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop