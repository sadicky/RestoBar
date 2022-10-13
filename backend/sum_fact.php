<?php
@session_start();
require_once '../load_model.php';
$det= new BeanDetailsOperation();
$paie = new BeanPaiement();

if(!isset($_SESSION['sum_fact'])) { $_SESSION['sum_fact']=0;}
if(!isset($_SESSION['op_id'])) {$_SESSION['op_id']=array();}

$op_id=array();
$op_id[]=$_POST['op_id'];

if(in_array($_POST['op_id'], $_SESSION['op_id'])) 
{
$_SESSION['op_id']=array_diff($_SESSION['op_id'],$op_id);
}
else
{
array_push($_SESSION['op_id'],$_POST['op_id']);
}

$max=sizeof($_SESSION['op_id']);
$sum_fact=0;
foreach ($_SESSION['op_id'] as $key => $value) {
$amount=$paie->select_sum_op($value);
$sum_fact +=($det->select_sum_op($value)-$amount['paie']);
}
$_SESSION['sum_fact']=$sum_fact;
echo number_format($sum_fact);
?>