<?php
@session_start();

require_once '../load_model.php';
$op = new BeanOperation();
$vente =new BeanVente();

$op->select($_POST['op_id']);
$_SESSION['op_vente_hist_id']=$_POST['op_id'];
$vente->select($_POST['op_id']);
//$nb_op=$op->select_num('Approvisionnement');
$_SESSION['op_vente_hist_num']=$vente->getNumVente();
?>
