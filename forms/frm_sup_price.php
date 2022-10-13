<?php session_start();

require_once '../load_model.php';
$prod = new BeanProducts();
$datas=$prod->select_all();
?>
<form method="post" id="sup_price_form">
<div class="form-body">
<h3 class="box-title">Produits - Prix</h3>
<hr>
<div class="form-row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label">Produit</label>
            <select id="lib_prod" name="lib_prod" class="form-control select2" required>
                <option value="">Choisir</option>
                <?php
                foreach($datas as $un)
                {
                    echo '<option value="'.$un['prod_id'].'">'.$un['prod_name'].'</option>';
                }
                ?>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label">Prix</label>
            <input type="number" id="prix_prod" name="prix_prod" class="form-control" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label">Date Début</label>
            <input type="text" id="date_debut" name="date_debut" class="form-control" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label">Commentaire</label>
            <textarea name="comment_price" id="comment_price" class="form-control">
            </textarea>

        </div>
    </div>
</div>
<div class="form-actions">
<input type="hidden" name="price_id" id="price_id" />
<input type="hidden" name="operation" id="operation" value="Add" />

<input type="hidden" id="sup_id" name="sup_id" class="form-control" value="<?php if(isset($_SESSION['sup_id'])) echo $_SESSION['sup_id'];?>" required>
<button id="action" data-id="Add" type="submit" class="btn btn-success" name="action"> <i class="fa fa-check"></i><span id="lab_action">Enregistrer</span></button>

<button type="reset" class="btn btn-default" id="reset_act">Annuler</button>
</div>
</form>
