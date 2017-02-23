<!-- Add Inmate Modal -->
<div class="modal fade" id="inmateModal" tabindex="-1" role="dialog" aria-labelledby="inmateModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="fwdModalLabel">Add Inmate Record</h4>
      </div>
      <div class="modal-body">
          <form class="form-horizontal" role="form" id="inmateForm">
              <input type="hidden" name="susp_id" value="<?php echo $suspect['susp_id']; ?>">
              <input type="hidden" name="crno" value="<?php echo $_GET['crno']; ?>">
              
              <div class="form-group">
                <label for="Prison_no" class="control-label col-md-4">Prison</label>
                <div class="col-md-6">
                    <select name="prison_id" class="form-control" required>
                        <option>-- Select Prison --</option>
                        <?php $list_prison = get_prisons(); ?>
                        <?php $prison_count = mysqli_num_rows($list_prison); if($prison_count !== 0) { ?>
                        <?php while($prisons = mysqli_fetch_assoc($list_prison)) { ?>
                        <option value="<?php echo $prisons['prison_id']; ?>"><?php echo $prisons['prison_name']; ?></option>
                        <?php } } ?>
                    </select>
                </div>
            </div>
              <div class="form-group">
                    <label for="Prison_no" class="control-label col-md-4">Prison #</label>
                    <div class="col-md-6">
                        <input type="text" name="prison_no" class="form-control" placeholder="Prison Number">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-4">Offence Title</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" placeholder="Offence Title" name="offence_title">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-4">Offence Category</label>
                    <div class="col-md-8">
                        <select name="offence_cat_id" class="form-control">
                            <option>-- Select Category --</option>
                            <?php $offence_category = get_offence_category(); ?>
                            <?php $count = mysqli_num_rows($offence_category); if($count !== 0) { ?>
                            <?php while($offencecate = mysqli_fetch_assoc($offence_category)) { ?>
                            <option value="<?php echo $offencecate['offence_cat_id']; ?>"><?php echo $offencecate['offence_cat_desc']; ?></option>
                            <?php } } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-4">Offence Details</label>
                    <div class="col-md-8">
                        <textarea rows="3" class="form-control" placeholder="Offence Details" name="offence_details"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-4">Date Committed</label>
                    <div class="col-md-5">
                        <input type="date" name="date_committed" id="dateCommitted" class="form-control datetimepicker" placeholder="Date Offence was Committed" data-date-format="yyyy-mm-dd HH:ii:ss">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-4">Date Arraigned</label>
                    <div class="col-md-5">
                        <input type="date" name="date_arraigned" id="araignedDate" class="form-control datetimepicker" placeholder="Date Arraigned" data-date-format="yyyy-mm-dd HH:ii:ss">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-4">Date To Be Released</label>
                    <div class="col-md-5">
                        <input type="date" name="release_date" class="form-control datetimepicker" id="releaseDate" placeholder="Date To Be Released" data-date-format="yyyy-mm-dd HH:ii:ss">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-4">Court</label>
                    <div class="col-md-5">
                        <select name="court_id" class="form-control">
                            <option>-- Select Court --</option>
                            <?php $list_courts = get_courts(); ?>
                            <?php while($courts = mysqli_fetch_assoc($list_courts)) { ?>
                            <option value="<?php echo $courts['court_id']; ?>"><?php echo $courts['court_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-4">Type of Detention</label>
                    <div class="col-md-5">
                        <select name="status_id" class="form-control">
                            <option>-- Select Type --</option>
                            <?php $list_detention = get_detention_status(); ?>
                            <?php while($detention = mysqli_fetch_assoc($list_detention)) { ?>
                            <option value="<?php echo $detention['status_id']; ?>"><?php echo $detention['status']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4">Sentence</label>
                    <div class="col-md-5">
                        <select name="sentence" class="form-control">
                            <option>-- Select Sentence --</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-4">Date Sentence Begins</label>
                    <div class="col-md-5">
                        <input type="text" name="sentence_begins" class="form-control datetimepicker" placeholder="Date Sentence Begins" data-date-format="yyyy-mm-dd HH:ii:ss">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-4">Crime Location</label>
                    <div class="col-md-5">
                        <input type="text" name="crime_location" class="form-control" placeholder="Crime Location">
          <input type="hidden" name="checkForm" value="true">
                    </div>
                </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="addInmateBtn" name="addInmateBtn" class="btn btn-primary"> Save </button>
      </div>
    </div>
  </div>
</div>

<!-- Suspect Bailout Modal -->
<div class="modal fade" id="bailoutModal" tabindex="-1" role="dialog" aria-labelledby="inmateModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="fwdModalLabel">Bailout Suspect</h4>
      </div>
      <div class="modal-body">
          <form class="form-horizontal" role="form" id="bailoutForm">
              <input type="hidden" name="susp_id" id="bailSuspID" value="<?php echo $suspect['susp_id']; ?>">
              <input type="hidden" id="bailCRNO" name="crno" value="<?php echo $_GET['crno']; ?>">
              
              <div class="form-group">
                  <label class="control-label col-md-4">Bail Date</label>
                  <div class="col-md-6">
                      <input type="date" name="bail_date" class="form-control datetimepicker" data-date-format="yyyy-mm-dd HH:ii:ss">
                  </div>
              </div>
              
              <div class="form-group">
                  <label class="control-label col-md-4">Bailer Name</label>
                  <div class="col-md-6">
                      <input name="bailer_name" class="form-control" placeholder="Bailer Name">
                  </div>
              </div>
              
              <div class="form-group">
                  <label class="control-label col-md-4">Address</label>
                  <div class="col-md-6">
                      <textarea name="bailer_addr" class="form-control" placeholder="Bailer Address"></textarea>
                  </div>
              </div>
              
              <div class="form-group">
                  <label class="control-label col-md-4">Phone</label>
                  <div class="col-md-6">
                      <input type="tel" name="bailer_phone" class="form-control" placeholder="Bailer Phone Number">
                  </div>
              </div>
              
              <div class="form-group">
                  <label class="control-label col-md-4">Terms</label>
                  <div class="col-md-6">
                      <textarea rows="5" name="bail_terms" class="form-control" placeholder="Bail Terms"></textarea>
                  </div>
              </div>
              
              <div class="form-group">
                  <label class="control-label col-md-4">Approved By</label>
                  <div class="col-md-6">
                      <input type="text" class="form-control" name="approved_by" placeholder="Bail Approved By">
                  </div>
              </div>
              <input type="hidden" value="true" name="checkBailOut">
                
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="bailSubBtn" name="bailSubBtn" class="btn btn-primary"> Save </button>
      </div>
    </div>
  </div>
</div>