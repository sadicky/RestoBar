<?php
@session_start();
require_once '../load_model.php';
$paie = new BeanTransactions();
$bq = new BeanBanque();

$type='Retrait';
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
        echo '<input value="table_dep" type="hidden" name="tab_paie" id="tab_name">';

        ?>
        <h3> Opérations de Caisse (Dépenses)</h3>

    </div>

    <div class="card-body">

      <?php
      include('../forms/frm_depense.php');
      ?>
      <form id="frm_srch_rap_dep" method="post">
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
            <label class="control-label">Provenance</label>
            <select name="bq_id" id="bq_id" class="custom-select">
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
        <table class="table table-bordered table-sm table-striped display" id="tab_depense">
            <thead class="thead-dark">
                <tr>
                    <th>Date</th><th>Désignation</th><th>Montant</th><th>Provenance</th><th>Mode de Paiement</th><th>-</th><th>-</th>
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
                $tot=0;
                   foreach ($datas as $key => $value) {
                   
                   $bq->select($value['id_bq']);
                   $typ->select($value['party_code']);

                       echo '<tr><td>'.$value['create_date'].'</td><td>'.$typ->getLibTyp().': '.$value['descript'].'</td><td>'.$value['amount'].'</td><td>'.$bq->getLibBq().'</td><td>'.$value['mode_paie'].'</td><td>';

                       
                        echo '<button class="btn btn-primary btn-sm nv_dep" data-id="'.$value['transaction_id'].'"><i class="fa fa-edit"></i></button>';
                      
                       echo '</td><td>';
                       echo '<button class="btn btn-danger btn-sm trash_trans" data-id="'.$value['transaction_id'].'"><i class="fa fa-times"></i></button>';
                       echo '</td></tr>';  

                       $tot +=$value['amount']; 
                     
              }
                   ?>
            </tbody>
            <tfoot>
              <tr>
                    <th>-</th><th>Total</th><th><?php echo number_format($tot); ?></th><th>-</th><th>-</th><th>-</th><th>-</th>
                </tr>
            </tfoot>
        </table>

    </div>
        
        </div>
