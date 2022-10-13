<?php
@session_start();
require_once '../load_model.php';
$det=new BeanDetailsOperation();
$op=new BeanOperation();
$pr=new BeanPrice();

$pr->select_2($_POST['prod_id'],$_POST['tar_id']);

  $output = array();

  $output["price"] =$pr->getPrice(); 

  echo json_encode($output);
?>
