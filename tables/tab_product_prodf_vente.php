<?php
@session_start();
require_once '../load_model.php';
$cat= new BeanCategory();
$prod=new BeanProducts();
$stock= new BeanStock();
$stock2= new BeanStock();
$pers=new BeanPersonne();
$pers->select($_SESSION['pos']);

if(empty($_POST['rech']))
{
$rech='-';
}
else
{
$rech=$_POST['rech'];
}

//if(isset($_SESSION['type_stock']))
//{
//$stk=$_SESSION['type_stock'];
$datas=$prod->select_all_2($rech,'1');
?>
<div class="white-box">
                         <?php

    if(isset($_SESSION['op_vente_id']) and !empty($_SESSION['op_vente_id']))
    {
                         ?>

                            <div class="table-responsive">
               <table class="table table-striped table-bordered table-hover table-sm" id="example22">
               <thead>
                    <tr>
                                           <th>Désignation</th><th>Qt</th><th>Unt</th><!-- <th>Prix (Gros)</th> --><th>Prix</th>
                                        </tr>
               </thead>


                                    <tbody>
                  <?php
                                    foreach ($datas as $un) {


                           $stock->select($un['prod_id'],$_SESSION['pos']);
                           //$stock2->select($un['prod_id'],$_SESSION['pos'],'1');
                            echo '<tr ';

                            if(empty($stock->getQuantity()) and $un['is_stock']=='Oui')
                            {
                            echo 'class="row_prod_vente bg-danger text-white"';
                            }
                            else
                            {
                             echo 'class="row_prod_vente bg-success text-white"';
                            }

                            echo ' data-id='.$un['prod_id'].' style="cursor:pointer">
                            <td> <i class="fa fa-hand-o-right fa-fw"></i> '.$un['prod_name'].'</td><td>';

                            if(empty($stock->getQuantity()))
                            {
                              echo '0';
                            }
                            else
                            {
                              echo number_format($stock->getQuantity()/*/$un['unt_mes']*/,'2','.',' ');
                            }

                            echo '</td><td>'.$un['unt_mes'].'</td>';/*<td>'.$un['prod_price_gros'].'</td>*/
                            echo '<td>'.$un['prod_price'].'</td>';

                             echo '</tr>';

                                  }
                                    ?>
                    </tbody>
               </table>
              </div>
              <?php
            /*}
            else
            {
              echo '<br/><p style="color:black">Créer d\'abord la facture</p>';
            }*/
            ?>
</div>
<?php
}
else
{
  echo '<p>Veuillez créer la facture</p>';
}
/*}
else
{
  echo '<p>Veuillez choisir le type du stock ou créer la facture</p>';
}*/
?>
