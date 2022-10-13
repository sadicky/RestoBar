<?php session_start(); ?>

<div class="card card-info" >
                            <div class="card-header bg-light">Alimentation de votre Compte</div>
                            <div >
                                <div class="card-body">
                                        <form method="post" id="frm_trans" enctype="multipart/form-data">
<div class="form-body">
<div class="form-row">
    <div class="col-md-4">
        <div class="form-group">
            <label class="control-label">Montant</label>
            <input type="number" id="mont_trans" name="mont_trans" class="form-control"  value="" required>
            <input type="hidden" name="hidden_mont" id="hidden_mont" value="" class="form-control">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="control-label">Date</label>
            <input type="text" id="date_trans" name="date_trans" class="form-control"  value="<?php echo date("Y-m-d"); ?>"required>
        </div>
    </div>

</div>
<div class="form-actions">
<input type="hidden" name="trans_id" id="trans_id" />
<input type="hidden" name="operation" id="operation" value="Add" />

<input type="hidden" id="acc_id" name="acc_id" class="form-control" value="<?php if(isset($_SESSION['acc_id'])) echo $_SESSION['acc_id'];?>" required>
<button id="action" data-id="Add" type="submit" class="btn btn-success" name="action"> <i class="fa fa-check"></i><span id="lab_action">Enregistrer</span></button>

<button type="reset" class="btn btn-default" id="reset_act">Annuler</button>
</div>
</form>
</div>
                            </div>
                </div>
