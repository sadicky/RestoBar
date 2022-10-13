<?php
require_once '../load_model.php';
$cat= new BeanCategory();
$prod=new BeanProducts();
$stock= new BeanStock();

$datas=$prod->select_all_3('2','1','1');
?>


                            <div class="table-responsive">
               <table class="table table-striped table-bordered table-hover" id="dataTables-example">
               <thead>
                                        <tr>
                                            <th>Produits</th><th>Qté</th><th>Unité</th><th>PV</th>
                                        </tr>
               </thead>


                                    <tbody>
                  <?php
                                    foreach ($datas as $un) {
                                      /*if($stock->getQuantity()!='0')
                            {*/
                            $stock->select($un['prod_id']);
                            echo '<tr class="row_prod_ent" data-id='.$un['prod_id'].' style="cursor:pointer">
                            <td><i class="fa fa-hand-o-right fa-fw"></i> '.$un['prod_name'].'</td><td>'.$stock->getQuantity().'</td><td>'.$un['unt_mes'].'</td><td>'.$un['prod_price_sale'].'</td>';
                             echo '</tr>';
                                    }
                                /*  }*/
                                    ?>
                    </tbody>
               </table>
              </div>
</div>
