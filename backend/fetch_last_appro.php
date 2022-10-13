<?php
@session_start();
require_once '../load_model.php';
$det=new BeanDetailsOperation();
$op=new BeanOperation();
/*
if(isset($_SESSION['op_inv_id']))
{
$op->select($_SESSION['op_inv_id']);
}*/

  $output = array();

  $last=$det->select_last_id('Approvisionnement',$_POST["prod_id"]);
  $det_id=$last['last_id'];
  $det->select($det_id);

  if(empty($det->getAmount()))
  {
  $last=$det->select_last_id('Inventaire',$_POST["prod_id"]);
  $det_id=$last['last_id'];
  $det->select($det_id);
  }

  $output["price"] =$det->getAmount(); 

  echo json_encode($output);
?>
