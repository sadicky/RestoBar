<?php
@session_start();
require_once '../load_model.php';
$det= new BeanDetailsOperation();
$prod= new BeanProducts();
$paie= new BeanPaiement();
$pers=new BeanPersonne();
$op=new BeanOperation();
$trans=new BeanTransactions();

$op->select($_POST['op_id']);
$pers->select($op->getPartyCode());
$paie->select($_POST['paie_id']);
$trans->select($paie->getTransactionId());
?>
<div class="card card-info" >
<div class="card-header bg-light">Recu de Paiement</div>
<div class="card-body">
<div id="bon">
<div class="table-responsive">
                             <table class="table table-bordered table-striped table-condensed display" cellspacing="0" width="100%" border="1">
                             <thead>
                                <tr>
                                    <th colspan="4">
                                        <h4>EN-TETE</h4>
                                        <h5>
                                        <?php
                                        echo 'Fournisseur :'.$pers->getNomComplet();
                                        ?>
                                        </h5>
                                    </th>
                                </tr>
                                        <tr>
                                            <th>Produit</th><th>Prix</th><th>Qt</th><th>Tot</th>
                                        </tr>
                            </thead>

                                    <tbody>
                                    <?php
                                    $datas2=$det->select_all($_POST['op_id']);
                                    $tot =0;
                                    foreach ($datas2 as $un) {
                                    $tot +=$un['amount'];
                                    $prod->select($un['prod_id']);
                                    echo '<tr><td >'.$prod->getProdName().'</td><td>'.number_format($un['amount'],0,'.',',').'</td><td>'.number_format($un['quantity'],0,'.',',').'</td><td>'.number_format($un['amount'],0,'.',',').'</td></tr>';


                                    }
                                    ?>
    </tbody>
    <tfoot>
        <tr><th colspan="3">Totaux</th><th><?php echo number_format($tot,0,'.',','); ?></th></tr>
        <tr><th colspan="3">Payé</th><th><?php echo number_format($paie->getAmount(),0,'.',','); ?></th></tr>
        <tr><th colspan="3">Paiement Antérieur</th><th><?php
        $mont=$paie->select_sum_op_date($_POST['op_id'],$trans->getCreateDate());
         echo number_format($mont['paie'],0,'.',','); ?></th></tr>
        <tr><th colspan="3">Dû</th><th><?php echo number_format($tot-($mont['paie']+$paie->getAmount()),0,'.',','); ?></th></tr>
    </tfoot>
    </table>
</div>
</div>
<button class="btn btn-success" id="print_bon"><i class="fa fa-print"></i></button>
</div>

                </div>
