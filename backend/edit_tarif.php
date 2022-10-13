<?php

require_once '../load_model.php';
$price = new BeanPrice();

if(isset($_POST['price_id']))
{
 $price->update_one($_POST["price_id"],'price_id',$_POST['field'],$_POST['price']);
 //echo 'modification reussie';
}
?>
