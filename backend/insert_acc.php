<?php

session_start();
require_once '../load_model.php';
$det = new BeanDetailsOperation();

$det->select($_POST['det_id']);
$val=$det->getDateExp().' '.$_POST['acc_name'];
$det->update_one($_POST['det_id'],'details_id','date_exp',$val);
?>
