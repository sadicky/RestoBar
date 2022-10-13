<?php
@session_start();
require_once '../load_model.php';
$cat= new BeanCategory();
$prod=new BeanProducts();
$stock= new BeanStock();
$stock2 = new BeanStock();
$pers=new BeanPersonne();
$datas=$prod->select_all_2_1('1');

if(empty($_POST['pos']))
{
   $pos=$_SESSION['pos'];
}
else
{
    $pos=$_POST['pos'];
}


?>
<div class="white-box">
                            <h3 class="box-title m-b-0">Point de vente :<?php
                            $pers->select($pos);
                             echo $pers->getNomComplet(); ?>/FICHE D'INVENTAIRE</h3>

                            <div class="table-responsive">
               <table class="table table-striped table-bordered table-hover" id="example23">
               <thead>
                                        <tr>
                                            <th>N°</th><th>Médicament*</th><th></th><th>P.U.A</th><th>P.U.V</th><th>Valeur Stock</th>
                                        </tr>
               </thead>


                                    <tbody>
                  <?php
                  $i=1;
                  $totgen=0;
                                    foreach ($datas as $un) {
                            $stock->select($un['prod_id'],$pos);
                            $data_exp=$stock2->select_all_by_prod($un['prod_id'],$pos);
                            if($stock->getQuantity()!=0 or $stock->getQuantity()!="")
                            {
                            echo '<tr>
                            <td>'.$i.'</td><td>'.$un['prod_name'].'</td><td>*'.$stock->getQuantity().'</td><td>'.$stock->getQuantity().'</td><td>0</td><td>'.$un['prod_price'].'</td><td>0</td><td>'.$stock->getQuantity()*$un['prod_price'].'</td>';
                             echo '</tr>';
                             $totgen +=$stock->getQuantity()*$un['prod_price'];

                             $i++;
                                    }
                                  }
                                    ?>

                    <tr>
                        <th><?php echo $i; ?></th><th>Total général</th><th>-</th><th>-</th><th>-</th><th>-</th><th>-</th><th><?php echo $totgen; ?></th>
                    </tr>
                    </tbody>

                    <!-- <tr>
                        <th>-</th><th>Total général</th><th>-</th><th>-</th><th>-</th><th>-</th><th>-</th><th>-</th><th>-</th><th>-</th><th><?php echo $totgen; ?></th>
                      </tr> -->

               </table>
              </div>
</div>
