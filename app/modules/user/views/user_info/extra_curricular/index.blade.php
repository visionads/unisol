@extends('layouts.layout')
@section('top_menu')
    @include('layouts._top_menu')
@stop
@section('sidebar')
    @include('layouts._sidebar_amw')
@stop
@section('content')

<button type="button" class="pull-right btn btn-sm btn-info" data-toggle="modal" data-target="#modal">
  + Extra Curricular Activities
</button>
<h2 class="page-header text-purple tab-text-margin">Extra Curricular Activities</h2>

<div class="row">

    <div class="box box-solid">

        <div class="col-sm-12">
           <div class="pull-left col-sm-4"></div>
           <div class="pull-right col-sm-4" style="padding-top: 1%;">
           </div>
        </div>
       <div class="box-body">
       <table id="example" class="table table-striped  table-bordered">
            <thead>
                <tr>
                    <th> Title</th>
                    <th> Description </th>
                    <th> Achievement</th>
                    <th> Certificate Medal </th>
                    <th> Action</th>
                </tr>
            </thead>
            <tbody>
            @if(isset($data))
                @foreach($data as $value)
                 <tr>
                    <td>{{$value->title}}</td>
                    <td>{{$value->description}}</td>
                    <td>{{$value->achievement}}</td>
                    <td>

                        @if(isset($value->certificate_medal))
                           {{--@if($data->certificate_medal == null)--}}
                              <a class=" btn-link" href="{{ URL::route('user/extra-curricular/certificate-medal',['id'=>$value->id])}}" data-toggle="modal" data-target="#ImageModal">
                                {{--{{ $data->certificate_medal != null ? HTML::image('user_images/profile/'.$data->certificate_medal, $data->certificate_medal):""}}--}}
                                <ins>View Certificate Medal</ins>
                              </a>
                              {{--@else--}}
                              {{--{{ $value->certificate_medal != null ? HTML::image('user_images/certificates/'.$value->certificate_medal, $value->certificate_medal):""}}--}}

                           {{--@endif--}}
                        @endif
                    </td>
                    <td>
                        {{--<a href="{{ URL::route('work-week.show',['id'=>$value->id]) }}" class="btn btn-xs btn-default" data-toggle="modal" data-target="#work-week" style="font-size: 12px;color: darkmagenta">View Certificate Medal</a>--}}
                        <a class="btn btn-xs btn-default" href="{{ URL::route('user/extra-curricular/edit',['id'=>$value->id])}}" data-toggle="modal" data-target="#myeditModal" style="font-size: 12px;color:darkgreen">Edit</a>
                        {{--<a data-href="{{ $values->id }}" class="btn btn-default btn-sm delete-dt-2" id="delete-dt-2{{ $values->id }}" ><i class="fa fa-trash-o" style="font-size: 12px;color: red"></i></a>--}}
                        {{--<a data-href="{{ URL::route('work-week.delete',$value->id) }}" class="btn btn-xs btn-default" data-toggle="modal" data-target="#confirm-delete" style="font-size: 12px;color: lightcoral"><span class="fa  fa-trash-o"></span></a>--}}
                    </td>
                 </tr>
                @endforeach
            @endif
            </tbody>

        </table>
        </div>
    </div>
</div>

{{ Form::open(array('route' => 'user/extra-curricular/store','files'=>'true')) }}
     @include('user::user_info.extra_curricular._modal')
{{ Form::close() }}

{{-- Modal Area --}}
<div class="modal fade" id="ImageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    </div>
  </div>
</div>

 <!-- Modal : edit -->
    <div class="modal fade" id="myeditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

            </div>
        </div>
    </div>

@stop