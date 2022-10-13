<?php
@session_start();
require_once '../load_model.php';
$det= new BeanDetailsOperation();
$prod= new BeanProducts();
$cat= new BeanCategory();
$vente=new BeanVente();
if(isset($_SESSION['op_vente_id']))
                                    {
$vente->select($_SESSION['op_vente_id']);
?>
<h3 class="box-title m-b-0">Détails Vente N° <?php echo $vente->getNumVente(); ?></h3><hr>

        <div class="table-responsive">
                             <table class="table table-bordered table-striped table-condensed display" cellspacing="0" width="100%">
                             <thead>
                                        <tr>
                                           <th>Produit</th><th>Quantité</th><th>Prix</th
                                        </tr>
                            </thead>
                                    <tbody>
                                    <?php

                                    $datas2=$det->select_all($_SESSION['op_vente_id']);
                                    foreach ($datas2 as $un) {
                                    $prod->select($un['prod_id']);
                                    $cat->select($prod->getCategoryId());
                                    echo '<tr><td >'.$prod->getProdName().'</td><td>'.$un['quantity'].'</td><td>'.number_format($un['amount'],0,'.',',').'</td></tr>';

                                    }

                                    ?>
    </tbody>
    </table>

</div>
<?php
}
?>

