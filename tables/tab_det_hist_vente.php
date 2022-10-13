<?php
@session_start();
require_once '../load_model.php';
$det= new BeanDetailsOperation();
$prod= new BeanProducts();
?>
<h4 class="box-title m-b-0">Détails / Vente N° : <?php if(isset($_SESSION['op_vente_hist_num'])){ echo $_SESSION['op_vente_hist_num']; } ?></h4><hr>

        <div class="table-responsive">
                             <table class="table table-bordered table-striped table-sm display" cellspacing="0" width="100%">
                             <thead>
                <tr>
                   <th>Code</th><th>Produit</th><th>Prix</th><th>Quantité</th><th>-</th>
                </tr>
                            </thead>
                                    <tbody>
                                    <?php
                                    if(isset($_SESSION['op_vente_hist_id']))
                                    {
                                    $datas2=$det->select_all($_SESSION['op_vente_hist_id']);
                                    foreach ($datas2 as $un) {
                                    $prod->select($un['prod_id']);
                                    //$cat->select($prod->getCategoryId());
                                    echo '<tr><td >'.$prod->getProdCode().'</td><td >'.$prod->getProdName().'</td><td class="edit_det_price" contenteditable="true" id="'.$un['details_id'].'">'.$un['amount'].'</td><td class="edit_det_qt" contenteditable="true" id="'.$un['details_id'].'">'.$un['quantity'].'</td>';

                                   /*echo '<td><button class="btn btn-success btn-circle update_det_vente" name="update" id="'.$un["details_id"].'"><span class="fa fa-edit"></span></button></td>';*/


                                    echo '</td><th><button class="btn btn-danger btn-circle delete_det_vente" name="delete" id="'.$un["details_id"].'">';

                                    echo '<span class="fa fa-times"></span>';


                                    echo '</button></th></tr>';

                                    }
                                    }
                                    ?>
    </tbody>
    </table>
    <p><a href="javascript:void(0)" id="det_hist_facture" class="btn btn-success">Facture</a></p>
</div>
