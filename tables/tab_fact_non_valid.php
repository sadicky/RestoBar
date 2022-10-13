<?php
@session_start();
require_once '../load_model.php';
$op= new BeanOperation();
$trans=new BeanTransactions();
$det= new BeanDetailsOperation();
$prod= new BeanProducts();
$cat= new BeanCategory();
$acc= new BeanAccounts();
$acc_cli= new BeanAccounts();
$vente= new BeanVente();
$pers= new BeanPersonne();
$acc->select_acc('1111111');
$datas=$op->select_all_by_state('Vente','1',$_SESSION['pos']);
//$datas_paie=$trans->select_all_ag($_SESSION['acc_id'],'paiement');
?>
<h3 class="box-title m-b-0">Commandes encours non validées</h3>
                            <hr>
                            <div class="table-responsive">
               <table id="example2x" class="table table-bordered table-striped table-condensed display" cellspacing="0" width="100%">
               <thead>
                                        <tr>
                                            <th>#N°</th><th>Date</th><th>Montant</th><th>Valid</th>
                                        </tr>
                            </thead>
                                    <!-- <tfoot>
                                        <tr>
                                            <th>#N°</th><th>Date</th><th>Montant</th><th>Client</th><th>Assureur</th><th>Clot</th>
                                        </tr>
                                    </tfoot> -->
                                    <tbody>
                  <?php
                                    foreach ($datas as $un) {
                                    if($un['is_send']=='1')
                                    {
                                    $acc->select($un['personne_id']);
                                    $acc_cli->select_acc_perso($un['party_code']);
                                    $pers->select($un['party_code']);
                                    $vente->select($un['op_id']);

                                    echo '<tr class="row_op_vente_valid" data-id='.$un['op_id'].' style="cursor:pointer"><td> <i class="fa fa-hand-o-right fa-fw"></i>'.$vente->getNumVente().'</td><td>'.date('Y-m-d',strtotime($un['create_date'])).'</td>';


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

                                    $m_vente =$vente->getAmount() + $tva;
                                    echo number_format($m_vente,0,'.',',');

                                    echo '</td>';
                                   /* <td>';
                                    $pers->select($vente->getAssId());
                                    echo $pers->getNomComplet();

                                    echo '</td>';*/

                                    echo '<td>';
                                    if($un["state"]=='1') echo '<button class="btn btn-success btn-circle valid_op_vente" name="delete" id="'.$un["op_id"].'"><span class="fa fa-check"></span></button>';
                                    else echo '<button class="btn btn-success btn-circle valid_op_vente" name="delete" id="'.$un["op_id"].'"><span class="fa fa-times"></span></button>';
                                    echo '</td>';

                                    echo '</tr>';
                                    }
                                }
                                    ?>
                    </tbody>
               </table>
                            </div>
