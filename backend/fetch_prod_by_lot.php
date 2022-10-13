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

$op->select($_SESSION['op_vente_id']);
$vente->select($_SESSION['op_vente_id']);

$perso->select($vente->getAssId());

$output = array();

if(isset($_POST["prod"]))
{
  $prod->select($stock->getProdId());
  $output["prod_appro"] = $prod->getProdName();
  $output["prod_id"] = $prod->getProdId();


      $output["prod_prix"] = $prod->getProdPrice();


  $cat->select($prod->getCategoryId());
  $output["prod_cat"] = $cat->getCategoryName();

 }
//echo  $price->getComment();
echo json_encode($output);


?>
