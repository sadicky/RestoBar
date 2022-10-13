<?php
@session_start();
require_once '../load_model.php';
$cat= new BeanCategory();
$prod=new BeanProducts();
$stock= new BeanStock();
$pers=new BeanPersonne();

$pers->select($_SESSION['pos']);

if(empty($_POST['srch']))
{
$srch='';
}
else
{
$srch=$_POST['srch'];
}
$datas=$prod->select_all_2($srch,'1');
?>
<!-- <h3 class="box-title m-b-0">Stock : <?php /*echo $pers->getNomComplet();*/ ?></h3> -->
<div class="white-box">
  <div class="table-responsive">
               <table class="table table-striped table-bordered table-hover" id="dataTables-example">
               <thead>
                                        <tr>
                                            <th>Produits</th><th>Qté</th><th>Unt</th>
                                        </tr>
               </thead>


                                    <tbody>
                  <?php
                                    foreach ($datas as $un) {
                            if($un['is_stock']=='Oui')
                            {
                            $stock->select($un['prod_id'],$_SESSION['pos']);
                            echo '<tr class="row_prod" data-id='.$un['prod_id'].' style="cursor:pointer">
                            <td> <i class="fa fa-hand-o-right fa-fw"></i> '.$un['prod_name'].'</td><td>';

                            if(empty($stock->getQuantity()))
                            {
                              echo '0';
                            }
                            else
                            {
                              echo number_format($stock->getQuantity()/*/$un['unt_mes']*/,'2','.',' ');
                            }

                            echo '</td><td>'.$un['unt_mes'].'</td>';
                             echo '</tr>';
                                    }
                                 }
                                    ?>
                    </tbody>
               </table>
              </div>
</div>
