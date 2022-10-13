<?php
@session_start();
require_once '../load_model.php';
$pers = new BeanPersonne();
$cust=new BeanCustomer();
$op=new BeanOperation();
//$op->select($_POST['op_id']);

$pers->select($_POST['pers_id']);
$cust->select($_POST['pers_id']);


$output = array();

  $output["nom"] = $pers->getNomComplet();
  $output["tel"] = $pers->getContact();
  $output["cust_code"] = $cust->getCustomerCode();
  $output["cust_adr"] = $cust->getCustomerAdr();
  $output["cust_num"] = $cust->getCustomerNum();
  $output["personne_id"] = $_POST['pers_id'];
  //$output['op_id'] = $_POST["op_id"];

$_SESSION['cust_id']=$_POST['pers_id'];
echo json_encode($output);


?>
