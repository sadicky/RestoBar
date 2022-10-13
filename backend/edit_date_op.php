<?php

session_start();
require_once '../load_model.php';
$op = new BeanOperation();
$vente = new BeanVente();

$op->update_one($_POST['op_id'],'op_id','create_date',$_POST['date_op']);

$last_vente=$vente->select_last_num($_POST['date_op'],'Vente');
$last_num=($last_vente['num']) .'/'.date("d.m", strtotime($_POST['date_op']));

$vente->update_one($_POST['op_id'],'op_id','num_vente',$last_num);
?>
