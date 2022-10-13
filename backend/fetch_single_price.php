<?php
session_start();
require_once '../load_model.php';
$price = new BeanPrice();
$price->select($_POST["price_id"]);

$output = array();
if(isset($_POST["price_id"]))
{

  $output["lib_prod"] = $price->getProdId();
  $output["prix_prod"] = $price->getPrice();
  $output["comment_price"] = $price->getComment();
  $output['date_debut'] = $price->getStartDate();

 }
$output['id'] = $_POST["price_id"];
//echo  $price->getComment();
echo json_encode($output);


?>
