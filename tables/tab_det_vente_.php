<?php
$op->select($_SESSION['op_vente_id']);
$vente->select($_SESSION['op_vente_id']);
$perso->select($op->getPersonneId());
$pos->select($op->getPosId());
$amount=$paie->select_sum_op($_SESSION['op_vente_id']);
?>
<div class="row">
<div class="col-md-12 mr-2">
<div class="form-row mb-2">
        <?php $pay=($vente->getAmount()-$vente->getRed()); ?>
        <a href="javascript:void(0)" id="pay_facture_v" data-id="<?php echo $pay; ?>" class="btn btn-sm btn-success mr-2"><i class="fa fa-print"></i> Facture</a>
        <a href="javascript:void(0)" id="new_fact" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Facture</a>
    </div>
<div class="table-responsive" id="current_det_vente">
    <span style="display: none;"><?php include('tab_facture.php');?></span>
    <h1 style="font-size: 30px; font-style: italic; color:red;">
    <?php
    echo 'Total : '.$pay.' BIF';
    ?>
    </h1>
        <table class="table table-bordered table-striped table-sm display" cellspacing="0" width="100%">
            <thead>
                <tr>
                   <th>Produit</th><th>Prix</th><th>Qt</th><th>Tot</th><th>-</th>
                </tr>
                            </thead>
                                    <tbody>
                                    <?php
                                    $tot=0;
                                    if(isset($_SESSION['op_vente_id']) and !empty($_SESSION['op_vente_id']))
                                    {
                                    $datas2=$det->select_all($_SESSION['op_vente_id']);
                                    foreach ($datas2 as $un) {
                                    $prod->select($un['prod_id']);
                                    $tot +=$un['quantity']*$un['amount'];
                                    echo '<tr><td >'.$prod->getProdName().'</td><td class="edit_det_price" contenteditable="false" id="'.$un['details_id'].'">'.number_format($un['amount'],0,'.',',').'</td><td class="edit_det_qt" contenteditable="true" id="'.$un['details_id'].'">'.$un['quantity'].'</td><td>'.number_format($un['quantity']*$un['amount'],0,'.',',').'</td>';

                                    echo '</td><th><button class="btn btn-sm btn-danger btn-circle delete_det_vente" name="delete" id="'.$un["details_id"].'">';

                                    echo '<span class="fa fa-times"></span>';


                                    echo '</button></th></tr>';

                                    }
                                    echo '<tr><th colspan="3">Totaux</th><th>'.number_format($tot,1,'.',',').'</th><th>-</th></tr>';
                                    echo '<tr><th colspan="3">Réduction</th><th>'.number_format($vente->getRed(),1,'.',',').'</th><th>-</th></tr>';
                                    echo '<tr><th colspan="3">A Payer</th><th>'.number_format($tot-$vente->getRed(),1,'.',',').'</th><th>-</th></tr>';
                                    }
                                    ?>
    </tbody>
    </table>
</div>
</div>
<?php
if(isset($_SESSION['level'])>1)
{
?>
<div class="col-md-12">

<div class="row">
<div class="col-md-12 mb-2">
<div class="card card-info" >
                            <div >
                                <div class="card-body">
<form method="post" action="javascript:void(0)">
<div class="form-row">
             <div class="col-md-4">
        <div class="form-group">
            <label class="control-label">Type</label>
            <select name="type_red" id="type_red" class="form-control">
                <option value="1">%</option>
                <option value="2">BIF</option>
            </select>
        </div>
    </div>
    <div class="col-md-5">
        <div class="form-group"><label class="control-label">Réduction</label>

            <input type="number" id="val_red" name="val_red" class="form-control" value="<?php //echo $vente->getRed(); ?>" required>

            <input type="hidden" id="an_val_red" name="an_val_red"  value="<?php echo $vente->getRed(); ?>" required>
            <input type="hidden" id="det_sup_vente_id" name="det_sup_vente_id"  value="<?php echo $vente->getIdvente(); ?>" required>
            <input type="hidden" id="val_tva" name="val_tva" value="1">

             </div>
    </div>
    <div class="col-md-2">
        <label class="control-label">&nbsp;</label><br/>
        <button id="add_det_fact" data-id="<?php echo $_SESSION['op_vente_id']; ?>" type="submit" class="btn btn-warning" name="action" style="bottom: 0;"> <span class="fa fa-save"></span></button>
     </div>
</div>
</form>
                                </div>
                            </div>
                </div>
</div>

<div class="col-md-12 mb-2">
<div class="card card-info" >
                            <div >
                                <div class="card-body">
<form method="post" action="javascript:void(0)">
<div class="form-row">

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
            <label class="control-label">Montant Payé</label>
            <input type="number" name="mont_pay" id="mont_pay" class="form-control" value="<?php echo $pay; ?>">
            <input type="hidden" name="cheque" id="cheque" class="form-control">
        </div>
    </div>
    <div class="col-md-2">
        <label class="control-label">&nbsp;</label><br/>
        <a href="javascript:void(0)" id="pay_facture" data-id="<?php echo $pay; ?>" class="btn btn-warning" title="Payer"><i class="fa fa-dollar"></i> & <i class="fa fa-print"></i></a>

    </div>

</div>
</form>
                                </div>
                            </div>
                </div>
</div>

</div>
</div>
<?php
}
?>
</div>
<hr color="blue">


<!-- fin de detail supplemetaire reduction et tva -->
<!-- </div> -->
