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
$pr=new BeanPrice();
$vente= new BeanVente();
$det=new BeanDetailsOperation();
/*if(isset($_SESSION['jour']))
{
    $jour=$_SESSION['jour'];
}
else
{
    $jour="";
}*/

$datas=$op->select_all_sale_period('Vente',$_GET['from_d'],$_GET['to_d']);

//echo $_GET['party']; 
?>
<a href="javascript:void(0)" id="print_rap" class="btn btn-success" title="Imprimer"><span class="fa fa-print"></span></a>
<div class="white-box" id="rap_to_print">
    <h4 class="box-title m-b-0">Rapport des Ventes du <?php echo $_GET['from_d']; ?> du <?php echo $_GET['to_d']; ?></h4>
    <hr/>
<div class="table-responsive">
                             <table id="example23" class="table table-bordered table-condensed display" cellspacing="0" width="100%" border="1">
                             <thead>
    <tr>
        <th>Produits</th><th>Quantité</th><th>PVT</th><th>PAT</th><th>Bén</th>
    </tr>
                            </thead>

                                    <tbody>
<?php
$tot=0;
$totpa=0;
$tot_ben;
foreach ($datas as $key => $value) {
    $prod->select($value['prod_id']);
    $last=$det->select_last_id('Approvisionnement',$value['prod_id']);
    $det_id=$last['last_id'];
    $det->select($det_id);
    $pa=$det->getAmount();
//echo $_GET['from_d'].'-'.$_GET['to_d'];
    if(!empty($_GET['cat']))
    {
            if($_GET['cat']==$prod->getCategoryId())
            {
                if(empty($_GET['party']))
                {
                    $tot +=$value['price'];
                    
                echo '<tr><td>'.$prod->getProdName().'</td><td>'.$value['qt'].'</td><td>'.number_format($value['price'],'0','.',',').'</td><td>-</td><td>-</td></tr>';
                }
                elseif(($prod->getUntMes()<>'Bouteille') and $_GET['party']=='1')
                {
                $tot +=$value['price'];
                
                echo '<tr><td>'.$prod->getProdName().'</td><td>'.$value['qt'].'</td><td>'.number_format($value['price'],'0','.',',').'</td><td>-</td><td>-</td></tr>';
                }
                elseif(($prod->getUntMes()=='Bouteille') and $_GET['party']=='2') 
                {
                $tot +=$value['price'];
                $pat =$pa*$value['qt'];
                $totpa +=$pat;
                $ben=$value['price']-$pat;
                echo '<tr><td>'.$prod->getProdName().'**</td><td>'.$value['qt'].'</td><td>'.number_format($value['price'],'0','.',',').'</td><td>'.number_format($pat,'0','.',',').'</td><td>'.number_format($ben,'0','.',',').'</td></tr>';
                }
            }
    }
    else
    {
        if(empty($_GET['party']))
            {
               $tot +=$value['price'];
                echo '<tr><td>'.$prod->getProdName().'</td><td>'.$value['qt'].'</td><td>'.number_format($value['price'],'0','.',',').'</td><td>-</td><td>-</td></tr>'; 
            }
            elseif($prod->getUntMes()<>'Bouteille' and $_GET['party']=='1')
                {

               $tot +=$value['price'];
                echo '<tr><td>'.$prod->getProdName().'</td><td>'.$value['qt'].'</td><td>'.number_format($value['price'],'0','.',',').'</td><td>-</td><td>-</td></tr>'; 
                }
            elseif($prod->getUntMes()=='Bouteille' and $_GET['party']=='2') 
                {

               $tot +=$value['price'];
               $pat =$pa*$value['qt'];
                $totpa +=$pat;
                $ben=$value['price']-$pat;
                echo '<tr><td>'.$prod->getProdName().'</td><td>'.$value['qt'].'</td><td>'.number_format($value['price'],'0','.',',').'</td><td>'.number_format($pat,'0','.',',').'</td><td>'.number_format($ben,'0','.',',').'</td></tr>'; 
                }

    }
}

?>

                                    <!-- </tbody>
<tfoot> -->

    <tr><th>Total Vente</th><th>-</th><th>-</th><th>-</th><th><?php echo number_format(($tot),'0','.',','); ?></th></tr>
    <tr><th>Total Achats</th><th>-</th><th>-</th><th>-</th><th><?php echo number_format(($totpa),'0','.',','); ?></th></tr>
    <tr><th>Total Bén</th><th>-</th><th>-</th><th>-</th><th><?php echo number_format(($tot-$totpa),'0','.',','); ?></th></tr>
<?php

if(empty($_GET['cat']))
{
if(empty($_GET['party']))
{    
?>
    <!-- <tr><th>Total Dépenses</th><th>-</th><th><?php //echo number_format($trans->select_sum_out_period($_GET['from_d'],$_GET['to_d']),'0','.',','); ?></th></tr>

    <tr><th>Solde</th><th>-</th><th><?php //echo number_format((($tot)-$trans->select_sum_out_period($_GET['from_d'],$_GET['to_d'])),'0','.',','); ?></th></tr> -->
    <?php
}
else
{
 ?>
    <!-- <tr><th>Total Dépenses</th><th>-</th><th><?php //echo number_format($trans->select_sum_out_period_2($_GET['from_d'],$_GET['to_d'],$_GET['party']),'0','.',','); ?></th></tr>

    <tr><th>Solde</th><th>-</th><th><?php //echo number_format((($tot)-$trans->select_sum_out_period_2($_GET['from_d'],$_GET['to_d'],$_GET['party'])),'0','.',','); ?></th></tr> -->
    <?php   
}
}
?>
</tbody>
                             </table>
                            </div>
</div>
