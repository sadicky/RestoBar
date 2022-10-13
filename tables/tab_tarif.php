<?php
@session_start();
require_once '../load_model.php';
$price= new BeanPrice();
$prod=new BeanProducts();
$tar=new BeanTarif();

$datas=$prod->select_all_isSale('Oui');
$tar->select($_GET['tar_id']);
?>

<h3>Tarif : <?php echo $tar->getTarName(); ?></h3>
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover table-sm tab2">
<thead>
<tr>
<th>Produits</th><th>PUV</th><th>Unité</th><th>Unité de Mesure</th>
</tr>
</thead>

<tbody>
<?php
foreach ($datas as $un) {
if($un['is_stock']==$tar->getIsStock())
{
if(!$tar->exist_tar_prod($_GET['tar_id'],$un['prod_id']))                                         
{	
if($tar->getIsStock()=='Oui')
{	
$price->setProdId($un['prod_id']);
$price->setTarId($_GET['tar_id']);
$price->setPrice('0');
$price->setUnt('1');
$price->setUntMes('Pce');
}
else
{
$price->setProdId($un['prod_id']);
$price->setTarId($_GET['tar_id']);
$price->setPrice('0');
$price->setUnt('1');
$price->setUntMes('Plat');	
}
$price->insert();
}

$price->select_2($un['prod_id'],$_GET['tar_id']);

echo '<tr><td>'.$un['prod_name'].'</td>
<td class="edit_tarif" contenteditable="true" id="'.$price->getPriceId().'" data-id="price">'.$price->getPrice().'</td>
<td class="edit_tarif" contenteditable="true" id="'.$price->getPriceId().'" data-id="unt">'.$price->getUnt().'</td>
<td class="edit_tarif" contenteditable="true" id="'.$price->getPriceId().'" data-id="unt_mes">'.$price->getUntMes().'</td>
</tr>';
}
}
?>
</tbody>
</table>
</div>
