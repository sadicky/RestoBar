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
$track=new BeanPayTrack();

 $datas=$op->select_all_party2('Vente',$_GET['cli']);

?>
<div class="white-box row">
<div class="col-md-12">
<div class="alert alert-info" style="background-color: white;" id="appro_tab">
                    <h3>FICHE DU CLIENT</h3><hr>
                            <h4 class="box-title m-b-0">Vente De <?php

                            $pers->select($_GET['cli']);
                            echo $pers->getNomComplet();
                             ?></h4>
                            <hr>
                            <div class="table-responsive">
               <table id="example23" class="table table-bordered table-striped table-condensed display table-sm" cellspacing="0" width="100%">
               <thead>
                                <tr>
                    <th>#N°</th><th>Date/Heure</th><th>Total</th><th width="200">Payé</th><th>Réduction</th><th>Dû</th><th>Article</th><th>Par</th>
                                        </tr>
                            </thead>

                                    <tbody>
                  <?php
                                    $tot=0;
                                    $tot_red=0;
                                    $totdu=0;
                                    $totpaie=0;
                                    foreach ($datas as $un) {

                                    $pers2->select($un['personne_id']);
                                    $pers->select($un['party_code']);
                                    $vente->select($un['op_id']);
                                    $track->select($un['op_id'],'0');
                                    $amount=$paie->select_sum_op($un['op_id']);

                                     $debut = new DateTime(date('Y-m-d'));
                                     $fin = new DateTime($track->getDatePay());
                                    if(!empty($track->getDatePay()) and $fin>$debut)
                                    {
                                    $days=$track->getWeekdayDifference($debut,$fin);
                                    }
                                    else
                                    {
                                        $days='';
                                    }

                                    $m_v=$det->select_sum_op($un['op_id']);
                                    //if($vente->getAmount()!=0)
                                    //{
                                    echo '<tr><td class="det_facture" style="cursor:pointer" data-id="'.$un['op_id'].'"> <i class="fa fa-hand-o-right fa-fw"></i> '.$vente->getNumVente().'</td><td>'.date('Y-m-d h:i',strtotime($un['create_date'])).'</td>';


                                    echo '<td>';

                                    echo number_format($m_v-$vente->getRed(),'0','.',',');
                                    $tot +=$m_v;
                                    echo '</td><td>';

                                    if(empty($amount['paie'])) echo '0'; else echo '<a href="javascript:void(0)" class="show_paid_det" data-id="'.$un['op_id'].'">'.number_format($amount['paie'],0,'.',',').'</a> : &#13;';
                                    $totpaie +=$amount['paie'];
                                    echo '<span id="det'.$un['op_id'].'" class="hide_paid_det"><ul>';
                                    $data_paie=$paie->select_all_op($un['op_id']);
                                    $nb=count($data_paie);
                                     foreach ($data_paie as $key => $value) {
                                        if($nb>1)
                                        {
                                         echo '<li>'.number_format($value['amount'],0,'.',',').' (payé : '.$value['datep'].')&#013;</li>';
                                        }
                                        else
                                        {
                                           echo 'payé : '.$value['datep'].'&#013;';
                                        }
                                     }
                                    echo '</ul></span>';

                                    echo '</td>
                                    <td>';

                                    echo number_format($vente->getRed(),'0','.',',');
                                    $tot_red +=$vente->getRed();
                                    echo '</td><td>';
                                    $du=$m_v-$vente->getRed();
                                    $rest=$du-$amount['paie'];
                                    echo number_format($rest,0,'.',',');
                                    $totdu +=$rest;

                                    echo '</td><td><ul>';

                                    $datas2=$det->select_all($un['op_id']);
                                    foreach ($datas2 as $un2) {
                                    $prod->select($un2['prod_id']);
                                    echo '<li>'.$un2['quantity'].' '.$prod->getProdName().'&#013;</li>';
                                     }

                                    echo '</ul>';
                                   /* <a href="javascript:void(0)" title="Imprimer" class="btn btn-light btn-sm print_appro" id="'.$un['op_id'].'"><i class="fa fa-print"></i></a>*/
                                    echo '</td><td>'.$pers2->getNomComplet().'</td>';
                                    echo '</tr>';
                                    //}
                                }
                                    ?>
                    </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>-</th><th>Total</th><th><?php echo number_format($tot,'0','.',',');?></th><th><?php echo number_format($totpaie,'0','.',',');?></th><th><?php echo number_format($tot_red,'0','.',',');?></th><th><?php echo number_format($totdu,'0','.',',');?></th><th>-</th><th>-</th>
                                        </tr>
                                    </tfoot>
               </table>
                            </div>
              </div>
    </div>

</div>
