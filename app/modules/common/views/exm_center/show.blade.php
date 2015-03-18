
<div class="modal-header">

    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title" id="myModalLabel">Exam Center Information</h4>
</div>

<div class="modal-body">
     <div style="padding: 20px;">
           <div class="span9 well">
                 <table style="font-size: large">

                   <tr>
                     <th class="col-lg-9">Exam Center:</th>
                     <td>{{ $model->title }}</td>
                   </tr>

                   <tr>
                       <th class="col-lg-9">Description:</th>
                       <td>{{ $model->description }}</td>
                   </tr>

                   <tr>
                     <th class="col-lg-9">Capacity:</th>
                     <td>{{ $model->capacity }}</td>
                   </tr>

                   <tr>
                       <th class="col-lg-9">Status:</th>
                       <td>{{ $model->status }}</td>
                   </tr>

                 </table>
           </div>
           <p>&nbsp;</p>
       <a href="" class="pull-right btn btn-default" span class="glyphicon-refresh">Close</a>
       <p>&nbsp;</p>
     </div>
</div>