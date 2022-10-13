<?php
@session_start();
require_once '../load_model.php';
$prod = new BeanProducts();
$cat = new BeanCategory();
$stock=new BeanStock();
$op=new BeanOPeration();
$perso=new BeanPersonne();
$vente=new BeanVente();



$stock->select($_POST["prod"],$_SESSION['pos']);

$output = array();
//echo $_POST["prod"];
if(isset($_POST["prod"]))
{
  $prod->select($_POST["prod"]);
  $output["prod_appro"] = $prod->getProdName();
  $output["prod_id"] = $prod->getProdId();


  $output["prod_prix"] = $prod->getProdPrice();
  $output["prod"] = $stock->getProdId();


  $cat->select($prod->getCategoryId());
  $output["prod_cat"] = $cat->getCategoryName();

}

echo json_encode($output);


?>
