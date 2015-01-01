<!-- Lab Proposal -->
<div class="modal fade" id="labProposal" tabindex="-1" role="dialog" aria-labelledby="addPublications"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <h4 class="modal-title">Lab Proposal</h4>
            </div>
            <div class="modal-body">
                <form>

                    <div class="form-group">
                        <label for="title">Lab Title</label>
                        <input type="text" class="form-control" id="title" placeholder="Type Here">
                    </div>
                    <div class="form-group">
                        <label for="description">Lab Description</label>
                        <textarea class="form-control" id="description" placeholder="Type Here"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputFile">Lab Proposal File</label>
                        <input type="file" id="exampleInputFile">
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Send</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->




<!-- submitConfirmation Modal -->
<div class="modal fade" id="submitConfirmation" tabindex="-1" role="dialog" aria-labelledby="submitConfirmation"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <h4 class="modal-title"> Confirmation</h4>
            </div>
            <div class="modal-body">
                Are you sure to Accept this item ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Accept</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmation" tabindex="-1" role="dialog" aria-labelledby="submitConfirmation"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <h4 class="modal-title">Confirmation</h4>
            </div>
            <div class="modal-body">
                Are you sure to Delete this item ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Ok</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- View Details Modal -->
<div class="modal fade" id="viewDetails" tabindex="-1" role="dialog" aria-labelledby="viewDetails" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <h4 class="modal-title">View Details</h4>
            </div>
            <div class="modal-body">
                <p>
                    <img src="../img/doc.png">
                </p>
            </div>
            <div class="modal-footer">
                <p><b><a href="../img/doc.png">Download</a> </b></p>

                <button type="button" class="btn btn-success" data-dismiss="modal">Back</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- View Details Modal -->
<div class="modal fade" id="finalReport" tabindex="-1" role="dialog" aria-labelledby="viewDetails" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <h4 class="modal-title">View Details</h4>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="exampleInputFile">Lab Report File/DOc </label>
                    <input type="file" id="exampleInputFile">
                </div>

                <div class="form-group">
                    <label for="description">Comment</label>
                    <textarea class="form-control" id="description"
                              placeholder="Your Comment Please"></textarea>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Submit</button>
                <button type="button" class="btn btn-success" data-dismiss="modal">Back</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->



<!-- Edit -->
<div class="modal fade" id="Edit" tabindex="-1" role="dialog" aria-labelledby="addPublications"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <h4 class="modal-title">Manage Lab</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" placeholder="Enter Title">
                    </div>

                    <div class="form-group">
                        <label for="title">Subject</label>
                        <input type="text" class="form-control" id="title" placeholder="Enter Title">
                    </div>

                    <div class="form-group">
                        <label>Deadline:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control" placeholder="dd/mm/yy" />
                        </div><!-- /.input group -->
                    </div><!-- /.form group -->

                    <div class="form-group">
                        <label for="description">Details</label>
                        <textarea class="form-control" id="description" placeholder="Description goes here"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">File input</label>
                        <input type="file" id="exampleInputFile">
                    </div>

                    <div class="form-group">
                        <label for="title">Teacher Name</label>
                        <input type="text" class="form-control" id="title" placeholder="Enter Title">
                    </div>

                    <div class="form-group">
                        <label for="title">Status</label>
                        <input type="text" class="form-control" id="title" placeholder="Enter Title">
                    </div>

                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Back</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- View Marks Distribution -->
<div class="modal fade" id="marksDistribution" tabindex="-1" role="dialog" aria-labelledby="addScholarship" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">View Marks</h4>
            </div>
            <div class="modal-body">

                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th> Category </th>
                            <th> Marks </th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <td>Lab Works </td>
                            <td> 10% </td>
                        </tr>
                        <tr>
                            <td>Class Test </td>
                            <td> 10% </td>
                        </tr>
                        <tr>
                            <td>Assignment </td>
                            <td> 10% </td>
                        </tr>
                        <tr>
                            <td>Mid Term </td>
                            <td> 10% </td>
                        </tr>
                        <tr>
                            <td>Final Term </td>
                            <td> 10% </td>
                        </tr>
                        </tbody>
                    </table>
                </div><!-- /.box -->

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Back</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

