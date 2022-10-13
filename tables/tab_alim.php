<?php
@session_start();
require_once '../load_model.php';
$paie = new BeanTransactions();
$bq = new BeanBanque();

$type='Versement';
if(!empty($_GET['from_d']))
{
  $bqId=$_GET['bq_id'];
  $from_d=$_GET['from_d'];
  $to_d=$_GET['to_d'];
}
else
{
  $bqId='';
  $from_d=date('Y-m-d');
  $to_d=date('Y-m-d');
}
?>
<div class="card">
    <div class="card-header">
        
        <?php
        $titre_etat="encours";
        echo '<input value="'.$paie->getTableName().'" type="hidden" name="table_name" id="table_name">';
        echo '<input value="idp" type="hidden" name="idp" id="id_name">';
        echo '<input value="table_alim" type="hidden" name="tab_paie" id="tab_name">';

        ?>
        <h3> Opérations de Caisse (Alimentation)</h3>

    </div>

    <div class="card-body">

      <?php
      include('../forms/frm_alim.php');
      ?>
      <form id="frm_srch_rap_alim" method="post">
                                        <div class="form-body">
<div class="form-row">
        <div class="col-md-2">
        <div class="form-group">
            <label class="control-label">Du : </label>
            <input type="date" id="from_d" name="from_d" class="form-control" value="<?php if(!empty($_GET['from_d'])) echo $_GET['from_d']; else echo date("Y-m-d"); ?>" required>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label">Au : </label>
            <input type="date" id="to_d" name="to_d" class="form-control" value="<?php if(!empty($_GET['to_d'])) echo $_GET['to_d']; else echo date("Y-m-d"); ?>" required>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label">Destination</label>
            <select name="bq_id" id="bq_id" class="form-control">
                <option value="" selected>Tous</option>
                <?php
                  $mode=$bq->select_all();
                  foreach($mode as $e)
                    {
                    if($e['id_bq']==$_GET['bq_id']) {echo '<option value="'.$e['id_bq'].'" selected>'.$e['lib_bq'].'</option>';}
                    echo '<option value="'.$e['id_bq'].'">'.$e['lib_bq'].'</option>';
                    }
            ?>
            </select>
        </div>
    </div>
    <div class="col-md-2" >
        <div class="form-group" style="bottom:0;">
            &nbsp;<br/>
            <button id="action" data-id="Add" type="submit" class="btn btn-success btn-sm" name="search"> <span class="fa fa-search"></span> Recherche</button>
        </div>
    </div>
</div>
</div>
</form>
        <table class="table table-bordered table-sm table-striped display" id="tab">
            <thead class="thead-dark">
                <tr>
                    <th>Date</th><th>Libellé</th><th>Montant</th><th>Destination</th><th>Mode de Paiement</th><th>-</th><th>-</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(empty($bqId))
                {
                $datas=$paie->select_all_type_period($type,$from_d,$to_d);
                }
                else
                {
                $datas=$paie->select_all_type_period_bq($type,$from_d,$to_d,$bqId);
                }

                   foreach ($datas as $key => $value) {
                   
                   $bq->select($value['id_bq']);

                       echo '<tr><td>'.$paie->date_format($value['create_date']).'</td><td>'.$value['descript'].'</td><td>'.$value['amount'].'</td><td>'.$bq->getLibBq().'</td><td>'.$value['mode_paie'].'</td><td>';

                       
                        echo '<button class="btn btn-primary btn-sm nv_alim" data-id="'.$value['transaction_id'].'"><i class="fa fa-edit"></i></button>';
                      
                       echo '</td><td>';
                       echo '<button class="btn btn-danger btn-sm trash_trans" data-id="'.$value['transaction_id'].'"><i class="fa fa-times"></i></button>';
                       echo '</td></tr>';   
                     
              }
                   ?>
            </tbody>
        </table>

    </div>
        <div class="card-footer">

        </div>
        </div>
