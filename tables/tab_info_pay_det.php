<?php
@session_start();
require_once '../load_model.php';
$op= new BeanOperation();
$det= new BeanDetailsOperation();
$prod= new BeanProducts();
$cat= new BeanCategory();
$acc= new BeanAccounts();
$achat= new BeanAchats();
$pers= new BeanPersonne();
$trans= new BeanTransactions();
$paie= new BeanPaiement();

$acc->select($_POST['acc_id']);
$datas=$op->select_all($acc->getPersonneId(),$_SESSION['pos']);
$acc->select_acc_perso($_SESSION['perso_id']);
?>
<div class="white-box row">
<div class="col-md-5">
<div class="alert alert-info" style="background-color: white;" id="appro_tab">
                            <h4 class="box-title m-b-0">Achats non payés</h4>
                            <hr>
                            <div class="table-responsive">
							 <table id="example23" class="table table-bordered table-striped table-condensed display" cellspacing="0" width="100%">
							 <thead>
                                        <tr>
                                            <th>#Id</th><th>Date</th><th>Payé</th><th>Dû</th>
                                        </tr>
                            </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#Id</th><th>Date</th><th>Payé</th><th>Dû</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
									<?php
                                    foreach ($datas as $un) {
                                    $achat->select($un['op_id']);
                                    if($un['is_paid']=='0' and $achat->getAmount()!=0)
                                    {
                                    $acc->select($un['personne_id']);
                                    $pers->select($acc->getPersonneId());
                                    $achat->select($un['op_id']);
                                    $amount=$paie->select_sum_op($un['op_id']);

                                    echo '<tr class="row_achat" data-id='.$un['op_id'].' style="cursor:pointer"><td >'.$achat->getNumAchat().'</td><td>'.date('Y-m-d',strtotime($un['create_date'])).'</td><td>';

                                    if(empty($amount['paie'])) echo '0'; else echo $amount['paie'];
                                    echo '</td><td>';

                                    //if($un['state']=='1') echo 'Done'; else echo 'Canceled';*/

                                    //echo number_format($achat->getAmount(),0,'.',',');
                                    echo number_format($achat->getAmount() - $amount['paie'],0,'.',',');
                                    echo '</td>';



                                    echo '</tr>';
                                    }
                                }
                                    ?>
										</tbody>
							 </table>
                            </div>
							</div>
    </div>
    <div class="col-md-7">
    <div class="alert alert-info" style="background-color: white;" id="appro_tab">
        <h4 class="box-title m-b-0">Paiements / Achat N° : #<?php
                                    if(isset($_POST['op_id']) and !empty($_POST['op_id']))
                                        {
                                        $achat->select($_POST['op_id']);
                                        echo $achat->getNumAchat();
                                        }
                                        ?></h4><hr>

        <div class="table-responsive">
                             <table class="table table-bordered table-striped table-condensed display" cellspacing="0" width="100%">
                             <thead>
                                        <tr>
                                            <th>Date*</th><th>Montant</th><th>-</th><th>-</th>
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

                                    echo '</td><td><button class="btn btn-danger btn-circle delete_paie_four" name="delete" id="'.$un["transaction_id"].'">';
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
