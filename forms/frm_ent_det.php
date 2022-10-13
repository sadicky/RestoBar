<?php
@session_start();
require_once '../load_model.php';
//$acc= new BeanCategory();
//$acc->select($_POST['cat_id']);
?>

<div class="card card-info" >
                            <div class="card-header bg-light">Categorie : <span id="prod_cat"></span> / N° Bon de Production : #<span id="num_ent"><?php if(isset($_SESSION['ent_num'])){echo $_SESSION['ent_num'];}else {echo '?';} ?></span></div>
                            <div >
                                <div class="card-body">
                                    <form id="ent_prodf_form" method="post">
                                        <div class="form-body">
<div class="form-row">
    <div class="col-md-7">
        <div class="form-group">
            <label class="control-label">Produit</label>

            <input type="text" id="prod_det" name="prod" class="form-control" value="" required>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label">Qté</label>

            <input type="number" id="prod_qt" name="prod_qt" class="form-control" value="" required>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <br/>
        <button id="action" data-id="Add" type="submit" class="btn btn-success" name="action" style="bottom: 0;" <?php if(!isset($_SESSION['ent_num'])){echo 'disabled="disabled"';} ?>> <span class="fa fa-save"></span> <span id="lab_action"></span></button>
        </div>
    </div>
</div>
</div>
        <input type="hidden" name="prod_prix" id="prod_prix" class="form-control">
            <input type="hidden" name="prod_id" id="prod_id" />
            <!-- <input type="hidden" name="prod_prix" id="prod_prix" /> -->
            <input type="hidden" name="ent_id" id="ent_id" />
            <input type="hidden" name="det_id" id="det_id" />
            <input type="hidden" name="operation" id="operation" value="Add" />

            <input type="hidden" id="sup_id" name="sup_id" class="form-control" value="<?php if(isset($_SESSION['sup_id'])) echo $_SESSION['sup_id'];?>" required>

            <input type="hidden" id="op_ent_id" name="op_ent_id" class="form-control" value="<?php if(isset($_SESSION['op_ent_id'])) echo $_SESSION['op_ent_id'];?>" required>

            <!-- <button id="action" data-id="Add" type="submit" class="btn btn-success" name="action"> <span class="fa fa-save"></span> <span id="lab_action">Enregistrer</span></button>
 -->

</form>
                                </div>
                            </div>
                </div>

