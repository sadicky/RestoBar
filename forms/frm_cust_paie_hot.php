<?php
$bq->select_status('Oui');
$balance=$trans->select_bal_jour($_SESSION['jour']);

if(isset($_SESSION['op_loc_id']))
{
    $frais=$aut->select_sum_op($_SESSION['op_loc_id']);
    $p=$paie->select_sum_op($_SESSION['op_loc_id']);
    $du=$cout;
    $du-=$p['paie'];
}
else
{
    $du=0;
    $frais=0;
    $pay=0;
}
?>
<div class="card card-info" >
    <div class="card-header bg-light">Paiement</div>
    <div class="card-body">
<form method="post" action="javascript:void(0)" id="pay_facture_hot">
    <div class="form-row">
    <div class="col-md-6">
            <label class="control-label">Balance</label>
            <input type="number" name="balance" id="balance" class="form-control" value="<?php echo $balance; ?>" readonly>
    </div>
    <input type="hidden" id="date_trans" name="date_trans"  class="form-control" value="<?php echo date('Y-m-d');?>">
    <input type="hidden" name="id_bq" id="id_bq_sup" class="form-control" value="<?php echo $bq->getIdBq(); ?>">
    <input type="hidden" name="mode_paie" id="mode_paie" class="form-control" value="Espèce">
    <input type="hidden" name="mont_du" id="mont_du" class="form-control" value="<?php echo $du; ?>">
    <input type="hidden" name="autref" id="autref" class="form-control" value="<?php echo $frais; ?>">
    <div class="col-md-6">
            <label class="control-label">Montant Payé</label>
            <input type="number" name="mont_trans" id="mont_trans" class="form-control" value="<?php echo $pay; ?>" <?php if($pay<=0) echo 'readonly';?>>
    </div>

    <div class="col-md-6">
        <label class="control-label">&nbsp;</label><br/>
        <input type="hidden" name="op_id" id="op_id_paie" value="<?php echo $_SESSION['op_loc_id']; ?>">
        <input type="hidden" name="cust_id" id="cust_id" value="<?php echo $op->getPartyCode(); ?>">
        <?php
        if($pay>0)
            {?>

                <button type="submit" class="btn btn-warning" title="Payer"><i class="fa fa-dollar"></i>Payer</button> 
                <?php
            }
            else
            {
            ?>
            <?php
            }
            if($trans->select_all_nb_op($_SESSION['op_loc_id'])>0 and !empty($_SESSION['op_loc_id']))
                {?>
                    <a href="javascript:void(0)" class="btn btn-sm more_pay_cust"><i class="fa fa-file"></i> Paiements</a> 
                    <?php
                }
                ?>
            </div>


        </div>
    </form>


    <?php include('modal_pay_det_cust_hot.php'); ?>
</div>
</div>
