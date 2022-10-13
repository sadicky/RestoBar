<?php
@session_start();

require_once '../load_model.php';
$op = new BeanOperation();
$achat =new BeanAchats();

$op->select($_POST['op_id']);
$_SESSION['op_id']=$_POST['op_id'];
$achat->select($_POST['op_id']);
//$_SESSION['num_op']=$op->select_num($_SESSION['sup_id']);
$nb_op=$op->select_num('Approvisionnement');
$_SESSION['op_num']=$achat->getNumAchat();
?>
