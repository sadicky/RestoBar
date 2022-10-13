<?php
@session_start();
require_once '../load_model.php';
$det= new BeanDetailsOperation();
$prod= new BeanProducts();
?>
<div class="card card-info" >
<div class="card-header bg-light">Bon de Transfert des Produits</div>
<div class="card-body">
<div id="bon">
<div class="table-responsive">
                             <table class="table table-bordered table-striped table-condensed display table-sm" cellspacing="0" width="100%" border="1">
                             <thead>
                                <tr>
                                    <th colspan="4">
                                        <?php include('../entete.php');?>
                                    </th>
                                </tr>
                                        <tr>
                                            <th>Produit</th><th>Qt</th>
                                        </tr>
                            </thead>

                                    <tbody>
                                    <?php
                                    $datas2=$det->select_all($_POST['op_id']);
                                    $tot =0;
                                    foreach ($datas2 as $un) {
                                    $tot +=($un['amount']*$un['quantity']);
                                    $prod->select($un['prod_id']);
                                    echo '<tr><td >'.$prod->getProdName().'</td><td>'.$un['quantity'].'</td></tr>';


                                    }
                                    ?>
    </tbody>

    </table>
</div>
</div>
<button class="btn btn-success" id="print_bon"><i class="fa fa-print"></i></button>
</div>

                </div>
