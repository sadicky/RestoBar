<?php
@session_start();
require_once '../load_model.php';
$trans= new BeanTransactions();
$acc= new BeanAccounts();
$pers= new BeanPersonne();
$pers2= new BeanPersonne();
$acc->select_acc_perso($_SESSION['perso_id']);
$datas=$trans->select_all_ag($acc->getAccId(),'paiement_client');
?>
<div class="white-box">
                            <h4 class="box-title m-b-0">Paiements* (Historique récente client)</h4>
                            <hr>
                            <p><a href="javascript:void(0)" class="btn btn-primary btn-rounded" id="add_pymt_cli"> <i class="fa fa-plus"></i> Ajouter</a></p>

                            <div class="table-responsive">
							 <table id="example2" class="table table-bordered table-condensed display" cellspacing="0" width="100%">
							 <thead>
                                        <tr>
                                            <th>Date</th><th>Montant</th><th>Statut</th><th>Pre-balance</th><th>Post-Balance</th><th>Client</th><th>Agent (Caisse)</th>
                                        </tr>
                            </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Date</th><th>Montant</th><th>Statut</th><th>Pre-balance</th><th>Post-Balance</th><th>Client</th><th>Agent (Caisse)</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
									<?php
                                    foreach ($datas as $un) {
                                        $acc->select($un['party_code']);
                                        $pers2->select($acc->getPersonneId());
                                        $acc->select($un['acc_id']);
                                        $pers->select($acc->getPersonneId());
                                    echo '<tr><td>'.$un['create_date'].'</td><td>'.$un['amount'].'</td><td>'.$un['status'].'</td><td>'.$un['pre_bal'].'</td><td>'.$un['bal_after'].'</td><td>'.$pers2->getNomComplet().'</td><td>'.$pers->getNomComplet().'</td>
                                </tr>';
                                    }
                                    ?>
										</tbody>
							 </table>
							</div>
</div>
