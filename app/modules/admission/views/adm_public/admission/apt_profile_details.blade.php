@extends('layouts.layout')
 @section('sidebar')
  @include('layouts._sidebar_applicant')
 @stop
@section('content')
{{--<a class="pull-right btn btn-sm btn-info" href="{{ URL::to('degree_manage/create')}}" data-toggle="modal" data-target="#addModal" >Add More Degree</a>--}}

<h3>Admission On </h3>
{{---------------------------------------------Data Table:admission on  degree Starts-----------------------------------------------------------------}}
 <div class="well well-sm">
      <table class="table table-bordered table-striped">

                   <tbody>
                             <tr>
                                  <th rowspan="100%" style="vertical-align: middle">
                                     <b style="font-size: medium">Degree Name</b>
                                  </th>
                             </tr>
                        @foreach($degree_applicant as $value)

                                <tr>
                                     <td>
                                           <a href="{{ URL::route('admission.adm_test_details',
                                               ['degree_id' => $value->id]) }}">
                                               {{ $value->relDegree->title }}
                                           </a>
                                     </td>
                                </tr>
                        @endforeach
                   </tbody>
      </table>
 </div>
 <p>&nbsp;</p>
{{-----------------------------------Data Table : admission on  degree Starts Ends---------------------------------------------------------------------------}}

<h4><b>Applicant's Profile</b></h4>
{{-----------------------------------Applicant's Profile:Personal Information starts-----------------------------------}}
<p>&nbsp;</p>

<section class="col-lg-6 connectedSortable">
 <h5><b>Applicant's Personal Information</b></h5>
    <div class="box box-info">
           <div class="box-header">
               <h3 class="box-title">Profile Information</h3>
               <!-- tools box -->
               <div class="pull-right box-tools">
                   <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
               </div><!-- /. tools -->
           </div>
           <div class="box-body">
                <div class="row">
                    <div class="col-lg-4">
                        {{ HTML::image('applicant_images/'.$applicant_personal_info->profile_image) }}
                    </div>
                    <div class="col-lg-6">
                        @if(isset($applicant_personal_info))

                            Phone : <b>{{$applicant_personal_info->phone}} </b><br>
                            Date of Birth : <b>{{$applicant_personal_info->date_of_birth}}</b><br>
                            Place of Birth : {{$applicant_personal_info->place_of_birth}}<br>
                            Gender : {{$applicant_personal_info->gender}}<br>
                            City : {{$applicant_personal_info->city}}<br>
                            State : {{$applicant_personal_info->state}}<br>
                            Country : {{$applicant_personal_info->relCountry->title}}

                        @else
                            {{"No Profile data found !"}}
                        @endif
                    </div>

                </div>
           </div>
           <div class="box-footer clearfix">
               <button class="pull-right btn btn-default" id="sendEmail">Edit <i class="fa fa-arrow-circle-right"></i></button>
           </div>
       </div>

</section>

{{--<div class="well well-sm">--}}
      {{--<table>--}}

             {{--<tbody>--}}
                    {{--@if($applicant_personal_info != null)--}}
                            {{--<tr >--}}
                                  {{--<th class="col-lg-4">Phone</th>--}}
                                  {{--<td>{{$applicant_personal_info->phone}}</td>--}}

                                  {{--<td rowspan="100%" style="vertical-align:middle">--}}
                                       {{--<p><b>Profile Picture</b></p>--}}
                                      {{--{{HTML::image('applicant_images/'.$applicant_personal_info->profile_image)}}--}}
                                  {{--</td>--}}
                            {{--</tr>--}}

                            {{--<tr >--}}
                                {{--<th class="col-lg-4">Date of Birth</th>--}}
                                {{--<td class="col-lg-5">{{$applicant_personal_info->date_of_birth}}</td>--}}
                            {{--</tr>--}}

                            {{--<tr >--}}
                                {{--<th class="col-lg-4">Place of Birth</th>--}}
                                {{--<td class="col-lg-5">{{$applicant_personal_info->place_of_birth}}</td>--}}
                            {{--</tr>--}}

                            {{--<tr >--}}
                                {{--<th class="col-lg-4">Gender</th>--}}
                                {{--<td class="col-lg-5">{{$applicant_personal_info->gender}}</td>--}}
                            {{--</tr>--}}

                            {{--<tr >--}}
                                {{--<th class="col-lg-4">City</th>--}}
                                {{--<td class="col-lg-5">{{$applicant_personal_info->city}}</td>--}}
                            {{--</tr>--}}

                            {{--<tr >--}}
                                {{--<th class="col-lg-4">State</th>--}}
                                {{--<td class="col-lg-5">{{$applicant_personal_info->state}}</td>--}}
                            {{--</tr>--}}

                            {{--<tr >--}}
                                {{--<th class="col-lg-4">Country</th>--}}
                                {{--<td class="col-lg-5">{{$applicant_personal_info->relCountry->title}}</td>--}}
                            {{--</tr>--}}

                            {{--<tr >--}}
                                {{--<th class="col-lg-4">Zip Code</th>--}}
                                {{--<td class="col-lg-5">{{$applicant_personal_info->zip_code}}</td>--}}
                            {{--</tr>--}}

                    {{--@endif--}}
             {{--</tbody>--}}

      {{--</table>--}}
 {{--</div>--}}
 <p>&nbsp;</p>
 <p>&nbsp;</p>
{{-----------------------------------Applicant's Profile:Personal Information Ends-------------------------}}

{{-----------------------------------Applicant's Academic Records Starts-----------------------------------}}
<p>&nbsp;</p>
<h5><b>Applicant's Academic Records</b></h5>

<div class="well well-sm">
      <table>
           <thead>
               <tr>
                      <th>Level Of Education</th>
                      <th>Board / University</th>
                      <th>Passing Year</th>
                      <th>Result</th>
               </tr>
           </thead>

           <tbody>
                   @if($applicant_acm_records != null)
                          @foreach($applicant_acm_records as $value)
                                 <tr>
                                      <td>{{($value->level_of_education )}}</td>
                                      <td>{{ $value->board_university}}</td>
                                      <td>{{ $value->year_of_passing}}</td>
                                      <td>
                                           @if($value->result_type =='division')
                                           {{ $value->result }}
                                           @else
                                           {{$value->gpa}}
                                           @endif
                                      </td>
                                 </tr>
                          @endforeach
                   @endif
           </tbody>
      </table>
 </div>
 <p>&nbsp;</p>
 <p>&nbsp;</p>
{{-----------------------------------Applicant's Academic Records Ends-------------------------------------------}}

{{-----------------------------------Applicant's Biographical Records Starts-------------------------------------------}}
<p>&nbsp;</p>
<h5><b>Applicant's Biographical Information</b></h5>

<div class="well well-sm">
      <table class="table table-bordered table-striped">

             <tbody>
                    @if($applicant_meta_records != null)
                            <tr>
                                  <th class="col-lg-4">Father's Name</th>
                                  <td>{{$applicant_meta_records->fathers_name}}</td>
                            </tr>

                            <tr>
                                <th class="col-lg-4">Father's Occupation</th>
                                <td class="col-lg-5">{{$applicant_meta_records->fathers_occupation}}</td>
                            </tr>

                            <tr>
                                <th class="col-lg-4">Father's Phone</th>
                                <td class="col-lg-5">{{$applicant_meta_records->fathers_phone}}</td>
                            </tr>

                            <tr>
                                <th class="col-lg-4">Mother's Name</th>
                                <td class="col-lg-5">{{$applicant_meta_records->mothers_name}}</td>
                            </tr>

                            <tr >
                                <th class="col-lg-4">Mother's Occupation</th>
                                <td class="col-lg-5">{{$applicant_meta_records->mothers_occupation}}</td>
                            </tr>

                            <tr>
                                <th class="col-lg-4">Mother's Phone</th>
                                <td class="col-lg-5">{{$applicant_meta_records->mothers_phone}}</td>
                            </tr>

                            <tr>
                                <th class="col-lg-4">Marital Status</th>
                                <td class="col-lg-5">{{$applicant_meta_records->marital_status}}</td>
                            </tr>

                            <tr>
                                <th class="col-lg-4">Religion</th>
                                <td class="col-lg-5">{{$applicant_meta_records->religion}}</td>
                            </tr>

                            <tr>
                                <th class="col-lg-4">Present Address</th>
                                <td class="col-lg-5">{{$applicant_meta_records->present_address}}</td>
                            </tr>

                            <tr>
                                <th class="col-lg-4">Permanent Address</th>
                                <td class="col-lg-5">{{$applicant_meta_records->permanent_address}}</td>
                            </tr>
                    @endif
             </tbody>
      </table>
</div>
 <p>&nbsp;</p>
 <p>&nbsp;</p>
{{-----------------------------------Applicant's Biographical Records Ends-------------------------------------------}}

@stop

