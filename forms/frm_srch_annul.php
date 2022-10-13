
<?php
@session_start();
require_once '../load_model.php';
?>
<div class="card card-info" >
                            <div class="card-header bg-light">Recherche des annulations</div>
                            <div >
                                <div class="card-body">
                                    <form id="frm_srch_annul" method="post">
                                        <div class="form-body">
<div class="form-row">
    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label">Du : </label>
            <input type="date" id="fromd" name="fromd" class="form-control" value="<?php echo date("Y-m-d"); ?>" required>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label">Au : </label>
            <input type="date" id="tod" name="tod" class="form-control" value="<?php echo date('Y-m-d', strtotime(date("Y-m-d"). ' + 1 days')); ?>" required>
        </div>
    </div>
    <div class="col-md-3" >
        <div class="form-group" style="bottom:0;">
            &nbsp;<br/>
            <button id="action" data-id="Add" type="submit" class="btn btn-success" name="search"> <span class="fa fa-search"></span> Recherche</button>
        </div>
    </div>
</div>
</div>
</form>
                                </div>
                            </div>
                </div>


<div id="tab_annul">

</div>

