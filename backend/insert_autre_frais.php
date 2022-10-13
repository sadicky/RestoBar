<?php
require_once '../load_model.php';
$aut = new BeanAutreFrais();

  $aut->setAutDet($_POST['aut_det']);
  $aut->setAmount($_POST['amount']);
  $aut->setOpId($_POST['op_id']);
  $aut->insert();
?>
