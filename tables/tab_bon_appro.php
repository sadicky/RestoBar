<?php
if(isset($_SESSION['op_appro_id']))
{
?>
<div id="rapport">
  <table class="table table-bordered table-striped table-condensed display" cellspacing="0" width="100%" border="1">
    <thead>
      <tr>
        <th colspan="5">
          <?php include('../entete.php');?>
        </th>
      </tr>
      <tr>
        <th colspan="5">
          Bon d'Approvisionnement N° <?php echo $achat->getNumAchat(); ?><br/>
          Date : <?php echo $op->getCreateDate();?>
        </th>
      </tr>
      <tr>
        <th>Produit</th><th>Prix</th><th>Qt</th><th>Tot</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $datas2=$det->select_all($_SESSION['op_appro_id']);
      $tot =0;
      foreach ($datas2 as $un) {
        $tot +=$un['amount']*$un['quantity'];
        $prod->select($un['prod_id']);
        echo '<tr><td >'.$prod->getProdName().'</td><td>'.number_format($un['amount']).'</td><td>'.number_format($un['quantity']).'</td><td>'.number_format($un['amount']*$un['quantity']).'</td></tr>';
      }
      ?>
    </tbody>
    <tfoot>
      <tr><th colspan="3">Totaux</th><th><?php echo number_format($tot,0,'.',','); ?></th></tr>
    </tfoot>
  </table>
</div>
<?php
}
?>