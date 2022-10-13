<?php
@session_start();
require_once '../load_model.php';
$op= new BeanOperation();
$trans=new BeanTransactions();
$paie= new BeanPaiement();
$loc= new BeanLocation();
$chamb= new BeanPlace();
$cat= new BeanCategory();
$acc= new BeanAccounts();
$fact= new BeanVente();
$pers= new BeanPersonne();
$pers2= new BeanPersonne();
$pers3= new BeanPersonne();

/*if(empty($_POST['client']))
{*/
$datas=$loc->select_all_by_period_loc($_POST['from_d'],$_POST['to_d']);
/*}
else
{
 $datas=$op->select_all_by_period_nopos_part_loc('Location',$_POST['from_d'],$_POST['to_d'],$_POST['client']);   
}*/
?>
<div class="white-box form-row">
<div class="col-md-12" id="vente_tab">

                            <h4 class="box-title m-b-0">Location du <?php echo $_POST['from_d']; ?>: Au: <?php echo $_POST['to_d']; ?> / Client :
                                <?php
                                $pers->select($_POST['client']);
                                    echo $pers->getNomComplet();

                                ?></h4>
                            <hr>
                            <div class="table-responsive">
							 <table id="example23" class="table table-bordered table-striped table-sm display" cellspacing="0" width="100%">
							 <thead>
                        <tr>
                        <th>#</th><th>Date début</th><th>Date Fin</th><th>Nb jrs</th><th>Chambre / Salle</th><th>Etat</th><th>Client</th><th>Montant dû</th><th>Par</th>
                        </tr>
                            </thead>

                                    <tbody>
									<?php
                                    $totdu=0;
                                    $totpaie=0;
                                    $tot_tva=0;
                                    $cout=0;
                                    $i=1;
                                    foreach ($datas as $un) {
                                    $op->select($un['op_id']);
                                    $pers2->select($op->getPersonneId());
                                    $pers3->select($op->getPartyCode());
                                    $fact->select($un['op_id']);
                                    $chamb->select_2($un['chamb_id']);
                                    
                                    $nb_days=$loc->dateDiff($un['from_d'],$un['to_d']);
                                    if($nb_days==0) $nb_days=1;
                                    $cout =$nb_days*$un['loc_price'];
                                    
                                    echo '<tr><td>';
                                    /*if($un['is_paid']=='0')
                                    {*/
                                    $loc->select_chamb_2($un['op_id']);
                                    echo '<button class=" btn btn-light btn-sm row_op_loc" id="'.$un['op_id'].'" data-id="'.$loc->getChambId().'" style="cursor:pointer"><i class="fa fa-edit fa-fw"></i></button>';
                                    //}

                                    echo $i.'</td><td>'.date('Y-m-d',strtotime($un['from_d'])).'</td><td>'.date('Y-m-d',strtotime($un['to_d'])).'</td><td>'.$nb_days.'</td><td>'.$chamb->getPlaceNum().'</td><td>';
                                     /*<a href="javascript:void(0)" class="new_loc" id="'.$un['op_id'].'" data-id="'.$ch.'"><i class="fa fa-file"></i></a>*/
                                     if($un['loc_etat']=='1' and $chamb->getStatus()=='0') echo 'Encours'; elseif($un['loc_etat']=='1' and $chamb->getStatus()=='1') echo 'Reservation'; else echo 'Cloturée';

                                    echo '</td><td>'.$pers3->getNomComplet().'</td>';
                                    echo '<td align="right">';
                                    echo $pers->nb_format($cout);
                                    
                                    $totdu +=$cout;
                                    echo '</td><td>'.$pers2->getNomComplet().'</td>';
                                    echo '</tr>';
                                    $i++;
                                   // }

                                }
                                    ?>
										</tbody>
                                        <tfoot>
                                        <tr>
                                             <th>#</th><th>-</th><th>Total</th><th>-</th><th>-</th><th>-</th><th>-</th>
                                             <td align="right"><b><?php echo $pers->nb_format($totdu);?></b></td>
                                            <th>-</th>
                                        </tr>
                                    </tfoot>
							 </table>
                            </div>

    </div>
</div>
    <!-- <div class="col-md-5" id="hist_vente_tab">

</div> -->
