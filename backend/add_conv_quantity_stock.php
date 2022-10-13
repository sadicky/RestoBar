<?php
@session_start();
require_once '../load_model.php';
$det = new BeanDetailsOperation();
$stock = new BeanStock();
$op=new BeanOperation();

$op->select($_SESSION["op_conv_id"]);
$op->update_one($_SESSION["op_conv_id"],'op_id','is_send',true);
$op->update_one($op->getPartyCode(),'op_id','is_paid',true);
unset($_SESSION['op_conv_id']);

?>
