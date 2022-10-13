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
$sort= new BeanSortieMatp();
$pers= new BeanPersonne();
$ent= new BeanEntreProdf();

$datas=$op->select_all_by_period_rap('Sortie',$_GET['from_d'],$_GET['to_d'],$_GET['pos']);

?>
<div class="white-box form-row">
<div class="col-md-12" id="appro_tab">
<!-- <div class="alert alert-info" style="background-color: white;" > -->
                            <h4 class="box-title m-b-0">Sortie du Stock Du <?php echo $_GET['from_d']; ?>: Au: <?php echo $_GET['to_d']; ?> / Stock :
                                <?php
                                $pers->select($_GET['pos']);
                                    echo $pers->getNomComplet();

                                ?></h4>
                            <hr>
                            <div class="table-responsive">
							 <table id="example23" class="table table-bordered table-striped table-condensed display" cellspacing="0" width="100%">
                             <thead>
                                        <tr>
                                           <th>Date</th><th>Motif</th><th>Code</th><th>Produits</th><th>Qté</th><th>Type</th><th>PU</th><th>PT</th><th>-</th>
                                        </tr>
                            </thead>
                                    <tbody>
                                    <?php
                                    foreach ($datas as $un) {
                                    $sort->select($un['op_id']);
                                    $prod->select($un['prod_id']);
                                    echo '<tr><td>'.date('Y-m-d',strtotime($un['create_date'])).'</td><td>'.$sort->getMotif().'</td>';


                                    echo '<td>'.$prod->getProdCode().'</td><td>';

                                    echo $prod->getProdName();
                                    echo '</td>';
                                    echo '<td>'.$un['quantity'].'</td><td>';
                                    if($un['det']=='0')
                                    {
                                        echo 'Gros';
                                    }
                                    else
                                    {
                                        echo 'Détail';
                                    }
                                    echo '</td><td>'.$un['amount'].'</td><td>'.$un['amount']*$un['quantity'].'</td>';

                                    echo '<td><button class="btn btn-danger btn-circle delete_det_sort" name="delete" id="'.$un["details_id"].'">';

                                    echo '<span class="fa fa-times"></span>';


                                    echo '</button></td>';
                                    echo '</tr>';
                                }
                                    ?>
                                        </tbody>

                             </table>
                            </div>
							<!-- </div> -->
    </div>
    </div>
