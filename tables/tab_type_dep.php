<?php
@session_start();
require_once '../load_model.php';
$typ = new BeanTypeDep();

?>
<div class="card">
    <div class="card-header">
       
        <?php
        echo '<input value="'.$typ->getTableName().'" type="hidden" name="table_name" id="table_name">';
        echo '<input value="id_typ" type="hidden" name="id_typ" id="id_name">';
        echo '<input value="table_typdep" type="hidden" name="tab_name" id="tab_name">';

        ?>
        <h3>Classes de Dépenses</h3>
    </div>

    <div class="card-body">
       <?php include('../forms/frm_type_dep.php');?>
        <table class="table table-bordered table-sm table-striped display" id="tab_typ_dep">
            <thead class="thead-dark">
                <tr>
                    <th>Nom classe</th><th>-</th><th>-</th>
                </tr>
            </thead>
            <tbody>
                <?php
                   $datas=$typ->select_all();

                   foreach ($datas as $key => $value) {
                    /*if($value['etat']==$etat)
                    {*/
                      //$prov->select($value['id_prov']);
                       echo '<tr><td>'.$value['lib_typ'].'</td><td>';
                       echo '<button class="btn btn-warning btn-sm nv_typ_dep" id="'.$value['id_typ'].'"><i class="fa fa-edit"></i></button>';
                       echo '</td><td>';
                       echo '<button class="btn btn-danger btn-sm trash_cash" id="'.$value['id_typ'].'"><i class="fa fa-times"></i></button>';

                       echo '</td></tr>';

                  //}
              }
                   ?>
            </tbody>
        </table>

    </div>
        <div class="card-footer">

        </div>
        </div>
