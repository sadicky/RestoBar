<?php
@session_start();
require_once '../load_model.php';
$prod= new BeanProducts();
$jr= new BeanJournal();
$pers= new BeanPersonne();
$pers2= new BeanPersonne();
$paie= new BeanPaiement();
$op= new BeanOperation();
$trans=new BeanTransactions();
$stock = new BeanStock();
$pr=new BeanPrice();
$vente= new BeanVente();


if(isset($_GET['jour']))
{
    $jour=$_GET['jour'];
}
else
{
    $jour="";
}

$jr->select($jour);
$datas=$op->select_all_sale_jour('Vente',$jour);
?>
<a href="javascript:void(0)" id="print_rap" class="btn btn-success" title="Imprimer"><span class="fa fa-print"></span></a>
<div class="white-box" id="rap_to_print">
    <h4 class="box-title m-b-0">Rapport de Synthèse de Caisse</h4>
    <small>(Journal Du <?php echo $jr->getStartDate(); ?> Au <?php if(!empty($jr->getEndDate())) echo $jr->getEndDate(); else echo '?'; ?> )</small>
    <h5>Balance : <i><?php
    
    echo number_format($trans->select_bal_jour_admin($jour),0,'.',',');
    
     ?> BIF</i></h5>
    <hr/>
    <hr/>

                            <div class="table-responsive">
               <table id="example2" class="table table-bordered table-condensed display" cellspacing="0" width="100%" border="1">
               <thead>
    <tr>
        <th>Libellé</th><th>Montant</th>
    </tr>
                            </thead>

                                    <tbody>
<?php
$tot=0;
$i=1;
foreach ($datas as $key => $value) {
    $prod->select($value['prod_id']);
    $tot +=$value['price'];

    //echo '<tr><td>'.$i.'</td><td>'.$prod->getProdName().'</td><td>'.number_format($value['qt'],'1','.',',').'</td><td>'.number_format($value['price'],'0','.',',').'</td></tr>';

    $i++;

}
?>
    <tr><th>Total Cash</th><th><?php
    $cash=$trans->select_sum_op_cash($jour);
    echo number_format($cash,'0','.',','); ?></th></tr>
    <tr><th>Total Banque</th><th><?php
    $bq=$trans->select_sum_op_bq($jour);
    echo number_format($bq,'0','.',','); ?></th></tr>
    <tr><th>Total Crédit </th><th><?php $paie_cash=$cash+$bq;
    echo number_format($tot-$paie_cash,'0','.',','); ?></th></tr>
    <tr><th>Total Vente</th><th><?php echo number_format(($tot),'0','.',','); ?></th></tr>
    <tr><th>Paiements</th><th><?php
    $ant=$trans->select_sum_op_ant($jour);
    echo number_format($ant,'0','.',','); ?></th></tr>
    <?php
    if(!empty($trans->select_sum_in($jour)))
    {
    ?>
    <tr><th>Total Versement</th><th><?php
    echo number_format($trans->select_sum_in($jour),'0','.',','); ?></th></tr>
    <?php
    }
    ?>
    <tr><th>Total Dépenses</th><th><?php
    echo number_format($trans->select_sum_out($jour),'0','.',','); ?></th></tr>

    <tr><th>Réport (Fonds de Caisse)</th><th><?php echo number_format($jr->getOpenBal(),'0','.',','); ?></th></tr>

    <tr><th>Solde (Cash) </th><th><?php $solde=(($jr->getOpenBal() + ($paie_cash+$ant) + $trans->select_sum_in($jour)) -$trans->select_sum_out($jour));
    echo number_format($solde,'0','.',','); ?></th></tr>
</tbody>
               </table>
              </div>
</div>
