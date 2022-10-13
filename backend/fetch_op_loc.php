<?php
@session_start();
require_once '../load_model.php';
$op = new BeanOperation();
$_SESSION['op_loc_id']=$_POST['op_id'];
$op->select($_SESSION['op_loc_id']);
$_SESSION['cust_id']=$op->getPartyCode();
?>
