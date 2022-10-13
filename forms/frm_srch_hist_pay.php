   <?php
@session_start();
require_once '../load_model.php';
?>
<div class="card card-info" >
    <div class="card-header bg-light">Paiement périodiques</div>
    <div >
        <div class="card-body">
            <form id="frm_srch_hist_pay" method="post">
                <div class="form-body">
                    <div class="form-row">
                        <div class="col-md-2">
                                <label class="control-label">Du : </label>
                                <input type="date" id="from_d" name="from_d" class="form-control" value="<?php echo date("Y-m-d"); ?>" required>
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Au : </label>
                            <input type="date" id="to_d" name="to_d" class="form-control" value="<?php echo date('Y-m-d');?>" required>
                        </div>
                        <div class="col-md-3" >
                            <div class="form-group" style="bottom:0;"> 
                                &nbsp;<br/>
                                <button id="action" data-id="Add" type="submit" class="btn btn-success btn-sm" name="search"> <span class="fa fa-search"></span> Recherche</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="tab_hist_pay">

</div>

