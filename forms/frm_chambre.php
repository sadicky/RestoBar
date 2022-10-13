<?php
require_once '../load_model.php';
$cat= new BeanCategory();
$prod= new BeanProducts();
$cat->select($_POST['cat_id']);
?>

<div class="card card-info" >
                            <div class="card-header bg-light">Categorie : <?php echo $cat->getCategoryName(); ?></div>
                            <div>
                                <div class="card-body">
                                    <form id="frm_chambre" method="post">
                                        <div class="form-body">
<div class="form-row">
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label">N° Chambre / Nom Salle</label>
            <input type="text" id="chamb_num" name="chamb" class="form-control" value="" required>
            <span id="available_msg_2"></span>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label">Prix</label>
            <input type="number" id="chamb_price" name="chamb_price" class="form-control" value="" required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="control-label">Détails</label>
            <textarea id="chamb_cara" name="chamb_cara" class="form-control">
            </textarea>
        </div>
    </div>
</div>
</div>
<div class="form-actions">
    
            <input type="hidden" name="chamb_id" id="chamb_id" value="" />
            <input type="hidden" name="cat_id" id="cat_id" value="<?php echo $_POST['cat_id']; ?>"/>
            <input type="hidden" name="operation" id="operation" value="Add" />
            <label class="control-label">&nbsp;</label>
            <button id="action" data-id="Add" type="submit" class="btn btn-sm btn-success" name="action"> <span class="fa fa-save"></span> Enregistrer</button>

        </div>
</form>

                                </div>
                            </div>
                </div>

