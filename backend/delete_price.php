<?php
@session_start(); dd
require_once '../load_model.php';
$price = new BeanPrice();
$price->select($_POST["price_id"]);

$status='0'; $msg='Entente de prix annulée';
$price->setEndDate(date('Y-m-d h:i'));

if($price->getState()=='0')
{
$status='1'; $msg='Entente de prix retablie';
$price->setEndDate(NULL);
}


if(isset($_POST["price_id"]))
{

 if($price->update_one($_POST["price_id"],'price_id','state',$status))
 {
  echo $msg;
  $price->update_one($_POST["price_id"],'price_id','end_date',$price->getEndDate());
 }
 else
 {
 	echo 'Echec opération ';
 }
}
else
{
echo " pas Id";
}



?>
