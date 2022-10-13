<?php
@session_start();
require_once '../load_model.php';
$det= new BeanDetailsOperation();
$prod= new BeanProducts();
$cat= new BeanCategory();
$sort=new BeanSortieMatp();
$sort->select($_POST['op_id']);
?>
<h5 class="box-title m-b-0">Détails MP / N° <?php echo $sort->getNumSort(); ?></h5><hr>

        <div class="table-responsive">
                             <table class="table table-bordered table-striped table-condensed display" cellspacing="0" width="100%">
                             <thead>
                                        <tr>
                                           <th>Produit</th><th>Prix</th><th>Quantité</th>
                                        </tr>
                            </thead>
                                    <tbody>
                                    <?php
                                    if(isset($_POST['op_id']))
                                    {
                                    $datas2=$det->select_all($_POST['op_id']);
                                    foreach ($datas2 as $un) {
                                    $prod->select($un['prod_id']);
                                    $cat->select($prod->getCategoryId());
                                    echo '<tr><td >'.$prod->getProdName().'</td><td>'.number_format($un['amount'],0,'.',',').'</td><td>'.$un['quantity'].'</td>';

                                   echo '</tr>';

                                    }
                                    }
                                    ?>
    </tbody>
    </table>
</div>
