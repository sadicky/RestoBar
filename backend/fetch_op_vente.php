<?php
@session_start();
require_once '../load_model.php';
$cmd = new BeanCoupon();
$det =new BeanDetailsOperation();

$_SESSION['op_vente_id']=$_POST['op_id'];

$_SESSION['cmd']=$cmd->select_last_cmd($_SESSION['op_vente_id']);

if(isset($_SESSION['cmd']) and $cmd->nb_op($_SESSION['cmd'])>=1)
{
$cmd->setOpId($_SESSION['op_vente_id']);
$_SESSION['cmd']=$cmd->insert();
}
elseif(empty($_SESSION['cmd']))
{
$cmd->setOpId($_SESSION['op_vente_id']);
$_SESSION['cmd']=$cmd->insert();
}
unset($_SESSION['lot']);
?>
