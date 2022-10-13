<?php
@session_start();
require_once '../load_model.php';
$pos = new BeanPos();
$tar = new BeanTarif();

if(!empty($_GET['id']))
{
    $pos->select($_GET['id']);
}
echo '<input value="'.$pos->getTableName().'" type="hidden" name="table_name" id="tab_details" data-id="pos_id">';
?>
<div class="card card-info" >
  <div class="card-header bg-light">Point de Vente</div>
    <div class="card-body">
      <form id="frm_pos" method="post">
          <div class="row p-2 mb-2" style="border: 1px gray solid; border-radius: 5px;">
            <div class="col col-md-1">
                    <label class=" form-control-label">Code</label>
                    <input type="text" id="pos_code" name="pos_code"  class="form-control" value="<?php if(!empty($_GET['id'])) echo $pos->getPosCode();?>">
                </div>
                <div class="col col-md-3">
                    <label class=" form-control-label">Libellé</label>
                    <input type="text" id="pos_name" name="pos_name"  class="form-control" value="<?php if(!empty($_GET['id'])) echo $pos->getPosName();?>">
                </div>
            <div class="col-md-2">
                <label class="control-label">Par Défaut</label>
                <select class="custom-select" name="status" id="status">
                  <?php
                  $datas=array('1'=>'Oui','2'=>'Non');
                  foreach ($datas as $key => $value) {
                    if(!empty($_GET['id']) and $value==$pos->getStatus())
                    {
                      echo '<option value="'.$key.'" selected>'.$value.'</option>';
                    }
                    echo '<option value="'.$key.'">'.$value.'</option>';
                  }
                  ?>
                </select>
            </div>
             
            <div class="col-md-3">
              <br/>
              <input type="hidden" id="pos_id" name="pos_id" value="<?php if(!empty($_GET['id'])) {echo $_GET['id']; }?>">
            <input type="hidden" id="operation" name="operation" value="<?php if(!empty($_GET['id'])) {echo 'Edit';} else { echo 'Add';}?>">
              <button id="Enregistrer" type="submit" class="btn btn-success" name="Enregistrer">Enregistrer</button>
            </div>
          </div>
    </form>
    <div id="last_inserted">
      <table class="table table-bordered table-sm table-striped display tab">
      <thead class="thead-dark">
        <tr>
          <th>Code</th> <th>Libellé</th><th>Par Défaut</th><th>-</th><th>-</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $datas=$pos->select_all();

        foreach ($datas as $key => $value) {

          

          echo '<tr><td>'.$value['pos_code'].'</td><td>'.$value['pos_name'].'</td><td>'.$value['status'].'</td><td>';
          echo '<button class="btn btn-warning btn-sm new_pos" data-id="'.$value['pos_id'].'"><i class="fa fa-edit"></i></button>';
          echo '</td><td>';

          /*if(!$pos->exist_pos($value['pos_id']))
          {*/
            echo '<button class="btn btn-danger btn-sm trash_art" id="'.$value['pos_id'].'" data-id="1"><i class="fa fa-times"></i></button>';
          /*}
          else
          {
            echo '-';
          }*/

          echo '</td></tr>';
        }
        ?>
      </tbody>
    </table>
    </div>
  </div>
</div>