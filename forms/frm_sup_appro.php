<?php @session_start(); ?>
<form method="post" id="sup_appro_form" enctype="multipart/form-data">
<div class="form-body">
<h3 class="box-title m-b-0">Détails Appro</h3>
N° : #<span id="num_appro"><?php if(isset($_SESSION['op_id'])) echo $_SESSION['op_id']; else echo '?'; ?></span>
<hr>
<div class="form-row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label">Date</label>
            <input type="text" id="date_appro" name="date_appro" class="form-control"  value="<?= date('Y-m-d') ?>"required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label">Produit</label>
            <input type="text" id="prod_appro" name="prod_appro" class="form-control" value="" required>
            <input type="hidden" id="prod_id" name="prod_id" class="form-control" value="">
            <input type="hidden" id="prod_prix" name="prod_prix" class="form-control" value="">
        </div>
    </div>

</div>
<div class="form-row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label">Salted Qty</label>
            <input type="number" id="s_qty" name="s_qty" class="form-control"  value="0">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label">Salted Weight</label>
            <input type="number" id="s_wgt" name="s_wgt" class="form-control"  value="0">
        </div>
    </div>

</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label">No-Salted Qty</label>
            <input type="number" id="ns_qty" name="ns_qty" class="form-control"  value="0">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label">No-Salted Weight</label>
            <input type="number" id="ns_wgt" name="ns_wgt" class="form-control"  value="0">
        </div>
    </div>

</div>
<div class="form-actions">
<input type="hidden" name="appro_id" id="appro_id" />
<input type="hidden" name="operation" id="operation" value="Add" />

<input type="hidden" id="sup_id" name="sup_id" class="form-control" value="<?php if(isset($_SESSION['sup_id'])) echo $_SESSION['sup_id'];?>" required>

<input type="hidden" id="op_id" name="op_id" class="form-control" value="<?php if(isset($_SESSION['op_id'])) echo $_SESSION['op_id'];?>" required>

<button id="action" data-id="Add" type="submit" class="btn btn-success" name="action"> <i class="fa fa-check"></i><span id="lab_action">Enregistrer</span></button>

<button type="reset" class="btn btn-default" id="reset_act">Annuler</button>
</div>
</form>
