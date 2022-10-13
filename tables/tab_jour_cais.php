<?php
@session_start();
require_once '../load_model.php';
$achat= new BeanAchats();
$vente=new BeanVente();
$paie=new BeanPaiement();
$trans= new BeanTransactions();
$acc= new BeanAccounts();
$pers= new BeanPersonne();
$pers2= new BeanPersonne();
$acc->select($_GET['user_acc']);
$pers->select($acc->getPersonneId());
$datas=$trans->select_rap_period($_GET['user_acc'],$_GET['from_d'],$_GET['to_d']);
?>
<div class="white-box">
                            <h4 class="box-title m-b-0">Journal de Caisse de : <?php echo $pers->getNomComplet(); ?></h4>
                            <hr>

                            <div class="table-responsive">
							 <table id="example2" class="table table-bordered table-condensed display" cellspacing="0" width="100%">
							 <thead>
                                        <tr>
                                            <th>Date</th><th>Description</th><th>Montant</th><th>Pre-balance</th><th>Post-Balance</th><th>N° Fact</th><th>Resp</th>
                                        </tr>
                            </thead>

                                    <tbody>
									<?php
                                    foreach ($datas as $un) {


                                    echo '<tr><td>'.$un['create_date'].'</td><td>'.$un['party_type'].'</td><td>'.$un['amount'].'</td><td>'.$un['pre_bal'].'</td><td>'.$un['bal_after'].'</td><td>';

                                    if($un['transaction_type']=='paiement_client')
                                    {
                                        $paie->select_by_trans($un['transaction_id']);
                                        $vente->select($paie->getOpId());
                                        echo $vente->getNumVente().'('.$paie->getModePaie().')';
                                    }
                                    else
                                    {
                                    echo '-';
                                    }
                                    echo '</td><td>';

                                    if($un['party_code']==$_GET['user_acc'])
                                    {
                                        $acc->select($un['acc_id']);
                                        $pers2->select($acc->getPersonneId());

                                        echo $pers2->getNomComplet();
                                    }
                                    else
                                    {
                                        $acc->select($un['party_code']);
                                        $pers2->select($acc->getPersonneId());
                                         echo $pers2->getNomComplet();
                                    }

                                    echo '</td></tr>';
                                    }
                                    ?>
										</tbody>
							 </table>
							</div>
</div>
