<?php
@session_start();

require_once '../load_model.php';
$op = new BeanOperation();
$ent = new BeanEntreProdf();

$op->select($_POST['op_id']);
$_SESSION['op_ent_id']=$_POST['op_id'];
$ent->select($_POST['op_id']);
//$_SESSION['num_op']=$op->select_num($_SESSION['sup_id']);
$nb_op=$op->select_num('Production');
$_SESSION['ent_num']=$ent->getNumEnt();
?>
