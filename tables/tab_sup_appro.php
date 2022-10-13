<?php
@session_start();
require_once '../load_model.php';
$op= new BeanOperation();
$trans=new BeanTransactions();
$det= new BeanDetailsOperation();
$prod= new BeanProducts();
$cat= new BeanCategory();
$acc= new BeanAccounts();
$achat= new BeanAchats();
$pers= new BeanPersonne();
$datas=$op->select_all_sup_by_pay($_SESSION['sup_id'],'0',$_SESSION['pos']);
//$datas_paie=$trans->select_all_ag($_SESSION['acc_id'],'paiement');
?>
<div class="white-box form-row" style="margin: 0px;">
<div class="col-md-5">
<div class="alert alert-info" style="background-color: white;" id="appro_tab">
                            <h4 class="box-title m-b-0">Bon de commande Encours</h4>
                            <hr>
                            <div class="table-responsive">
							 <table id="example23" class="table table-bordered table-striped table-condensed display" cellspacing="0" width="100%">
							 <thead>
                                        <tr>
                                            <th>#N°</th><th>Date</th><th>Montant</th><th>-</th>
                                        </tr>
                            </thead>

                                    <tbody>
									<?php
                                    foreach ($datas as $un) {
                                    if($un['state']=='1')
                                    {
                                    $acc->select($un['personne_id']);
                                    $pers->select($acc->getPersonneId());
                                    $achat->select($un['op_id']);

                                    echo '<tr class="row_op" data-id='.$un['op_id'].' style="cursor:pointer"><td> <i class="fa fa-hand-o-right fa-fw"></i>'.$achat->getNumAchat().'</td><td>'.date('Y-m-d',strtotime($un['create_date'])).'</td>';


                                    echo '<td>';

                                    //if($un['state']=='1') echo 'Done'; else echo 'Canceled';*/

                                    echo number_format($achat->getAmount(),0,'.',',');
                                    echo '</td>';



                                    echo '<td>';
                                    if($un["state"]=='1') echo '<button class="btn btn-warning btn-circle delete_op" name="delete" id="'.$un["op_id"].'"><span class="fa fa-minus"></span></button>';
                                    else echo '<button class="btn btn-success btn-circle delete_op" name="delete" id="'.$un["op_id"].'"><span class="fa fa-check"></span></button>';

                                    echo '</td></tr>';
                                    }
                                }
                                    ?>
										</tbody>
							 </table>
                            </div>
							</div>
    </div>
    <div class="col-md-7">
    <div class="alert alert-info" style="background-color: white;" id="appro_tab">
        <h4 class="box-title m-b-0">Détails Bon de commande</h3><hr>
        <div id="facture">
            <?php
            $achat->select($_SESSION['op_id']);
            $op->select($_SESSION['op_id']);
            ?>
        <!-- <h4 class="box-title m-b-0">Bon de commande</h4><hr>
        <h5>Bon N° : <?php /*if(isset($_SESSION['op_num'])){echo $_SESSION['op_num'];}else {echo '?';}*/ ?><br/><br/>
         Fournisseur : <?php
         /*$pers->select($op->getPartyCode()); echo $pers->getNomComplet();*/ ?>
         <br/><br/>
         Date : <?php /*echo $op->getCreateDate();*/ ?>
        </h5><hr/> -->
        <div class="table-responsive">
                             <table id="example24" class="table table-bordered table-striped table-condensed display" cellspacing="0" width="100%" border="1">
                             <thead>
                                        <tr>
                                            <th>Produit</th><th>Prix</th><th>Qt</th><th>-</th><th>-</th>
                                        </tr>
                            </thead>

                                    <tbody>
                                    <?php
                                    if(isset($_SESSION['op_id']))
                                    {
                                    $datas2=$det->select_all($_SESSION['op_id']);
                                    foreach ($datas2 as $un) {
                                    $prod->select($un['prod_id']);
                                    //$cat->select($prod->getCategoryId());
                                    echo '<tr><td >'.$prod->getProdName().'</td><td>'.number_format($un['amount'],0,'.',',').'</td><td>'.$un['quantity'].'</td>';

                                    echo '<td>';

                                    if($un['amount']!=0)
                                    {
                                    echo '<button class="btn btn-success btn-circle update_det" name="update" id="'.$un["details_id"].'"><span class="fa fa-edit"></span></button>';
                                    }
                                    echo '</td>';


                                    echo '</td><td><button class="btn btn-danger btn-circle delete_det" name="delete" id="'.$un["details_id"].'">';

                                    echo '<span class="fa fa-times"></span>';


                                    echo '</button></td></tr>';

                                    }
                                    }
                                    ?>
    </tbody>
    </table>
</div>
<!-- <h5>
    Receptionné par : <?php $pers->select($_SESSION['perso_id']); echo $pers->getNomComplet(); ?>
         <br/><br/>
    Signature : ................................
         <br/><br/>
</h5>
    </div>
    <a href="javascript:void(0)" id="print_facture" class="btn btn-success" title="Imprimer"><span class="fa fa-print"></span></a> -->
</div>
