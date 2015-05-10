@extends('layouts.layout')
 @section('sidebar')
   @include('layouts._sidebar_applicant')
 @stop
@section('content')
<a class="pull-right btn btn-xs btn-success" href="{{ URL::route('academic.student.course-enrollment.tution-fees',['year_title'=>$year_title,'semester_title'=>$semester_title])}}"><b><i class="fa fa-arrow-circle-left"></i>Go Back</b></a>
<h4 class="box-title"><b>Exam Enrollment</b></h4>
<div class="box box-solid ">

</div>
{{------------------ Cost Details -----------------------------------------------}}
 <div class="box box-info">
     <div class="box-body">
         <div class="row">
             <div class="col-lg-12">
                    <table class="table table-bordered table-striped">
                           <thead>
                                 <tr>
                                     <th>Items</th>
                                     <th>Qty</th>
                                     <th>Unit Cost </th>
                                     <th>Item Total</th>
                                     <th>Waiver</th>
                                     <th>Waiver Amount</th>
                                     <th>Partial Total</th>
                                 </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                              </tr>
                              <tr>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                              </tr>
                           </tbody>
                    </table>
             </div>
         </div>
     </div>
 </div>
 {{--------------------------------------------Ends-------------------------------------}}


 <div class="box box-solid">
    <div class="box-header">
       <div class="box-tools pull-right">
           <button class="btn btn-info btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
           <button class="btn btn-info btn-xs" data-widget="remove"><i class="fa fa-times"></i></button>
       </div>
       <div class="box box-info">
           <h4 class="box-title">Payment Method</h4>
       </div>
       <p>&nbsp;</p>
       <form class="form-inline" role="form">
          <div class="form-group">
             <label class="col-lg-12 control-label">Please Select Any One :</label>
             <br>
             <div class="col-xs-12">
                  <label class="radio-inline"><input type="radio" name="radio" id="bank" class="minimal"  value="bank"><b>Bank</b></label>
                  <label class="radio-inline"><input type="radio" name="radio" id="bkash" value="bkash"> <b>Bkash</b></label>
                  <label class="radio-inline"><input type="radio" name="radio" id="credt_card" value="credtcard"> <b>Credit Card</b> </label>

                    <br><br>
                  <a class="pull-right btn btn-sm btn-default" id="ch_bank" style="display: none;"  href=""><b>Checkout With Bank</b></a>
                  <a class="pull-right btn btn-sm btn-default"  id="ch_bkash" style="display:none" href=""><b>Checkout With Bkash</b></a>
                  <a class="pull-right btn btn-sm btn-default" id="ch_credt_card" style="display:none" href=""><b>Checkout With CC</b></a>
                  <p>&nbsp;</p>
                  <p>&nbsp;</p>
             </div>
             <br>
          </div>
       </form>
    </div>
 </div>

{{------------------------------------ Modal --------------------------------------------------------------------------}}
 <div class="modal fade" id="addDegreeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
         <div class="modal-content">

        </div>
       </div>
 </div>

@stop
