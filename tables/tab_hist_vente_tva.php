<?php
@session_start();
require_once '../load_model.php';
$op= new BeanOperation();
$trans=new beanTransactions();
$paie= new BeanPaiement();
$det= new BeanDetailsOperation();
$prod= new BeanProducts();
$cat= new BeanCategory();
$acc= new BeanAccounts();
$vente= new BeanVente();
$pers= new BeanPersonne();
$pers2= new BeanPersonne();
$pers3= new BeanPersonne();
$pr=new BeanPrice();

if(empty($_GET['client']))
{
    $datas=$op->select_all_by_period_det('Vente',$_GET['from_d'],$_GET['to_d'],$_GET['pos']);
}
else
{
    $datas=$op->select_all_by_period_det_cat('Vente',$_GET['from_d'],$_GET['to_d'],$_GET['pos'],$_GET['client']);
}
//$datas_paie=$trans->select_all_ag($_SESSION['acc_id'],'paiement');
?>
<div class="white-box form-row">
    <div class="col-md-12" id="vente_tab">

        <h4 class="box-title m-b-0">Vente du <?php echo $_GET['from_d']; ?>: Au: <?php echo $_GET['to_d']; ?> / Stock :
            <?php
            $pers->select($_GET['pos']);
            echo $pers->getNomComplet();

            ?>/ Catégorie :
            <?php
            $cat->select($_GET['client']);
            echo $cat->getCategoryName();

            ?></h4>
            <hr>
            <div class="table-responsive">
                <table id="example23" class="table table-bordered table-striped table-sm display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Date</th><th>FREE</th><th>Client</th><th>Désigantions</th><th>Qt</th><th>PU HTVA</th><th>PT HTVA</th><th>TVA</th><th>PT TVAC</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $pthtva=0;
                        $pttvac=0;
                        $ttva=0;
                        
                        $i=1;
                        foreach ($datas as $un) {

                            $pers2->select($un['personne_id']);
                            $pers3->select($un['party_code']);
                            $vente->select($un['op_id']);

/*$price=$un['amount'];
if($un['is_tva']=='1')
                                    {*/
                                        $price=($un['amount']*100)/118;
                                    $tva = round($un['quantity']*$price * 0.18);
                                    /*}
                                    else
                                    {
                                        $tva=0;
                                    }
*/
$pt=$un['quantity']*$price;
$ptc=$un['quantity']*$un['amount'];
$ttva +=$tva;
$pttvac +=$ptc;
$pthtva +=$pt;


                            
    echo '<tr><td>'.date('d-m-Y',strtotime($un['create_date'])).'</td><td>'.$vente->getNumVente().'</td><td>'.$pers3->getNomComplet().'</td><td>'.$un['prod_name'].'</td><td>'.number_format($un['quantity']).'</td><td align="right">'.number_format($price).'</td><td align="right">'.number_format($pt).'</td><td align="right">'.number_format($tva).'</td><td align="right">'.number_format($ptc).'</td></tr>';
}
?>
</tbody>
<tfoot>
    <tr>
        <th>#</th><th>-</th><th>Total</th><th>-</th><th>-</th>
        <td align="right"><b>-</b></td>
        <td align="right"><b><?php echo number_format($pthtva); ?></b></td>
        <td align="right"><b><?php echo number_format($ttva); ?></b></td>
        <td align="right"><b><?php echo number_format($pttvac); ?></b></td>
    </tr>
</tfoot>
</table>
</div>

</div>
</div>
<!-- <div class="col-md-5" id="hist_vente_tab">

</div> -->
