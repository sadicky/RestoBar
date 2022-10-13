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


 $datas=$op->select_all_by_pay_party('Vente',$_GET['client'],'0',$_SESSION['pos']);

?>
<div class="white-box form-row">
<div class="col-md-12" id="vente_tab">

                            <h4 class="box-title m-b-0">Factures Non Payées du Client :
                                <?php
                                $pers->select($_GET['client']);
                                    echo $pers->getNomComplet();

                                ?></h4>
                            <hr>
                            <div class="table-responsive">
							 <table id="example23" class="table table-bordered table-striped table-sm display" cellspacing="0" width="100%">
							 <thead>
                        <tr>
                        <th>#</th><th>N° Fact.</th><th>Date</th><th>Client</th><th>Dû</th><th>Payé</th><th>Article</th><th>Par</th>
                        </tr>
                            </thead>

                                    <tbody>
									<?php
                                    $totdu=0;
                                    $totpaie=0;
                                    $i=1;
                                    foreach ($datas as $un) {

                                    $pers2->select($un['personne_id']);
                                    $pers->select($un['party_code']);
                                    $vente->select($un['op_id']);
                                    $amount=$paie->select_sum_op($un['op_id']);


                                    if($vente->getAmount()!=0)
                                    {
                                    echo '<tr><td class="det_facture" data-id='.$un['op_id'].' style="cursor:pointer"> <i class="fa fa-hand-o-right fa-fw"></i>'.$i.'</td><td>'.$vente->getNumVente().'</td><td>'.date('Y-m-d',strtotime($un['create_date'])).'</td><td>'.$pers->getNomComplet().'</td>';


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
                                    //$m_vente=$vente->getAmount();

                                    $reste=$m_vente- $amount['paie'];
                                    echo number_format($reste,'0','.',',');
                                    $totdu +=$reste;
                                    echo '</td>';
                                    echo '<td>';
                                    echo number_format($amount['paie'],'0','.',',');
                                    $totpaie +=$amount['paie'];
                                    echo '</td>';
                                    echo '<td><ul>';
                                    $datas2=$det->select_all($un['op_id']);
                                    foreach ($datas2 as $un2) {
                                    $prod->select($un2['prod_id']);
                                    echo '<li>'.$un2['quantity'].' '.$prod->getProdName().'</li>';
                                     }
                                    echo '</ul>

                                    <a href="javascript:void(0)" title="Imprimer" class="btn btn-light btn-sm det_facture" data-id="'.$un['op_id'].'"><i class="fa fa-print"></i></a>
                                    </td><td>'.$pers2->getNomComplet().'</td>';
                                    echo '</tr>';
                                    $i++;
                                    }

                                }
                                    ?>
										</tbody>
                                        <tfoot>
                                        <tr>
                                             <th>#</th><th>-</th><th>Total</th><th>-</th><th><?php echo number_format($totdu,'0','.',',');?></th><th><?php echo number_format($totpaie,'0','.',','); ?></th><th>-</th><th>-</th>
                                        </tr>
                                    </tfoot>
							 </table>
                            </div>

    </div>
</div>
    <!-- <div class="col-md-5" id="hist_vente_tab">

</div> -->
