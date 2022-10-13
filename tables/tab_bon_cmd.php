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
$achat= new BeanAchats();
$pers= new BeanPersonne();

if(empty($_GET['pos']))
{
   $pos=$_SESSION['pos'];
}
else
{
    $pos=$_GET['pos'];
}

if(empty($_GET['four']))
{
$datas=$op->select_all_by_period('Approvisionnement',$_GET['from_d'],$_GET['to_d'],$pos);
}
else
{
$acc->select($_GET['four']);
 $datas=$op->select_all_by_period_sup('Approvisionnement',$_GET['from_d'],$_GET['to_d'],$acc->getPersonneId(),$pos);
}
//$datas_paie=$trans->select_all_ag($_SESSION['acc_id'],'paiement');
?>
<div class="white-box row">
<div class="col-md-12">
<div class="alert alert-info" style="background-color: white;" id="appro_tab">
                            <h4 class="box-title m-b-0">Point de vente :<?php
                            $pers->select($pos);
                             echo $pers->getNomComplet(); ?>/ Bon de commande Du <?php echo $_GET['from_d']; ?>: Au: <?php echo $_GET['to_d']; ?></h4>
                            <hr>
                            <div class="table-responsive">
							 <table id="example23" class="table table-bordered table-striped table-condensed display" cellspacing="0" width="100%">
							 <thead>
                                        <tr>
                                            <th>#N°</th><th>Date</th><th>Fournisseur</th><th>Dû</th><th>Payé</th>
                                        </tr>
                            </thead>

                                    <tbody>
									<?php
                                    $totdu=0;
                                    $totpaie=0;
                                    foreach ($datas as $un) {

                                    $acc->select($un['personne_id']);
                                    $pers->select($un['party_code']);
                                    $achat->select($un['op_id']);
                                    $amount=$paie->select_sum_op($un['op_id']);


                                    if($achat->getAmount()!=0)
                                    {
                                    echo '<tr class="row_bon_cmd" data-id='.$un['op_id'].' style="cursor:pointer"><td> <i class="fa fa-hand-o-right fa-fw"></i>'.$achat->getNumAchat().'</td><td>'.date('Y-m-d',strtotime($un['create_date'])).'</td><td>'.$pers->getNomComplet().'</td>';


                                    echo '<td>';
                                    $reste=$achat->getAmount()- $amount['paie'];
                                    echo number_format($reste,'0','.',',');
                                    $totdu +=$reste;
                                    echo '</td>';
                                    echo '<td>';
                                    echo number_format($amount['paie'],'0','.',',');
                                    $totpaie +=$amount['paie'];
                                    echo '</td>';
                                    echo '</tr>';
                                    }
                                }
                                    ?>
										</tbody>
                                        <tfoot>
                                        <tr>
                                            <th>-</th><th>Total</th><th>-</th><th><?php echo number_format($totdu,'0','.',',');?></th><th><?php echo number_format($totpaie,'0','.',','); ?></th>
                                        </tr>
                                    </tfoot>
							 </table>
                            </div>
							</div>
    </div>
    </div>
