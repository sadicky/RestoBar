<?php

require_once '../load_model.php';
$pers = new BeanPersonne();
$serv=new BeanServeur();
$op=new BeanOperation();
//$op->select($_POST['op_id']);

$pers->select($_POST['pers_id']);
$serv->select($_POST['pers_id']);


$output = array();

  $output["nom"] = $pers->getNomComplet();
  $output["serv_code"] = $serv->getServCode();
  $output["personne_id"] = $_POST['pers_id'];
  
echo json_encode($output);


?>
