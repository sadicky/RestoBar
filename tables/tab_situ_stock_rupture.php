<?php
@session_start();
require_once '../load_model.php';
$cat= new BeanCategory();
$prod=new BeanProducts();
$stock= new BeanStock();

$datas=$stock->select_end_prod_stk('0','360',$_SESSION['pos']);
?>
<div class="white-box">
                            <h3 class="box-title m-b-0">Situation du Stock En rupture</h3>

                            <div class="table-responsive">
               <table class="table table-striped table-bordered table-hover" id="example23">
               <thead>
                                        <tr>
                                            <th>Produits</th><th>Forme</th><th>Dosage</th><th>Qté</th>
                                        </tr>
               </thead>


                                    <tbody>
                  <?php
                                    foreach ($datas as $un) {
                            $prod->select($un['prod_id']);
                            echo '<tr>
                            <td>'.$prod->getProdName().'</td><td>'.$prod->getProdShape().'</td><td>'.$prod->getProdDosage().'</td><td>'.$un['qt_stock'].'</td>';
                             echo '</tr>';
                                    }
                                    ?>
                    </tbody>
               </table>
              </div>
</div>
