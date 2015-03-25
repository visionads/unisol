@extends('layouts.layout')
@section('sidebar')
    @include('layouts._sidebar_amw')
@stop
@section('content')
<div>
   <a class="pull-right btn btn-sm btn-success" href="{{ action('UserSignupController@batchApplicantIndex', $batch_id)}}"> <i class="fa fa-arrow-circle-left"></i> Go Back</a>
</div>

 <section class="col-lg-6 connectedSortable">
       <h3 class="box-title">Applicant's Profile </h3>
            <p>&nbsp;</p>
            <div class="box box-info">
                 <div class="box-header">
                     <h3 class="box-title">Account Information</h3>
                     <!-- tools box -->
                     <div class="pull-right box-tools">
                         <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" ><i class="fa fa-times"></i></button>
                     </div><!-- /. tools -->
                 </div>
                     <div class="box-body">
                          <div class="row">
                              <div class="col-lg-8">
                                  <table>
                                          @if(isset($applicant_account_info))
                                                 <tr>
                                                     <th class="col-lg-6">Name</th>
                                                     <td>{{$applicant_account_info->first_name.''.$applicant_account_info->last_name}}</td>
                                                 </tr>

                                                 <tr>
                                                     <th class="col-lg-6">Username</th>
                                                     <td>{{$applicant_account_info->username}}</td>
                                                 </tr>

                                                 <tr>
                                                     <th class="col-lg-6">Email Address</th>
                                                     <td>{{$applicant_account_info->email}}</td>
                                                 </tr>

                                          @else
                                              {{"No Account data found !"}}
                                          @endif
                                  </table>
                              </div>
                          </div>
                     </div>
                     <p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><br>
                     <div class="box-footer clearfix">
                         {{--<button class="pull-right btn btn-default" id="sendEmail">Edit <i class="fa fa-arrow-circle-right"></i></button>--}}
                     </div>
            </div>


        {{--------------------------------------------- Academic Information ------------------------------------------------------------------------------}}
            <div class="box box-info">
                 <div class="box-header">
                     <h3 class="box-title">Academic Information</h3>
                     <!-- tools box -->
                     <div class="pull-right box-tools">
                         <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" ><i class="fa fa-times"></i></button>
                     </div><!-- /. tools -->
                 </div>
                     <div class="box-body">
                          <div class="row">

                              <div class="col-lg-12">
                                 <table class="table  table-bordered">
                                       <thead>
                                              <tr>
                                                 <th>Level Of Education</th>
                                                 <th>Board / University</th>
                                                 <th>Passing Year</th>
                                                 <th>Result</th>
                                              </tr>
                                       </thead>
                                            <tbody >
                                                 @if(isset($applicant_acm_records))
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
                                                 @else
                                                      {{"No Academic Records found !"}}
                                                 @endif
                                            </tbody>

                                 </table>
                              </div>
                          </div>
                     </div>

                     <div class="box-footer clearfix">
                         {{--<button class="pull-right btn btn-default" id="sendEmail">Edit <i class="fa fa-arrow-circle-right"></i></button>--}}
                     </div>
            </div>

               <p>&nbsp;</p>
               <p>&nbsp;</p>
 </section>


 <section class="col-lg-6 connectedSortable">
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <div class="box box-info">

         <div class="box-header">
             <h3 class="box-title">Profile Information</h3>
             <!-- tools box -->
             <div class="pull-right box-tools">
                 <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" ><i class="fa fa-times"></i></button>
             </div><!-- /. tools -->
         </div>
         <div class="box-body">
              <div class="row">
                  <div class="col-lg-4">
                    @if(isset($applicant_personal_info))
                        {{ HTML::image('applicant_images/'.$applicant_personal_info->profile_image) }}
                    @endif
                  </div>

                  <div class="col-lg-8">
                      <table>
                          @if(isset($applicant_profile_info))
                               <tr>
                                   <th class="col-lg-6">Phone</th>
                                   <td>{{$applicant_profile_info->phone}}</td>
                               </tr>

                               <tr>
                                   <th class="col-lg-6">Date of Birth</th>
                                   <td>{{$applicant_profile_info->date_of_birth}}</td>
                               </tr>

                               <tr>
                                   <th class="col-lg-6">Place of Birth</th>
                                   <td>{{$applicant_profile_info->place_of_birth}}</td>
                               </tr>

                               <tr>
                                   <th class="col-lg-6">Gender</th>
                                   <td>{{$applicant_profile_info->gender}}</td>
                               </tr>

                               <tr>
                                    <th class="col-lg-6">City</th>
                                    <td>{{$applicant_profile_info->city}}</td>
                               </tr>

                               <tr>
                                    <th class="col-lg-6">State</th>
                                    <td>{{$applicant_profile_info->state}}</td>
                               </tr>

                               <tr>
                                    <th class="col-lg-6">Country</th>
                                    <td>{{$applicant_profile_info->relCountry->title}}</td>
                               </tr>
                          @else
                            {{"No Profile data found !"}}
                          @endif

                      </table>
                  </div>
              </div>

         </div>

         <div class="box-footer clearfix">
             {{--<button class="pull-right btn btn-default" id="sendEmail">Edit <i class="fa fa-arrow-circle-right"></i></button>--}}
         </div>
    </div>
    <p>&nbsp;</p>
        <div class="box box-info">
             <div class="box-header">
                 <h3 class="box-title">Biographical Information</h3>
                 <!-- tools box -->
                 <div class="pull-right box-tools">
                     <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" ><i class="fa fa-times"></i></button>
                 </div><!-- /. tools -->
             </div>
                 <div class="box-body">
                      <div class="row">

                          <div class="col-lg-10">
                             <table>
                                   @if(isset($applicant_meta_records))
                                         <tr>
                                               <th class="col-lg-8">Father's Name</th>
                                               <td>{{$applicant_meta_records->fathers_name}}</td>
                                         </tr>

                                         <tr>
                                             <th class="col-lg-8">Father's Occupation</th>
                                             <td>{{$applicant_meta_records->fathers_occupation}}</td>
                                         </tr>

                                         <tr>
                                             <th class="col-lg-8">Father's Phone</th>
                                             <td>{{$applicant_meta_records->fathers_phone}}</td>
                                         </tr>

                                         <tr>
                                             <th class="col-lg-8">Mother's Name</th>
                                             <td>{{$applicant_meta_records->mothers_name}}</td>
                                         </tr>

                                         <tr >
                                             <th class="col-lg-8">Mother's Occupation</th>
                                             <td>{{$applicant_meta_records->mothers_occupation}}</td>
                                         </tr>

                                         <tr>
                                             <th class="col-lg-8">Mother's Phone</th>
                                             <td>{{$applicant_meta_records->mothers_phone}}</td>
                                         </tr>

                                         <tr>
                                             <th class="col-lg-8">Marital Status</th>
                                             <td>{{$applicant_meta_records->marital_status}}</td>
                                         </tr>

                                         <tr>
                                             <th class="col-lg-8">Religion</th>
                                             <td>{{$applicant_meta_records->religion}}</td>
                                         </tr>

                                         <tr>
                                             <th class="col-lg-8">Present Address</th>
                                             <td>{{$applicant_meta_records->present_address}}</td>
                                         </tr>

                                         <tr>
                                             <th class="col-lg-8">Permanent Address</th>
                                             <td>{{$applicant_meta_records->permanent_address}}</td>
                                         </tr>

                                     @else
                                         {{"No Biographical Information found !"}}
                                     @endif
                             </table>
                          </div>
                      </div>
                 </div>

                 <div class="box-footer clearfix">
                     {{--<button class="pull-right btn btn-default" id="sendEmail">Edit <i class="fa fa-arrow-circle-right"></i></button>--}}
                 </div>
        </div>

 </section>

 <p>&nbsp;</p>
 <p>&nbsp;</p>
 <p>&nbsp;</p>

@stop