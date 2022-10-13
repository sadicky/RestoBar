<?php
@session_start();
require_once '../load_model.php';
$prod = new BeanProducts();
$perso=new BeanPersonne();
$vente=new BeanVente();

$prod->select($_POST["prod_id"]);

$output = array();
if(isset($_POST["prod_id"]))
{
  $output["prod_prix"] = $prod->getProdPrice();
  $output["prod_code"] = $prod->getProdCode();
  $output["is_stock"] = $prod->getIsStock();
}

$output['id'] = $_POST["prod_id"];

echo json_encode($output);


?>
