<?php
@session_start();
require_once '../load_model.php';
$trans= new BeanTransactions();
$acc= new BeanAccounts();
$pers= new BeanPersonne();
$pers2= new BeanPersonne();
$acc->select_acc_perso($_SESSION['perso_id']);
$datas=$trans->select_all_type('retrait');
?>
<div class="white-box">
                            <h4 class="box-title m-b-0">Dépenses (Historique récente)</h4>
                            <hr>
                            <div class="table-responsive">
							 <table id="example2" class="table table-bordered table-condensed display" cellspacing="0" width="100%">
							 <thead>
                                        <tr>
                                            <th>Date</th><th>Montant</th><th>Statut</th><th>Pre-balance</th><th>Post-Balance</th><th>Motif</th><th>Agent (Caisse)</th><th>-</th><th>-</th>
                                        </tr>
                            </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Date</th><th>Montant</th><th>Statut</th><th>Pre-balance</th><th>Post-Balance</th><th>Motif</th><th>Agent (Caisse)</th><th>-</th><th>-</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
									<?php
                                    foreach ($datas as $un) {
                                      $acc->select($un['acc_id']);
                                    if($un['party_type']!='Retrait' and $acc->getPersonneId()==$_SESSION['perso_id'] and $un['acc_res_id']=='0')
                                    {
                                        $acc->select($un['acc_id']);
                                        $pers->select($acc->getPersonneId());
                                    echo '<tr><td>'.$un['create_date'].'</td><td>'.$un['amount'].'</td><td>'.$un['status'].'</td><td>'.$un['pre_bal'].'</td><td>'.$un['bal_after'].'</td><td>'.$un['party_type'].'</td>
                                    <td>'.$pers->getNomComplet().'</td>
                                    <td>';

                                    if($un["status"]=='done') echo '<button class="btn btn-success btn-circle update" name="update" id="'.$un["transaction_id"].'"><span class="fa fa-edit"></span></button>';
                                    else echo '-';

                                    echo '</td><td><button class="btn btn-danger btn-circle delete_dep" name="delete" id="'.$un["transaction_id"].'">';
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
