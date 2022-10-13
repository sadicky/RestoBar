<?php
@session_start();
require_once '../load_model.php';
$prod= new BeanProducts();
$prod2= new BeanProducts();
$compo=new BeanComposition();

$tar=new BeanTarif();
$price=new BeanPrice();
$tar->select_status('Oui');

if(isset($_SESSION['plat_compo']))
{
  $prod->select($_SESSION['plat_compo']);
  $datas=$compo->select_all($_SESSION['plat_compo']);

?>
<table class="table table-bordered table-sm" id="tab3">
<thead>
        <tr><th colspan="4">Plat : <?php echo $prod->getProdName(); ?> </th></tr>
        <tr><th>Ingredient</th><th>Qt</th><th>UM</th><th>-</th></tr>
</thead>
<tbody>
<?php
foreach ($datas as $key => $value) {
  $prod2->select($value['ingred']);
  $price->select_2($value['ingred'],$tar->getTarId());
  echo '<tr><td>'.$prod2->getProdName().'</td><td contenteditable="true" id="'.$value['id_compo'].'">'.$value['qt'].'</td><td>'.$price->getUntMes().'</td><td><a class="delete_det_compo" href="javascript:void(0)" id="'.$value['id_compo'].'"><span class="fa fa-times"></span></a></td></tr>';
}
?>
</tbody>
</table>
<?php
}
?>
