<?php
@session_start();
require_once '../load_model.php';
$tar = new BeanTarif();
$datas=$tar->select_all();
echo '<input value="'.$tar->getTableName().'" type="hidden" name="table_name" id="tab_details" data-id="tar_id">';
?>
<div class="card">
  <div class="card-header">
    
    <h3> Information du Tarif</span></h3>

  </div>

  <div class="card-body">
    <div class="row">
      <div class="col-md-6 mr-2">
    <p><a href="javascript:void(0)" data-id="" class="btn btn-primary btn-sm new_tarif"><i class="fa fa-plus"></i> Nouveau</a></p>
    <table class="table table-bordered table-sm table-striped display tab">
      <thead class="thead-dark">
        <tr>
          <th>Code</th> <th>Libellé</th><th>Par Défaut</th><th>Stockable</th><th>Détails Tarif</th><th>-</th><th>-</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $datas=$tar->select_all();

        foreach ($datas as $key => $value) {

          echo '<tr><td>'.$value['tar_code'].'</td><td>'.$value['tar_name'].'</td><td>'.$value['status'].'</td><td>'.$value['is_stock'].'</td><td>
          <a class="btn btn-primary btn-sm det_tarif" href="javascript:void(0)" data-id="'.$value['tar_id'].'">Afficher</a>
          </td><td>';
          echo '<button class="btn btn-warning btn-sm new_tarif" data-id="'.$value['tar_id'].'"><i class="fa fa-edit"></i></button>';
          echo '</td><td>';
          if(!$tar->exist_tar($value['tar_id']))
          {
            echo '<button class="btn btn-danger btn-sm trash_art" id="'.$value['tar_id'].'" data-id="1"><i class="fa fa-times"></i></button>';
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
  <div class="col-md-5" id="disp_tarif">
    
  </div>
</div>
  </div>

</div>
