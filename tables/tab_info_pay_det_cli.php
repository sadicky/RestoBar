<?php
@session_start();
require_once '../load_model.php';
$op= new BeanOperation();
$det= new BeanDetailsOperation();
$prod= new BeanProducts();
$cat= new BeanCategory();
$acc= new BeanAccounts();
$vente= new BeanVente();
$pers= new BeanPersonne();
$trans= new BeanTransactions();
$paie= new BeanPaiement();

$acc->select($_POST['acc_id']);
$datas=$op->select_all_by_cust_pay($acc->getPersonneId(),'Vente','0',$_SESSION['pos']);
$acc->select_acc_perso($_SESSION['perso_id']);
?>
<div class="white-box row">
<div class="col-md-5">
<div class="alert alert-info" style="background-color: white;" id="appro_tab">
                            <h4 class="box-title m-b-0">Factures non encore payés</h4>
                            <hr>
                            <div class="table-responsive">
							 <table id="example23" class="table table-bordered table-striped table-condensed display" cellspacing="0" width="100%">
							 <thead>
                                        <tr>
                                            <th>#Id</th><th>Date</th><th>Payé</th><th>Dû</th>
                                        </tr>
                            </thead>

                                    <tbody>
									<?php
                                    $totp=0;
                                    $totdu=0;
                                    foreach ($datas as $un) {
                                    $vente->select($un['op_id']);
                                    /*if($un['is_paid']=='0' and $achat->getAmount()!=0)
                                    {*/
                                    $acc->select($un['personne_id']);
                                    $pers->select($acc->getPersonneId());
                                    $vente->select($un['op_id']);
                                    $amount=$paie->select_sum_op($un['op_id']);

                                    echo '<tr class="row_vente" data-id='.$un['op_id'].' style="cursor:pointer"><td >'.$vente->getNumVente().'</td><td>'.date('Y-m-d',strtotime($un['create_date'])).'</td><td>';

                                    if(empty($amount['paie'])) echo '0'; else echo $amount['paie'];
                                    $totp +=$amount['paie'];
                                    echo '</td><td>';

                                    //if($un['state']=='1') echo 'Done'; else echo 'Canceled';*/

                                    //echo number_format($achat->getAmount(),0,'.',',');
                                    echo number_format($tot=$vente->getAmount() - $amount['paie']-$vente->getRed(),0,'.',',');
                                    $totdu +=$tot;
                                    echo '</td>';



                                    echo '</tr>';
                                    //}
                                }
                                echo '<tr><td colspan="2">Total</td><td>'.number_format($totp,0,'.',',').'</td><td>'.number_format($totdu,0,'.',',').'</td></tr>';
                                    ?>

										</tbody>
							 </table>
                            </div>
							</div>
    </div>
    <div class="col-md-7">
    <div class="alert alert-info" style="background-color: white;" id="vente_tab">
        <h4 class="box-title m-b-0">Paiements / Facture N° : #<?php
                                    if(isset($_POST['op_id']) and !empty($_POST['op_id']))
                                        {
                                        $vente->select($_POST['op_id']);
                                        echo $vente->getNumVente();
                                        }
                                        ?>
                                            </h4><hr>

        <div class="table-responsive">
                             <table class="table table-bordered table-striped table-condensed display" cellspacing="0" width="100%">
                             <thead>
                                        <tr>
                                            <th>Date</th><th>Montant</th><th>-</th><th>-</th>
                                        </tr>
                            </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Date</th><th>Montant</th><th>-</th><th>-</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>
                                    <?php
                                    if(isset($_POST['op_id']) and !empty($_POST['op_id']))
                                        {
                                            $datas_paie=$paie->select_all_op($_POST['op_id']);

                                    foreach ($datas_paie as $un) {

                                    echo '<tr><td>'.$un['create_date'].'</td><td>'.$un['amount'].'</td>
                                    <td>';

                                    if($un["status"]=='done') echo '<button class="btn btn-success btn-circle update" name="update" id="'.$un["transaction_id"].'"><span class="fa fa-edit"></span></button>';
                                    else echo '-';

                                    echo '</td><td><button class="btn btn-danger btn-circle delete" name="delete" id="'.$un["transaction_id"].'">';
                                    if($un["status"]=='done') echo '<span class="fa fa-times"></span>';
                                    else echo '<span class="fa fa-check"></span>';

                                    echo '</button></td></tr>';

                                }
                            }
                                    ?>
                                        </tbody>
    </table>
</div>
    </div>
</div>
