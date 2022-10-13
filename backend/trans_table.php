<?php
@session_start();
require_once '../load_model.php';

$vente=new BeanVente();
$vente2=new BeanVente();
$det=new BeanDetailsOperation();

$vente->select($_POST["op_id"]);
$vente2->select($_SESSION["op_vente_id"]);

$m_amount=$vente->getAmount()+$vente2->getAmount();

$det->update_one($_POST["op_id"],'op_id','op_id',$_SESSION["op_vente_id"]);

$vente->update_one($_SESSION["op_vente_id"],'op_id','amount',$m_amount);

$vente->update_one($_POST["op_id"],'op_id','ass_id','0');
$vente->update_one($_POST["op_id"],'op_id','place','0');
$vente->update_one($_POST["op_id"],'op_id','amount','0');

?>
