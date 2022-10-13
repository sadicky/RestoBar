<?php
@session_start();
require_once '../load_model.php';
$cat= new BeanCategory();
$cat2= new BeanCategory();
$prod=new BeanProducts();
$stock=new BeanStock();
?>
<div class="white-box" style="overflow: auto;">
  <h2 style="font-size: 18px; font-weight: bold">Tarifs</h2>
<form class="form-inline"  method="post" id="cat-select">
<div class="form-group">
<label class="control-label mr-2">Catégorie</label> 
<select class="custom-select cat-srch">
  <option value="">-- Tous --</option>
  <?php
  $datas=$cat->select_all_4('Oui');
  foreach ($datas as $key => $value) {
      if($_GET['cat_id']==$value['category_id'])
      echo '<option value="'.$value['category_id'].'" selected>'.$value['category_name'].'</option>';
      else
      echo '<option value="'.$value['category_id'].'">'.$value['category_name'].'</option>';  
    
  }
  ?>
</select>
</div>
</form>
<hr>
<div class="table-responsive">
  <!-- <button class="btn btn-success btn-sm new_prod_tar"><i class="fa fa-plus"></i> Nouveau</button> -->
  <table class="table table-sm w-25">
    <tr><td>Catégorie :</td><th contenteditable="true" class="edit_cat" id="<?php echo $_GET['cat_id']; ?>" data-id="category_name"><?php $cat->select($_GET['cat_id']); echo $cat->getCategoryName(); ?></th>
    </tr>
  </table>
               <table class="table table-striped table-bordered table-hover table-sm tab">
        <thead>
          <tr>
            <th>Categorie</th><th>Produits</th><th>Prix</th><th>Nb El</th><th>Unité</th><th>Stockable</th>
          </tr>
        </thead>

        <tbody>
          <?php
          $datas=$prod->select_all();
          foreach ($datas as $un) {
            $cat->select($un['category_id']);
            $prod->select($un['prod_equiv']);
            if($cat->getIsSale()=='Oui' and $cat->getCategoryId()==$_GET['cat_id'])
            {
            echo '<tr><td>'.$cat->getCategoryName().'</td>
            <td contenteditable="true" class="edit_prod" id="'.$un['prod_id'].'" data-id="prod_name">'.$un['prod_name'].'</td><td contenteditable="true" class="edit_prod" id="'.$un['prod_id'].'" data-id="prod_price">'.$un['prod_price'].'</td><td contenteditable="true" class="edit_prod" id="'.$un['prod_id'].'" data-id="nb_el">'.$un['nb_el'].'</td><td contenteditable="true" class="edit_prod" id="'.$un['prod_id'].'" data-id="unt_mes">'.$un['unt_mes'].'</td><td>';
           
           echo '<span class="mr-2">
           <input name="state'.$un['prod_id'].'" data-id="'.$un['prod_id'].'" value="1" type="radio" class="stock_state" '; if($un['is_stock']=='Oui') echo ' checked'; echo '> <label for="Oui">Oui</label>
           </span>';
          
          echo '<span class="mr-2">
          <input name="state'.$un['prod_id'].'" data-id="'.$un['prod_id'].'" value="2" type="radio" class="stock_state" '; if($un['is_stock']=='Non') echo ' checked'; echo '> <label for="Non">Non</label></span>';

            echo '</td></tr>';
            }
            elseif($cat->getIsSale()=='Oui' and empty($_GET['cat_id']))
            {
            echo '<tr><td>'.$cat->getCategoryName().'</td>
            <td contenteditable="true" class="edit_prod" id="'.$un['prod_id'].'" data-id="prod_name">'.$un['prod_name'].'</td><td contenteditable="true" class="edit_prod" id="'.$un['prod_id'].'" data-id="prod_price">'.$un['prod_price'].'</td><td contenteditable="true" class="edit_prod" id="'.$un['prod_id'].'" data-id="nb_el">'.$un['nb_el'].'</td><td contenteditable="true" class="edit_prod" id="'.$un['prod_id'].'" data-id="unt_mes">'.$un['unt_mes'].'</td><td>';
            
             echo '<span class="mr-2">
           <input name="state'.$un['prod_id'].'" data-id="'.$un['prod_id'].'" value="1" type="radio" class="stock_state" '; if($un['is_stock']=='Oui') echo ' checked'; echo '> <label for="Oui">Oui</label>
           </span>';
          
          echo '<span class="mr-2">
          <input name="state'.$un['prod_id'].'" data-id="'.$un['prod_id'].'" value="2" type="radio" class="stock_state" '; if($un['is_stock']=='Non') echo ' checked'; echo '> <label for="Non">Non</label></span>';

            echo '</td></tr>';
            }
            {

            }
// }
          }
          ?>
        </tbody>
      </table>
              </div>
</div>
<?php// include('../forms/modal_prod.php'); ?>