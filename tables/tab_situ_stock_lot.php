<?php
@session_start();
require_once '../load_model.php';
$cat= new BeanCategory();
$prod=new BeanProducts();
$stock= new BeanStock();
$pos=new BeanPos();
$tar=new BeanTarif();
$pr= new BeanPrice();

$posId=$_GET['pos_id'];
$catId=$_GET['cat_id'];
$tarId=$_GET['tar_id'];

if(!empty($catId))
{
  $datas=$stock->select_all_cat($posId,$tarId,$catId);
}
else
{
  $datas=$stock->select_all($posId,$tarId);
}
?>
<div class="white-box">
  <h3 class="box-title m-b-0">Stock : <?php $pos->select($posId); echo $pos->getPosName(); ?> - Tarif :  <?php $tar->select($tarId); echo $tar->getTarName(); ?>/Situaton du stock par lot*</h3>

  <div class="table-responsive">
    <table class="table table-striped table-bordered table-hover" id="tab">
      <thead>
        <tr>
          <th>Categorie</th><th>Produits</th><th>Date Exp</th><th>Qté</th><th>Unité</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $tot=0;
        foreach ($datas as $un) {

          $prod->select($un['prod_id']);
          $cat->select($un['category_id']);
          $pr->select_2($un['prod_id'],$tarId);
          echo '<tr><td>'.$cat->getCategoryName().'</td><td>'.$prod->getProdName().'</td><td>'.$un['date_exp'].'</td><td>'.$un['quantity'].'</td><td>'.$pr->getUntMes().'</td>';
          echo '</tr>';

          if($stock->existstock($un['prod_id'],$posId,$tarId,$un['date_exp']))
          {
            $stock->select($un['prod_id'],$posId,$tarId,$un['date_exp']);
            $qt_stk=$stock->qt_stock_lot($posId,$tarId,$un['prod_id'],$un['date_exp']);
            $stock->update_qt($stock->getStockId(),$qt_stk);
          }
        }
        ?>
      </tbody>
    </table>
  </div>
</div>
