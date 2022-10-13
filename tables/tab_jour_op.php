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

$acc->select($_GET['user']);
if(!empty($_GET['user']))
{
$datas=$op->select_all_by_period_jr('Vente',$_GET['from_d'],$_GET['to_d'],$acc->getPersonneId());

$dep=$trans->select_all_type_period_by_ag('Retrait',$_GET['from_d'],$_GET['to_d'],$_GET['user']);
}
else
{
$datas=$op->select_all_by_period_jr_2('Vente',$_GET['from_d'],$_GET['to_d']);

$dep=$trans->select_all_type_period('Retrait',$_GET['from_d'],$_GET['to_d']);
}
/*else
{
$acc->select($_GET['client']);
 $datas=$op->select_all_by_period_sup('Vente',$_GET['from_d'],$_GET['to_d'],$acc->getPersonneId(),$_SESSION['pos']);
}*/
//$datas_paie=$trans->select_all_ag($_SESSION['acc_id'],'paiement');
?>
<div class="white-box form-row">
<div class="col-md-12" id="tab_journal_op">

                            <h4 class="box-title m-b-0">
                                <?php
                                if(empty($_GET['user']))
                                {
                                    ?>
                                Recette du <?php echo $_GET['from_d']; ?>: Au: <?php echo $_GET['to_d']; ?>/Tous les utilisateurs
                                <?php
                                }
                                else
                                {
                                    $pers2->select($acc->getPersonneId());
                                    ?>
                                    Recette du <?php echo $_GET['from_d']; ?>: Au: <?php echo $_GET['to_d']; ?>/
                                    <?php
                                    echo 'Utilisateur :'.$pers2->getNomComplet();
                                }
                                ?>
                                </h4>
                            <hr>
                            <div class="table-responsive">
							 <table  border="1" class="table table-bordered table-striped table-sm display" cellspacing="0" width="100%">
							 <thead>
                                        <tr>
                                            <th>#N°</th><th>Date</th><th>Client/Motif</th><th>Dû</th><th>Payé</th><th>Mode Paie</th>
                                        </tr>
                            </thead>

                                    <tbody>
                                      <tr>
                                            <th colspan="6">Ventes</th>
                                        </tr>
									<?php
                                    $totdu=0;
                                    $totpaie=0;
                                    $totpaie_cash=0;
                                    $totpaie_bq=0;
                                    foreach ($datas as $un) {

                                    $acc->select($un['personne_id']);
                                    $pers->select($un['party_code']);
                                    $vente->select($un['op_id']);
                                    $amount=$paie->select_sum_op($un['op_id']);
                                    $paie->select_by_op($un['op_id']);

                                    if($vente->getAmount()!=0)
                                    {
                                    echo '<tr><td> <i class="fa fa-hand-o-right fa-fw"></i>'.$vente->getNumVente().'</td><td>'.date('d-m-Y h:i',strtotime($un['create_date'])).'</td><td>'.$pers->getNomComplet().'</td>';


                                    echo '<td>';
                                    $m_vente=$vente->getAmount() + $vente->getRed();

                                    if($vente->getTva()=='1')
                                    {
                                        $tva=round($m_vente*0.18);
                                    }
                                    else
                                    {
                                        $tva=0;
                                    }
                                    $m_vente=$vente->getAmount() + round($tva);

                                    $reste=$m_vente- $amount['paie'];
                                    echo number_format($reste,'0','.',',');
                                    $totdu +=$reste;
                                    echo '</td>';
                                    echo '<td>';
                                    echo number_format($amount['paie'],'0','.',',');
                                    $totpaie +=$amount['paie'];

                                    if($paie->getModePaie()=='Cash')
                                    {
                                        $totpaie_cash +=$amount['paie'];
                                    }
                                    else
                                    {
                                        $totpaie_bq +=$amount['paie'];
                                    }
                                    echo '</td><td>'.$paie->getModePaie().'</td>';
                                    echo '</tr>';
                                    }
                                }
                                    ?>
										<!-- </tbody>
                                        <tfoot> -->
                                        <tr>
                                            <th>-</th><th>Sous-totaux Cash</th><th>-</th><th>-</th><th><?php echo number_format($totpaie_cash,'0','.',','); ?></th><th>-</th>
                                        </tr>
                                        <tr>
                                            <th>-</th><th>Sous-totaux Banque</th><th>-</th><th>-</th><th><?php echo number_format($totpaie_bq,'0','.',','); ?></th><th>-</th>
                                        </tr>
                                        <tr>
                                            <th>-</th><th>Totaux des Entrées</th><th>-</th><th><?php echo number_format($totdu,'0','.',',');?></th><th><?php echo number_format($totpaie,'0','.',','); ?></th><th>-</th>
                                        </tr>
                                        <tr>
                                            <th colspan="6">Dépenses</th>
                                        </tr>
                                    <?php
                                    $totdep=0;
                                    foreach ($dep as $un) {
                                        if($un['party_type']!='Retrait' and $un['acc_res_id']=='0')
                                    {
                                        $totdep +=$un['amount'];
                                    echo '<tr><td>-</td><td>'.$un['create_date'].'</td><td>'.$un['party_type'].'</td><td>-</td><td>'.$un['amount'].'</td><td>-</td></tr>';
                                    }
                                }

                                    ?>
                                    <tr>
                                            <th>-</th><th>Sous-Totaux</th><th>-</th><th>-</th><th><?php echo number_format($totdep,'0','.',','); ?></th><th>-</th>
                                        </tr>
                                    <tr>
                                            <th>-</th><th>Solde</th><th>-</th><th>-</th><th><?php echo number_format($totpaie-$totdep,'0','.',','); ?></th><th>-</th>
                                        </tr>
                                    </tbody>
							 </table>
                            </div>

    </div>
<p><a href="javascript:void(0)" id="print_journal_op" class="btn btn-success"><span class="fa fa-print"></span></a></p>
</div>
