<?php
@session_start();
require_once '../load_model.php';
$det= new BeanDetailsOperation();
$op= new BeanOperation();
$prod= new BeanProducts();
?>
<div class="card card-info" >
<div class="card-header bg-light">Bon de Production</div>
<div class="card-body" id="bon">
<div class="row">
    <div class="col-md-12">
        <?php include('../entete.php');?>
    </div>
</div>
<div  class="row">


<div class="col-md-5">

<div class="table-responsive m-2">
                             <table class="table table-bordered table-striped table-condensed display table-sm" cellspacing="0" width="80%" border="1">
                             <thead>
                                <tr>
                                    <th colspan="3">
                                        <h3>MATIERES PREMIERES</h3>
                                    </th>
                                </tr>
                                        <tr>
                                            <th>Produit</th><th>Qt</th><th>Unité</th>
                                        </tr>
                            </thead>

                                    <tbody>
                                    <?php
                                    $op->select($_POST['op_id']);
                                    $datas=$det->select_all($op->getPartyCode());
                                    //$tot =0;
                                    foreach ($datas as $un) {
                                    //$tot +=($un['amount']*$un['quantity']);
                                    $prod->select($un['prod_id']);
                                    echo '<tr><td >'.$prod->getProdName().'</td><td>'.$un['quantity'].'</td><td >'.$prod->getUntMes().'</td></tr>';


                                    }
                                    ?>
    </tbody>

    </table>
</div>

</div>
<div class="col-md-5">
<div class="table-responsive m-2">
                             <table class="table table-bordered table-striped table-condensed display table-sm" cellspacing="0" width="80%" border="1">
                             <thead>
                                <tr>
                                    <th colspan="3">
                                        <h3>PRODUITS FINISS</h3>
                                    </th>
                                </tr>
                                        <tr>
                                            <th>Produit</th><th>Qt</th><th>Unité</th>
                                        </tr>
                            </thead>

                                    <tbody>
                                    <?php
                                    $datas2=$det->select_all($_POST['op_id']);
                                    //$tot =0;
                                    foreach ($datas2 as $un) {
                                    //$tot +=($un['amount']*$un['quantity']);
                                    $prod->select($un['prod_id']);
                                    echo '<tr><td >'.$prod->getProdName().'</td><td>'.$un['quantity'].'</td><td >'.$prod->getUntMes().'</td></tr>';


                                    }
                                    ?>
    </tbody>

    </table>
</div>
</div>
</div>
<button class="btn btn-success" id="print_bon"><i class="fa fa-print"></i></button>
</div>

                </div>
