<?php
@session_start();
require_once '../load_model.php';
$per = new BeanPeriode();
if(isset($_GET['etat']))
{
    $etat=$_GET['etat'];
}
else
{
    $etat='1';
}
?>
<div class="card">
    <div class="card-header">
        <a href="javascript:void(0)" id="nv_periode" data-id="" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Nouveau</a>
        <?php
        $titre_etat="encours";
        echo '<input value="'.$per->getTableName().'" type="hidden" name="table_name" id="table_name">';
        echo '<input value="id_per" type="hidden" name="id_an_sco" id="id_name">';
        echo '<input value="periode" type="hidden" name="tab_name" id="tab_name">';
        
        ?>
        <h3> Période</span></h3>

    </div>

    <div class="card-body">
        <table class="table table-bordered table-sm table-striped display" id="tab_per">
            <thead class="thead-dark">
                <tr>
                    <th>Code</th><th>Debut</th><th>Fin</th><th>Etat</th><th>Inventaire</th>
                    <th>-</th><th>-</th>
                </tr>
            </thead>
            <tbody>
                <?php
                   $datas=$per->select_all();

                   foreach ($datas as $key => $value) {
                    
                       echo '<tr><td>'.$value['code_per'].'</td><td>'.$value['debut'].'</td><td>'.$value['fin'].'</td><td>';
                       if($value['crt']=='1')
                      {
                        echo 'Encours';
                      }
                      else
                      {
                        echo 'Ancienne';
                      }

                       echo '</td><td><a class="btn btn-primary btn-sm inv_val" href="javascript:void(0)" data-id="'.$value['id_per'].'">Afficher</a></td><td>';
                       echo '<button class="btn btn-warning btn-sm" id="nv_periode" data-id="'.$value['id_per'].'" data-id="1"><i class="fa fa-edit"></i></button>';
                       echo '</td><td>';
                      if(!$per->exist_per($value['id_per']))
                       {
                       echo '<button class="btn btn-danger btn-sm delete_per" id="'.$value['id_per'].'" data-id="1"><i class="fa fa-times"></i></button>';
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
        <div class="card-footer">

        </div>
        </div>
