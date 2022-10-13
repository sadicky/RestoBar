<?php
@session_start();
require_once '../load_model.php';
$cat= new BeanCategory();
$cat2= new BeanCategory();
$prod=new BeanProducts();
$stock=new BeanStock();
?>
<div class="card has-shadow p-2">
  <div class="card-header bg-light"> <h3 class="box-title m-b-0"><a href="javascript:void(0)" data-id="Tous" class="cat_products" style="cursor:pointer">Tous Les articles</a></h3></div>
  <div class="card-body">
<div class="row">
  <div class="col-md-3">
    <table class="table table-bordered table-striped table-sm display tab" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>Categorie</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $datas=$cat->select_all();
        foreach ($datas as $un) {
          //$cat->select($un['category_parent']);
          echo '<tr><td>';//<a href="javascript:void(0)" data-id="'.$un['category_id'].'" class="cat_products" style="cursor:pointer">';

          echo '<a href="javascript:void(0)" class="show_cont_det" id="'.$un['category_id'].'" data-id="'.$un['category_name'].'"><i class="fa fa-plus"></i> '.$un['category_name'].'</a>';

            $dat2=$cat->select_all_parent($un['category_id']);
            foreach ($dat2 as $un2) {
              //echo $un2['category_name'];

                echo '<div class="det'.$un['category_id'].' hide_cont_det" style="padding-left:25px;">
                <a href="javascript:void(0)" class="cat_products" data-id="'.$un2['category_id'].'"> '.$un2['category_name'].'</a>
                </div>';

            }

          echo '</td></tr>';
        }
        ?>
      </tbody>
    </table> 
  </div>
  <div class="col-md-9">
    <div class="table-responsive">
      <?php
      if(!empty($_GET['cat_id']))
      {
        if($_GET['cat_id']=='Tous')
        {
          $datas=$prod->select_all();
        echo '<h3>Catégorie : Tous</h3>';
        }
        else
        {
        $datas=$prod->select_all_cat($_GET['cat_id']);
        $cat->select($_GET['cat_id']);
        $cat2->select($cat->getCategoryParent());
        echo '<h3>Catégorie : '.$cat->getCategoryName().'/Menu : '.$cat2->getCategoryName().'</h3>';
        }
      }
      else
      {
        $datas=$prod->select_all_date(date('Y-m-d'));
        echo '<h3>Dernièrs enregistrements</h3>';
      }

      echo '<input value="'.$prod->getTableName().'" type="hidden" name="table_name" id="tab_details" data-id="prod_id">';
      ?>
      <table class="table table-striped table-bordered table-hover table-sm tab">
        <thead>
          <tr>
            <th>Categorie</th><th>Produits</th><th>Code</th><th>Prix</th><th>Unité</th><th>Nbre El</th><th>Stockable</th><th>TVA</th><th>Equivalent</th><th>Tarif</th><th>Modifier</th><th>Supprimer</th>
          </tr>
        </thead>

        <tbody>
          <?php
          foreach ($datas as $un) {
            $cat->select($un['category_id']);
            $prod->select($un['prod_equiv']);
            
            echo '<tr><td>'.$cat->getCategoryName().'</td>
            <td contenteditable="true" class="edit_prod" id="'.$un['prod_id'].'" data-id="prod_name">'.$un['prod_name'].'</td>
            <td contenteditable="true" class="edit_prod" id="'.$un['prod_id'].'" data-id="prod_code">'.$un['prod_code'].'</td>
            <td contenteditable="true" class="edit_prod" id="'.$un['prod_id'].'" data-id="prod_price">'.$un['prod_price'].'</td>
            <td contenteditable="true" class="edit_prod" id="'.$un['prod_id'].'" data-id="unt_mes">'.$un['unt_mes'].'</td>
            <td contenteditable="true" class="edit_prod" id="'.$un['prod_id'].'" data-id="nb_el">'.$un['nb_el'].'</td>
            <td contenteditable="true" class="edit_prod" id="'.$un['prod_id'].'" data-id="is_stock">'.$un['is_stock'].'</td>
            <td contenteditable="true" class="edit_prod" id="'.$un['prod_id'].'" data-id="is_tva">'.$un['is_tva'].'</td><td>'.$prod->getProdName().'</td><td>';

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
