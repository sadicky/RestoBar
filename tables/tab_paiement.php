<?php
@session_start();
require_once '../load_model.php';
$trans= new BeanTransactions();
$acc= new BeanAccounts();
$pers= new BeanPersonne();
$pers2= new BeanPersonne();

$achat= new BeanAchats();
$paie= new BeanPaiement();
$op= new BeanOperation();

$datas=$trans->select_all_ag($_SESSION['acc_id']);
$datas_op=$op->select_all($_SESSION['acc_id']);
?>
<div class="white-box row">
<div class="col-md-7 well">
                            <h3 class="box-title m-b-0">Paiements / Achat N° : #<span id="num_appro2"><?php if(isset($_SESSION['op_id'])) echo $_SESSION['op_id']; else echo '?'; ?></span></h3>
                            <hr>
                            <div class="table-responsive">
							 <table id="example23" class="table table-bordered table-condensed display" cellspacing="0" width="100%">
							 <thead>
                                        <tr>
                                            <th>Date</th><th>Type</th><th>Montant</th><th>Référence</th><th>N° Op</th><th>-</th><th>-</th>
                                        </tr>
                            </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Date</th><th>Type</th><th>Montant</th><th>Référence</th><th>N° Op</th><th>-</th><th>-</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
									<?php
                                    foreach ($datas as $un) {

                                    $paie->select_by_trans($un['transaction_id']);
                                    if (isset($_SESSION['op_id']) and $_SESSION['op_id']==$paie->getOpId()) {
                                    echo '<tr><td>'.$un['create_date'].'</td><td>'.$un['transaction_type'].'</td><td>'.$un['amount'].'</td><td><a href="upload/'.$un['reference'].'" target="_blank">Afficher</a></td><td>'.$paie->getOpId().'</td>
                                    <td>';

                                    if($un["status"]=='done') echo '<button class="btn btn-success update" name="update" id="'.$un["transaction_id"].'"><span class="glyphicon glyphicon-edit"></span></button>';
                                    else echo '-';

                                    echo '</td><td><button class="btn btn-danger delete" name="delete" id="'.$un["transaction_id"].'">';
                                    if($un["status"]=='done') echo '<span class="glyphicon glyphicon-remove"></span>';
                                    else echo '<span class="glyphicon glyphicon-ok"></span>';

                                    echo '</button></td></tr>';
                                    }
                                }
                                    ?>
										</tbody>
							 </table>
                            </div>
</div>
<div class="col-md-5 well">
                            <h4 class="box-title m-b-0">Achat Non Payé</h4>
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
                                    foreach ($datas_op as $un) {
                                    if($un['is_paid']=='0')
                                    {
                                    $acc->select($un['personne_id']);
                                    $pers->select($acc->getPersonneId());
                                    $achat->select($un['op_id']);
                                    $amount=$paie->select_sum_op($un['op_id']);

                                    echo '<tr class="row_op" data-id='.$un['op_id'].' style="cursor:pointer"><td >'.$un['op_id'].'</td><td>'.date('Y-m-d',strtotime($un['create_date'])).'</td><td>';

                                    if(empty($amount['paie'])) echo '0'; else echo $amount['paie'];
                                    echo '</td><td>';

                                    //if($un['state']=='1') echo 'Done'; else echo 'Canceled';*/

                                    echo $achat->getAmount() - $amount['paie'];
                                    echo '</td></tr>';
                                    }
                                    }
                                    ?>
                                        </tbody>
                             </table>
                            </div>
    </div>
</div>
