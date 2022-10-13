<?php
@session_start();
require_once '../load_model.php';
$prod2= new BeanProducts();
$ing=$prod2->select_all_menu('Oui','Non');
$tar=new BeanTarif();
$price=new BeanPrice();

$tar->select_status('Oui');

?>

<table class="table table-bordered" id="tab2">
<thead>
        <tr><th>Ingredients</th><th>UM</th></tr>
    </thead>
    <tbody>
<?php
foreach ($ing as $value) {
$price->select_2($value['prod_id'],$tar->getTarId());
echo '<tr class="row_add_ing" data-id="'.$price->getUnt().'" id="'.$value['prod_id'].'" style="cursor:pointer"><td>'.$value['prod_name'].'</td> <td>'.$price->getUntMes().'</td></tr>';
}
?>
</tbody>
</table>
