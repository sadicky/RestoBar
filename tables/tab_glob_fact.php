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
$pers3= new BeanPersonne();
$autre= new BeanAutreInfo();
$pr=new BeanPrice();


 $datas=$op->select_all_glob_fact('Vente',$_GET['from_d'],$_GET['to_d'],$_GET['client'],$_GET['pos']);


?>
<div class="white-box form-row">
<div class="col-md-12" id="vente_tab">

                            <h4 class="box-title m-b-0">Vente du <?php echo $_GET['from_d']; ?>: Au: <?php echo $_GET['to_d']; ?> / Stock :
                                <?php
                                $pers->select($_GET['pos']);
                                    echo $pers->getNomComplet();

                                ?>/ Tarif :
                                <?php
                                $pers->select($_GET['client']);
                                    echo $pers->getNomComplet();

                                ?></h4>

                            <hr>
                            <div class="table-responsive">
							 <table id="example23" class="table table-bordered table-striped table-sm display" cellspacing="0" width="100%">
							 <thead>
                        <tr>
                        <th>#</th><th>Date</th><th>Matricule</th><th>Bon</th><th>Affilié</th><th>Bénéficiaire</th><th>Produits</th><th>Qté</th><th>PU<th>PT</th><th>Patronale(%)</th><th>Bénéficiaire(%)</th>
                        </tr>
                            </thead>

                                    <tbody>
									<?php
                                    $totdu=0;
                                    $totpaie=0;
                                    $tot_perc=0;
                                    $perc=0;
                                    $i=1;
                                    foreach ($datas as $un) {
                                    $vente->select($un['op_id']);
                                    $autre->select($vente->getIdvente());
                                    $amount=$paie->select_sum_op($un['op_id']);
                                    $trans->select_op($un['op_id']);

                                    $prod->select($un['prod_id']);
                                    $pers->select($vente->getAssId());
                                    $pr->select_2($un['prod_id'],$vente->getAssId());
                                    
                                    /*if($prod->getEquivId()!='0' and $pers->getNomComplet()=='MFP')
                                    {
                                        $perc=$pr->getPricePub()-$un['pu'];
                                    }    
                                    else
                                    {  
                                    $div=(100-$un['det']);  
                                    if($div>0)
                                    {
                                    $perc1 =$pr->getPrice()*$un['quantity'];
                                    $perc =($perc1*$un['det'])/100; 
                                    }
                                    else
                                    {
                                     $pr->select_2($un['prod_id'],$vente->getAssId());
                                     $perc=$pr->getPrice()*$un['quantity']; 
                                    }  
                                    }*/
                                    
                                    $tot_perc +=$perc;
                                    $pt100=$un['quantity']*$pr->getPrice();
                                    $pu=$un['quantity']*$un['pu'];
                                    

                                   
                                    echo '<tr><td>'.$i.'<td>';
                                
                                    if(empty($trans->getCreateDate()))
                                    {
                                       echo date('Y-m-d',strtotime($un['create_date'])).' '.date('h:i:s',strtotime($un['h_op'])); 
                                    }
                                    else
                                    {
                                    echo $trans->getCreateDate();
                                    }
                                    echo '</td><td>'.$autre->getNumBon().'</td><td>'.$autre->getMat().'</td><td>'.$autre->getAffilie().'</td><td>'.$autre->getBenef().'</td><td>'.$prod->getProdName().'</td><td>'.$un['quantity'].'</td><td>'.$pr->getPrice().'</td><td>'.$pt100.'</td><td class="tc" align="right">'.$pers->nb_format($pt100-$pu).' ('.$un['det'].'%)</td><td class="tc" align="right">'.$pu.'</td>';
                                   
                                    echo '</tr>';
                                    $i++;
                                    $pt=0;

                                }
                                    ?>
										</tbody>
                                        <tfoot>
                                        <tr>
                                             <th>#</th><th>-</th><th>Total</th><th>-</th><th>-</th>
                                             <td class="tc" id="t1" align="right"><b><?php echo $pers->nb_format($tot_perc);?></b></td>
                                             <td class="tc" id="t3" align="right"><b><?php echo $pers->nb_format($totpaie); ?></b></td><th>-</th><th>-</th><th>-</th><th>-</th><th>-</th>
                                        </tr>
                                    </tfoot>
							 </table>
                            </div>

    </div>
</div>
    <!-- <div class="col-md-5" id="hist_vente_tab">

</div> -->
