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

if(isset($_POST["prod"]))
{
  $prod->select($stock->getProdId());
  $output["prod_appro"] = $prod->getProdName();
  $output["prod_id"] = $prod->getProdId();

  if($stk=='0')
  {
  $output["prod_prix"] = $prod->getProdPriceGros();
  }
  else
  {
    $output["prod_prix"] = $prod->getProdPrice();
  }

  $output["prod"] = $stock->getProdId();


  $cat->select($prod->getCategoryId());
  $output["prod_cat"] = $cat->getCategoryName();

}

echo json_encode($output);


?>
