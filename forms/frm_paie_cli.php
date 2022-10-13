<?php session_start(); ?>

<div class="card card-info" >
                            <div class="card-header bg-light">Paiement du Client</div>
                            <div >
                                <div class="card-body">
                                        <form method="post" id="frm_paie_cli" enctype="multipart/form-data">
<div class="form-body">
<div class="form-row">
    <div class="col-md-4">
        <div class="form-group">
            <label class="control-label">Montant dû</label>
            <input type="number" id="mont_du" name="mont_du" class="form-control" value="<?php if(isset($_SESSION['mont_du'])) echo $_SESSION['mont_du']; else echo '0'; ?>" required readonly>
        </div>
    </div>
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

            <input type="hidden" id="num_ref" name="num_ref" class="form-control"  value="">

</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label class="control-label">Mode de Paie</label>
            <select name="mode_paie" id="mode_paie" class="form-control">
                <option value="1">Cash</option>
                <option value="2">Banque</option>
            </select>
        </div>
    </div>
    <div class="col-md-5">
        <div class="form-group">
            <label class="control-label">N° Chèque</label>
            <input type="text" name="cheque" id="cheque" class="form-control">
        </div>
    </div>
    </div>
<div class="form-actions">
<input type="hidden" name="trans_id" id="trans_id" />
<input type="hidden" id="op_id_paie" name="op_id"/>
<input type="hidden" name="operation" id="operation" value="Add" />

<input type="hidden" id="acc_id" name="party_code" class="form-control" value="<?php if(isset($_GET['acc_id'])) echo $_GET['acc_id'];?>" required>

<button id="action" data-id="Add" type="submit" class="btn btn-success" name="action"> <i class="fa fa-check"></i><span id="lab_action">Enregistrer</span></button>

<button type="reset" class="btn btn-default" id="reset_act">Annuler</button>
</div>
</form>
</div>
                            </div>
                </div>
