<?php
@session_start();
require_once '../load_model.php';
$cat= new BeanCategory();
$prod=new BeanProducts();
$stock= new BeanStock();

$datas=$stock->select_exp_prod_stk('0','60',$_SESSION['pos']);
?>
<div class="white-box">
                            <h3 class="box-title m-b-0">Situation du Stock En peremption</h3>

                            <div class="table-responsive">
               <table class="table table-striped table-bordered table-hover" id="example23">
               <thead>
                                        <tr>
                                            <th>Produits</th><th>Forme</th><th>Dosage</th><th>Lot</th><th>Qté</th><th>Date Exp.</th><th>Jours restants</th>
                                        </tr>
               </thead>


                                    <tbody>
                  <?php
                                    foreach ($datas as $un) {
                            $prod->select($un['prod_id']);
                            echo '<tr>
                            <td>'.$prod->getProdName().'</td><td>'.$prod->getProdShape().'</td><td>'.$prod->getProdDosage().'</td><td>'.$un['num_lot'].'</td><td>'.$un['quantity'].'</td><td>'.$un['date_exp'].'</td><th>'.$un['rem_days'].'</th>';
                             echo '</tr>';
                                    }
                                    ?>
                    </tbody>
               </table>
              </div>
</div>
