<?php
@session_start();
require_once '../load_model.php';
$op = new BeanOperation();
$paie=new BeanPaiement();
$achat=new BeanAchats();
$pers=new BeanPersonne();

$amount=$paie->select_sum_op($_POST['op_id']);
$achat->select($_POST['op_id']);
$mont_du = $achat->getAmount() - $amount['paie'];
$op->select($_POST['op_id']);
  ?>

<div class="card card-info" >
                            <div class="card-header bg-light">Paiement du Fournisseur :<?php $pers->select($op->getPartyCode());
                            echo $pers->getNomComplet();
                             ?>
                                 <input type="hidden" name="nom_four" id="nom_four"
                                 value="<?php echo $pers->getNomComplet(); ?>">

                             </div>
                            <div>
                                <div class="card-body">
                                        <form method="post" id="frm_paie" enctype="multipart/form-data">
<div class="form-body">
<div class="form-row">
    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label">Source</label>
            <select name="mode_paie" id="mode_paie" class="form-control">
                <option value="Cash">Caisse</option>
                <option value="Banque" selected>Banque</option>
            </select>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label">Montant dû</label>
            <input type="number" id="mont_du" name="mont_du" class="form-control" value="<?php echo $mont_du; ?>" required readonly>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label">Montant</label>
            <input type="number" id="mont_trans" name="mont_trans" class="form-control"  value="" required>

        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label">Prochaine Date Paiement</label>
            <input type="date" id="date_pay" name="date_pay" class="form-control"  value="" readonly required>

        </div>
    </div>
<div class="col-md-2">
    <br/>
<input type="hidden" id="op_id_paie" name="op_id" value="<?php echo $_POST['op_id'];?>"/>
<input type="hidden" id="four_id" name="four_id" value="<?php echo $op->getPartyCode(); ?>"/>
<input type="hidden" name="operation" id="operation" value="Add" />

<button id="action" data-id="Add" type="submit" class="btn btn-success btn-sm" name="action"> <i class="fa fa-save"></i><span id="lab_action"> Enregistrer</span></button>

</div>
</div>
</form>
</div>
                            </div>
                </div>
