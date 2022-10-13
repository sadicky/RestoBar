<?php
@session_start();
?>

<div class="card card-info" >
                            <div>
                                <div class="card-body">
<form id="det_sup_vente" method="post">
                                        <div class="form-body">
<div class="form-row">
    <div class="col-md-7">
        <div class="form-group">
            <label class="control-label">Réduction</label>
            <input type="text" id="val_red" name="val_red" class="form-control" value="" required>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label">TVA (18%)</label>
            <input type="checkbox" id="val_tva" name="val_tva" value="0">
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <br/>
        <button id="action_sup" data-id="Add" type="submit" class="btn btn-success" name="action" style="bottom: 0;"> <span class="fa fa-save"></button>
        </div>
    </div>
</div>
</div>
        <input type="hidden" name="prod_prix" id="prod_prix" class="form-control">

            <input type="hidden" name="vente_id" id="vente_id" />
            <input type="hidden" id="op_vente_id" name="op_vente_id" class="form-control" value="<?php if(isset($_SESSION['op_vente_id'])) echo $_SESSION['op_vente_id'];?>" required>

</form>
                                </div>
                            </div>
                </div>

