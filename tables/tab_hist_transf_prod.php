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
$sortie= new BeanSortieMatp();
$pers= new BeanPersonne();
$pers2= new BeanPersonne();
/*if(empty($_GET['four']))
{*/
$datas=$op->select_all_by_period('Transfert produit',$_GET['from_d'],$_GET['to_d'],$_GET['pos']);
//}
/*else
{

 $datas=$op->select_all_by_period_sup('Approvisionnement',$_GET['from_d'],$_GET['to_d'],$_GET['four'],$_GET['pos']);
}*/
//$datas_paie=$trans->select_all_ag($_SESSION['acc_id'],'paiement');
?>
<div class="white-box row">
<div class="col-md-12">
<div class="alert alert-info" style="background-color: white;" id="appro_tab">
                            <h4 class="box-title m-b-0">Historique du Trasfert des Produits Du <?php echo $_GET['from_d']; ?>: Au: <?php echo $_GET['to_d']; ?> / Stock :
                                <?php
                                $pers->select($_GET['pos']);
                                    echo $pers->getNomComplet();

                                ?></h4>
                            <hr>
                            <div class="table-responsive">
							 <table id="example23" class="table table-bordered table-striped table-condensed display table-sm" cellspacing="0" width="100%">
							 <thead>
                                <tr>
                    <th>#N°</th><th>Date/Heure</th><th>Destination</th><th>Article</th><th>Par</th>
                                        </tr>
                            </thead>

                                    <tbody>
									<?php
                                    $totdu=0;
                                    $totpaie=0;
                                    foreach ($datas as $un) {

                                    $pers2->select($un['personne_id']);
                                    $pers->select($un['party_code']);
                                    $sortie->select($un['op_id']);

                                    echo '<tr><td> ';
                                    if($un['jour_id']==$_SESSION['jour'])
                                    {
                                    echo '<button class="btn btn-light btn-sm row_edit_transf_hist" style="cursor:pointer" data-id="'.$un['op_id'].'"><i class="fa fa-edit fa-fw" ></i></button>';
                                    }
                                    echo $sortie->getNumSort().'</td><td>'.date('Y-m-d h:i',strtotime($un['create_date'])).'</td><td>'.$pers->getNomComplet().'</td>';


                                    /*echo '<td>';

                                    echo number_format($achat->getAmount(),'0','.',',');
                                    $totdu +=$achat->getAmount();
                                    echo '</td>';*/
                                    echo '<td><ul>';
                                    $datas2=$det->select_all($un['op_id']);
                                    foreach ($datas2 as $un2) {
                                    $prod->select($un2['prod_id']);
                                    echo '<li>'.$un2['quantity'].' '.$prod->getProdName().'</li><span style="visibility:hidden;">;</span>&#013;';
                                     }
                                    echo '</ul>

                                    <a href="javascript:void(0)" title="Imprimer" class="btn btn-light btn-sm print_transf" id="'.$un['op_id'].'"><i class="fa fa-print"></i></a>
                                    </td><td>'.$pers2->getNomComplet().'</td>';
                                    echo '</tr>';

                                }
                                    ?>
										</tbody>
                                        <!-- <tfoot>
                                        <tr>
                                            <th>-</th><th>Total</th><th>-</th><th><?php //echo number_format($totdu,'0','.',',');?></th><th>-</th><th>-</th>
                                        </tr>
                                    </tfoot> -->
							 </table>
                            </div>
							</div>
    </div>
    <!-- <div class="col-md-6">
    <div class="alert alert-info" style="background-color: white;" id="hist_det_appro_tab">

    </div>
</div> -->
</div>
