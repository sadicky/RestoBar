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
$achat= new BeanAchats();
$pers= new BeanPersonne();
$pers2= new BeanPersonne();
$track=new BeanPayTrack();

 $datas=$op->select_all_sup_by_pay_no_pos('Approvisionnement','0');

?>
<div class="white-box row">
<div class="col-md-12">
<div class="alert alert-info" style="background-color: white;" id="appro_tab">
                            <h4 class="box-title m-b-0">Paiement des fournitures à effecutuer bientôt</h4>
                            <hr>
                            <div class="table-responsive">
               <table id="example2" class="table table-bordered table-striped table-condensed display table-sm" cellspacing="0" width="100%">
               <thead>
                                <tr>
                     <th>RDV DE PAIEMENT</th><th>#N°</th><th>Date/Heure</th><th>Total</th><th width="200">Payé</th><th>Dû</th><th>Article</th><th>A</th>
                                        </tr>
                            </thead>

                                    <tbody>
                  <?php
                                    $tot=0;
                                    $totdu=0;
                                    $totpaie=0;
                                    foreach ($datas as $un) {
                                     $datas2=$track->select_under_min();
                                     foreach ($datas2 as $un2) {
                                        if($un2['op_id']==$un['op_id'])
                                        {
                                    $pers2->select($un['personne_id']);
                                    $pers->select($un['party_code']);
                                    $achat->select($un['op_id']);
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

                                    if($achat->getAmount()!=0)
                                    {
                                    echo '<tr><td class="row_achat" style="cursor:pointer" data-id="'.$un['op_id'].'"> <i class="fa fa-hand-o-right fa-fw"></i> ';

                                    if(!empty($days))
                                    {
                                    echo '<span style="color:';
                                    if($days>5 and $days<10)
                                    echo 'maroon';
                                    else if($days<=5)
                                    echo 'red';
                                    else
                                    echo 'black';

                                    echo '; ">'.$track->getDatePay().'<br/>&#013;('.$days.' jrs)</span>';
                                        }
                                    else {
                                        echo '<button class="btn btn-light btn-sm row_pay_date" data-id="'.$un['op_id'].'"><i class="fa fa-calendar"></i> Date Paiement</button>';
                                    }
                                    echo '</td><td>  '.$achat->getNumAchat().'</td><td>'.date('Y-m-d h:i',strtotime($un['create_date'])).'</td>';


                                    echo '<td>';

                                    echo number_format($achat->getAmount(),'0','.',',');
                                    $tot +=$achat->getAmount();
                                    echo '</td><td>';

                                    if(empty($amount['paie'])) echo '0'; else echo '<a href="javascript:void(0)" class="show_paid_det" data-id="'.$un['op_id'].'">'.number_format($amount['paie'],0,'.',',').'</a> : &#013;';
                                    $totpaie +=$amount['paie'];
                                    echo '<span id="det'.$un['op_id'].'" class="hide_paid_det"><ul>';
                                    $data_paie=$paie->select_all_op($un['op_id']);
                                     foreach ($data_paie as $key => $value) {
                                         echo '<li><a href="javascript:void(0)" class="aff_recu_four" id="'.$un['op_id'].'" data-id="'.$value['paie_id'].'"  >'.number_format($value['amount'],0,'.',',').' (payé : '.$value['datep'].')</a><span style="visibility:hidden;">;</span>&#013;</li>';
                                     }
                                    echo '</ul></span>';

                                    echo '</td><td>';
                                    echo
                                    number_format($achat->getAmount() - $amount['paie'],0,'.',',');
                                    $totdu +=($achat->getAmount() - $amount['paie']);


                                    echo '</td><td><ul>';

                                    $datas2=$det->select_all($un['op_id']);
                                    foreach ($datas2 as $un2) {
                                    $prod->select($un2['prod_id']);
                                    echo '<li>'.$un2['quantity'].' '.$prod->getProdName().'<span style="visibility:hidden;">;</span>&#013;</li>';
                                     }

                                    echo '</ul>
                                    <a href="javascript:void(0)" title="Imprimer" class="btn btn-light btn-sm print_appro" id="'.$un['op_id'].'"><i class="fa fa-print"></i></a>
                                    </td><td>'.$pers->getNomComplet().'</td>';
                                    echo '</tr>';
                                    }
                                }
                                }
                                }
                                    ?>
                    </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>-</th> <th>-</th><th>Total</th><th><?php echo number_format($tot,'0','.',',');?></th><th><?php echo number_format($totpaie,'0','.',',');?></th><th><?php echo number_format($totdu,'0','.',',');?></th><th>-</th><th>-</th>
                                        </tr>
                                    </tfoot>
               </table>
                            </div>
              </div>
    </div>

</div>
