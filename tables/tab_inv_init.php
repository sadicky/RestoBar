<?php
set_time_limit(500);
@session_start();
require_once '../load_model.php';
$cat= new BeanCategory();
$prod=new BeanProducts();
$stock= new BeanStock();
$det = new BeanDetailsOperation();
$pers=new BeanPersonne();
$per=new BeanPeriode();
$op=new BeanOperation();

$per->select($_SESSION['periode']);
$pos=$_SESSION['pos'];

$datas=$det->select_all_by_type('Inventaire',$_SESSION['periode']);
?>
<div class="white-box">
    <h3 class="box-title m-b-0">Point de vente :<?php
      $pers->select($pos);
      echo $pers->getNomComplet(); ?>/FICHE D'INVENTAIRE DU <?php echo $per->getDebut(); ?></h3>

              <div class="table-responsive">
               <table class="table table-striped table-bordered table-hover" id="example23">
               <thead>
                  <tr>
                    <th>Médicament**</th><th>Stock </th><th>Date Exp.</th></th><th>P.U.A</th><th>Valeur Stock</th>
                 </tr>
               </thead>
                <tbody>
                  <?php
                  $i=1;
                  $totgen=0;
                            foreach ($datas as $un) {
                            $prod->select($un['prod_id']);
                            echo '<tr><td>'.$prod->getProdName().'</td><td class="edit_qt_inv" contenteditable="true" id="'.$un['details_id'].'" data-id="quantity">'.$un['quantity'].'</td><td class="edit_qt_inv" contenteditable="true" id="'.$un['details_id'].'" data-id="date_exp">'.$un['date_exp'].'</td><td class="edit_qt_inv" contenteditable="true" id="'.$un['details_id'].'" data-id="amount">'.$un['amount'].'</td><td>'.$un['quantity']*$un['amount'].'</td>';
                             echo '</tr>';
                             $totgen +=$un['quantity']*$un['amount'];
                           
                            }
                                    ?>
 </tbody>
 <tfoot>
                    <tr>
                        <th>Total général</th><th>-</th><th>-</th><th>-</th><th><?php echo $totgen; ?></th>
                    </tr>
</tfoot>
</table>
              </div>
</div>
