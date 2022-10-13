<?php
session_start();
require_once '../load_model.php';
$track = new BeanPayTrack();

$track->setOpId($_POST['op_id']);
$track->setDatePay($_POST['date_pay']);
$track->update_one($_POST["op_id"],'op_id','is_paid',true);
$track->insert();
?>
