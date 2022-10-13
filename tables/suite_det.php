<?php
//if($_SESSION['level']>1)
//{
?>
<!-- <div class="col-md-12"> -->
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
            

             </div>
    </div>
    <div class="col-md-2">
        <label class="control-label">&nbsp;</label><br/>
        <button id="add_det_fact" data-id="<?php echo $_SESSION['op_vente_id']; ?>" type="submit" class="btn btn-warning" name="action" style="bottom: 0;"> <span class="fa fa-save"></span></button>
     </div>
</div>
</form>
            
<!-- </div>
 -->
<!-- <div class="col-md-12 mb-2">
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
            <input type="number" name="mont_pay" id="mont_pay" class="form-control" value="<?php //echo $payf; ?>">
            <input type="hidden" name="cheque" id="cheque" class="form-control">
        </div>
    </div>
    <div class="col-md-2">
        <label class="control-label">&nbsp;</label><br/>
        <?php
        //if($payf>0)
            //{?>
        <a href="javascript:void(0)" id="pay_facture" data-id="<?php //echo $pay; ?>" class="btn btn-warning" title="Payer"><i class="fa fa-dollar"></i> Payer</i></a>
        <?php
    //}
        ?>


    </div>

</div>
</form>
                                </div>
                            </div>
                </div>
</div>

</div> -->
</div>
<?php
//}
?>
</div>
<hr color="blue">
