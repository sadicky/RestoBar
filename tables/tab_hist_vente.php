<?php
@session_start();
require_once '../load_model.php';
$op= new BeanOperation();
$trans=new BeanTransactions();
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
$datas=$op->select_all_by_period('Vente',$_GET['from_d'],$_GET['to_d'],$_GET['pos']);
}
else
{
 $datas=$op->select_all_by_period_ass('Vente',$_GET['from_d'],$_GET['to_d'],$_GET['client'],$_GET['pos']);
}
//$datas_paie=$trans->select_all_ag($_SESSION['acc_id'],'paiement');
?>
<div class="white-box form-row">
<div class="col-md-12" id="vente_tab">

                            <h4 class="box-title m-b-0">Vente du <?php echo $_GET['from_d']; ?>: Au: <?php echo $_GET['to_d']; ?> / Stock :
                                <?php
                                $pers->select($_GET['pos']);
                                    echo $pers->getNomComplet();

                                ?>/ Client :
                                <?php
                                $pers->select($_GET['client']);
                                    echo $pers->getNomComplet();

                                ?></h4>
                            <hr>
                            <div class="table-responsive">
							 <table id="example23" class="table table-bordered table-striped table-sm display" cellspacing="0" width="100%">
							 <thead>
                        <tr>
                        <th>DATE</th><th>N° FACT.</th><th>ClIENT</th><th>TABLE</th><th>SERVEUR</th><th>ARTICLE</th><th>PTTVAC</th><th>DU</th><th>PAYE</th><th>CAISSIER</th>
                        </tr>
                            </thead>

                                    <tbody>
									<?php
                                    $tot=0;
                                    $totdu=0;
                                    $totpaie=0;
                                    $tot_tva=0;
                                    $i=1;
                                    foreach ($datas as $un) {

                                    $pers2->select($un['personne_id']);

                                    
                                    $vente->select($un['op_id']);
                                    $amount=$paie->select_sum_op($un['op_id']);
                                    $pers->select($vente->getAssId());

                                    /*if(!empty($_GET['client']))
                                    {
                                    $pers3->select($un['party_code']);
                                    if($un['party_code']==$_GET['client'])
                                    {
                                        include('det_hist_vente.php');
                                    }
                                    }
                                    else
                                    {*/
                                    $pers3->select($un['party_code']);
                                        include('det_hist_vente.php');   
                                    //}

                                }
                                    ?>
										</tbody>
                                        <tfoot>
                                        <tr>
                                             <th>-</th><th>Total</th><th>-</th><th>-</th><th>-</th><th>-</th><td align="right"><b><?php echo $pers->nb_format($tot);?></b></td>
                                              <td align="right"><b><?php echo $pers->nb_format($totdu);?></b></td>
                                             <td class="tc" id="t3" align="right"><b><?php echo $pers->nb_format($totpaie); ?></b></td><td>-</td>
                                        </tr>
                                    </tfoot>
							 </table>
                            </div>

    </div>
</div>
    <!-- <div class="col-md-5" id="hist_vente_tab">

</div> -->
