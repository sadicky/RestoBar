<!-- The Modal -->
<?php
if(isset($_POST['op_id']))
{
  $opId=$_POST['op_id'];
  echo '<input type="hidden" value="fiche" name="direct" id="direct">';
}
else
{
  $opId=$_SESSION['op_vente_id'];
  echo '<input type="hidden" value="vente" name="direct" id="direct">';
}

$vente->select($opId);

?>
<div id="myModalPayCust" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <h3 style="text-align: center">Paiement de la Fact No : <?php echo $vente->getNumVente(); ?></h3>
            <span class="close text-danger">&times;</span>
        </div>
        <div class="p-1 mb-2 m-0" style="border: 1px gray solid; border-radius: 5px;">
            <table class="table table-bordered table-sm table-striped display">
            <thead class="thead-dark">
                <tr>
                    <th>Date</th><th>Libellé</th><th>Montant</th><th>Provenance</th><th>Mode de Paiement</th><th>-</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $datas=$trans->select_all_op($opId);
                    $tot=0;
                   foreach ($datas as $key => $value) {
                   
                   $bq->select($value['id_bq']);
                   $tot +=$value['amount'];
                       echo '<tr><td>'.$value['create_date'].'</td><td>'.$value['descript'].'</td><td align="right">'.number_format($value['amount']).'</td><td>'.$bq->getLibBq().'</td><td>'.$value['mode_paie'].'</td><td>';
                       echo '<button class="btn btn-danger btn-sm del_pay_cust" data-id="'.$value['transaction_id'].'"><i class="fa fa-times"></i></button>';
                       echo '</td></tr>';   
                     
                }
                echo '<tr><th>Total</th><td>-</td><th style="text-align:right">'.number_format($tot).'</th><td>-</td><td>-</td><td>-</td></tr>';   
                   ?>

            </tbody>
            </table>
        </div>
</div>
</div>