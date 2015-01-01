
<!-- Aprroval Modal -->
<div class="modal fade" id="approvalModal" tabindex="-1" role="dialog" aria-labelledby="approvalModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Approval</h4>
      </div>
      <div class="modal-body">
        Are you gonna approve this publication ?
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">Approve</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
    </div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Add new questions  Title Modal -->
<div class="modal fade" id="addTitle" tabindex="-1" role="dialog" aria-labelledby="addResearchReview" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Add New Question Title</h4>
            </div>
            <div class="modal-body">
                <form>
                      <div class="form-group">
                        <label for="question">Title</label>
                        <input type="text" class="form-control" id="title" placeholder="Enter Question Title">
                    </div>
                    <div class="form-group">
                        <label for="degname">Type </label>
                        <select class="form-control">
                            <option>Select</option>
                            <option>MCQ</option>
                            <option>Descriptive</option> 
                            <option>Mixed</option> 
                        </select>
                    </div>
                   
                    <div class="form-group">
                            <label for="Payment">Auto Evaluated</label>
                            <label class="radio-inline">
                                <input type="radio" name="optradio">Yes
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="optradio">No
                            </label>
                            

                        </div>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- Add new questions Modal -->
<div class="modal fade" id="addQuestion" tabindex="-1" role="dialog" aria-labelledby="addResearchReview" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Add New Question</h4>
            </div>
            <div class="modal-body">
                <form>
 
                    <div class="form-group">
                        <label for="degname">Type </label>
                        <select class="form-control">
                            <option>Select</option>
                            <option>MCQ</option>
                            <option>Descriptive</option> 
                            <option>Mixed</option> 
                        </select>
                    </div>
                     <div class="form-group">
                        <label for="question">Question</label>
                        <input type="text" class="form-control" id="title" placeholder="Enter Question">
                    </div>
                    <div class="form-group">
                        <label for="Option1">Option1</label>
                        <input type="text" class="form-control" id="option" placeholder="Enter Option">
                        <label for="Option1">Option2</label>
                        <input type="text" class="form-control" id="option" placeholder="Enter Option">
                        <label for="Option3">Option3</label>
                        <input type="text" class="form-control" id="option" placeholder="Enter Option">
                        <label for="Option4">Option4</label>
                        <input type="text" class="form-control" id="option" placeholder="Enter Option">
                    </div>
                    <div class="form-group">
                    <label for="lastname">Answer</label>
                    <label class="checkbox-inline"><input type="checkbox" value="">Option 1</label>
                    <label class="checkbox-inline"><input type="checkbox" value="">Option 2</label>
                    <label class="checkbox-inline"><input type="checkbox" value="">Option 3</label>
                    <label class="checkbox-inline"><input type="checkbox" value="">Option 3</label>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




<!-- 1-View details Modal -->
<div class="modal fade" id="viewDetails" tabindex="-1" role="dialog" aria-labelledby="viewDetails" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">View Details</h4>
            </div>
     
            <div class="modal-body">
                <h2>Question Information:</h2>
                <h4>Department:
                <p>BBA</p>
                </h4><br>
                <h4>TeacherName:
                <p>Alamgir Bhuyan</p>
                </h4><br> 
                <h4>Subject:
                <p>Business Communication</p>
                </h4><br>                        
                <h4>Type:
                <p>MCQ</p>
                </h4><br>
                <h4>Auto Evaluated:
                <p>yes</p>
                </h4><br>
                <h4>Question:
                <p>Communication with superiors involves?</p>
                </h4><br>
                <h4>Options:
                <p>1.1.Problem solving
                <p>2.Disciplinary matters</p>
                <p>3.Welfare aspects</p>
                <p>4.Public relations</p>
                </h4><br>
                <h4>Answer:
                <p>1.Problem solving</p>
                </h4><br>
               </div>
            <td></td>
                                           
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Back</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- 2-View details Modal -->
<div class="modal fade" id="viewDetailstb" tabindex="-1" role="dialog" aria-labelledby="viewDetails" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">View Details</h4>
            </div>

             <td>BBA</td>
                                                                            <td>Saidur Rahman</td>
                                                                            <td>Business Communication</td>
                                                                            <td>Question for BBA Department</td>
                                                                            <td>Business Communication 5 question</td>
                                                                            <td>Written</td>
                                                                            <td>No</td>
                                                                            <td>What is Bisiness Communication</td>
            <div class="modal-body">
                <h2>Question Information:</h2>                          
                <h4>Title:
                <p>Question for BBA Department</p>
                </h4><br>                         
                <h4>Type:
                <p>MCQ</p>
                </h4><br>
                <h4>Auto Evaluated:
                <p>yes</p>
                </h4><br>
                <h4>Question:
                <p>Communication with superiors involves?</p>
                </h4><br>
                <h4>Options:
                <p>1.Problem solving
                <p>2.Disciplinary matters</p>
                <p>3.Welfare aspects</p>
                <p>4.Public relations</p>
                </h4><br>
                <h4>Answer:
                <p>1.Problem solving</p>
                </h4><br>
               </div>
            <td></td>
                                           
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Back</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!--Login Delete Modal -->

<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="approvalModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Approval</h4>
      </div>
      <div class="modal-body">
        Are you sure you want to delete ?
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">Delete</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
    </div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->






