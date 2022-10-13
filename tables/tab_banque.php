<?php
@session_start();
require_once '../load_model.php';
$bq = new BeanBanque();
$paie =new BeanTransactions();

?>
<div class="card">
    <div class="card-header">
        <a href="javascript:void(0)" id="nv_bq" data-id="" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Nouveau</a>

        <?php
        $titre_etat="encours";
        echo '<input value="'.$bq->getTableName().'" type="hidden" name="table_name" id="table_name">';
        echo '<input value="id_bq" type="hidden" name="id_bq" id="id_name">';
        echo '<input value="table_bq" type="hidden" name="tab_name" id="tab_name">';

        ?>
        <h3>Banque</h3>

    </div>

    <div class="card-body">

        <table class="table table-bordered table-sm table-striped display" id="tab_bq">
            <thead class="thead-dark">
                <tr>
                    <th>Libellé</th><th>Balance</th><th>Par défaut</th><th>-</th><th>-</th>
                </tr>
            </thead>
            <tbody>
                <?php
                   $datas=$bq->select_all();
                   $tot=0;
                   foreach ($datas as $key => $value) {
                    
                      $balance=$paie->select_balance($value['id_bq']);

                      $tot +=$balance;
                       echo '<tr><td>'.$value['lib_bq'].'</td><td align="right">'.$paie->nb_format($balance).'</td><td>'.$value['status'].'</td><td>';
                       echo '<button class="btn btn-warning btn-sm" id="nv_bq" data-id="'.$value['id_bq'].'" data-id="1"><i class="fa fa-edit"></i></button>';
                       echo '</td><td><button class="btn btn-danger btn-sm trash_op" id="'.$value['id_bq'].'" data-id="1"><i class="fa fa-times"></i></button></td></tr>';

                  
              }
                   ?>
            </tbody>
            <tfoot>
              <tr><th>Total</th><td align="right"><?php echo $paie->nb_format($tot); ?></td><td>-</td><td>-</td></tr>
            </tfoot>
        </table>

    </div>
        <div class="card-footer">

        </div>
        </div>
