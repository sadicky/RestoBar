<?php
@session_start();
require_once '../load_model.php';
$op= new BeanOperation();
$trans=new BeanTransactions();
$det= new BeanDetailsOperation();
$prod= new BeanProducts();
$cat= new BeanCategory();
$vente= new BeanVente();
$pers= new BeanPersonne();
$pers2= new BeanPersonne();
$tab=new BeanTable();
$datas=$op->select_all_by_state('Vente','1',$_SESSION['pos']);
//$datas_paie=$trans->select_all_ag($_SESSION['acc_id'],'paiement');
?>
<button class="btn btn-sm btn-warning" id="new_fact"><i class="fa fa-plus"></i> Nouvelle</button>
<h5 class="box-title m-b-0">Factures Non payées</h5>
                            <hr>
                            <div class="table-responsive">
               <table id="example2a" class="table table-bordered table-striped table-condensed display" cellspacing="0" width="100%">
               <thead>
                    <tr>
                      <tr>
                        <th>#N°</th><th>Date</th><th>Montant</th><th>Client</th><th>-</th>
                      </tr>
                    </tr>
                </thead>

                                    <tbody>
                  <?php
                                    foreach ($datas as $un) {
                                    $vente->select($un['op_id']);
                                    if($un['is_paid']=='0' and $un['personne_id']==$_SESSION['perso_id'])
                                    {
                                    $pers->select($un['personne_id']);
                                    $pers2->select($un['party_code']);

                                    echo '<tr class="row_op_vente" data-id='.$un['op_id'].' style="cursor:pointer"><td> <i class="fa fa-hand-o-right fa-fw"></i>'.$vente->getNumVente().'</td><td>'.date('Y-m-d',strtotime($un['create_date'])).'</td>';


                                    echo '<td>';
                                    $m_vente=$vente->getAmount() - $vente->getRed();

                                    /*if($vente->getTva()=='1')
                                    {
                                        $tva=round($m_vente*0.18);
                                    }
                                    else
                                    {
                                        $tva=0;
                                    }*/

                                    echo number_format($m_vente,0,'.',',');

                                    echo '</td><td>';
                                    echo $pers2->getNomComplet();
                                    echo '</td>';
                                    /*echo '<td>';
                                    $pers->select($vente->getAssId());
                                    echo $pers->getNomComplet();

                                    echo '</td>';*/

                                    /*echo '<td>';
                                    if(empty($un["valid_id"])) echo '<span class="fa fa-times"></span>';
                                    else echo '<span class="fa fa-check"></span>';
                                    echo '</td>';*/
                                    echo '<td>';
                                    echo '<button class="btn btn-success btn-circle delete_op_vente" name="delete" id="'.$un["op_id"].'"><span class="fa fa-minus"></span></button>';

                                    echo '</td>';
                                    echo '</tr>';
                                    }

                                }
                                    ?>
                    </tbody>
               </table>
                            </div>
