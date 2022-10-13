<?php
@session_start();
require_once '../load_model.php';
$det= new BeanDetailsOperation();
$prod= new BeanProducts();
$cat= new BeanCategory();
?>
<h5 class="box-title m-b-0">Détails MP</h5><hr>

        <div class="table-responsive">
                             <table class="table table-bordered table-striped table-condensed display" cellspacing="0" width="100%">
                             <thead>
                                        <tr>
                                           <th>Produit</th><th>Prix</th><th>Quantité</th><th>-</th><th>-</th>
                                        </tr>
                            </thead>
                                    <tbody>
                                    <?php
                                    if(isset($_SESSION['op_ent_id']))
                                    {
                                    $datas2=$det->select_all($_SESSION['op_ent_id']);
                                    foreach ($datas2 as $un) {
                                    $prod->select($un['prod_id']);
                                    $cat->select($prod->getCategoryId());
                                    echo '<tr><td >'.$prod->getProdName().'</td><td>'.number_format($un['amount'],0,'.',',').'</td><td>'.$un['quantity'].'</td>';

                                   echo '<td><button class="btn btn-success btn-circle update_det_ent" name="update" id="'.$un["details_id"].'"><span class="fa fa-edit"></span></button></td>';


                                    echo '</td><td><button class="btn btn-danger btn-circle delete_det_ent" name="delete" id="'.$un["details_id"].'">';

                                    echo '<span class="fa fa-times"></span>';


                                    echo '</button></td></tr>';

                                    }
                                    }
                                    ?>
    </tbody>
    </table>
</div>
