<?php
require_once '../load_model.php';
$cat= new BeanCategory();
$datas=$cat->select_all();
echo '<input value="'.$cat->getTableName().'" type="hidden" name="table_name" id="tab_details" data-id="category_id">';
?>
<div class="card has-shadow p-2">
  <div class="card-header bg-light"> <h3 class="box-title m-b-0">Categories</h3></div>
  <div class="card-body">
    <p id="nouveau"><a href="javascript:void(0)" class="btn btn-primary btn-sm btn-rounded new_cat"> <i class="fa fa-plus"></i> Nouveau</a>
    </p>
    <div class="table-responsive">
      <table id="example2" class="table table-bordered table-striped table-sm display" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>Categorie</th><th>Coeff(%)</th><th>A Vendre</th><th>Sous Catégorie</th><th>&nbsp;</th><th>&nbsp;</th>
          </tr>
        </thead>


        <tbody>
          <?php
          foreach ($datas as $un) {

            $cat->select($un['category_parent']);
            echo '<tr><td>'.$un['category_name'].'</td><td>'.$un['coeff'].'</td><td>'.$un['is_sale'].'</td><td>'.$cat->getCategoryName().'</td><td>';

            echo '<button class="btn btn-sm btn-warning btn-circle new_cat" id="'.$un['category_id'].'" data-id="'.$un['category_id'].'" id="'.$un['category_id'].'"><i class="fa fa-edit"></i></button>';

            echo '</td><td>';

            if(!$cat->exist_cat($un['category_id']))
            {
              echo '<button class="btn btn-sm btn-danger btn-circle trash_art" id="'.$un['category_id'].'" data-id="1"><i class="fa fa-times"></i></button>';
            }
            else
            {
              echo '-';
            }

            echo '</td></tr>';

          }
          ?>

        </tbody>
      </table>
    </div>
  </div>
</div>
