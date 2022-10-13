<?php
@session_start();
require_once '../load_model.php';
$op= new BeanOperation();
$trans=new BeanTransactions();
$det= new BeanDetailsOperation();
$prod= new BeanProducts();
$cat= new BeanCategory();
$acc= new BeanAccounts();
$ent = new BeanEntreProdf();
$pers= new BeanPersonne();
$datas=$op->select_all_by_state('Production','1');
//$datas_paie=$trans->select_all_ag($_SESSION['acc_id'],'paiement');
?>
<div class="white-box row">
<div class="col-md-12">
<div class="alert alert-info" style="background-color: white;" id="appro_tab">
                            <h4 class="box-title m-b-0">Entrée de produits finis</h4>
                            <hr>
                            <div class="table-responsive">
							 <table id="example23" class="table table-bordered table-striped table-condensed display table-sm" cellspacing="0" width="100%">
							 <thead>
                                        <tr>
                                            <th>#N°</th><th>Date</th><th>Montant</th><th>-</th>
                                        </tr>
                            </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#N°</th><th>Date</th><th>Montant</th><th>-</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
									<?php
                                    foreach ($datas as $un) {
                                    //if($un['is_paid']=='0')
                                    //{
                                    //$acc->select($un['personne_id']);
                                    //$pers->select($acc->getPersonneId());
                                    $ent->select($un['op_id']);

                                    echo '<tr class="row_op_ent" data-id='.$un['op_id'].' style="cursor:pointer"><td><i class="fa fa-hand-o-right fa-fw"></i>'.$ent->getNumEnt().'</td><td>'.date('Y-m-d',strtotime($un['create_date'])).'</td>';


                                    echo '<td>';

                                    //if($un['state']=='1') echo 'Done'; else echo 'Canceled';*/

                                    echo number_format($ent->getAmount(),0,'.',',');
                                    echo '</td>';

echo '<td>';
                                    if($ent->getAmount()!=0)
                                    {

                                    if($un["state"]=='1') echo '<button class="btn btn-warning btn-circle delete_op_ent" name="delete" id="'.$un["op_id"].'"><span class="fa fa-minus"></span></button>';
                                    else echo '<button class="btn btn-success btn-circle delete_op_sort" name="delete" id="'.$un["op_id"].'"><span class="fa fa-check"></span></button>';

                                    }
                                    else
                                        {
                                            echo '-';
                                        }
                                        echo '</td>';

                                    echo '</tr>';
                                    //}
                                }
                                    ?>
										</tbody>
							 </table>
                            </div>
							</div>
    </div>

</div>
