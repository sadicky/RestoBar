<?php
@session_start();
require_once '../load_model.php';
$op= new BeanOperation();
$trans=new BeanTransactions();
$paie= new BeanPaiement();
$loc= new BeanLocation();
$chamb= new BeanChambre();
$cat= new BeanCategory();
$acc= new BeanAccounts();
$fact= new BeanLocationFact();
$pers= new BeanPersonne();
$pers2= new BeanPersonne();
$pers3= new BeanPersonne();
$vente= new BeanVente();
$det=new BeanDetailsOperation();
$prod= new BeanProducts();

$datas=$op->select_op_paid_part($_GET['client'],'0');   

?>
<div class="white-box form-row">
<div class="col-md-12" id="vente_tab">

                            <h4 class="box-title m-b-0">Client :
                                <?php
                                $pers->select($_GET['client']);
                                echo $pers->getNomComplet();

                                ?></h4>
                            <hr>
                            <div class="table-responsive">
							 <table id="example23" class="table table-bordered table-striped table-sm display dtab2" border="1">
							 <thead>
                        <tr>
                        <th>#</th><th>N° Fact.</th><th>Date de saisie</th><th>Description</th><th>Dû</th><th>TVA</th><th>Payé</th>
                        </tr>
                            </thead>

                                    <tbody>
									<?php
                                    $totdu=0;
                                    $totpaie=0;
                                    $tot_tva=0;
                                    $i=1;
                                    foreach ($datas as $un) {

                                    $pers2->select($un['personne_id']);
                                    $pers3->select($un['party_code']);
                                    $fact->select($un['op_id']);
                                    $vente->select($un['op_id']);
                                    $amount=$paie->select_sum_op($un['op_id']);


                                    
                                    echo '<tr><td>';
                                    /*if($un['is_paid']=='0')
                                    {
                                    $loc->select_chamb_2($un['op_id']);
                                    echo '<button class=" btn btn-light btn-sm row_op_loc" id="'.$un['op_id'].'" data-id="'.$loc->getChambId().'" style="cursor:pointer"><i class="fa fa-edit fa-fw"></i></button>';
                                    }*/

                                    echo $i.'</td><td>';
                                    if($un['op_type']=='Location')
                                    {
                                     echo $fact->getLocNum();   
                                    }
                                    else
                                    {
                                     echo $vente->getNumVente();
                                    }
                                    echo '</td><td>'.date('Y-m-d',strtotime($un['create_date'])).'</td><td><ul>';

                                    if($un['op_type']=='Location')
                                    {
                                    $datas2=$loc->select_all($un['op_id']);
                                    $cout=0;
                                    foreach ($datas2 as $un2) {
                                    $to_day=date('Y-m-d');
                                    $chamb->select($un2['chamb_id']);

                                    if($un2['loc_etat']=='1') { $nb_days=$fact->dateDiff($un2['from_d'],$to_day);}
                                    else { $nb_days=$fact->dateDiff($un2['from_d'],$un2['to_d']); }

                                    echo '<li>Chambre No : '.$chamb->getChambNum().' : <b>'.$un2['from_d'].'</b> au <b>'.$un2['to_d'].'</b>';

                                    

                                    echo '&#013;</li>';
                                    
                                    
                                    if($nb_days<=0) $nb_days=1;
                                    $cout +=$nb_days*$un2['loc_price'];
                                     }
                                     echo '</ul><a href="javascript:void(0)" title="Imprimer" class="btn btn-light btn-sm det_facture_hot" data-id="'.$un['op_id'].'"><i class="fa fa-print"></i></a>';
                                    }
                                    else
                                    {
                                    $datas2=$det->select_all($un['op_id']);
                                    $perc=0;
                                    foreach ($datas2 as $un2) {
                                    $prod->select($un2['prod_id']);
                            
                                    echo '<li>'.$un2['quantity'].' '.$prod->getProdName().'&#013;</li>';
                                     }
                                     echo '</ul><a href="javascript:void(0)" title="Imprimer" class="btn btn-light btn-sm det_facture" data-id="'.$un['op_id'].'"><i class="fa fa-print"></i></a>';
                                    }
                                    
                                    echo '</td>';
                                    echo '<td align="right">';
                                    if($un['op_type']=='Location')
                                    {
                                    $pttc=$cout-$fact->getLocRed();
                                    $cout -=($fact->getLocRed()+$amount['paie']);
                                    $reste=$cout;
                                    echo $pers->nb_format($reste);
                                    }
                                    else
                                    {

                                        $m_vente=$det->select_sum_op($un['op_id']) - $vente->getRed();
                                        $reste=($m_vente- $amount['paie']);
                                        echo $pers->nb_format($reste);
                                    }
                                    $totdu +=$reste;

                                    echo '</td><td align="right">';

                                    if($un['op_type']=='Location')
                                    {
                                    if($fact->getLocTva()=='1'){$tva=$pttc*0.18; $tot_tva +=$tva;} else {$tva=0;}
                                    echo $pers->nb_format($tva);
                                    }
                                    else
                                    {
                                    
                                    if($vente->getTva()=='1'){$tva=$vente->getAmount()*0.18; $tot_tva +=$tva;} else {$tva=0;}
                                            echo $pers->nb_format($tva);
                                    }
                                    echo '</td><td class="tc" align="right">';
                                    echo $pers->nb_format($amount['paie']);
                                    $totpaie +=$amount['paie'];
                                    echo '</td>';
                                    echo '</tr>';
                                    $i++;
                                   // }

                                }
                                    ?>
										</tbody>
                                        <tfoot>
                                        <tr>
                                             <th>#</th><th>-</th><th>Total</th><th>-</th>
                                             <td align="right"><b><?php echo $pers->nb_format($totdu);?></b></td>
                                             <td align="right"><b><?php echo $pers->nb_format($tot_tva);?></b></td>
                                             <td align="right"><b><?php echo $pers->nb_format($totpaie); ?></b></td>
                                        </tr>
                                    </tfoot>
							 </table>
                            </div>

    </div>
</div>
    <!-- <div class="col-md-5" id="hist_vente_tab">

</div> -->
