<?php
@session_start();
require_once '../load_model.php';
$cat= new BeanCategory();
$prod=new BeanProducts();
$stock= new BeanStock();
$pos=new BeanPos();
$tar=new BeanTarif();
$pr = new BeanPrice();

$posId=$_GET['pos_id'];
$catId=$_GET['cat_id'];


if(!empty($catId))
{
$datas=$stock->select_all_cat_gen($posId,$catId);
}
else
{
$datas=$stock->select_all_gen($posId);
}
?>
<div class="row">
  <div class="col-md-6">
  <h3 class="box-title m-b-0">Stock : <?php $pos->select($posId); echo $pos->getPosName(); ?>/Situaton du stock général</h3>
<div><button id="print_rp" class="btn btn-success m-2" title="Imprimer"><span class="fa fa-print"></span></button></div>
  <div class="table-responsive" id="rapport">
    <h3>Situation du Stock du <?php echo date('d-m-Y'); ?></h3>
    <table class="table table-striped table-bordered table-hover" id="tab" border="1">
      <thead>
        <tr>
          <th>Categorie</th><th>Produits</th><th>Unité</th><th>Qté</th><th>Pv</th><th>Tot</th>
        </tr>
      </thead>


      <tbody>
        <?php
        $tot=0;
        foreach ($datas as $un) {

          $prod->select($un['prod_id']);
          $cat->select($un['category_id']);
          
          $tot +=$prod->getProdPrice()*$un['tot_qt'];
          if($cat->getIsSale()=='Oui')
          {
          echo '<tr><td>'.$cat->getCategoryName().'</td><td><a href="javascript:void(0)" class="fiche_det" data-id="'.$un['prod_id'].'">'.$prod->getProdName().'</td><td>'.$prod->getUntMes().'</a></td><td>'.$un['tot_qt'].'</td><td align="right">'.number_format($prod->getProdPrice()).'</td><td align="right">'.number_format($prod->getProdPrice()*$un['tot_qt']).'</td>';
          echo '</tr>';
          }
        }
        ?>
      </tbody>
      <tfoot>
        <tr><th>Total</th><th>-</th><th>-</th><th>-</th><th>-</th><td align="right"><b><?php echo number_format($tot); ?></b></td></tr>
      </tfoot>
    </table>
  </div>
</div>
<div class="col-md-6 fiche_art p-2">
  </div>
</div>
