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
                            <div class="card-header bg-light">Date de Paiement du Fournisseur :<?php $pers->select($op->getPartyCode());
                            echo $pers->getNomComplet();
                             ?></div>
                            <div>
                                <div class="card-body">

                                        <form method="post" id="frm_date_paie" enctype="multipart/form-data">
                                            <input type="hidden" name="nom_four" id="nom_four"
                                 value="<?php echo $pers->getNomComplet(); ?>">
<div class="form-body">
<div class="form-row">
    <div class="col-md-4">
        <div class="form-group">
            <label class="control-label">Date</label>
            <input type="date" id="date_pay" name="date_pay" class="form-control"  value="" required>

        </div>
    </div>
<div class="col-md-4">
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
