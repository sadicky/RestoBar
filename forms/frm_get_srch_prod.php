<?php
require_once '../load_model.php';
$cat= new BeanCategory();
$prod= new BeanProducts();
$prod2= new BeanProducts();
if(empty($_GET['keyVal'])){$keyVal='*';}
else {$keyVal=$_GET['keyVal'];}
$datas=$prod->select_all_srch_prod_2($keyVal);


foreach ($datas as $un) {
$cat->select($un['category_id']);
$prod->select($un['prod_equiv']);

echo '<tr><td>'.$cat->getCategoryName().'</td>
<td>'.$un['prod_name'].' ('.$un['prod_id'].')</td><td>'.$un['prod_code'].'</td><td>'.$un['prod_price'].'</td><td>'.$un['unt_mes'].'</td><td>'.$un['nb_el'].'</td><td>'.$un['is_stock'].'</td><td>'.$un['is_tva'].'</td><td>'.$prod->getProdName().'</td><td>';

echo '<button class="btn btn-sm btn-primary btn-circle new_tarif_art" id="" data-id="'.$un['prod_id'].'"><i class="fa fa-plus"></i></button>';

echo '</td><td>';

echo '<button class="btn btn-sm btn-warning btn-circle new_prod" id="'.$un['prod_id'].'" data-id="'.$un['prod_id'].'"><i class="fa fa-edit"></i></button>';

echo '</td><td>'; 
if(!$prod->exist_prod($un['prod_id']))
{
echo '<button class="btn btn-sm btn-danger btn-circle trash_art" id="'.$un['prod_id'].'" data-id="'.$un['prod_id'].'"><i class="fa fa-times"></i></button>';
}
else
{
echo '-';
}
echo '</td></tr>';
// }
}
?>