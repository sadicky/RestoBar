<div class="card card-info" >
    <div class="card-header bg-light">LOCATION</div>
    <div class="card-body">
<?php
$pay=($cout-$fact->getLocRed()-$p['paie']);
?>
<hr color="blue">
<h3>Application de Réduction</h3>
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

            <input type="number" id="val_red" name="val_red" class="form-control" value="<?php echo $fact->getLocRed(); ?>" required>

            <input type="hidden" id="an_val_red" name="an_val_red"  value="<?php echo $fact->getLocRed(); ?>" required>
            <input type="hidden" id="tot_amount" name="tot_amount"  value="<?php echo $cout ?>" required>
            

             </div>
    </div>
    <div class="col-md-2">
        <label class="control-label">&nbsp;</label><br/>
        <button id="add_loc_red" data-id="<?php echo $_SESSION['op_loc_id']; ?>" type="submit" class="btn btn-warning" name="action" style="bottom: 0;"> <span class="fa fa-save"></span></button>
     </div>
</div>
</form>
<hr color="blue">
    <h3>Paiement de la facture</h3>
    <form method="post" action="javascript:void(0)" id="pay_facture_hot">
<div class="form-row">

    <div class="col-md-5">
        <div class="form-group">
            <label class="control-label">Mode de Paie</label>
            <select name="mode_paie" id="mode_paie" class="form-control">
                <option value="Cash">Cash</option>
                <option value="Banque">Banque</option>
            </select>
        </div>
    </div>
    <div class="col-md-5">
        <div class="form-group">
            <label class="control-label">Montant Du</label>
            <input type="number" name="tot_amount" id="tot_amount" class="form-control" value="<?php echo $pay; ?>" required readonly>
        </div>
    </div>
    <div class="col-md-5">
        <div class="form-group">
            <label class="control-label">Montant Payé</label>
            <input type="number" name="mont_trans" id="mont_trans" class="form-control" value="<?php echo $pay; ?>">
            <input id="chamb_id" type="hidden"  name="chamb_id" value=""/>
        </div>
    </div>

    <div class="col-md-2">
        <label class="control-label">&nbsp;</label><br/>
        
        <input type="hidden" name="cheque" id="cheque" class="form-control">
        <input type="hidden" name="opera" id="opera" value="Add" class="form-control">
        <input type="hidden" name="op_id" id="op_id" value="<?php echo $_SESSION['op_loc_id']; ?>" class="form-control">
        <button type="submit" class="btn btn-warning" title="Payer"><i class="fa fa-dollar"></i> Payer</button> 
        


    </div>

</div>
</form>                    </div>
                            </div>

