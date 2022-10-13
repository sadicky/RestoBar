<?php
@session_start();
require_once '../load_model.php';
$op= new BeanOperation();
$trans=new BeanTransactions();
$det= new BeanDetailsOperation();
$prod= new BeanProducts();
$cat= new BeanCategory();
$acc= new BeanAccounts();
$sort= new BeanSortieMatp();
$pers= new BeanPersonne();
$datas=$op->select_all_by_state('Transfert produit','1',$_SESSION['pos']);
//$datas_paie=$trans->select_all_ag($_SESSION['acc_id'],'paiement');
?>
<div class="white-box form-row">
<div class="col-md-6">
<div class="alert alert-info" style="background-color: white;" id="appro_tab">
                            <h4 class="box-title m-b-0">Sortie des produits</h4>
                            <hr>
                            <div class="table-responsive">
							 <table id="example23" class="table table-bordered table-striped table-condensed display" cellspacing="0" width="100%">
							 <thead>
                                <tr>
                                <th>#N°</th><th>Date</th><th>Montant</th><th>Destination</th><th>-</th>
                                </tr>
                            </thead>

                                    <tbody>
									<?php
                                    foreach ($datas as $un) {
                                    //if($un['is_paid']=='0')
                                    //{
                                    $acc->select($un['personne_id']);
                                    $pers->select($un['party_code']);
                                    $sort->select($un['op_id']);

                                    echo '<tr class="row_op_transf_prod" data-id='.$un['op_id'].' style="cursor:pointer"><td><i class="fa fa-hand-o-right fa-fw"></i>'.$sort->getNumSort().'</td><td>'.date('Y-m-d',strtotime($un['create_date'])).'</td>';


                                    echo '<td>';

                                    //if($un['state']=='1') echo 'Done'; else echo 'Canceled';*/

                                    echo number_format($sort->getAmount(),0,'.',',');
                                    echo '</td><td>'.$pers->getNomComplet().'</td>';


                                    echo '<td>';
                                    if($un["state"]=='1') echo '<button class="btn btn-warning btn-circle delete_op_transf_prod" name="delete" id="'.$un["op_id"].'"><span class="fa fa-minus"></span></button>';
                                    else echo '<button class="btn btn-success btn-circle delete_op_transf_prod" name="delete" id="'.$un["op_id"].'"><span class="fa fa-check"></span></button>';

                                    echo '</tr>';
                                    //}
                                }
                                    ?>
										</tbody>
							 </table>
                            </div>
							</div>
    </div>
    <div class="col-md-6">
    <div class="alert alert-info" style="background-color: white;" id="sort_tab">
        <h4 class="box-title m-b-0">Détails (Sortie des produits)</h4>
        <div id="facture">
            <?php
            $sort->select($_SESSION['op_id']);
            $op->select($_SESSION['op_id']);
            ?>
        <h4 class="box-title m-b-0">Bon de sortie</h4><hr>
        <h5>Bon N° : <?php if(isset($_SESSION['sort_num'])){echo $_SESSION['sort_num'];}else {echo '?';} ?><br/><br/>
         Agent : <?php $pers->select($_SESSION['perso_id']); echo $pers->getNomComplet(); ?>
         <br/><br/>
         Date : <?php echo $op->getCreateDate(); ?>
        </h5><hr/>
        <div class="table-responsive">
                             <table class="table table-bordered table-striped table-condensed display" cellspacing="0" width="100%" border="1">
                             <thead>
                                        <tr>
                                            <th>Produit</th><th>Qté(Gros)</th><th>PU</th><th>Tot</th><th>-</th>
                                        </tr>
                            </thead>

                                    <tbody>
                                    <?php
                                    if(isset($_SESSION['op_id']))
                                    {
                                    $datas2=$det->select_all($_SESSION['op_id']);

                                    $tot=0;
                                    $totgen=0;

                                    foreach ($datas2 as $un) {

                                    $tot=$un['quantity']*$un['amount'];
                                    $totgen +=$tot;

                                    $prod->select($un['prod_id']);
                                    $cat->select($prod->getCategoryId());
                                    echo '<tr><td >'.$prod->getProdName().'</td><td>'.$un['quantity'].'</td><td>'.number_format($un['amount'],0,'.',',').'</td><td>'.number_format($tot,0,'.',',').'</td>';

                                    /*echo '<td><button class="btn btn-success btn-circle update_det_sort" name="update" id="'.$un["details_id"].'"><span class="fa fa-edit"></span></button></td>';*/


                                    echo '</td><td><button class="btn btn-danger btn-circle delete_det_transf_prod" name="delete" id="'.$un["details_id"].'">';

                                    echo '<span class="fa fa-times"></span>';


                                    echo '</button></td></tr>';

                                    }
                                     echo '<tr><th colspan="3">Total Gén</th><th>'.number_format($totgen,0,'.',',').'</th><th>-</th><tr>';
                                    }
                                    ?>
    </tbody>
    </table>
</div>
<h5>
    Destination : <?php $pers->select($op->getPartyCode()); echo $pers->getNomComplet(); ?>
         <br/><br/>
    Responsable : ................................
         <br/><br/>
</h5>
</div>
 <a href="javascript:void(0)" id="print_facture" class="btn btn-success" title="Imprimer"><span class="fa fa-print"></span></a>
    </div>
</div>
