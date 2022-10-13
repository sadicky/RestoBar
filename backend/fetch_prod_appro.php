<?php
@session_start();
require_once '../load_model.php';
$prod = new BeanProducts();
$cat = new BeanCategory();
$prod->select($_POST["prod_id"]);

$output = array();
if(isset($_POST["prod_id"]))
{
  $prod->select($prod->getProdId());
  $output["prod_appro"] = $prod->getProdName();
  $output["prod_id"] = $prod->getProdId();

  $output["prod_prix"] = $prod->getProdPriceGros();

  $cat->select($prod->getCategoryId());
  $output["prod_cat"] = $cat->getCategoryName();

 }
//echo  $price->getComment();
echo json_encode($output);


?>
