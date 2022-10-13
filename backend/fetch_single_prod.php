<?php

require_once '../load_model.php';
$prod = new BeanProducts();
$prod->select($_POST["prod_id"]);

$output = array();
if(isset($_POST["prod_id"]))
{
  $output["prod_name"] = $prod->getProdName();
  $output["prod_code"] = $prod->getProdCode();
  $output["prod_price"] = $prod->getProdPrice();
  $output["qt_min"] = $prod->getQtMin();
  $output["is_stock"] = $prod->getIsStock();
  $output["unt_mes"] = $prod->getUntMes();
}

$output['id'] = $_POST["prod_id"];

echo json_encode($output);


?>
