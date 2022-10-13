<?php
require_once '../load_model.php';
$cat= new BeanCategory();
$prod=new BeanProducts();
$datas=$prod->select_all_date(date('Y-m-d'));

echo '<input value="'.$prod->getTableName().'" type="hidden" name="table_name" id="tab_details" data-id="prod_id">';
?>
<div class="card has-shadow p-2">
  <div class="card-header bg-light"> <h3 class="box-title m-b-0">Dernières produits enregistrés</h3></div>
  <div class="card-body">
  <p id="nouveau"><a href="javascript:void(0)" class="btn btn-primary btn-sm btn-rounded new_prod" data-id=""> <i class="fa fa-plus"></i> Nouveau Produit</a>
    </p>
  <div class="table-responsive">
    <table class="table table-striped table-bordered table-hover table-sm" id="tab">
      <thead>
        <tr>
          <th>Categorie</th><th>Produits</th><th>Code</th><th>Unité</th><th>Prix</th><th>Stockable</th><th>En Promo</th><th>TVA</th><th>Compo</th><th>Tarif</th><th>Modifier</th><th>Supprimer</th>
        </tr>
      </thead>

      <tbody>
        <?php
        foreach ($datas as $un) {
          $cat->select($un['category_id']);

          echo '<tr><td>'.$cat->getCategoryName().'</td>
          <td>'.$un['prod_name'].'</td><td>'.$un['prod_code'].'</td><td>'.$un['unt_mes'].'</td><td>'.$un['prod_price'].'</td><td>'.$un['is_stock'].'</td><td>'.$un['is_promo'].'</td><td>'.$un['is_tva'].'</td><td>'.$un['nb_el'].'</td><td>';

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