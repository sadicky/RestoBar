<?php
require_once '../load_model.php';
$cat= new BeanCategory();
$prod= new BeanProducts();
$prod2= new BeanProducts();

if(!empty($_GET['id']))
{
    $prod->select($_GET['id']);
    $cat->select($prod->getCategoryId());
    $prod2->select($prod->getProdEquiv());
}
echo '<input value="'.$prod->getTableName().'" type="hidden" name="table_name" id="tab_details" data-id="prod_id">';
?>

<div class="card card-info" >
    <div class="card-header bg-light">Nouveau Produit</div>
    <div>
        <div class="card-body">
            <form id="frm_product" method="post" autocomplete="off">
                <div class="form-body">
                    <div class="row p-2 mb-2" style="border: 1px gray solid; border-radius: 5px;">
                        <div class="col-md-1">
                            <div class="form-group">
                                <label class="control-label">Code</label>
                                <input type="number" id="prod_code" name="prod_code" class="form-control" value="<?php if(!empty($_GET['id'])) echo $prod->getProdCode(); else echo $prod->select_last_num();?>" required>
                                <span id="available_msg"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Produit</label>
                                <input type="text" id="prod_name" name="prod" class="form-control" value="<?php if(!empty($_GET['id'])) echo $prod->getProdName();?>" required>
                                <span id="available_msg_2"></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Prix</label>
                                <input type="number" id="prod_price" name="prod_price" class="form-control" value="<?php if(!empty($_GET['id'])) echo $prod->getProdPrice(); else echo '0';?>" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Unité Mes</label>
                            <select class="custom-select" name="unt_mes" id="unt_mes">
                                <?php
                                $datas=array('Bouteille','Plat','Godet','Portion');
                                foreach ($datas as $key => $value) {
                                    if(!empty($_GET['id']) and $value==$prod->getUntMes())
                                    {
                                        echo '<option value="'.$value.'" selected>'.$value.'</option>';
                                    }
                                    echo '<option value="'.$value.'">'.$value.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <!-- <div class="col-md-1">
                            <div class="form-group">
                                <label class="control-label">Nbre El</label>
                                <input type="number" id="nb_el" name="nb_el" class="form-control" value="<?php //if(!empty($_GET['id'])) echo $prod->getNbEl(); else echo '1';?>" required>
                            </div>
                        </div> -->
                        <!-- <div class="col-md-2">
                            <label class="control-label">Equivalent : </label>
                            <div class="input_container">
                                <input type="text" id="content_lib_prod" name="content_lib_prod" class="form-control" value="<?php //if(!empty($_GET['id'])) echo $prod2->getProdName();?>"> 
                                <ul id="content_list_prod"></ul>
                                
                            </div>
                        </div> -->
                        <div class="col-md-2">
                            <label class="control-label">Catégorie</label>  
                            <div class="input_container">
                                <input type="text" id="content_lib_cat" name="content_lib_cat" class="form-control" value="<?php if(!empty($_GET['id'])) echo $cat->getCategoryName();?>" required> 
                                <ul id="content_list_cat"></ul>
                                <input type="hidden" name="cat_id" id="cat_id" value="<?php if(!empty($_GET['id'])) echo $prod->getCategoryId();?>" />
                            </div>
                        </div>
                        <div class="col-md-1">
                            <label class="control-label">Stockable</label>
                            <select class="custom-select" name="is_stock" id="is_stock">
                                <?php
                                $datas=array('1'=>'Oui','2'=>'Non');
                                foreach ($datas as $key => $value) {
                                    if(!empty($_GET['id']) and $value==$prod->getIsStock())
                                    {
                                        echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                    }
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-m-1">

                            <?php 
                            if(!empty($_GET['id']))
                            {
                                ?>
                                <input type="hidden" name="operation" id="operation" value="Edit" />
                                <input type="hidden" name="mod_id" id="mod_id" value="<?php echo $_GET['id'];?>" />
                                <?php
                            }
                            else
                            {
                                ?>
                                <input type="hidden" name="operation" id="operation" value="Add" />
                                <?php
                            }
                            ?>
                            <br/>
                            <input type="hidden" name="is_tva" id="is_tva" value="2" />
                            <input type="hidden" id="nb_el" name="nb_el" value="1">
                            <input type="hidden" name="prod_equiv" id="prod_equiv" value="<?php if(!empty($_GET['id'])) echo $prod->getProdEquiv();?>" />
                            <button id="action" data-id="Add" type="submit" class="btn btn-sm btn-success" name="action"> <span class="fa fa-save"></span> Enregistrer</button>

                        </div>
                    </div>
                </div>
            </form>
            <div id="last_inserted">
                <!-- <h3>Derniers Enregistrements</h3> -->
                <div class="table-responsive">
                    <!-- <div class="pull-right">
                    <label>Produit : </label>
                    <input type="text" id="searchProd" placeholder="Votre mot clé ici" class="ml-1" style="height: 30px;"/>
                    </div> -->
                    <table class="table table-striped table-bordered table-hover table-sm" id="tab">
                        <thead>
                            <tr>
                                <th>Categorie</th><th>Produits</th><th>Code</th><th>Prix</th><th>Unité</th><th>Nbre El</th><th>Stockable</th><th>TVA</th><th>Equivalent</th><th>Tarif</th><th>Modifier</th><th>Supprimer</th>
                            </tr>
                        </thead>

                        <tbody class="res_srch">
                            <?php
$datas=$prod->select_all();


foreach ($datas as $un) {
$cat->select($un['category_id']);
$prod->select($un['prod_equiv']);

echo '<tr><td>'.$cat->getCategoryName().'</td>
<td>'.$un['prod_name'].'</td><td>'.$un['prod_code'].'</td><td>'.$un['prod_price'].'</td><td>'.$un['unt_mes'].'</td><td>'.$un['nb_el'].'</td><td>'.$un['is_stock'].'</td><td>'.$un['is_tva'].'</td><td>'.$prod->getProdName().'</td><td>';

echo '<button class="btn btn-sm btn-primary btn-circle new_tarif_art" id="" data-id="'.$un['prod_id'].'"><i class="fa fa-plus"></i></button>';

echo '</td><td>';

echo '<button class="btn btn-sm btn-warning btn-circle new_prod" id="'.$un['prod_id'].'" data-id="'.$un['prod_id'].'"><i class="fa fa-edit"></i></button>';

echo '</td><td>'; 
if(!$prod->exist_prod($un['prod_id']))
{
echo '<button class="btn btn-sm btn-danger btn-circle trash_art" id="'.$un['prod_id'].'" data-id="'.$un['prod_id'].'"><i class="fa fa-times"></i></button>';
}
else
{
echo '-';
}
echo '</td></tr>';
// }
}
?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>

