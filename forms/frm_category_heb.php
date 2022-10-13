<?php
require_once '../load_model.php';
$acc= new BeanAccounts();
$cat=new BeanCategory();
?>

<div class="card" >
<div class="card-header bg-light">Categorie des chambres</div>

                                <div class="card-body">
                                    <form id="frm_category" method="post">
                                        <div class="form-body">
<div class="form-row">
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label">Libellé</label>
            <input type="text" id="category_name" name="cat_name" class="form-control" value="" required>
        </div>
    </div>
    
<div class="col-md-3">
    <br/>
            <input type="hidden" name="cat_id" id="category_id" />
            <input type="hidden" name="is_sale" id="is_sale_oui" value="Oui" />
            <input type="hidden" name="category_type" id="category_type" value="2" />
            <input type="hidden" name="operation" id="operation" value="Add" />
            <label class="control-label">&nbsp;</label>
            <button id="action" data-id="Add" type="submit" class="btn btn-sm btn-success" name="action"> <span class="fa fa-save"></span> Enregistrer</button>

</div>
</div>
</div>
</form>
<div id="last_insertedx">
    </div>
                                </div>

                </div>

