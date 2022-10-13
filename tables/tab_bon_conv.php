<?php
if(isset($_SESSION['op_chg_id']))
{
$op->select($_SESSION['op_chg_id']);
?>
<div id="rapport">
<table class="table table-bordered table-striped table-condensed display table-sm" cellspacing="0" width="80%" border="1">
<thead>
<tr>
<th colspan="3">
<?php include('../entete.php');?>
</th>
</tr>
<th colspan="4">
<H3>Bon de Conversion</H3>
Date : <?php echo $op->getCreateDate();?><br>
</th>
<tr>
<th>Produit</th><th>Qt (orig)</th><th>Qt (Dest)</th>
</tr>
</thead>
<tbody>
<?php

$datas2=$det->select_all($_SESSION['op_chg_id']);
$tot=0;
foreach ($datas2 as $un) {

$prod->select($un['prod_id']);
$detTo->select_op($op->getPartyCode(),$un['prod_id']);

$pr->select_2($un['prod_id'],$op->getTarId());
$prTo->select_2($un['prod_id'],$opTo->getTarId());

echo '<tr><td >'.$prod->getProdName().'</td><td>'.$un['quantity'].' '.$pr->getUntMes().'</td><td>'.$detTo->getQuantity().' '.$prTo->getUntMes().'</td></tr>';
}

?>
</tbody>
</table>

</div><?php
}
?>