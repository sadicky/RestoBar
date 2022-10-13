<?php
@session_start();
require_once '../load_model.php';
$det= new BeanDetailsOperation();
$prod= new BeanProducts();
?>
<h4 class="box-title m-b-0">Détails / Bon de commande N° : <?php if(isset($_SESSION['op_appro_hist_num'])){ echo $_SESSION['op_appro_hist_num']; } ?></h4><hr>

        <div class="table-responsive">
                             <table class="table table-bordered table-striped table-condensed display" cellspacing="0" width="100%">
                             <thead>
                                        <tr>
                                           <th>Code</th><th>Produit</th><th>Prix</th><th>Qté</th><th>-</th>
                                        </tr>
                            </thead>

                                    <tbody>
                                    <?php
                                    if(isset($_SESSION['op_appro_hist_id']))
                                    {
                                    $datas2=$det->select_all($_SESSION['op_appro_hist_id']);
                                    foreach ($datas2 as $un) {
                                    $prod->select($un['prod_id']);
                                    echo '<tr><td >'.$prod->getProdCode().'</td><td >'.$prod->getProdName().'</td><td>'.number_format($un['amount'],0,'.',',').'</td><td>'.$un['quantity'].'</td>';
                                    echo '<td><button class="btn btn-danger btn-circle delete_det" name="delete" id="'.$un["details_id"].'">';

                                    echo '<span class="fa fa-times"></span>';
                                    echo '</td></tr>';

                                    }
                                    }
                                    ?>
    </tbody>
    </table>
</div>
