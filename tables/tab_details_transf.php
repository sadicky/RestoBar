<?php
@session_start();
require_once '../load_model.php';
$det= new BeanDetailsOperation();
$prod= new BeanProducts();
//$sort= new BeanSortieMatp();
?>
<div class="table-responsive">
                             <table class="table table-bordered table-striped table-condensed display table-sm" cellspacing="0" width="100%" border="&" id="dt">
                             <thead>
                                <tr>
                                  <th>Produit</th><th>Unité</th><th>Qt</th><th>-</th>
                                </tr>
                            </thead>
                                    <tbody>
                                    <?php
                                    if(isset($_SESSION['op_transf_prod_id']))
                                    {
                                    $datas2=$det->select_all($_SESSION['op_transf_prod_id']);

                                    foreach ($datas2 as $un) {

                                    $prod->select($un['prod_id']);
                                    //$cat->select($prod->getCategoryId());
                                    echo '<tr><td >'.$prod->getProdName().'</td><td >'.$prod->getUntMes().'</td></td><td>'.$un['quantity'].'</td>';
                                    echo '<td><button class="btn btn-sm btn-danger btn-circle delete_det_transf_prod" name="delete" id="'.$un["details_id"].'">';


                                    echo '<span class="fa fa-times"></span>';


                                    echo '</button></td></tr>';

                                    }

                                    }
                                    ?>
    </tbody>
    </table>
</div>
