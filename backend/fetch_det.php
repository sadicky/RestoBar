<?php
@session_start();
require_once '../load_model.php';
$det=new BeanDetailsOperation();
$prod=new BeanProducts();

$det->select($_GET['det_id']);
$prod->select($det->getProdId());
$output = array();

  $output["price"] =$det->getAmount();
  $output["prod_id"] =$det->getProdId(); 
  $output["qt"] =$det->getQuantity(); 
  $output["lot"] =$det->getLot(); 
  $output["prod_name"] =$prod->getProdName(); 
  $output["m_exp"] =date('m',strtotime($det->getDateExp()));
  $output["y_exp"] =date('y',strtotime($det->getDateExp()));
  $output["date_exp"] =date('m/y',strtotime($det->getDateExp()));

  echo json_encode($output);
?>
