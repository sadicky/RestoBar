<?php
@session_start();
require_once '../load_model.php';
$check= new BeanCheckExp();
$prod=new BeanProducts();
$det= new BeanDetailsOperation();

$datas=$check->select_exp_prod_stk('90');
?>
<div class="white-box">
                            <h3 class="box-title m-b-0">Produits En Peremption</h3>

              <div class="table-responsive">
               <table class="table table-striped table-bordered table-hover" id="example23">
               <thead>
                                        <tr>
                                            <th>Jours restants</th><th>Produits</th><th>Qté</th><th>Lot</th><th>Date Exp.</th>
                                        </tr>
               </thead>


                                    <tbody>
                  <?php
                                    foreach ($datas as $un) {
                            $prod->select($un['prod_id']);
                            $solde=$det->select_qt_lot($un['lot'],$un['prod_id']);
                            if($solde>0)
                            {

                            echo '<tr ';
                            if($un['rem_days']<=0)
                            {
                              echo 'class="text-danger"';
                            }
                            else
                            {
                             echo 'class="text-warning"';
                            }
                            echo ' ><th>'.$un['rem_days'].'</th>
                            <td>'.$prod->getProdName().'</td><td>'.$solde.'</td><td>'.$un['lot'].'</td><td class="edit_exp" contenteditable="true" id="'.$un['id'].'">'.$un['date_exp'].'</td>';
                             echo '</tr>';
                           }
                                    }
                                    ?>
                    </tbody>
               </table>
              </div>
</div>
