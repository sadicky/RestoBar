<?php

require_once '../load_model.php';
$acc = new BeanAccounts();
$info=new BeanInfoSuppl();

$acc->select($_POST["acc_id"]);
$info->select($acc->getPersonneId());

$output = array();

  $output["mat"] = $info->getMat();
  $output["service"] = $info->getService();



echo json_encode($output);


?>
