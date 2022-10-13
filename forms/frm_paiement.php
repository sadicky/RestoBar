<?php session_start(); ?>
<form method="post" id="user_form" enctype="multipart/form-data">
<div class="form-body">
<h3 class="box-title">Paiement</h3>
N° : #<span id="num_appro"><?php if(isset($_SESSION['op_id'])) echo $_SESSION['op_id']; else echo '?'; ?></span>
<hr>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label">Montant dû</label>
            <input type="number" id="mont_du" name="mont_du" class="form-control" value="<?php if(isset($_SESSION['mont_du'])) echo $_SESSION['mont_du']; else echo '0'; ?>" required readonly> 
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label">Montant Payé</label>
            <input type="number" id="mont_trans" name="mont_trans" class="form-control"  value="" required> 
            <input type="hidden" name="hidden_mont" id="hidden_mont" value="" class="form-control">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label">Date</label>
            <input type="text" id="date_trans" name="date_trans" class="form-control"  value=""required> 
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label">Référence</label>
            <input type="file" name="trans_image" id="user_image" class="form-control">
            <input type="hidden" name="hidden_ref" id="hidden_ref" value="" class="form-control">
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