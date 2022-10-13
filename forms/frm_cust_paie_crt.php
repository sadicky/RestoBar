<?php
$bq->select_status('Oui');
$balance=$trans->select_bal_jour($_SESSION['jour']);

if(isset($_SESSION['op_vente_id']))
{
    $frais=$aut->select_sum_op($_SESSION['op_vente_id']);
    $pay=0;
    $p=$paie->select_sum_op($_SESSION['op_vente_id']);
    $du=$det->select_sum_op($_SESSION['op_vente_id']);

    if(isset($_SESSION['list_det'])) { $max=sizeof($_SESSION['list_det']);}
    else { $max=0;}

    if($max==0)
    {
    $pay=($du + $frais )-$p['paie'];
    }
    else
    {
        foreach ($_SESSION['list_det'] as $key => $value) {
                                       
                    $datas2=$det->select_all_5($_SESSION['op_vente_id'],$value);
                                    foreach ($datas2 as $un) {
                                    $prod->select($un['prod_id']);
                                    $pay+=$un['amount']*$un['quantity'];
                                }
        }
                                
    }

    
    

    $frais -=$p['paie'];
    if($frais<0){$du +=$frais; $frais=0; }
    if($du<0){$du=0;}
}
else
{
    $du=0;
    $frais=0;
    $pay=0;
}
?>
<form method="post" action="javascript:void(0)" id="pay_facture_cust_v">
    <div class="form-row">
    <div class="col-md-4">
        <div class="form-group">
            <label class="control-label">Balance</label>
            <input type="number" name="balance" id="balance" class="form-control" value="<?php echo $balance; ?>" readonly>
        </div>
    </div>
    <input type="hidden" id="date_trans" name="date_trans"  class="form-control" value="<?php echo date('Y-m-d');?>">
    <input type="hidden" name="id_bq" id="id_bq_sup" class="form-control" value="<?php echo $bq->getIdBq(); ?>">
    <input type="hidden" name="mode_paie" id="mode_paie" class="form-control" value="Espèce">
    <input type="hidden" name="mont_du" id="mont_du" class="form-control" value="<?php echo $du; ?>">
    <input type="hidden" name="autref" id="autref" class="form-control" value="<?php echo $frais; ?>">
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label">Montant Payé</label>
            <input type="number" name="mont_trans" id="mont_trans" class="form-control" value="<?php echo $pay; ?>" <?php if($pay<=0) echo 'readonly';?>>
        </div>
    </div>

    <div class="col-md-5">
        <label class="control-label">&nbsp;</label><br/>
        <input type="hidden" name="op_id" id="op_id_paie" value="<?php echo $_SESSION['op_vente_id']; ?>">
        <input type="hidden" name="cust_id" id="cust_id" value="<?php echo $op->getPartyCode(); ?>">
        <?php
        if($pay>0)
            {?>

                <button type="submit" class="btn btn-warning" title="Payer"><i class="fa fa-dollar"></i> <!-- Payer --></button> 
                <?php
            }
            else
            {
            ?>
            <?php
            }
            if($trans->select_all_nb_op($_SESSION['op_vente_id'])>0 and !empty($_SESSION['op_vente_id']))
                {?>
                    <a href="javascript:void(0)" class="btn btn-sm more_pay_cust"><i class="fa fa-file"></i> Paiements</a> 
                    <?php
                }
                ?>
            </div>


        </div>
    </form>


    <?php include('modal_pay_det_cust.php'); ?>