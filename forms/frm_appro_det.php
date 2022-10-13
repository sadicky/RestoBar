<?php
@session_start();
require_once '../load_model.php';
//$acc= new BeanCategory();
//$acc->select($_POST['cat_id']);
?>

<div class="card card-info" >
                            <div class="card-header bg-light">Categorie : <span id="prod_cat"></span> / N° Bon de commande : #<span id="num_appro"><?php if(isset($_SESSION['op_num'])){echo $_SESSION['op_num'];}else {echo '?';} ?></span></div>
                            <div>
                                <div class="card-body">
                                    <form id="sup_appro_form" method="post">
                                        <div class="form-body">
<div class="form-row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="control-label">Produit</label>

            <input type="text" id="prod_appro" name="prod" class="form-control" value="" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label">Qté</label>

            <input type="text" id="prod_qt" name="prod_qt" class="form-control" value="" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label">P.A.U</label>
            <input type="number" name="prod_prix" id="prod_prix" class="form-control" value="" required>
        </div>
    </div>

</div>
</div>
<div class="form-actions">
            <input type="hidden" name="prod_id" id="prod_id" />
            <!-- <input type="hidden" name="prod_prix" id="prod_prix" /> -->
            <input type="hidden" name="appro_id" id="appro_id" />
            <input type="hidden" name="det_id" id="det_id" />
            <input type="hidden" name="operation" id="operation" value="Add" />

            <input type="hidden" id="sup_id" name="sup_id" class="form-control" value="<?php if(isset($_SESSION['sup_id'])) echo $_SESSION['sup_id'];?>" required>

            <input type="hidden" id="op_id" name="op_id" class="form-control" value="<?php if(isset($_SESSION['op_id'])) echo $_SESSION['op_id'];?>" required>

            <button id="action" data-id="Add" type="submit" class="btn btn-sm btn-success" name="action"> <span class="fa fa-save"></span> <span id="lab_action">Enregistrer</span></button>

        </div>
</form>
                                </div>
                            </div>
                </div>

