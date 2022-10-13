<?php
@session_start();
require_once '../load_model.php';
$det= new BeanDetailsOperation();
$prod= new BeanProducts();
$entre= new BeanEntreProdf();
?>
<div class="table-responsive">
                             <table class="table table-bordered table-striped table-condensed display table-sm" cellspacing="0" width="100%" border="&">
                             <thead>
                                <tr>
                                  <th>Produit</th><th>Qt</th><th>lot</th>><th>Date Exp.</th><th>-</th><th>-</th>
                                </tr>
                            </thead>
                                    <tbody>
                                    <?php
                                    if(isset($_SESSION['op_conv_id']))
                                    {
                                    $datas2=$det->select_all($_SESSION['op_conv_id']);

                                    foreach ($datas2 as $un) {

                                    $prod->select($un['prod_id']);
                                    //$cat->select($prod->getCategoryId());
                                    echo '<tr><td >'.$prod->getProdName().'</td><td>'.$un['quantity'].'</td><td>'.$un['lot'].'</td><td>'.$un['date_exp'].'</td>';

                                    echo '</td><td><button class="btn btn-sm btn-warning btn-circle update_det_conv" name="delete" id="'.$un["details_id"].'">';
                                    echo '<span class="fa fa-edit"></span>';
                                    echo '</button></td>';

                                    echo '</td><td><button class="btn btn-sm btn-danger btn-circle delete_det_conv" name="delete" id="'.$un["details_id"].'">';


                                    echo '<span class="fa fa-times"></span>';


                                    echo '</button></td></tr>';

                                    }

                                    }
                                    ?>
    </tbody>
    </table>
</div>
