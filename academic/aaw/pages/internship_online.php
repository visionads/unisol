<?php include('../_header.php'); ?>

<div class="wrapper row-offcanvas row-offcanvas-left">
<!-- Left side column. contains the logo and sidebar -->

<?php include('../_sidebar.php'); ?>


<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
<h3>Welcome to Internship Management</h3>

<div class="box-body">
    <p>
        <button class="pull-right btn btn-success btn-sm"  data-toggle="modal" data-target="#add">Add New</button>
    </p>

</div>
<div class="row">
<div class="col-xs-12">

<div class="box">
<div class="box-header">
    <h3 class="box-title"> List Of Organization For Internship</h3>
</div><!-- /.box-header -->
<div class="box-body table-responsive">
<table id="example1" class="table table-bordered table-striped">
<col width="200">
<col width="80">
<col width="350">
<col width="80">
<col width="100">
<col width="150">
<thead>
<tr>

    <th>Name of Organization</th>

    <th>Type</th>
    <th>Business Description</th>
    <th>Intern Policy</th>
    <th>Status</th>
    <th>Action</th>


</tr>
</thead>
<tbody>

<tr>

    <td>Edu TechSolutions</td>


    <td>Software</td>
    <td>Many developers, designers  developing beautiful, powerful web apps</td>
    <td>6 month</td>
    <th>
        <h5 style="color:#0089db"><b>open</b></h5>
    </th>
    <th>

        <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#assign">assign</button>
        <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#view">view</button></th>


</tr>



<tr>

    <td>Qlik</td>
    <td>Telecom</td>
    <td>QlikView, is the leading Business Discovery Platform, providing user-driven business intelligence (BI) to a variety of organizations worldwide</td>
    <td>6 month</td>
    <th>
        <h5 style="color: #b11b64"><b>approved</b></h5>
    </th>
    <th><button class="btn btn-info btn-xs" data-toggle="modal" data-target="#view">view</button></th>


</tr>

<tr>

    <td>edu TechSolutions</td>


    <td>Software</td>
    <td>With a small team of developers, designers works day in and day out on developing beautiful, powerful, and user-friendly apps</td>
    <td>6 month</td>
    <th>
        <h5 style="color:#0089db"><b>open</b></h5>
    </th>
    <th><button class="btn btn-success btn-xs" data-toggle="modal" data-target="#assign">assign</button>
        <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#view">view</button></th>


</tr>

<tr>

    <td>Grameen Solutions</td>


    <td>Software</td>
    <td>Designers works day in and day out on developing beautiful, powerful, and user-friendly apps which will be able to do many works.</td>
    <td>6 month</td>
    <th>
        <h5 style="color:#0089db"><b>open</b></h5>
    </th>
    <th><button class="btn btn-success btn-xs" data-toggle="modal" data-target="#assign">assign</button>
        <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#view">view</button></th>


</tr>
<tr>

    <td>TechSolutions</td>


    <td>Software</td>
    <td>With a small team of developers,Making a powerful web application.</td>
    <td>6 month</td>
    <th>
        <h5 style="color:#0089db"><b>open</b></h5>
    </th>
    <th><button class="btn btn-success btn-xs" data-toggle="modal" data-target="#assign">assign</button>
        <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#view">view</button></th>


</tr>
<tr>

    <td>TechSolutions</td>


    <td>Software</td>
    <td>We are developing beautiful, powerful, and user-friendly apps</td>
    <td>6 month</td>
    <th>
        <h5 style="color:#0089db"><b>open</b></h5>
    </th>
    <th><button class="btn btn-success btn-xs" data-toggle="modal" data-target="#assign">assign</button>
        <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#view">view</button></th>


</tr>

<tr>

    <td>GP-IT</td>


    <td>Software</td>
    <td>All developers are developing beautiful, powerful, and user-friendly apps</td>
    <td>6 month</td>
    <th>
        <h5 style="color:#0089db"><b>open</b></h5>
    </th>
    <th><button class="btn btn-success btn-xs" data-toggle="modal" data-target="#assign">assign</button>
        <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#view">view</button></th>


</tr>


</tbody>

</table>
</div><!-- /.box-body -->
</div><!-- /.box -->
</div>
</div>



</section><!-- /.content -->
</aside><!-- /.right-side -->
</div><!-- ./wrapper -->

<script type="text/javascript">
    $(function() {
        $("#example1").dataTable();
        $('#example2').dataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false
        });
    });
</script>

<!-- Modal :: approve  -->

<div class="modal fade " id="assign" tabindex="-1" role="dialog" aria-labelledby="confirm-delete" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><b>Approval</b></h4>
            </div>
            <div class="modal-body">
                <p style="font-size: medium"><b>Are you sure to assign this item?</b></p>
            </div>
            <div class="modal-footer">

                <button type="submit" class="btn btn-success" data-dismiss="modal">Assign</button>
                <button type="submit" class="btn btn-info" data-dismiss="modal">Cancel</button>



            </div>
        </div>
    </div>
</div>

<!-- Modal :: view  -->

<div class="modal fade " id="view" tabindex="-1" role="dialog" aria-labelledby="confirm-delete" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Information</h4>
            </div>

            <div class="modal-body">
                <div class="span well">



                    <table>

                        <tr>

                            <td style="font-size: 140%"><b>Name of Organization:</b>edu TechSolutions</td>

                        </tr>

                        <td style="font-size: 140%"><b>Type:</b>Software</td></tr>
                        <td style="font-size: 140%"><b>Intern Policy:</b>6 month</td></tr>

                        </tr>
                    </table>


                </div>
            </div>
            <div class="modal-footer">


                <button type="submit" class="btn btn-info" data-dismiss="modal">Cancel</button>



            </div>
        </div>
    </div>
</div>

<!-- Modal :: add-->


<div class="modal fade " id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Organization Information</h4>
            </div>
            <div class="modal-body">


                <form role="form">
                    <div class="box-body">

                        <div class="form-group">
                            <label for="name">Name of Organization</label>
                            <input type="name" class="form-control" id="name" >
                        </div>

                        <div class="form-group">
                            <label for="year">Type</label>
                            <select class="form-control input-sm" id="year">
                                <option>Select One</option>
                                <option value="CSE">Software</option>
                                <option value="ICT">Telecom</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="roll">Business Description</label>

                            <textarea class="form-control" id="Description" ></textarea>
                        </div>
                        <div class="form-group">
                            <label for="roll">InternShip Policy</label>

                            <textarea class="form-control" id="Policy" ></textarea>
                        </div>



                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">



            </div>
        </div>
    </div>
</div>





<?php include('../_footer.php'); ?>
