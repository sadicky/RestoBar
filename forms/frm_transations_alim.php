<?php @session_start();
require_once '../load_model.php';
$acc= new BeanAccounts();
$datas=$acc->select_all_role('users');
?>

<div class="card card-info" >
                            <div class="card-header bg-light">Alimentation de la caisse</div>
                            <div >
                                <div class="card-body">
<form method="post" id="frm_alim_cpt" enctype="multipart/form-data">
<div class="form-body">
<div class="form-row">
    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label">Destination</label>
            <select name="mode_paie" id="mode_paie" class="form-control">
                <option value="Cash">Caisse</option>
                <option value="Banque" selected>Banque</option>
            </select>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label">Date</label>
            <input type="date" id="date_trans" name="date_trans" class="form-control"  value="<?php echo date("Y-m-d"); ?>" required>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label">Montant</label>
            <input type="number" id="mont_trans" name="mont_trans" class="form-control"  value="" required>
            <input type="hidden" name="hidden_mont" id="hidden_mont" value="" class="form-control">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label">Commentaires</label>
            <input type="text" id="comment_trans" name="comment_trans" class="form-control"  value="">
        </div>
    </div>



<div class="col-md-3">
    <label class="control-label">&nbsp;</label>  <br/>

<!-- <input type="hidden" name="mode_paie" id="mode_paie" value="Banque" /> -->

<input type="hidden" name="trans_id" id="trans_id" />
<input type="hidden" name="operation" id="operation" value="Add" />

<button id="action" data-id="Add" type="submit" class="btn btn-success" name="action"> <i class="fa fa-save"></i><span id="lab_action">Enregistrer</span></button>
</div>
</div>
</div>
</form>
</div>
</div>
</div>

<div id="trans_alim_tab">
</div>
