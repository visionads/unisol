{{ HTML::style('assets/etsb/etsb_css/bootstrap/bootstrap.min.css') }}

<h4 style="text-align: center">Exam Center Choice Sequence</h4>

{{-----------------------------------------Help Text -------------------------------------------------------------------------------------}}
    <div class="col-md-12">
        <div class="help-text-top">
             <p style="text-align: center"><em>You can change exam center sequence using drag & drop.</em></p>
        </div>
    </div>
{{-----------------------------------------Help Text ends ----------------------------------------------------------------------}}
 {{ Form::open(['route' => ['admission.applicant.exm-center',$batch_id], 'class'=>'form-horizontal','files' => true,])}}
 <section class="col-lg-12 connectedSortable">
     @if(isset($exm_center_all))
          @foreach(($exm_center_all) as $value)
              <div class="nav-tabs-custom" style="background:lavender">
                 <ul class="nav nav-tabs">
                   <li class="pull-left header" style="font-size: small"><i class="fa fa-arrows"></i><b>
                       <input type="hidden" name="exm_center_id[]" value="{{$value->id}}">{{ $value->title }}
                   </b></li>
                 </ul>
              </div>
          @endforeach
     @endif
 </section>
      {{ Form::submit('Save', array('class'=>'pull-right btn btn-sm btn-primary')) }}
      <a  href="" class="pull-right btn btn-sm btn-default" style="margin-right: 5px">Close</a>
         <p>&nbsp;</p>
         <p>&nbsp;</p>
      {{Form::close()}}
<!-- add js script -->
{{ HTML::script('assets/etsb/etsb_js/jquery/jquery.min.js')}}
{{ HTML::script('assets/etsb/etsb_js/jquery-ui/jquery-ui.min.js')}}
{{ HTML::script('assets/etsb/etsb_js/admin/dashboard.js')}}

