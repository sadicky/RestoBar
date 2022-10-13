<?php
@session_start();
require_once '../load_model.php';
$det= new BeanDetailsOperation();
$paie = new BeanPaiement();


if(!isset($_SESSION['list_det'])) {$_SESSION['list_det']=array();}

$cmd=array();
$cmd[]=$_POST['cmd'];

if(in_array($_POST['cmd'], $_SESSION['list_det'])) 
{
$_SESSION['list_det']=array_diff($_SESSION['list_det'],$cmd);
}
else
{
array_push($_SESSION['list_det'],$_POST['cmd']);
}

$max=sizeof($_SESSION['list_det']);
/*$sum_fact=0;
foreach ($_SESSION['op_id'] as $key => $value) {
$amount=$paie->select_sum_op($value);
$sum_fact +=($det->select_sum_op($value)-$amount['paie']);
}
$_SESSION['sum_fact']=$sum_fact;
echo number_format($sum_fact);*/
echo $max;
?>