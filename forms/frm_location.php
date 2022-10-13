<div class="card card-info" >
    <div class="card-header bg-light">LOCATION</div>
    <div class="card-body">
        <form id="frm_location" method="post">
            <div class="form-body">
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label class="control-label">Du</label>
                        <input type="date" id="from_d" name="from_d" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                    </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label class="control-label">Au</label>
                        <input type="date" id="to_d" name="to_d" class="form-control" value="" required>
                        </div>
                    </div>
                    
                      </div>

                                          </div>
                                        <div class="form-actions">
<input type="hidden" name="op_loc" id="op_loc" value="<?php if(isset($_SESSION['op_loc_id'])) echo $_SESSION['op_loc_id']; ?>" class="form-control">
                                            <input id="person_id" type="hidden"  name="party_code" value="<?php if(isset($_SESSION['cust_id'])) echo $_SESSION['cust_id'];?>"/>

                                            <input id="chamb_id" type="hidden"  name="chamb_id" value="<?php echo $_POST['chamb_id']; ?>"/>
                      <input id="enregistrer_loc" type="submit" class="btn btn-sm btn-success"
                      name="Enregistrer" value="Enregistrer" <?php if(!isset($_SESSION['cust_id'])) echo 'disabled="true"'; ?> />

                                            
                                        </div>
                                    </form>
                      </div>
                            </div>

